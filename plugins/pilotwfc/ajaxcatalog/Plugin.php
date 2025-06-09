<?php namespace Pilotwfc\AjaxCatalog;

use Backend;
use System\Classes\PluginBase;

/**
 * Plugin Information File
 *
 * @link https://docs.octobercms.com/3.x/extend/system/plugins.html
 */
class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'Pilotwfc\AjaxCatalog\Components\CatalogComponent' => 'catalogComponent',
        ];
    }
    public function pluginDetails()
    {
        return [
            'name' => 'AjaxCatalog',
            'description' => 'No description provided yet...',
            'author' => 'PilotWfc',
            'icon' => 'icon-leaf'
        ];
    }

    /**
     * register method, called when the plugin is first registered.
     */
    public function register()
    {
        //
    }

    /**
     * boot method, called right before the request route.
     */
    public function boot()
    {
        //
    }

    /**
     * registerComponents used by the frontend.
     */


    /**
     * registerPermissions used by the backend.
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'pilotwfc.ajaxcatalog.some_permission' => [
                'tab' => 'AjaxCatalog',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * registerNavigation used by the backend.
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'ajaxcatalog' => [
                'label' => 'AjaxCatalog',
                'url' => Backend::url('pilotwfc/ajaxcatalog/mycontroller'),
                'icon' => 'icon-leaf',
                'permissions' => ['pilotwfc.ajaxcatalog.*'],
                'order' => 500,
            ],
        ];
    }
}
