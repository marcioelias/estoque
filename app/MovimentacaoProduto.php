<?php

namespace App;

use App\Estoque;
use App\Produto;
use App\Inventario;
use App\EntradaEstoque;
use App\TipoMovimentacaoProduto;
use Illuminate\Database\Eloquent\Model;

class MovimentacaoProduto extends Model
{
    public $fillable = [
        'data_movimentacao',
        'estoque_id',
        'produto_id',
        'tipo_movimentacao_produto_id',
        'quantidade_movimentada',
        'entrada_estoque_id'
    ];

    public function entradaEstoque() {
        return $this->hasOne(EntradaEstoque::class);
    }

    public function inventario() {
        return $this->hasOne(Inventario::class);
    }

    public function tipo_movimentacao_produto() {
        return $this->belongsTo(TipoMovimentacaoProduto::class);
    }

    public function produto() {
        return $this->belongsTo(Produto::class);
    }

    public function estoque() {
        return $this->belongsTo(Estoque::class);
    }
}
