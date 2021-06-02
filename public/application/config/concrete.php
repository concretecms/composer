<?php

return [
    'updates' => [
        // Skip the automatic check of new concrete5 versions availability
        'skip_core' => true,
    ],
    'debug' => [
        'hide_keys' => [
            // Hide database password and hostname in whoops output if supported
            '_ENV' => ['DB_PASSWORD', 'DB_HOSTNAME'],
        ]
    ]
];
