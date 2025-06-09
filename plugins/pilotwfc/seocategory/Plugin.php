<?php namespace Pilotwfc\Seocategory;

use Event;
use Lovata\Shopaholic\Models\Category;
use Lovata\Shopaholic\Controllers\Categories;
use Backend;
use Backend\Models\UserRole;
use System\Classes\PluginBase;

/**
 * Seocategory Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'pilotwfc.seocategory::lang.plugin.name',
            'description' => 'pilotwfc.seocategory::lang.plugin.description',
            'author'      => 'Pilotwfc',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     */
    public function boot()
    {
        Category::extend(function ($model) {
            $model->addFillable(['seo_title', 'seo_description', 'seo_add']);
        });

        Event::listen('backend.form.extendFields', function ($widget) {
            if (!$widget->model instanceof Category) return;
            if (!$widget->isNested) {
                $widget->addTabFields([
                    'seo_title' => [
                        'label'   => 'SEO Title',
                        'tab'     => 'SEO',
                        'type'    => 'text'
                    ],
                    'seo_description' => [
                        'label'   => 'SEO Description',
                        'tab'     => 'SEO',
                        'type'    => 'textarea'
                    ],
                    'seo_add' => [
                        'label'   => 'Additional SEO Content',
                        'tab'     => 'SEO',
                        'type'    => 'textarea'
                    ],
                ]);
            }
        });

        \Lovata\Shopaholic\Classes\Item\CategoryItem::extend(function ($item) {
            $item->addDynamicMethod('getSeoTitleAttribute', function () use ($item) {
                $model = \Lovata\Shopaholic\Models\Category::find($item->id);
                return $model ? $model->seo_title : null;
            });

            $item->addDynamicMethod('getSeoDescriptionAttribute', function () use ($item) {
                $model = \Lovata\Shopaholic\Models\Category::find($item->id);
                return $model ? $model->seo_description : null;
            });
        });
    }

    /**
     * Registers any frontend components implemented in this plugin.
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate
    }

    /**
     * Registers any backend permissions used by this plugin.
     */
    public function registerPermissions()
    {
        return [
            'pilotwfc.seocategory.some_permission' => [
                'tab' => 'pilotwfc.seocategory::lang.plugin.name',
                'label' => 'pilotwfc.seocategory::lang.permissions.some_permission',
                'roles' => [UserRole::CODE_DEVELOPER, UserRole::CODE_PUBLISHER],
            ],
        ];
    }

    /**
     * Registers backend navigation items for this plugin.
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate
    }
}
