<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\models\User */

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['auth/email-confirm', 'token' => $user->email_verify_token]);
?>

    <p>
        Здравствуйте, <?= Html::encode($user->username) ?>!
        Для подтверждения адреса пройдите по ссылке:
    </p>

<?= Html::a(Html::encode($confirmLink), $confirmLink) ?>