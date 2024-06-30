<?php
declare(strict_types=1);
// miscellaneous file (MISC)

namespace DevPhanuel\ApiSimpleMenu\Helpers;

function response(array $data): void
{
    echo json_encode($data);
}