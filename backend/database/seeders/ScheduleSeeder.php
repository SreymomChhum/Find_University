<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schedules = [
            ["name" => "schedule 1", "description" => "Enjoy your schedule", "start_time" => "2023-07-09 14:30:00", "end_time"=>"2023-07-10 14:30:00", "school_id"=>1],
            
        ];
        foreach($schedules as $schedule){
            Schedule::create($schedule);
        }
    }
}
