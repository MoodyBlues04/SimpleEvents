<?php

namespace app\commands;

use app\repositories\UserRepository;
use yii\console\Controller;
use yii\db\Exception;

class AdminSeederController extends Controller
{
    private UserRepository $userRepository;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->userRepository = new UserRepository();
    }

    /**
     * @throws Exception
     * @throws \yii\base\Exception
     */
    public function actionSeed(): void
    {
        $this->userRepository->create([
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => \Yii::$app->security->generatePasswordHash('123456'),
            'email_verified_at' => date('Y-m-d H:i:s'),
        ]);
    }
}