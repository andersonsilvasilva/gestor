<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // admin
        DB::table('users')->insert([
            'department_id' => 1,   // Administração
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('Aa123456'),
            'role' => 'admin',
            'permissions' => '["admin"]',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // admin details
        DB::table('user_details')->insert([
            'user_id' => 1,
            'endereco' => 'Rua Ivan Rodrigues Arrais, s/n',
            'bairro' => 'Coxipo da ponte',
            'cep' => '78085-055',
            'cidade' => 'Cuiabá',
            'telefone' => '(65)99221-8155',
            'cns' => '00000000000000000000',
            'cbo' => '000000',
            'comentario' => '',
            'data_nascimento' => '1986-02-15',
            'salario' => 4000.00,
            'admission_date' => '2024-11-16',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // admin department
        DB::table('departments')->insert([
            'name' => 'Administração',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // recursos humanos
        DB::table('departments')->insert([
            'name' => 'Recursos Humanos',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
