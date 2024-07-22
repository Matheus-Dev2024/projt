<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SituacaoConta extends Model
{
    use HasFactory;

    protected $table = 'situacoes_contas';

    protected $fillable = ['nome', 'cor'];

    public function conta()
    {
        return $this->hasMany(Conta::class, 'situacao_conta_id', 'id');
    }
}
