<?php namespace Pilotwfc\WebpGenerator;

use Backend;
use System\Classes\PluginBase;

/**
 * Plugin Information File
 *
 * @link https://docs.octobercms.com/3.x/extend/system/plugins.html
 */
class Plugin extends PluginBase
{
    /**
     * pluginDetails about this plugin.
     */
    public function pluginDetails()
    {
        return [
            'name' => 'WebpGenerator',
            'description' => 'No description provided yet...',
            'author' => 'Pilotwfc',
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
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'Pilotwfc\WebpGenerator\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * registerPermissions used by the backend.
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'pilotwfc.webpgenerator.some_permission' => [
                'tab' => 'WebpGenerator',
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
            'webpgenerator' => [
                'label' => 'WebpGenerator',
                'url' => Backend::url('pilotwfc/webpgenerator/mycontroller'),
                'icon' => 'icon-leaf',
                'permissions' => ['pilotwfc.webpgenerator.*'],
                'order' => 500,
            ],
        ];
    }
}
