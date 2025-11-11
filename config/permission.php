<?php

return [
    'models' => [
        'permission' => Spatie\\Permission\\Models\\Permission::class,
        'role' => Spatie\\Permission\\Models\\Role::class,
    ],

    'table_names' => [
        'roles' => 'roles',
        'permissions' => 'permissions',
        'model_has_permissions' => 'model_has_permissions',
        'model_has_roles' => 'role_user',
        'role_has_permissions' => 'permission_role',
    ],

    'column_names' => [
        'model_morph_key' => 'user_id',
    ],

    'register_permission_check_method' => false,

    'teams' => [
        'enabled' => false,
        'team_model' => null,
        'team_foreign_key' => 'team_id',
    ],

    'enable_wildcard_permission' => true,

    'display_permission_in_exception' => false,

    'display_role_in_exception' => false,

    'cache' => [
        'expiration_time' => \DateInterval::createFromDateString('24 hours'),
        'key' => 'spatie.permission.cache',
        'store' => 'default',
    ],
];
