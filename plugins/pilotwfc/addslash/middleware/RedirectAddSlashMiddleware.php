<?php

namespace Pilotwfc\Addslash\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectAddSlashMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $path  = $request->getPathInfo();
        $query = $request->getQueryString();

        // 1) Пропускаем сразу все пути к .css и .js (чтобы не добавлять и не редиректить /style.css/ или /app.js/)
        if (preg_match('/\.(?:css|js)(?:\/|$)/i', $path)) {
            return $next($request);
        }

        // 2) Проверяем – не корневой ли это путь, нет ли в конце слэша,
        //    это GET-запрос и путь не заканчивается на любое расширение (чтобы не трогать .png, .pdf и т.п.)
        if (
            $path !== '/' &&
            substr($path, -1) !== '/' &&
            $request->isMethod('get') &&
            !preg_match('/\.[a-zA-Z0-9]{2,4}$/', $path)
        ) {
            // 3) Исключаем пагинацию (?page=)
            if (stripos($query, 'page=') === false) {
                // Собираем новый URL с добавленным слэшем
                $newUrl = $request->getSchemeAndHttpHost()
                    . $request->getBaseUrl()
                    . $path
                    . '/';

                // Добавляем query-параметры, если они есть
                if ($query) {
                    $newUrl .= '?' . $query;
                }

                // Редиректим, если URL реально отличается
                if ($request->fullUrl() !== $newUrl) {
                    return redirect($newUrl, 301);
                }
            }
        }

        return $next($request);
    }
}
