<?php

return [
    'role_structure' => [
        'superadministrator' => [
            'profile' => 'a,c,r,u,d,l,v,un',
            'vehicles' => 'a,c,r,u,d,l,v,un',
            'drivers' => 'a,c,r,u,d,l,v,un'
        ],
        'administrator' => [
            'profile' => 'a,c,r,u,l,v,un',
            'vehicles' => 'a,c,r,u,l,v,un',
            'drivers' => 'a,c,r,u,l,v,un'
        ],
        'company' => [
            'profile' => 'a,c,r,u,l',
            'vehicles' => 'a,c,r,u,l,d,v,un',
            'drivers' => 'a,c,r,u,l,d,v,un',
        ],
        'independent' => [
            
        ],
        'driver' => [
            
        ],
        'client' => [
            
        ],
    ],
    'permission_structure' => [
        'cru_user' => [
            'profile' => 'c,r,u'
        ],
    ],
    'permissions_map' => [
        'a' => 'access',
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
        'l' => 'list',
        'v' => 'verify',
        'un' => 'update-unverify'
    ]
];
