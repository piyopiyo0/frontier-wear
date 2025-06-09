<?php namespace Pilotwfc\Customfields\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class AddCustomFieldsToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('lovata_shopaholic_products', function($table)
        {
            $table->string('video')->nullable();          // Ссылка на видео
            $table->string('ibis_url')->nullable();       // Ссылка на Ibis
            $table->text('features')->nullable();         // Особенности товара
            $table->text('peculiarities')->nullable();    // Специфические характеристики
            $table->string('size')->nullable();           // Размер
            $table->string('weight')->nullable();         // Вес
            $table->string('components_dimen')->nullable(); // Габариты компонентов
            $table->string('scale')->nullable();          // Масштаб
            $table->string('warranty')->nullable();       // Гарантия
            $table->string('battery')->nullable();        // Тип батареи
            $table->string('age')->nullable();            // Возраст (выпадающий список)
            $table->string('sex')->nullable();            // Пол (выпадающий список)
        });
    }

    public function down()
    {
        Schema::table('lovata_shopaholic_products', function($table)
        {
            $table->dropColumn([
                'video', 'ibis_url', 'features', 'peculiarities',
                'size', 'weight', 'components_dimen', 'scale',
                'warranty', 'battery', 'age', 'sex'
            ]);
        });
    }
}
