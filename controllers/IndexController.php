<?php

namespace app\controllers;

use app\models\Event;
use yii\filters\AccessControl;
use yii\web\Controller;

class IndexController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'], // TODO redirects to site/login, should be to auth/login
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $str = Event::class;
        $cls = $str::find()->modelClass;
        var_dump(new $cls());
    }
}