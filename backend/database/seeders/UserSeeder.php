<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ["name" => "TheJay","email" => "mkt@gmail.com","password" => "mk3A1123*","gender" => true, "role_id" => 1, "address_id"=>1],
        ];
        
        foreach($users as $users){
            User::create($users);
        }
    }
}
