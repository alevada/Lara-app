<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('posts')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $publisher_id = DB::table('user_roles')->select('id')->where('slug', 'publisher')->first()->id;  

        $posts = [];
        for ($i=1; $i<30; $i++) {
            array_push($posts, [
                'title' => 'My post '.$i,
                'content' => 'Lorem ipsum',
                'author_id' => \App\User::where('role_id', $publisher_id)->orderByRaw('RAND()')->first()->id,
                'category_id' => \App\Category::orderByRaw('RAND()')->first()->id,
                'created_at' => date('Y-m-d H:i:s'), 
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }

        DB::table('posts')->insert($posts);
    }
}
