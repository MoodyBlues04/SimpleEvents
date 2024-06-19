<?php

namespace app\models\forms\auth;

use app\models\User;
use Exception;
use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    public string $email = '';
    public string $password = '';
    public bool $rememberMe = false;

    private ?User $user = null;

    public function rules(): array
    {
        return [
            [['email', 'password'], 'required'],
            ['email', 'email'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the username and password.
     * This method serves as the inline validation for password.
     */
    public function validatePassword(): void
    {
        if ($this->hasErrors()) {
            return;
        }

        $user = $this->getUser();
        if (is_null($user) || !$user->validatePassword($this->password)) {
            $this->addError('password', 'Incorrect username or password.');
        } elseif (null === $user->email_verified_at) {
            $this->addError('email', 'Verify your email.');
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     * @throws Exception
     */
    public function login(): bool
    {
        if (!$this->validate()) {
            $errors = json_encode($this->errors);
            throw new Exception("Validation errors: {$errors}");
        }
        return Yii::$app->user->login(
            $this->getUser(),
            $this->rememberMe ? 3600 * 24 * 30 : 0
        );
    }

    private function getUser(): ?User
    {
        return User::findByEmail($this->email);
    }
}