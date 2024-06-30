<?php

namespace DevPhanuel\ApiSimpleMenu\Routes;

use DevPhanuel\ApiSimpleMenu\Api\User;
use DevPhanuel\ApiSimpleMenu\Exception\InvalidSchemaException;

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
        $userId = isset($_GET['user_id']) ? (int)$_GET['user_id'] : 0;

        // TODO Remove the hard coded values from here
        $user = new User('Omamowho Phanuel', 'omamowhop@gmail.com', '0810 829 5665');

        $response = match ($this) {
            self::CREATE => $user->create($postBody),
            self::GET => $user->get($userId),
            self::UPDATE => $user->update($userId),
            self::REMOVE => $user->remove($userId),
            self::GET_ALL => $user->getAll(),
            default => "404"
        };
        return json_encode($response);
    }
}

$action = $_GET['action'] ?? '';
match ($action) {
    'create' => $userAction = UserAction::CREATE,
    'get' => $userAction = UserAction::GET,
    'update' => $userAction = UserAction::UPDATE,
    'remove' => $userAction = UserAction::REMOVE,
    default => $userAction = UserAction::GET_ALL
};

try {
    echo $userAction->getResponse();
} catch (InvalidSchemaException $e) {
    // TODO Send 400 status code with header()
    echo json_encode([
        'status' => 'error',
        'err_type' => 'schema error',
        'err_message' => $e->getMessage(),
        'err_code' => $e->getCode()
    ]);
}
