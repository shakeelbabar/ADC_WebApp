<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'admin' => [
            'users' => 'c,r,u,d',
            'meeting' => 'c,r,u,d',
            'application' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'secretary' => [
            'meeting' => 'c,r,u,d',
            'application' => 'c,r,u,d'
        ],
        'jury' => [
            'meeting' => 'r,u',
            'application' => 'r,u'
        ],
        'instructor' => [
            'meeting' => 'r',
            'application' => 'r,u'
        ],
        'student' => [
            'application' => 'c,r,u,d',
            'meeting' => 'r'
        ]
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
