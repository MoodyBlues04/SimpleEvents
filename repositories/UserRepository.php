<?php

namespace app\repositories;

use app\models\User;

class UserRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(User::class);
    }
}