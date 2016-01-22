<?php

use Illuminate\Database\Seeder;
use \App\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'1',
            'email'=>'1@1.c',
            'password'=>Hash::make('123123'),
            'points'=>100000,
            'is_admin'=>false
        ]);
        User::create([
            'name'=>'2',
            'email'=>'2@1.c',
            'password'=>Hash::make('123123'),
            'points'=>100000,
            'is_admin'=>false
        ]);
        User::create([
            'name'=>'3',
            'email'=>'3@1.c',
            'password'=>Hash::make('123123'),
            'points'=>100000,
            'is_admin'=>false
        ]);
        User::create([
            'name'=>'4',
            'email'=>'4@1.c',
            'password'=>Hash::make('123123'),
            'points'=>100000,
            'is_admin'=>false
        ]);
        User::create([
            'name'=>'1',
            'email'=>'2@2.com',
            'password'=>Hash::make('123123'),
            'points'=>100000,
            'is_admin'=>true
        ]);
        User::create([
            'name'=>'1',
            'email'=>'3@3.com',
            'password'=>Hash::make('123123'),
            'points'=>100000,
            'is_reception'=>true
        ]);
    }
}
