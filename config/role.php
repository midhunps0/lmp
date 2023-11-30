<?php


/* Defining set of roles accessible to an authenticated user */

return[
    'accessibleRoles'=>[
        'System Admin'=>[
            'Client Admin',
            'Branch Admin',
            'Executive'
        ],
        'Client Admin'=>[
            'Branch Admin',
            'Executive'
        ],
        'Branch Admin'=>[
            'Executive'
        ]
    ]
];