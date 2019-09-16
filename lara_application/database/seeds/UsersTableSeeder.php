<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
    	DB::table('user_roles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // create roles
        $user_roles = [
            ['slug' => 'admin', 'name' => 'Admin', 'created_at' => date('Y-m-d H:i:s')],
            ['slug' => 'publisher', 'name' => 'Publisher', 'created_at' => date('Y-m-d H:i:s')]
        ];
        DB::table('user_roles')->insert($user_roles);

        $admin_id = DB::table('user_roles')->select('id')->where('slug', 'admin')->first()->id;  
        $publisher = DB::table('user_roles')->select('id')->where('slug', 'publisher')->first()->id;  

        // create users with attached roles
        $users = [
            ['role_id' => $admin_id, 'first_name' => 'John', 'last_name' => 'Doe', 'email' => 'admin@admin.com', 'password' => bcrypt('admin'), 'created_at' => date('Y-m-d H:i:s')],
            ['role_id' => $publisher, 'first_name' => 'Jane', 'last_name' => 'Doe', 'email' => 'jane@example.com', 'password' => bcrypt('12345678'), 'created_at' => date('Y-m-d H:i:s')],
            ['role_id' => $publisher, 'first_name' => 'Publisher', 'last_name' => 'One', 'email' => 'publisher_one@example.com', 'password' => bcrypt('12345678'), 'created_at' => date('Y-m-d H:i:s')],
            ['role_id' => $publisher, 'first_name' => 'Pulisher', 'last_name' => 'Two', 'email' => 'publisher_two@example.com', 'password' => bcrypt('12345678'), 'created_at' => date('Y-m-d H:i:s')],
        ];
        DB::table('users')->insert($users);

        // create posts with attached publishers (users)
    }
}
