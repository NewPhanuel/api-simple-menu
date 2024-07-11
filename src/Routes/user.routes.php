<?php

namespace DevPhanuel\ApiSimpleMenu\Routes;

use DevPhanuel\ApiSimpleMenu\Api\User;
use DevPhanuel\ApiSimpleMenu\Exception\InvalidValidationException;
use PH7\JustHttp\StatusCode;
use PH7\PhpHttpResponseHeader\Http;
use function DevPhanuel\ApiSimpleMenu\errorMessage;

enum UserAction: string
{
    case CREATE = 'create';
    case GET = 'get';
    case REMOVE = 'remove';
    case UPDATE = 'update';
    case GET_ALL = 'getAll';

    public function getResponse(): string
    {
        $postBody = file_get_contents('php://input');
        $postBody = json_decode($postBody);
        $userId = $_REQUEST['userId'] ?? 0;

        $user = new User();

        $response = match ($this) {
            self::CREATE => $user->create($postBody),
            self::GET => $user->get($userId),
            self::UPDATE => $user->update($postBody),
            self::REMOVE => $user->remove($userId),
            self::GET_ALL => $user->getAll(),
            default => "404"
        };
        return json_encode($response);
    }
}

$action = $_REQUEST['action'] ?? '';
match ($action) {
    'create' => $userAction = UserAction::CREATE,
    'get' => $userAction = UserAction::GET,
    'update' => $userAction = UserAction::UPDATE,
    'remove' => $userAction = UserAction::REMOVE,
    default => $userAction = UserAction::GET_ALL
};

try {
    echo $userAction->getResponse();
} catch (InvalidValidationException $e) {
    Http::setHeadersByCode(StatusCode::BAD_REQUEST);
    echo json_encode(errorMessage('InvalidValidationException', $e->getMessage(), $e->getCode()));
}
