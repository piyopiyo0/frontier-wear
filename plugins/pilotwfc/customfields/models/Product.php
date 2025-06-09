<?php namespace Pilotwfc\Customfields\Models;

use Lovata\Shopaholic\Models\Product as BaseProduct;

class Product extends BaseProduct
{
    public $attachOne = [
        'file_3d' => \System\Models\File::class,
        'instructions' => 'System\Models\File',
        'preview_image' => 'System\Models\File',
    ];

    public $attachMany = [
        'images' => 'System\Models\File',
        'additional_images' => 'System\Models\File',
    ];

    public $fillable = [
        'video', 'ibis_url', 'features', 'peculiarities', 'size', 'weight',
        'components_dimen', 'scale', 'warranty', 'battery', 'age', 'sex'
    ];
}
