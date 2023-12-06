<?php

namespace Database\Seeders;

use App\Models\SkillSubject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skillsubjects = [
            ["skill_id" =>1, "subject_id"=>1],
            
        ];
        foreach($skillsubjects as $skillsubject){
            SkillSubject::create($skillsubject);
        }
    }
}
