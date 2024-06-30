<?php
declare(strict_types=1);

namespace DevPhanuel\ApiSimpleMenu\Api;

use DevPhanuel\ApiSimpleMenu\Exception\InvalidSchemaException;
use Respect\Validation\Validator as validate;

class User
{
    public readonly int $userId;

    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $phone
    )
    {
    }

    /**
     * Create a user
     *
     * @param mixed $data
     * @return object
     */
    public function create(object $data): object
    {
        $minLength = 2;
        $maxLength = 20;

        $schemaValidator = validate::attribute('firstName', validate::stringType()->length($minLength, $maxLength))
            ->attribute('middleName', validate::stringType()->length($minLength, $maxLength))
            ->attribute('lastName', validate::stringType()->length($minLength, $maxLength))
            ->attribute('email', validate::email(), mandatory: false)
            ->attribute('phone', validate::phone(), mandatory: false);

        if ($schemaValidator->validate($data)) {
            return $data;
        }
        throw new InvalidSchemaException("Schema does not follow validation rules");
    }

    /**
     * Retrieves a user from the database
     *
     * @param int $userId
     * @return self
     */
    public function get(int $userId): self
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * Retrieves all the users from the database
     *
     * @return array
     */
    public function getAll(): array
    {
        return [
            'status' => 200,
            'data' => $this,
        ];
    }

    /**
     * Deletes a user from the database
     *
     * @param int $userId
     * @return bool
     */
    public function remove(int $userId): bool
    {
        return true;
    }

    /**
     * Updates the data of a user and
     * returns the updated user data
     *
     * @param int $userId
     * @return self
     */
    public function update(int $userId): self
    {
        $this->userId = $userId;
        return $this;
    }
}