<?php

namespace Database\Seeders;

use App\Models\ScholarShip;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScholarshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $scholarships = [
            ["name" => "scholarship 1", "image" => "https://i.pinimg.com/564x/1b/80/f2/1b80f2d5745bca5f4bc619c4d2a5084f.jpg","description"=> "Get 100% scholarship", "post_date" => "2023-07:07", "expired_date"=>"2023:07:08", "school_id"=>1, "skill_id"=>1],
            
        ];
        foreach($scholarships as $scholarship){
            ScholarShip::create($scholarship);
        }
    }
}
