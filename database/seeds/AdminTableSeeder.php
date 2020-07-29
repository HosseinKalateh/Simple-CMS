<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->insertDefaultAdmin();
    }

    //insert default admin
    public function insertDefaultAdmin()
    {
        //check that admins table be empty
        $adminExists = DB::table('admins')->count();
        if (!$adminExists) {
            DB::table('admins')->insert([
               'first_name' => 'super',
               'last_name'  => 'admin',
               'email'      => 'admin@gmail.com',
               'password'   => Hash::make('admin@123'),
               'created_at' => Carbon::now()
            ]);
        }
    }
}
