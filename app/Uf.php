<?php

namespace App;

use App\Cliente;
use Illuminate\Database\Eloquent\Model;

class Uf extends Model
{
    public $fillable = ['uf'];

    public function clientes() {
        return $this->hasMany(Cliente::class);
    }
}
