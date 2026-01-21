<?php

use Illuminate\Support\Str;

return [

    'default' => getenv('DB_CONNECTION') ?: 'pgsql',

    'connections' => [

        'pgsql' => [
            'driver' => 'pgsql',
            'host' => getenv('DB_HOST') ?: '127.0.0.1',
            'port' => getenv('DB_PORT') ?: '5432',
            'database' => getenv('DB_DATABASE') ?: 'laravel',
            'username' => getenv('DB_USERNAME') ?: 'root',
            'password' => getenv('DB_PASSWORD') ?: '',
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => 'prefer',
        ],

        'mysql' => [
            'driver' => 'mysql',
            'host' => getenv('DB_HOST') ?: '127.0.0.1',
            'port' => getenv('DB_PORT') ?: '3306',
            'database' => getenv('DB_DATABASE') ?: 'laravel',
            'username' => getenv('DB_USERNAME') ?: 'root',
            'password' => getenv('DB_PASSWORD') ?: '',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
        ],

        'sqlite' => [
            'driver' => 'sqlite',
            'database' => getenv('DB_DATABASE') ?: database_path('database.sqlite'),
            'prefix' => '',
            'foreign_key_constraints' => true,
        ],

    ],

    'migrations' => [
        'table' => 'migrations',
        'update_date_on_publish' => true,
    ],

    'redis' => [
        'client' => 'phpredis',
        'default' => [
            'host' => getenv('REDIS_HOST') ?: '127.0.0.1',
            'password' => getenv('REDIS_PASSWORD') ?: null,
            'port' => getenv('REDIS_PORT') ?: '6379',
            'database' => getenv('REDIS_DB') ?: 0,
        ],
        'cache' => [
            'host' => getenv('REDIS_HOST') ?: '127.0.0.1',
            'password' => getenv('REDIS_PASSWORD') ?: null,
            'port' => getenv('REDIS_PORT') ?: '6379',
            'database' => getenv('REDIS_CACHE_DB') ?: 1,
        ],
    ],

];
