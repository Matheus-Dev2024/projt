<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conta extends Model
{
    use HasFactory;
    use Timestamp;

    protected $table = 'contas';

    protected $fillable = ['nome', 'valor', 'vencimento', 'situacao_conta_id'];

    public function situacaoConta()
    {
        return $this->belongsTo(SituacaoConta::class);
    }
}
