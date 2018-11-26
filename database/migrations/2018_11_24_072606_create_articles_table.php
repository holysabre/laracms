<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->default(0)->comment('分类id');
            $table->string('title')->comment('标题');
            $table->text('content')->comment('内容');
            $table->string('excerpt')->nullable()->comment('摘要');
            $table->string('picture')->nullable()->comment('图片');
            $table->text('picture_set')->nullable()->comment('图片集');
            $table->string('author')->nullable()->comment('作者');
            $table->string('source')->nullable()->comment('来源');
            $table->integer('click_count')->default(0)->comment('点击数');
            $table->string('slug')->nullable()->comment('静态名');
            $table->integer('order')->default(0)->comment('排序');
            $table->tinyInteger('status')->default(1)->comment('状态');
            $table->tinyInteger('attribute')->default(0)->comment('属性(0：默认，1：推荐，2：热门，3：置顶)');
            $table->string('seo_title')->nullable()->comment('SEO标题');
            $table->string('seo_keywords')->nullable()->comment('SEO关键词');
            $table->text('seo_description')->nullable()->comment('SEO描述');
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
        Schema::dropIfExists('articles');
    }
}
