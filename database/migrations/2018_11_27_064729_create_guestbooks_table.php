<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guestbooks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->default(0)->comment('栏目id');
            $table->string('title')->nullable()->comment('标题');
            $table->text('content')->comment('内容');
            $table->string('name')->comment('姓名');
            $table->string('mobile')->comment('手机号码');
            $table->string('email')->nullable()->comment('邮箱');
            $table->string('address')->nullable()->comment('地址');
            $table->string('ip')->nullable()->comment('IP地址');
            $table->text('extra')->nullable()->comment('其他信息');
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
        Schema::dropIfExists('guestbooks');
    }
}
