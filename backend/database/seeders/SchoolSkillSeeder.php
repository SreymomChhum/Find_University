<?php

namespace Database\Seeders;

use App\Models\SchoolSkill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class SchoolSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $school_skill = [
            ["school_id"=>1, "skill_id"=>1]
           
        ];
        foreach($school_skill as $ss){
            SchoolSkill::create($ss);
        }
    }
}
