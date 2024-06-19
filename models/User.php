<?php

namespace app\models;

use yii\base\Exception;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $auth_key
 * @property string|null $email_verify_token
 * @property string|null $email_verified_at
 * @property bool $is_admin
 */
class User extends ActiveRecord implements IdentityInterface
{
    public static function tableName(): string
    {
        return "{{%users}}";
    }

    public static function findIdentity($id): ?User
    {
        return static::findOne($id);
    }

    /**
     * @throws NotSupportedException
     */
    public static function findIdentityByAccessToken($token, $type = null): User
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * @param bool $insert
     * @return bool
     * @throws Exception
     */
    public function beforeSave($insert): bool
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        if ($this->isNewRecord) {
            $this->generateAuthKey();
        }
        return true;
    }

    public function rules(): array
    {
        return [
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => self::class, 'message' => 'This username has already been taken.'],

            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => self::class, 'message' => 'This email address has already been taken.'],
        ];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAuthKey(): string
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey): bool
    {
        return $this->getAuthKey() === $authKey;
    }

    public static function findByEmail(string $email): User
    {
        return static::findOne(['email' => $email]);
    }

    public function validatePassword(string $password): bool
    {
        return \Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * @throws Exception
     */
    public function setPassword(string $password): void
    {
        $this->password = \Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     * @throws Exception
     */
    public function generateAuthKey(): void
    {
        $this->auth_key = \Yii::$app->security->generateRandomString();
    }

    public static function findByEmailVerifyToken(string $emailConfirmToken): ?User
    {
        return static::findOne(['email_verify_token' => $emailConfirmToken]);
    }

    /**
     * @throws Exception
     */
    public function generateEmailVerifyToken(): void
    {
        $this->email_verify_token = \Yii::$app->security->generateRandomString();
    }

    public function removeEmailVerifyToken(): void
    {
        $this->email_verify_token = null;
    }
}