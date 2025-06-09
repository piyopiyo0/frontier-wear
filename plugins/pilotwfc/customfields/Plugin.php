<?php namespace Pilotwfc\Customfields;

use Backend;
use Backend\Models\UserRole;
use System\Classes\PluginBase;
use Lovata\Shopaholic\Classes\Item\ProductItem;
use Lovata\Shopaholic\Models\Product;
use Event;
use System\Models\File;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name' => 'Customfields',
            'description' => 'No description provided yet...',
            'author' => 'Pilotwfc',
            'icon' => 'icon-leaf'
        ];
    }

    public function boot()
    {
        // Расширение ProductItem кастомными полями
        Event::listen('shopaholic.product.extendItem', function (ProductItem $obProductItem) {
            $obProduct = $obProductItem->getObject(); // Получаем оригинальный объект продукта

            // Добавляем кастомные методы (геттеры) для каждого поля
            if ($obProduct) {
                // Загружаем изображения для продукта
                $obProduct->load('images', 'additional_images', 'preview_image');

                $obProductItem->addDynamicProperty('images', $obProduct->images); // Добавляем отношения images в ProductItem
                $obProductItem->addDynamicProperty('additional_images', $obProduct->additional_images);
                $obProductItem->addDynamicProperty('preview_image', $obProduct->preview_image);

                // Добавляем все остальные необходимые геттеры
                $obProductItem->addDynamicMethod('getVideoAttribute', function () use ($obProduct) {
                    return $obProduct->video;
                });
                $obProductItem->addDynamicMethod('getIbisUrlAttribute', function () use ($obProduct) {
                    return $obProduct->ibis_url;
                });
                $obProductItem->addDynamicMethod('getFeaturesAttribute', function () use ($obProduct) {
                    return $obProduct->features;
                });
                $obProductItem->addDynamicMethod('getPeculiaritiesAttribute', function () use ($obProduct) {
                    return $obProduct->peculiarities;
                });
                $obProductItem->addDynamicMethod('getSizeAttribute', function () use ($obProduct) {
                    return $obProduct->size;
                });
                $obProductItem->addDynamicMethod('getWeightAttribute', function () use ($obProduct) {
                    return $obProduct->weight;
                });
                $obProductItem->addDynamicMethod('getComponentsDimenAttribute', function () use ($obProduct) {
                    return $obProduct->components_dimen;
                });
                $obProductItem->addDynamicMethod('getScaleAttribute', function () use ($obProduct) {
                    return $obProduct->scale;
                });
                $obProductItem->addDynamicMethod('getWarrantyAttribute', function () use ($obProduct) {
                    return $obProduct->warranty;
                });
                $obProductItem->addDynamicMethod('getBatteryAttribute', function () use ($obProduct) {
                    return $obProduct->battery;
                });
                $obProductItem->addDynamicMethod('getAgeAttribute', function () use ($obProduct) {
                    return $obProduct->age;
                });
                $obProductItem->addDynamicMethod('getSexAttribute', function () use ($obProduct) {
                    return $obProduct->sex;
                });
            }
        });

        // Расширяем базовую модель Product для добавления полей и связей
        Product::extend(function ($model) {
            // Добавляем дополнительные поля для заполнения
            $model->addFillable([
                'video', 'ibis_url', 'features', 'peculiarities',
                'size', 'weight', 'components_dimen', 'scale',
                'warranty', 'battery', 'age', 'sex'
            ]);

            $model->addDynamicMethod('getPreviewImageAttribute', function () use ($model) {
                return $model->preview_image()->first();
            });

            // Определяем отношения для загружаемых файлов
            $model->attachOne = array_merge($model->attachOne, [
                'file_3d' => \System\Models\File::class,
                'instructions' => \System\Models\File::class,
                'preview_image' => \System\Models\File::class,
            ]);

            $model->attachMany = array_merge($model->attachMany, [
                'images' => \System\Models\File::class,
                'additional_images' => \System\Models\File::class,
            ]);

            // Удаление пользовательских методов для удаления файлов
            // Стандартное удаление от Shopaholic будет работать автоматически
        });

        // Добавляем поля в форму редактирования продукта
        Event::listen('backend.form.extendFields', function ($widget) {
            // Проверяем, чтобы это был правильный контроллер и модель
            if (!$widget->getController() instanceof \Lovata\Shopaholic\Controllers\Products || !$widget->model instanceof Product) {
                return;
            }

            $widget->addFields([
                'video' => [
                    'label' => 'Посилання на відео',
                    'type' => 'text',
                    'tab' => 'Custom Fields'
                ],
                'ibis_url' => [
                    'label' => 'Ibis URL',
                    'type' => 'text',
                    'tab' => 'Custom Fields'
                ],
                'features' => [
                    'label' => 'Характеристики',
                    'type' => 'textarea',
                    'size' => 'large',
                    'tab' => 'Custom Fields'
                ],
                'peculiarities' => [
                    'label' => 'Особливості',
                    'type' => 'richeditor',
                    'size' => 'large',
                    'tab' => 'Custom Fields'
                ],
                'size' => [
                    'label' => 'Розмір виробу',
                    'type' => 'text',
                    'tab' => 'Custom Fields'
                ],
                'weight' => [
                    'label' => 'Вага',
                    'type' => 'text',
                    'tab' => 'Custom Fields'
                ],
                'components_dimen' => [
                    'label' => 'Розмір комплектуючих',
                    'type' => 'text',
                    'tab' => 'Custom Fields'
                ],
                'scale' => [
                    'label' => 'Масштаб',
                    'type' => 'text',
                    'tab' => 'Custom Fields'
                ],
                'warranty' => [
                    'label' => 'Гарантія',
                    'type' => 'dropdown',
                    'options' => [
                        '14_days' => '14 діб',
                        '3_months' => '3 міс',
                        '6_months' => '6 міс',
                        '1_year' => '1 рік'
                    ],
                    'tab' => 'Custom Fields'
                ],
                'battery' => [
                    'label' => 'Формат батарейок',
                    'type' => 'dropdown',
                    'options' => [
                        'none' => 'Нет',
                        'AA' => 'AA',
                        'AAA' => 'AAA',
                        'rechargeable' => 'Перезаряжаемая'
                    ],
                    'tab' => 'Custom Fields'
                ],
                'age' => [
                    'label' => 'Вік',
                    'type' => 'dropdown',
                    'options' => [
                        '3-5' => '3-5 років',
                        '6-9' => '6-9 років',
                        '10-12' => '10-12 років'
                    ],
                    'tab' => 'Custom Fields'
                ],
                'sex' => [
                    'label' => 'Стать',
                    'type' => 'dropdown',
                    'options' => [
                        'male' => 'Для хлопчиків',
                        'female' => 'Для дівчаток',
                        'unisex' => 'Унісекс'
                    ],
                    'tab' => 'Custom Fields'
                ],
                'file_3d' => [
                    'label' => '3D файл',
                    'type' => 'fileupload',
                    'mode' => 'file',
                    'tab' => 'Custom Fields'
                ],
                'instructions' => [
                    'label' => 'Інструкція',
                    'type' => 'fileupload',
                    'mode' => 'file',
                    'tab' => 'Custom Fields'
                ]
            ], 'primary');
        });
    }

    public function registerComponents()
    {
        return [
            'Pilotwfc\Customfields\Components\ProductDetails' => 'productDetails'
        ];
    }
}
