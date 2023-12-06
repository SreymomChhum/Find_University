<?php

namespace Database\Seeders;

use App\Models\ScholarshipUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScholarshipUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $scholarshipusers = [
            ["user_id" => 1, "scholarship_id"=>1,"Pass"=>1]
        ];
        foreach($scholarshipusers as $scholarshipuser){
            ScholarshipUser::create($scholarshipuser);
        }
    }
}
