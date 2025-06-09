<?php namespace Your\Plugin\Components;

use Cms\Classes\ComponentBase;
use Session;

class GameResults extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Game Results',
            'description' => 'Збереження результатів гри'
        ];
    }

    public function onSaveScore()
    {
        $score = post('score');
        if (is_numeric($score)) {
            Session::put('real_score', (int) $score);
        }
    }

    public function onFormSubmit()
    {
        $score = Session::get('real_score', 0); // <- Тут достовірний результат
        $name = post('name');
        $phone = post('phone');
        $email = post('email');

        // Тут можна зберігати результат у базу або надсилати email

        return ['#formMessage' => 'Результат збережено!'];
    }
}
