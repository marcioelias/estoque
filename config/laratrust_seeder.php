<?php

return [
    'role_structure' => [
        'super' => [
            'user' => 'c,r,u,d',
            'role' => 'c,r,u,d',
            'role_user' => 'c,r,u,d',
            'tipo_pessoa' => 'c,r,u,d',
            'abastecimento' => 'c,r,u,d',
            'atendente' => 'c,r,u,d',
            'bico' => 'c,r,u,d',
            'bomba' => 'c,r,u,d',
            'cliente' => 'c,r,u,d',
            'combustivel' => 'c,r,u,d',
            'departamento' => 'c,r,u,d',
            'grupo_veiculo' => 'c,r,u,d',
            'grupo_produto' => 'c,r,u,d',
            'marca_veiculo' => 'c,r,u,d',
            'modelo_bomba' => 'c,r,u,d',
            'modelo_veiculo' => 'c,r,u,d',
            'veiculo' => 'c,r,u,d',
            'produto' => 'c,r,u,d',
            'tanque' => 'c,r,u,d',
            'tipo_bomba' => 'c,r,u,d',
            'tipo_pessoa' => 'c,r,u,d',
            'uf' => 'c,r,u,d',
            'unidade' => 'c,r,u,d',
            'fornecedor' => 'c,r,u,d',
            'estoque' => 'c,r,u,d',
            'entrada_estoque' => 'c,r,u,d',
            'inventario' => 'c,r,u,d',
            'tanque-movimentacao' => 'c,r,u,d',
            'tipo_movimentacao_produto' => 'c,r,u,d',
            'posicao_tanques_grafico' => 'a',
            'media_consumo_veiculos_grafico' => 'a',
            'listagem_clientes' => 'a',
            'listagem_veiculos' => 'a',
            'listagem_tanques' => 'a',
            'relatorio_abastecimentos' => 'a',
            'relatorio_abastecimentos_bico' => 'a',
            'relatorio_media_consumo_modelo' => 'a',
            'relatorio_posicao_estoque' => 'a',
            'importar_abastecimentos' => 'a',
            'exportar_exportar_dados_cadastrais' => 'a'
        ],
        'administrador' => [
            'user' => 'c,r,u,d',
        ],
        'usuario' => [
            'user' => 'r,u'
        ],
    ],
    'permissions_map' => [
        'c' => 'cadastrar',
        'r' => 'listar',
        'u' => 'alterar',
        'd' => 'excluir',
        'v' => 'visualizar',
        'a' => 'acesso'
    ]
];
