<?php

namespace Database\Seeders;

use App\Models\WorkshopUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkShopUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $workshop_user = [
            ["user_id" => 1,
            
             "workshop_id"=>1]  
        ];
        foreach($workshop_user as $theworkshop){
            WorkshopUser::create($theworkshop);
        }
    }
}
