<?php namespace Pilotwfc\Customfields\Components;

use Cms\Classes\ComponentBase;
use Pilotwfc\Customfields\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductPage extends ComponentBase
{
    public $product;

    public function componentDetails()
    {
        return [
            'name'        => 'Product Page',
            'description' => 'Displays product details by ID'
        ];
    }

    public function defineProperties()
    {
        return [
            'id' => [
                'title'       => 'Product ID',
                'description' => 'The ID of the product to display',
                'type'        => 'string',
                'default'     => '{{ :id }}',
                'required'    => true
            ]
        ];
    }

    public function onRun()
    {
        $id = $this->property('id');
        Log::info('Product ID received: ' . $id);

        // Получаем продукт по ID
        $this->product = Product::find($id);

        if ($this->product) {
            Log::info('Product found: ' . $this->product->name);
        } else {
            Log::error('Product not found with ID: ' . $id);
        }

        // Передаем продукт в шаблон
        $this->page['obProduct'] = $this->product;
    }
}
