<?php
declare(strict_types=1);

namespace DevPhanuel\ApiSimpleMenu\Api;

use DevPhanuel\ApiSimpleMenu\Exception\InvalidValidationException;
use DevPhanuel\ApiSimpleMenu\Validation\SchemaValidation;

class User
{
    public readonly ?string $userId;
    private SchemaValidation $schemaValidation;

    public function __construct() {
        $this->schemaValidation = new SchemaValidation();
    }

    /**
     * Create a user
     *
     * @param object $data
     * @return object
     */
    public function create(object $data): object
    {
        if ($this->schemaValidation->validateUserSchema($data)) {
            return $data;
        }
        throw new InvalidValidationException("Schema does not follow validation rules");
    }

    /**
     * Retrieves a user from the database
     *
     * @param string $userId
     * @return self
     */
    public function get(string $userId): self
    {
        if ($this->schemaValidation->validateUserId($userId)) {
            $this->userId = $userId;
            return $this;
        }
        throw new InvalidValidationException('Invalid User UUID');
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
    public function remove(string $userId): bool
    {
        if ($this->schemaValidation->validateUserId($userId)) {
            $this->userId = $userId;
            return true;
        } else {
            throw new InvalidValidationException('Invalid User UUID');
        }
    }

    /**
     * Updates the data of a user and
     * returns the updated user data
     *
     * @param object $data
     * @return object
     */
    public function update(object $data): object
    {
        if ($this->schemaValidation->validateUserSchema($data)) {
            return $data;
        }
        throw new InvalidValidationException("Schema does not follow validation rules");
    }
}