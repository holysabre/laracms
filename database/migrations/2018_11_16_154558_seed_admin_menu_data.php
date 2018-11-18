<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedAdminMenuData extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $faker = Faker\Factory::create();
        $updated_at = $faker->dateTimeThisMonth();
        $created_at = $faker->dateTimeThisMonth($updated_at);
        $menus = [
            [
                'parent_id' => 0,
                'title' => '内容',
                'icon' => 'fa-cubes',
                'uri' => '',
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ],
            [
                'parent_id' => 0,
                'title' => '单页',
                'icon' => 'fa-file-o',
                'uri' => 'pages',
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ],
        ];
        DB::table('admin_menu')->insert($menus);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('categories')->where('id', '>', 7)->delete();
    }
}
