<?php
declare(strict_types=1);

namespace DevPhanuel\ApiSimpleMenu;

/**
 * Gets the base path of a path
 *
 * @param string $path
 * @return string
 */
function basePath(string $path): string
{
    return __DIR__ . '/' . $path;
}

function inspectAndDie(mixed $data): void
{
    echo "<pre>";
    var_export($data);
    echo "</pre>";
}

function successMessage(?string $message = '', array|object $data = []): array
{
    return [
        'success' => [
            'message' => $message,
            'data' => $data,
        ]
    ];
}

function errorMessage(?string $type, ?string $message, mixed $code = 0): array
{
    return [
        'error' => [
            'type' => $type,
            'message' => $message,
            'code' => $code
        ]
    ];
}