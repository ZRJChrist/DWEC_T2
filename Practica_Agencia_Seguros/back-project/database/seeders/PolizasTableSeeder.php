<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PolizasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('polizas')->insert([
            [
                'cliente_id' => 1,
                'numero' => '000123',
                'importe' => 1000.00,
                'fecha' => '2024-02-05',
                'estado' => 'Cobrada',
            ],
            [
                'cliente_id' => 2,
                'numero' => '000456',
                'importe' => 1500.50,
                'fecha' => '2024-01-15',
                'estado' => 'Prepagado',
            ],
            [
                'cliente_id' => 3,
                'numero' => '000678',
                'importe' => 1200.50,
                'fecha' => '2024-01-10',
                'estado' => 'Liquidada',
            ],
            [
                'cliente_id' => 4,
                'numero' => '000876',
                'importe' => 1150.99,
                'fecha' => '2024-02-01',
                'estado' => 'Liquidada',
            ],
        ]);
    }
}
