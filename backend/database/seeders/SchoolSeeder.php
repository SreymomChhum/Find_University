<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $school = [
            ["name" => "PNC","image" => "https://i.pinimg.com/564x/62/d7/90/62d79024b48bf9d6dc8dc7e2388b7d6e.jpg","type_education_id"=>1,"address_id"=>1],
            ["name" => "PNV","image" => "https://i.pinimg.com/564x/62/d7/90/62d79024b48bf9d6dc8dc7e2388b7d6e.jpg","type_education_id"=>1,"address_id"=>1],
        ];
        foreach($school as $school){
            School::create($school);
        }

    }
}

