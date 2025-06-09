<?php namespace Pilotwfc\Addslash;

use Pilotwfc\Addslash\Middleware\HandleAddSlashMiddleware;
use System\Classes\PluginBase;
use Illuminate\Contracts\Http\Kernel;
use Pilotwfc\Addslash\Middleware\AddSlashToHtmlMiddleware;
use Pilotwfc\Addslash\Middleware\RedirectAddSlashMiddleware;

class Plugin extends PluginBase
{
    public function boot()
    {
    // Регистрируем middleware для обработки входящих запросов и HTML-ответов
    $this->app[Kernel::class]->pushMiddleware(HandleAddSlashMiddleware::class);
    }

    public function pluginDetails()
    {
        return [
            'name' => 'AddSlash',
            'description' => 'Adds a trailing slash to all URLs in the HTML response and redirects to URLs with trailing slashes.',
            'author' => 'PilotWfc',
            'icon' => 'icon-leaf'
        ];
    }
}
