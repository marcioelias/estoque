<?php

namespace App;

use App\Cliente;
use Illuminate\Database\Eloquent\Model;

class Parametro extends Model
{
    public $fillable = ['cliente_id', 'logotipo'];

    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }
}
