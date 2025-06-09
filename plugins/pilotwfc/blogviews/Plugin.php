<?php namespace PilotWfc\BlogViews;

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
            'name' => 'BlogViews',
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
    public function registerComponents()
    {
        return [
            'PilotWfc\BlogViews\Components\ViewCounter' => 'viewCounter',
        ];
    }

    /**
     * registerPermissions used by the backend.
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'pilotwfc.blogviews.some_permission' => [
                'tab' => 'BlogViews',
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
            'blogviews' => [
                'label' => 'BlogViews',
                'url' => Backend::url('pilotwfc/blogviews/mycontroller'),
                'icon' => 'icon-leaf',
                'permissions' => ['pilotwfc.blogviews.*'],
                'order' => 500,
            ],
        ];
    }
}
