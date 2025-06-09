<?php

namespace Pilotwfc\Addslash\Middleware;

use Closure;
use Illuminate\Http\Request;

class AppendSlashMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Получаем текущий путь
        $path = $request->getPathInfo();

        // Проверяем, что путь не корневой, не заканчивается на слэш, это GET запрос, и нет расширения файла
        if ($path !== '/' && substr($path, -1) !== '/' && $request->isMethod('get') && !preg_match('/\.[a-zA-Z0-9]{2,4}$/', $path)) {
            // Добавляем слэш в конец пути
            $newUrl = $request->getSchemeAndHttpHost() . $request->getBaseUrl() . $path . '/';

            // Сохраняем параметры запроса, если они есть
            if ($request->getQueryString()) {
                $newUrl .= '?' . $request->getQueryString();
            }

            // Проверяем, не пытаемся ли мы перенаправить на тот же URL снова
            if ($request->fullUrl() !== $newUrl) {
                return redirect($newUrl, 301);
            }
        }

        return $next($request);
    }
}
