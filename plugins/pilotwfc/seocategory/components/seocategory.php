<?php namespace Pilotwfc\Seocategory\Components;

use Cms\Classes\ComponentBase;

class CustomFields extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'SeoCategory',
            'description' => 'Описание компонента'
        ];
    }

    public function defineProperties()
    {
        return [];
    }
}
