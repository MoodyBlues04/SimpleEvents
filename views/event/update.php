<?php
/**
 * @var \app\models\Event $event
 * @var \app\models\Organiser[] $organisers
 */
?>

<div class="col-md-8">
    <div class="card">
        <div class="card-header">Update event</div>
        <div class="card-body">
            <form action="/event/update" method="POST">
                <input type="hidden" class="form-control" name="_csrf"
                       value="<?= Yii::$app->request->getCsrfToken() ?>">
                <input type="hidden" class="form-control" name="id" value="<?= $event->id ?>">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name" placeholder="Name" type="text" name="name" class="form-control" value="<?=$event->name?>">
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input id="date" placeholder="Date" type="date" name="date" class="form-control" value="<?=$event->date?>">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" placeholder="Description" name="description" class="form-control"><?=$event->description?></textarea>
                </div>
                <div class="form-group">
                    <label for="organisers">Organisers</label>
                    <br>
                    <select class="selectpicker" multiple id="organisers" name="organisers[]">
                        <?php foreach ($organisers as $organiser): ?>
                            <option
                                    value="<?=$organiser->id?>"
                                    <?php if ($event->hasOrganiser($organiser)): ?> selected <?php endif; ?>>
                                <?=$organiser->fio?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <br><br>
                <a href="/event/index">Events</a>
            </form>
        </div>
    </div>
</div>

