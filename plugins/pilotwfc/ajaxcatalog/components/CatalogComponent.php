<?php

namespace Pilotwfc\AjaxCatalog\Components;

use Cms\Classes\ComponentBase;
use Lovata\Shopaholic\Models\Category;

class CatalogComponent extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Catalog Component',
            'description' => 'Загружает категории каталога через AJAX'
        ];
    }

    public function onLoadCategories()
    {
        // Метод, который будет загружать категории через AJAX
        return ['categories' => $this->loadCategories()];
    }

    protected function loadCategories()
    {
        // Получение активных категорий
        return Category::isActive()->get();
    }
}
