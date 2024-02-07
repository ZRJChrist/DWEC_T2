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
        DB::table('clientes')->insert([
            ['nombre' => 'Juana Vaquero Cuesta', 'email' => 'juana@hotmail.com', 'telefono' => '739564864', 'localidad' => 'Camós', 'codigoPostal' => '17843', 'provincia_id' => 17, 'tipo' => 1],
            ['nombre' => 'Nayara Rosa Hidalgo', 'email' => 'nayara@gmail.com', 'telefono' => '742412314', 'localidad' => 'Villar Del Olmo', 'codigoPostal' => '54321', 'provincia_id' => 28, 'tipo' => 0],
            ['nombre' => 'Esperanza Rubio Heredia', 'email' => 'rubio@yahoo.com', 'telefono' => '624688256', 'localidad' => 'Alameda De La Sagra', 'codigoPostal' => '45991', 'provincia_id' => 45, 'tipo' => 0],
            ['nombre' => 'Bruno Saiz Singh', 'email' => 'brunoss@gmail.com', 'telefono' => '620491198', 'localidad' => 'Torres De Albarracín', 'codigoPostal' => '44418', 'provincia_id' => 44, 'tipo' => 0],
            ['nombre' => 'Juan Ignacio Mendez Paz', 'email' => 'juanim@hotmail.com', 'telefono' => '711604438', 'localidad' => 'Sant Jaume De Llierca', 'codigoPostal' => '17934', 'provincia_id' => 17, 'tipo' => 1],
        ]);
    }
}
