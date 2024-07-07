<?php
declare(strict_types=1);

namespace DevPhanuel\ApiSimpleMenu\Models;

use DevPhanuel\ApiSimpleMenu\Entity\UserEntity;
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
}