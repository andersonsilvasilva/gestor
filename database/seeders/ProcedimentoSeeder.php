<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProcedimentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('procediments')->insert([
            'codigo' => '0301040079',    // Acolhimento
            'name' => 'Acolhimento',
            'ativo' => 1,
            'tipo_relate' =>'ave',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
