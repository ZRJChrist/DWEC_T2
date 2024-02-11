<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customer')->insert([
            ['name' => 'Juana Vaquero Cuesta', 'email' => 'juana@hotmail.com', 'phone' => '739564864', 'city' => 'Camós', 'postal_code' => '17843', 'province_id' => 17, 'type' => 1],
            ['name' => 'Nayara Rosa Hidalgo', 'email' => 'nayara@gmail.com', 'phone' => '742412314', 'city' => 'Villar Del Olmo', 'postal_code' => '54321', 'province_id' => 28, 'type' => 0],
            ['name' => 'Esperanza Rubio Heredia', 'email' => 'rubio@yahoo.com', 'phone' => '624688256', 'city' => 'Alameda De La Sagra', 'postal_code' => '45991', 'province_id' => 45, 'type' => 0],
            ['name' => 'Bruno Saiz Singh', 'email' => 'brunoss@gmail.com', 'phone' => '620491198', 'city' => 'Torres De Albarracín', 'postal_code' => '44418', 'province_id' => 44, 'type' => 0],
            ['nombre' => 'Juan Ignacio Mendez Paz', 'email' => 'juanim@hotmail.com', 'phone' => '711604438', 'city' => 'Sant Jaume De Llierca', 'postal_code' => '17934', 'province_id' => 17, 'type' => 1],
        ]);
    }
}
