<?php

namespace Database\Seeders;

use App\Models\TypeEducation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeEducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $typeeducation = [
            ["name" => "organization"],
            ["name" => "university"]
        ];
        foreach($typeeducation as $type){
            TypeEducation::create($type);
        }
    }
}
