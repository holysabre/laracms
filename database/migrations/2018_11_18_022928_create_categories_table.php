<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0)->comment('父ID');
            $table->string('name')->comment('名称');
            $table->integer('order')->default(0)->comment('排序');
            $table->string('alias')->nullbale()->comment('别名');
            $table->string('icon')->nullbale()->comment('图标');
            $table->string('image')->nullable()->comment('图片');
            $table->string('link')->nullable()->comment('链接');
            $table->string('seo_title')->nullable()->comment('SEO标题');
            $table->string('seo_keywords')->nullable()->comment('SEO关键词');
            $table->text('seo_description')->nullable()->comment('SEO描述');
            $table->string('index_template')->nullable()->comment('首页模版');
            $table->string('detail_template')->nullable()->comment('详情模版');
            $table->tinyInteger('status')->default(1)->comment('状态');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
