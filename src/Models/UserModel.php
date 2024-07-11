<?php
declare(strict_types=1);

namespace DevPhanuel\ApiSimpleMenu\Models;

use DevPhanuel\ApiSimpleMenu\Entity\UserEntity;
use DevPhanuel\ApiSimpleMenu\Exception\InvalidValidationException;
use RedBeanPHP\R;
use RedBeanPHP\RedException\SQL as RedBeanSQLException;

final class UserModel
{
    protected const TABLE_NAME = 'users';

    /**
     * Adds a user to the users table in the
     * database
     *
     * @param UserEntity $userEntity
     * @return int|string
     * @throws RedBeanSQLException
     */
    public static function create(UserEntity $userEntity): int|string
    {
        $existingUserByEmail = R::findOne(self::TABLE_NAME, 'email = ?', [$userEntity->getEmail()]);
        if ($existingUserByEmail) {
            throw new RedBeanSQLException('A user with this email already exists.');
        }

        $existingUserByPhone = R::findOne(self::TABLE_NAME, 'phone = ?', [$userEntity->getPhone()]);
        if ($existingUserByPhone) {
            throw new RedBeanSQLException('A user with this phone number already exists.');
        }

        $userBean = R::dispense(self::TABLE_NAME);
        $userBean->user_uuid = $userEntity->getUserUuid();
        $userBean->first_name = $userEntity->getFirstName();
        $userBean->middle_name = $userEntity->getMiddleName();
        $userBean->last_name = $userEntity->getLastName();
        $userBean->email = $userEntity->getEmail();
        $userBean->phone = $userEntity->getPhone();
        $userBean->password = $userEntity->getPassword();
        $userBean->created_at = $userEntity->getCreatedAt();
        $beanId =  R::store($userBean);
        R::close();
        return $beanId;
    }

    public static function get(string $userUuid): array
    {
        $userBean = R::findOne(self::TABLE_NAME, 'user_uuid = :userUuid', ['userUuid' => $userUuid]);
        if ($userBean) {
            return $userBean->export();
        }
        throw new InvalidValidationException('Invalid User UUID');
    }

    public static function getAll(): array
    {
        return R::findAll(self::TABLE_NAME);
    }

    public static function remove(string $userUuid): bool
    {
        $userBean = R::findOne(self::TABLE_NAME, 'user_uuid = :userUuid', ['userUuid' => $userUuid]);
        if ($userBean) {
            return (bool) R::trash($userBean);
        }
        throw new InvalidValidationException("Invalid User UUID");
    }
}