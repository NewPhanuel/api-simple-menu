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