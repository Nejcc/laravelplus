<?php

declare(strict_types=1);

return [
    'items' => [
        [
            'title' => 'Home',
            'route' => 'home',
            'icon' => 'home',
            'active' => 'home',
        ],
        // [
        //     'title' => 'Submenu',
        //     'icon' => 'package',
        //     'items' => [
        //         [
        //             'title' => 'Empty Page',
        //             'route' => '#',
        //         ],
        //         [
        //             'title' => 'Cards',
        //             'badge' => 'New',
        //             'items' => [
        //                 [
        //                     'title' => 'Sample Cards',
        //                     'route' => '#',
        //                 ],
        //                 [
        //                     'title' => 'Card Actions',
        //                     'route' => '#',
        //                 ],
        //                 [
        //                     'title' => 'Cards Masonry',
        //                     'route' => '#',
        //                 ],
        //             ],
        //         ],
        //     ],
        // ],
        [
            'title' => 'Administration',
            'icon' => 'settings',
            'roles' => ['super-admin', 'admin'],
            'items' => [
                [
                    'title' => 'Roles',
                    'route' => 'admin.roles.index',
                    'icon' => 'shield-lock',
                ],
                [
                    'title' => 'Permissions',
                    'route' => 'admin.permissions.index',
                    'icon' => 'key',
                ],
                [
                    'title' => 'Users',
                    'route' => 'admin.users.index',
                    'icon' => 'users',
                ],
            ],
        ],
    ],
];
