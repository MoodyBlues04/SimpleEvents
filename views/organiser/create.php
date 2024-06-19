<div class="col-md-8">
    <div class="card">
        <div class="card-header">Create organiser</div>
        <div class="card-body">
            <form action="/organiser/create" method="POST">
                <input type="hidden" class="form-control" name="_csrf"
                       value="<?= Yii::$app->request->getCsrfToken() ?>">
                <div class="form-group">
                    <label for="fio">Fio</label>
                    <input id="fio" placeholder="Fio" type="text" name="fio" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" placeholder="Email" type="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input id="phone" placeholder="phone" name="phone" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
                <br><br>
                <a href="/organiser/index">Organisers</a>
            </form>
        </div>
    </div>
</div>

