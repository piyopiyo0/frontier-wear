<?php

namespace Pilotwfc\Seocategory\Models;

use Lovata\Shopaholic\Models\Category as BaseProduct;


class Category extends BaseProduct
{
    protected $fillable = [
        'seo_title',
        'seo_description',
        'seo_add',
    ];
}
