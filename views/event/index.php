<?php
/** @var \app\models\Event[] $events */
?>

<div class="col-md-12">
    <h5>Events</h5>
    <a href="/event/create" class="btn btn-primary">
        Create
    </a>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Date</th>
            <th scope="col">Description</th>
            <th scope="col">Organisers</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($events as $event): ?>
            <tr>
                <th scope="row"><?= $event->id ?></th>
                <td><?= $event->name ?></td>
                <td><?= $event->date ?></td>
                <td><?= $event->description ?></td>
                <td><?= json_encode($event->organisers, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) ?></td>
                <td>
                    <a href="/event/update?id=<?=$event->id?>" class="btn btn-primary">Edit</a>
                    <a href="/event/delete?id=<?=$event->id?>" class="btn btn-danger" >Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>