<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $address = [
            ["city/province" => "PhnomPenh","street" => "30B","location" => "Sangkat Boeung Tumpun, Khan Mean Chey","link" => "https://goo.gl/maps/vK1H2QD9ffouJaEw5"],
           
        ];
        foreach($address as $address){
            Address::create($address);
        }

}}
