<?php

namespace Pilotwfc\Addslash\Middleware;

use Closure;
use Illuminate\Http\Request;

class HandleAddSlashMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Skip backend/admin requests
        if ($this->isBackendRequest($request)) {
            return $next($request);
        }

        $path = $request->getPathInfo();
        $originalUrl = $request->fullUrl();

        // Remove multiple trailing slashes but keep a single one at the end
        $cleanPath = preg_replace('#/{2,}#', '/', rtrim($path, '/') . '/');

        // Check if redirection is actually needed
        if ($path !== $cleanPath) {
            $newUrl = $request->getSchemeAndHttpHost() . $request->getBaseUrl() . $cleanPath;

            if ($request->getQueryString()) {
                $newUrl .= '?' . $request->getQueryString();
            }

            // Prevent unnecessary redirects
            if ($originalUrl !== $newUrl) {
                return redirect($newUrl, 301);
            }
        }

        // Process the next middleware
        $response = $next($request);

        // Modify HTML content if necessary
        if ($response->headers->get('Content-Type') !== null && strpos($response->headers->get('Content-Type'), 'text/html') !== false) {
            $content = $response->getContent();

            // Fix multiple slashes in links
            $content = preg_replace_callback('/(href|src)="([^"]+)"/', function ($matches) {
                $attribute = $matches[1];
                $url = $matches[2];

                if (preg_match('#^https?://#', $url) || substr($url, 0, 2) === '//') {
                    return $matches[0]; // Skip absolute URLs
                }

                // Normalize slashes
                $url = preg_replace('#/{2,}#', '/', rtrim($url, '/') . '/');

                return $attribute . '="' . $url . '"';
            }, $content);

            $response->setContent($content);
        }

        return $response;
    }

    /**
     * Checks if the request is for the backend.
     *
     * @param Request $request
     * @return bool
     */
    protected function isBackendRequest(Request $request)
    {
        $backendPrefixes = ['backend', 'admin', 'admin_otamanko'];
        foreach ($backendPrefixes as $prefix) {
            if (strpos(trim($request->path(), '/'), $prefix) === 0) {
                return true;
            }
        }
        return false;
    }
}
