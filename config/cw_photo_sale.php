<?php

return [
    'plans' => [
        [
            'name' => 'Plano 001',
            'price' => '14.50',
            'description' => 'Voce uma unica vez 12 fotos polaroid na sua casa.',
            'photo_amount' => '12',
            'photo_type' => 'Polaroid',
            'recurrent' => false
        ],
        [
            'name' => 'Plano 002',
            'price' => '24.50',
            'description' => 'Voce recebe todos os meses 24 fotos polaroid na sua casa.',
            'photo_amount' => '24',
            'photo_type' => 'Polaroid',
            'recurrent' => true
        ],
        [
            'name' => 'Plano 003',
            'price' => '34.50',
            'description' => 'Voce recebe todos os meses 36 fotos polaroid na sua casa.',
            'photo_amount' => '36',
            'photo_type' => 'Polaroid',
            'recurrent' => true
        ]
    ],
    'order' => [
        'statuses' => [
            ['name' => 'Incompleto', 'order' => 1, 'description' => 'Um pedido incompleto acontece quando um comprador acessa a página de pagamento, mas não conclui a transação'],
            ['name' => 'Pendente', 'order' => 2, 'description' => 'O cliente iniciou o processo de checkout, mas não o concluiu'],
            ['name' => 'Enviado', 'order' => 3, 'description' => 'O pedido foi enviado, mas o recebimento não foi confirmado'],
            ['name' => 'Enviado parcialmente', 'order' => 4, 'description' => 'Apenas alguns itens do pedido foram enviados, devido a alguns produtos serem apenas pré-encomendados ou outros motivos'],
            ['name' => 'Devolveu', 'order' => 5, 'description' => 'O vendedor usou a ação Reembolsar.'],
            ['name' => 'Cancelado', 'order' => 6, 'description' => 'O vendedor cancelou um pedido devido a uma inconsistência de estoque ou outros motivos'],
            ['name' => 'Recusado', 'order' => 7, 'description' => 'O vendedor marcou o pedido como recusado por falta de pagamento manual ou outros motivos'],
            ['name' => 'Aguardando Pagamento', 'order' => 8, 'description' => 'O cliente concluiu o processo de checkout, mas o pagamento ainda não foi confirmado'],
            ['name' => 'Aguardando Coleta', 'order' => 9, 'description' => 'O pedido foi retirado e está aguardando a retirada do cliente em um local especificado pelo vendedor'],
            ['name' => 'À espera de envio', 'order' => 10, 'description' => 'O pedido foi retirado e embalado e está aguardando a coleta de um transportador'],
            ['name' => 'Concluído', 'order' => 11, 'description' => 'O cliente pagou, os produtos foram enviados e recebidos'],
            ['name' => 'Aguardando cumprimento', 'order' => 12, 'description' => 'O cliente concluiu o processo de checkout e o pagamento foi confirmado'],
            ['name' => 'Verificação manual necessária', 'order' => 13, 'description' => 'Pedido em espera enquanto algum aspecto precisa ser confirmado manualmente'],
            ['name' => 'Disputado', 'order' => 14, 'description' => 'O cliente iniciou um processo de resolução de disputa para a transação do pagamento que pagou o pedido.'],
            ['name' => 'Parcialmente ressarcido', 'order' => 15, 'description' => 'O vendedor reembolsou parcialmente o pedido'],
        ]
    ]
];
