<?php namespace Pilotwfc\Customfields\Extend;

use Lovata\Shopaholic\Models\Product;

// Расширяем модель Product
Product::extend(function ($model) {
    $model->addDynamicMethod('import_file', function($value) {
        // Здесь реализуем обработку файла или просто возвращаем путь для CSV импорта
        return $value;
    });
});
