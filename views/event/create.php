<?php
/** @var \app\models\Organiser[] $organisers */
?>

<div class="col-md-8">
    <div class="card">
        <div class="card-header">Create event</div>
        <div class="card-body">
            <form action="/event/create" method="POST">
                <input type="hidden" class="form-control" name="_csrf"
                       value="<?= Yii::$app->request->getCsrfToken() ?>">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name" placeholder="Name" type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input id="date" placeholder="Date" type="date" name="date" class="form-control">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" placeholder="Description" name="description" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="organisers">Organisers</label>
                    <br>
                    <select class="selectpicker" multiple id="organisers" name="organisers[]">
                        <?php foreach ($organisers as $organiser): ?>
                            <option value="<?=$organiser->id?>"><?=$organiser->fio?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
                <br><br>
                <a href="/event/index">Events</a>
            </form>
        </div>
    </div>
</div>

