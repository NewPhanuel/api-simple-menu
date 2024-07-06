<?php

namespace DevPhanuel\ApiSimpleMenu;

use PH7\JustHttp\StatusCode;
use PH7\PhpHttpResponseHeader\Http;

$resource = $_GET['resource'] ?? null;

switch ($resource) {
    case 'user':
        return require_once 'user.routes.php';
    default:
        // 404
        Http::setHeadersByCode(StatusCode::NOT_FOUND);
        echo json_encode([
            'error' => [
                'type' => '404',
                'message' => 'Request not found',
            ]
        ]);
}
