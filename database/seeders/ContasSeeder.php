<?php

namespace Database\Seeders;

use App\Models\Conta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!Conta::where('nome', 'luz')->first()){
            Conta::create([
                'nome' => 'luz',
                'valor' => '147.52',
                'vencimento' => '2024-07-31',
            ]);
        }

        if (!Conta::where('nome', 'internet')->first()){
            Conta::create([
                'nome' => 'internet',
                'valor' => '110.00',
                'vencimento' => '2024-07-15',
            ]);
        }
    }
}
