<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\TypeEducation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(TypeEducationSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(AddressSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SkillSeeder::class);
        $this->call(SchoolSeeder::class);
        $this->call(SchoolSkillSeeder::class);
        $this->call(SubjectSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(ScheduleSeeder::class);
        $this->call(ScholarshipSeeder::class);
        $this->call(ScholarshipUserSeeder::class);
        $this->call(SkillSubjectSeeder::class);
        $this->call(WorkshopSeeder::class);
        $this->call(WorkShopUserSeeder::class);

        













   





    }
}
