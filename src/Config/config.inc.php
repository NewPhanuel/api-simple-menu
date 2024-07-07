<?php

namespace DevPhanuel\ApiSimpleMenu\Config;

use Dotenv\Dotenv;

enum Environment: int {
    case PRODUCTION = 1;
    case DEVELOPMENT = 0;

    public function isFreezeAllowed(): bool
    {
        return match($this) {
            self::DEVELOPMENT => false,
            self::PRODUCTION => true,
        };
    }
}

$dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();
$dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASSWORD']);