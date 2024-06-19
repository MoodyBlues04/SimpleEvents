<?php

namespace app\controllers;

use app\models\forms\auth\EmailConfirm;
use app\models\forms\auth\LoginForm;
use app\models\forms\auth\SignupForm;
use Yii;
use yii\db\Exception;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

class AuthController extends Controller
{
    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionLogin(): Response|string
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        try {
            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post(), '') && $model->login()) {
                \Yii::$app->getSession()->setFlash('success', 'You\'ve successfully logged in');
                return $this->goBack();
            }
        } catch (\Exception $e) {
            \Yii::$app->getSession()->setFlash('error', $e->getMessage());
        }
        return $this->render('login');
    }

    public function actionLogout(): Response
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup(): string
    {
        try {
            $model = new SignupForm();
            if ($model->load(Yii::$app->request->post(), '') && $model->signUp()) {
                Yii::$app->getSession()->setFlash('success', 'Подтвердите ваш электронный адрес.');
                return $this->render('signup');
            }
        } catch (\Exception $e) {
            Yii::$app->getSession()->setFlash('error', $e->getMessage());
        }
        return $this->render('signup');
    }

    /**
     * @param $token
     * @return Response
     * @throws Exception
     */
    public function actionEmailConfirm($token): Response
    {
        $model = new EmailConfirm($token);

        if ($model->verifyEmail()) {
            Yii::$app->getSession()->setFlash('success', 'Success.');
        } else {
            Yii::$app->getSession()->setFlash('error', 'Email verify failed.');
        }

        return $this->redirect('/auth/login');
    }
}