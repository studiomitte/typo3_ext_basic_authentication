<?php

return [
    'backend' => [
        'typo3/basic-auth/backend' => [
            'target' => \StudioMitte\BasicAuthentication\Middleware\BasicAuthenticationBackend::class,
            'after' => [
                'typo3/cms-backend/locked-backend'
            ],
        ],
    ],
    'frontend' => [
        'typo3/basic-auth/frontend' => [
            'target' => \StudioMitte\BasicAuthentication\Middleware\BasicAuthenticationFrontend::class,
            'after' => [
                'typo3/cms-frontend/maintenance-mode'
            ],
        ],
    ]
];
