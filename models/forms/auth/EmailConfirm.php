<?php

namespace app\models\forms\auth;

use app\models\User;
use yii\base\InvalidArgumentException;
use yii\base\Model;
use yii\db\Exception;

class EmailConfirm extends Model
{
    private ?User $user = null;

    public function __construct(string $token, array $config = [])
    {
        if (empty($token)) {
            throw new InvalidArgumentException('No token.');
        }
        $this->user = User::findByEmailVerifyToken($token);
        if (!$this->user) {
            throw new InvalidArgumentException('Illegal token.');
        }
        parent::__construct($config);
    }

    /**
     * Confirm email.
     *
     * @return boolean if email was confirmed.
     * @throws Exception
     */
    public function verifyEmail(): bool
    {
        $user = $this->user;
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->removeEmailVerifyToken();

        return $user->save();
    }
}