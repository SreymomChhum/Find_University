<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = [
            ["name" => "student"],
            ["name" => "university"],
            ["name" => "admin"]
        ];
        foreach($role as $role){
            Role::create($role);
        }
    }
}
