<?php

namespace App;

use App\Uf;
use App\Produto;
use App\TipoPessoa;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    protected $table = 'fornecedores';

    public $fillable = [
        'id',
        'nome_razao',
        'apelido_fantasia',
        'cpf_cnpj',
        'rg_ie',
        'im',
        'tipo_pessoa_id',
        'endereco',
        'numero',
        'bairro',
        'cidade',
        'uf_id',
        'cep',
        'fone',
        'email',
        'ativo'
    ];

    public function uf() {
        return $this->belongsTo(Uf::class);
    }

    public function tipo_pessoa() {
        return $this->belongsTo(TipoPessoa::class);
    }

    public function produtos() {
        return $this->belongsToMany(Produto::class);
    }
}
