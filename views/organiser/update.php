<?php
/**
 * @var \app\models\Organiser $organiser
 */
?>

<div class="col-md-8">
    <div class="card">
        <div class="card-header">Update organiser</div>
        <div class="card-body">
            <form action="/organiser/update" method="POST">
                <input type="hidden" class="form-control" name="_csrf"
                       value="<?= Yii::$app->request->getCsrfToken() ?>">
                <input type="hidden" class="form-control" name="id" value="<?=$organiser->id?>">
                <div class="form-group">
                    <label for="fio">Fio</label>
                    <input id="fio" placeholder="Fio" type="text" name="fio" class="form-control" value="<?=$organiser->fio?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" placeholder="Email" type="email" name="email" class="form-control" value="<?=$organiser->email?>">
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input id="phone" placeholder="phone" name="phone" class="form-control" value="<?=$organiser->phone?>">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <br><br>
                <a href="/organiser/index">Organisers</a>
            </form>
        </div>
    </div>
</div>

