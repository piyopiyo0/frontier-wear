<?php

namespace Pilotwfc\Addslash\Middleware;

use Closure;

class AddSlashToHtmlMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Проверяем, что ответ имеет тип HTML
        if (strpos($response->headers->get('Content-Type'), 'text/html') !== false) {
            $content = $response->getContent();

            // Добавляем слэш в конце всех ссылок
            $content = preg_replace_callback('/href="([^"]+)"/', function ($matches) {
                $url = $matches[1];

                // 1) Исключаем стили и скрипты
                if (preg_match('/\.(?:css|js)(?:$|\?)/i', $url)) {
                    return 'href="' . $url . '"';
                }

                // 2) Только ссылки без слэша, без прочих расширений и без пагинации
                if (substr($url, -1) !== '/'
                    && !preg_match('/\.[a-zA-Z0-9]{2,4}$/', $url)
                    && strpos($url, 'page=') === false) {

                    $url .= '/';
                }

                return 'href="' . $url . '"';
            }, $content);


            // Устанавливаем измененное содержимое в ответ
            $response->setContent($content);
        }

        return $response;
    }
}
