<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Basic authentication',
    'description' => 'Basic authentication for backend and frontend requests',
    'category' => 'module',
    'author' => 'Georg Ringer',
    'author_email' => 'gr@studiomitte.com',
    'state' => 'beta',
    'clearCacheOnLoad' => true,
    'version' => '0.1.0',
    'constraints' => [
        'depends' => [
            'typo3' => '9.5.0-9.5.99'
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
