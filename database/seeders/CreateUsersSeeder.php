<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = [
            [
               'name'=>'Admin User',
               'email'=>'admin@ecitizen.com',
               'type'=>1,
               'status' => 'yes',
               'password'=> bcrypt('drc.123'),
            ],
            [
               'name'=>'Nonresident User',
               'email'=>'nonresident@ecitizen.com',
               'type'=> 2,
               'status' => 'yes',
               'password'=> bcrypt('drc.123'),
            ],
            [
               'name'=>'Citizen User',
               'email'=>'citizen@ecitizen.com',
               'type'=>0,
               'status' => 'yes',
               'password'=> bcrypt('drc.123'),
            ],
            [
                'name'=>'Business User',
                'email'=>'business@ecitizen.com',
                'type'=>3,
                'status' => 'yes',
                'password'=> bcrypt('drc.123'),
             ],
             [
                'name'=>'Organization User',
                'email'=>'org@ecitizen.com',
                'type'=>4,
                'status' => 'yes',
                'password'=> bcrypt('drc.123'),
             ],
        ];
    
        foreach ($users as $key => $user) {
            User::create($user);
        }
    }

}