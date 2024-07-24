<?php

namespace Database\Seeders;

use App\Models\SituacaoConta;
use Illuminate\Database\Seeder;

class SituacaoContaSeeder extends Seeder
{
    public function run(): void
    {
        if (!SituacaoConta::where('nome', 'paga')->first()) {
            SituacaoConta::create([
                'nome' => 'paga',
                'cor' => 'success',
            ]);
        }
        if (!SituacaoConta::where('nome', 'atrasada')->first()) {
            SituacaoConta::create([
                'nome' => 'atrasada',
                'cor' => 'danger',
            ]);
        }
        if (!SituacaoConta::where('nome', 'pendente')->first()) {
            SituacaoConta::create([
                'nome' => 'pendente',
                'cor' => 'warning',
            ]);
        }

    }
}
