<?php

namespace App;

use App\Estoque;
use App\Fornecedor;
use App\EntradaEstoqueItem;
use App\MovimentacaoProduto;
use Illuminate\Database\Eloquent\Model;

class EntradaEstoque extends Model
{
    public $fillable = [
        'nr_docto',
        'serie',
        'data_doc',
        'data_entrada',
        'fornecedor_id',
        'estoque_id',
        'valor_total'
    ];

    public function entrada_estoque_items() {
        return $this->hasMany(EntradaEstoqueItem::class);
    }

    public function fornecedor() {
        return $this->belongsTo(Fornecedor::class);
    }

    public function movimentacao_produto() {
        return $this->belongsTo(MovimentacaoProduto::class);
    }

    public function estoque() {
        return $this->belongsTo(Estoque::class);
    }
}
