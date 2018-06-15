<?php

namespace App;

use App\MovimentacaoProduto;
use Illuminate\Database\Eloquent\Model;

class TipoMovimentacaoProduto extends Model
{
    public $fillable = [
        'tipo_movimentacao_produto',
        'eh_entrada',
        'ativo'
    ];

    public function movimentacao_produto() {
        return $this->belongsTo(MovimentacaoProduto::class);        
    }
}
