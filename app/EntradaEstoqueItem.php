<?php

namespace App;

use App\Produto;
use App\EntradaEstoque;
use Illuminate\Database\Eloquent\Model;

class EntradaEstoqueItem extends Model
{
    public $fillable = [
        'entrada_estoque_id',
        'produto_id',
        'quantidade',
        'valor_unitario',
        'valor_desconto',
        'valor_acrescimo'
    ];

    public function entrada_estoque() {
        return $this->belongsTo(EntradaEstoque::class);
    }

    public function produto() {
        return $this->hasOne(Produto::class);
    }
}
