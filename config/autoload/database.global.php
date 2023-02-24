<?php

declare(strict_types=1);

return [
    'driver' => 'mysql',
    'username' => getenv('MYSQL_USER') ?: 'dev',
    'password' => getenv('MYSQL_PASSWORD') ?: 3034,
    'host' => getenv('MYSQL_HOST') ?: 'application-mysql',
    'database' => getenv('MYSQL_DATABASE') ?: 'app_db',
    'port' => getenv('MYSQL_PORT') ?: 3306,
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
];
