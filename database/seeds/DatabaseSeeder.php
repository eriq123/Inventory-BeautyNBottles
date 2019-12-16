<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
        ['name' => 'Admin','guard_name'=>'web'], //1
        ['name' => 'Assistant','guard_name'=>'web'], //2
        ['name' => 'Employee','guard_name'=>'web'], //3
        ]);

        DB::table('users')->insert([
        ['first_name' => 'Admin','last_name'=>'Admin','username'=>'Admin','password'=>bcrypt('qweasd'),'active'=>1], //1
        ['first_name' => 'Assistant','last_name'=>'Assistant','username'=>'asst','password'=>bcrypt('qweasd'),'active'=>1], //2
        ['first_name' => 'Employee','last_name'=>'Employee','username'=>'emp','password'=>bcrypt('qweasd'),'active'=>1], //3
        ]);

        DB::table('model_has_roles')->insert([
        ['role_id'=>1,'model_type'=>'App\User','model_id'=>1],
        ['role_id'=>2,'model_type'=>'App\User','model_id'=>2],
        ['role_id'=>3,'model_type'=>'App\User','model_id'=>3],
        ]);




    }
}
