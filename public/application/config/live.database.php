<?php

return [
    'default-connection' => 'concrete',
    'connections' => [
        'concrete' => [
            'driver' => 'c5_pdo_mysql',
            'server' => $_ENV['DB_HOSTNAME'],
            'database' => $_ENV['DB_DATABASE'],
            'username' => $_ENV['DB_USERNAME'],
            'password' => $_ENV['DB_PASSWORD'],
            'character_set' => $_ENV['DB_CHARSET'],
            'collation' => $_ENV['DB_COLLATION'],
        ],
    ],
];
