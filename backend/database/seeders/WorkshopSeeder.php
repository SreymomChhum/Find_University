<?php

namespace Database\Seeders;

use App\Models\WorkShop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkshopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $workshops = [
            ["name" => "Design",
            "image" => "https://i.pinimg.com/564x/1b/80/f2/1b80f2d5745bca5f4bc619c4d2a5084f.jpg",
             "address_id"=>1,
             "school_id"=>1,
             "description"=>"Join us",
             "start_date"=>"2023-09-09",
             "expired_date"=>"2023-09-12",
             "time"=>"09:30:00",]  
        ];
        foreach($workshops as $workshop){
            WorkShop::create($workshop);
        }
    }
}
