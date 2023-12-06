<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            ["name" => "IT","description" => "This is about science" ,"image" => "https://img.freepik.com/free-vector/illustration-social-media-concept_53876-18139.jpg"],
        ];
        foreach($skills as $skill){
            Skill::create($skill);
        }
    }
}
