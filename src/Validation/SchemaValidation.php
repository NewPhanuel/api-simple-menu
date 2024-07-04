<?php

namespace DevPhanuel\ApiSimpleMenu\Validation;

use Respect\Validation\Validator as validate;

class SchemaValidation
{
    private const MIN_NAME_LENGTH = 2;
    private const MAX_NAME_LENGTH = 20;
    public function __construct() {}

    /**
     * Validates user info that is sent from the frontend
     * @param object $data
     * @return bool
     */
    public function validateUserSchema(object $data): bool
    {
        $schemaValidator = validate::attribute('firstName', validate::stringType()->length(self::MIN_NAME_LENGTH, self::MAX_NAME_LENGTH))
            ->attribute('middleName', validate::stringType()->length(self::MIN_NAME_LENGTH, self::MAX_NAME_LENGTH))
            ->attribute('lastName', validate::stringType()->length(self::MIN_NAME_LENGTH, self::MAX_NAME_LENGTH))
            ->attribute('email', validate::email(), mandatory: false)
            ->attribute('phone', validate::phone(), mandatory: false);
        return $schemaValidator->validate($data);
    }

    public function validateUserId(string $userId): bool
    {
        return validate::uuid(4)->validate($userId);
    }
}