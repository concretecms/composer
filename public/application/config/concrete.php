<?php

return [
    'updates' => [
        // Skip the automatic check of new Concrete versions availability
        'skip_core' => true,
    ],
    'debug' => [
        'hide_keys' => [
            // Hide database password and hostname in whoops output if supported
            '_ENV' => ['DB_PASSWORD', 'DB_HOSTNAME'],
            '_SERVER' => ['DB_PASSWORD', 'DB_HOSTNAME'],
        ]
    ]
];
