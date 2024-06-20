<?php
/**
 * @var \app\models\Event[] $events
 * @var \app\models\Organiser[] $organisers
 */
?>

<div class="col-md-8">
    <h5>Events</h5>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Date</th>
            <th scope="col">Description</th>
            <th scope="col">Organisers</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($events as $event): ?>
            <tr>
                <th scope="row"><?= $event->id ?></th>
                <td><?= $event->name ?></td>
                <td><?= $event->date ?></td>
                <td><?= $event->description ?></td>
                <td><?= json_encode($event->mapOrganisers(fn ($organiser) => $organiser->fio), JSON_UNESCAPED_UNICODE) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="col-md-4">
    <h5>Organisers</h5>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Fio</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($organisers as $organiser): ?>
            <tr>
                <th scope="row"><?= $organiser->id ?></th>
                <td><?= $organiser->fio ?></td>
                <td><?= $organiser->email ?></td>
                <td><?= $organiser->phone ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
