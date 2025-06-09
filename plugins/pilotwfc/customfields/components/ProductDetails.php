<?php namespace Pilotwfc\Customfields\Components;

use Cms\Classes\ComponentBase;
use Pilotwfc\Customfields\Models\Product;

class ProductDetails extends ComponentBase
{
    public $product;

    public function componentDetails()
    {
        return [
            'name'        => 'Product Details',
            'description' => 'Displays product details including custom fields'
        ];
    }

    public function defineProperties()
    {
        return [
            'productSlug' => [
                'title'       => 'Product Slug',
                'description' => 'The slug of the product to display',
                'type'        => 'string',
                'default'     => '{{ :id }}' // Здесь используется :id, но по сути это slug
            ]
        ];
    }

    public function onRun()
    {
        $slug = $this->property('productSlug'); // Получаем slug из параметра URL

        // Ищем продукт по slug
        $this->product = Product::where('slug', $slug)->first();

        if ($this->product) {
            // Загружаем отношения
            $this->product->load('file_3d', 'instructions', 'preview_image', 'images');
        } else {
            \Log::error('Product not found with slug: ' . $slug);
        }

        // Передаем продукт в шаблон
        $this->page['obProduct'] = $this->product;
    }


}

