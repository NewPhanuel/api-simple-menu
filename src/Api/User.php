<?php
declare(strict_types=1);

namespace DevPhanuel\ApiSimpleMenu\Api;

use DevPhanuel\ApiSimpleMenu\Exception\InvalidValidationException;
use DevPhanuel\ApiSimpleMenu\Models\UserModel;
use DevPhanuel\ApiSimpleMenu\Validation\SchemaValidation;
use PH7\JustHttp\StatusCode;
use PH7\PhpHttpResponseHeader\Http;
use Ramsey\Uuid\Uuid;
use DevPhanuel\ApiSimpleMenu\Entity\UserEntity;
use RedBeanPHP\RedException\SQL as RedBeanSQLException;
use function DevPhanuel\ApiSimpleMenu\errorMessage;
use function DevPhanuel\ApiSimpleMenu\successMessage;

class User
{
    private SchemaValidation $schemaValidation;
    private const DATE_TIME_FORMAT = 'Y-m-d H:i:s';

    public function __construct()
    {
        $this->schemaValidation = new SchemaValidation();
    }

    /**
     * Create a user
     *
     * @param object $data
     * @return array
     */
    public function create(object $data): array
    {
        if ($this->schemaValidation->validateUserSchema($data)) {
            $data->userUuid = (string)Uuid::uuid4();
            $data->createdAt = date(self::DATE_TIME_FORMAT);

            $userEntity = new UserEntity();
            $userEntity->setUserUuid($data->userUuid)->setFirstName($data->firstName)->setMiddleName($data->middleName ?? '')
                ->setLastName($data->lastName)->setEmail($data->email)->setPhone($data->phone)
                ->setPassword($data->password)->setCreatedAt($data->createdAt);

            try {
                UserModel::create($userEntity);
                Http::setHeadersByCode(StatusCode::CREATED);
                return successMessage('User created successfully', $data);
            } catch (RedBeanSQLException $e) {
                Http::setHeadersByCode(StatusCode::INTERNAL_SERVER_ERROR);
                return errorMessage('RedBeanSQLException', $e->getMessage(), $e->getCode());
            }
        }
        throw new InvalidValidationException("Schema does not follow validation rules");
    }

    /**
     * Retrieves a user from the database
     *
     * @param string $userUuid
     * @return array
     */
    public function get(string $userUuid): array
    {
        if ($this->schemaValidation->validateUserUuid($userUuid)) {
            $user = UserModel::get($userUuid);
            unset($user['id']);
            Http::setHeadersByCode();
            return successMessage('User retrieved successfully', $user);
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
        $users = UserModel::getAll();
        if ($users) {
            foreach ($users as $user) {
                unset($user['id']);
            }
            return successMessage(data: $users);
        }
    }

    /**
     * Deletes a user from the database
     *
     * @param string $userUuid
     * @return array
     */
    public function remove(string $userUuid): array
    {
        if (!$this->schemaValidation->validateUserUuid($userUuid)) {
            throw new InvalidValidationException('Invalid User UUID');
        }
        if (UserModel::remove($userUuid)) {
            return successMessage('User deleted successfully');
        }
        return errorMessage('SQLError', 'User could not be deleted');
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