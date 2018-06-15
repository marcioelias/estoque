<?php

use Faker\Generator as Faker;

$factory->define(App\Fornecedor::class, function (Faker $faker) {
    return [
        'nome_razao' => $faker->name,
        'apelido_fantasia' => $faker->name,
        'tipo_pessoa_id' => 1,
        'cpf_cnpj' => '000.288.120.93',
        'rg_ie' => '7077935596',
        'im' => '',
        'endereco' => $faker->streetAddress,
        'numero' => $faker->buildingNumber,
        'bairro' => $faker->streetName,
        'cidade' => $faker->city,
        'cep' => '99999-999',
        'uf_id' => random_int(1, 27),
        'fone' => $faker->phoneNumber,
        'email' => $faker->freeEmail
    ];
});
