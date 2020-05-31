<?php
//use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role' 	            =>	'Administrador',
            'user' 	            =>	'1088008382',
            'name' 	            =>	'Carlos Eduardo Hincapie Hidalgo',
            'password'	        =>  hash("SHA256",'12345'),
        ]);
    }
}
