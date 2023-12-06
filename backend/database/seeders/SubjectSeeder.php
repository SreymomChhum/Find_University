<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\Subjects;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            ["name" => "Math"],
            ["name" => "Physics"],
            ["name" => "Chemistry"],
            ["name" => "English"],
        ];
        foreach($subjects as $subject){
            Subject::create($subject);
        }
    }
}
