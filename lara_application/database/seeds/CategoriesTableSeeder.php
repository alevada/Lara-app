<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('categories')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // create roles
        $categories = [
            ['name' => 'Category 1', 'created_at' => date('Y-m-d H:i:s')],
            ['name' => 'Category 2', 'created_at' => date('Y-m-d H:i:s')],
            ['name' => 'Category 3', 'created_at' => date('Y-m-d H:i:s')],
            ['name' => 'Category 4', 'created_at' => date('Y-m-d H:i:s')],
            ['name' => 'Category 5', 'created_at' => date('Y-m-d H:i:s')],
        ];
        DB::table('categories')->insert($categories);
    }
}
