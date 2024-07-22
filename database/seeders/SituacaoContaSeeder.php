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
        if (!SituacaoConta::where('nome', 'pendente')->first()) {
            SituacaoConta::create([
                'nome' => 'pendente',
                'cor' => 'danger',
            ]);
        }
        if (!SituacaoConta::where('nome', 'A pagar')->first()) {
            SituacaoConta::create([
                'nome' => 'A pagar',
                'cor' => 'warning',
            ]);
        }
    }
}
