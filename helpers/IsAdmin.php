<?php

namespace app\helpers;

use app\models\User;

class IsAdmin
{
    public static function check(): bool
    {
        $userId = \Yii::$app->user->id;
        if (!$userId) {
            return false;
        }
        $user = User::findOne($userId);
        return $user && $user->is_admin;
    }
}