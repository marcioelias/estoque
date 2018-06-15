<?php

namespace App;

use App\Estoque;
use App\InventarioItem;
use App\MovimentacaoProduto;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    public $fillable = [
        'estoque_id',
        'data_abertura',
        'data_fechamento',
        'fechado'
    ];

    public function inventario_items() {
        return $this->hasMany(InventarioItem::class);
    }

    public function estoque() {
        return $this->belongsTo(Estoque::class);
    }

    public function movimentacao_produto() {
        return $this->belongsTo(MovimentacaoProduto::class);
    }
}
