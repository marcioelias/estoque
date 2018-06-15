<?php

namespace App;

use App\Produto;
use App\Inventario;
use Illuminate\Database\Eloquent\Model;

class InventarioItem extends Model
{
    public $fillable = [
        'inventario_id',
        'produto_id',
        'qtd_estoque',
        'qtd_contada',
        'qtd_ajustada',
        'ajustado'
    ];

    public function inventario() {
        return $this->belongsTo(Inventario::class);
    }

    public function produto() {
        return $this->belongsTo(Produto::class);
    }
}
