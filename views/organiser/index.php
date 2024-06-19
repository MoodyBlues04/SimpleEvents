<?php
/** @var \app\models\Organiser[] $organisers */
?>

<div class="col-md-12">
    <h5>Organisers</h5>
    <a href="/organiser/create" class="btn btn-primary">
        Create
    </a>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Fio</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($organisers as $organiser): ?>
            <tr>
                <th scope="row"><?= $organiser->id ?></th>
                <td><?= $organiser->fio ?></td>
                <td><?= $organiser->email ?></td>
                <td><?= $organiser->phone ?></td>
                <td>
                    <a href="/organiser/update?id=<?=$organiser->id?>" class="btn btn-primary">Edit</a>
                    <a href="/organiser/delete?id=<?=$organiser->id?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>