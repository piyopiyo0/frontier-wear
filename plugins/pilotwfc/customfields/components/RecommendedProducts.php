<?php namespace Pilotwfc\Customfields\Components;

use Cms\Classes\ComponentBase;
use Lovata\Shopaholic\Classes\Collection\ProductCollection;
use Lovata\Shopaholic\Models\Product;

class RecommendedProducts extends ComponentBase
{
    public $recommendedProducts;

    public function componentDetails()
    {
        return [
            'name'        => 'Recommended Products',
            'description' => 'Displays recommended products from the current category.'
        ];
    }

    public function defineProperties()
    {
        return [
            'categoryId' => [
                'title'       => 'Category ID',
                'description' => 'ID of the category to pull recommended products from.',
                'type'        => 'string',
                'default'     => '{{ :category }}'
            ],
            'limit' => [
                'title'       => 'Limit',
                'description' => 'Number of products to show.',
                'type'        => 'string',
                'default'     => '4'
            ]
        ];
    }

    public function onRun()
    {
        $categoryId = $this->property('categoryId');
        $limit = $this->property('limit');

        if ($categoryId) {
            $this->recommendedProducts = ProductCollection::make()
                ->category($categoryId)
                ->active()
                ->take($limit);
        } else {
            $this->recommendedProducts = collect(); // Пустая коллекция, если категория не найдена
        }

        $this->page['recommendedProducts'] = $this->recommendedProducts;
    }
}
