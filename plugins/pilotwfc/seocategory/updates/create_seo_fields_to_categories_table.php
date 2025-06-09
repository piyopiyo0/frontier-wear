<?php namespace Pilotwfc\Seocategory\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateSeoFieldsToCategoriesTable extends Migration
{
    public function up()
    {
        Schema::table('lovata_shopaholic_categories', function (Blueprint $table) {
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->text('seo_add')->nullable();
        });
    }

    public function down()
    {
        Schema::table('lovata_shopaholic_categories', function (Blueprint $table) {
            $table->dropColumn(['seo_title', 'seo_description', 'seo_add']);
        });
    }
}
