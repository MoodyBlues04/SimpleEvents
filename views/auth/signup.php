<div class="col-md-8">
    <div class="card">
        <div class="card-header">Signup</div>
        <div class="card-body">
            <form action="/auth/signup" method="POST">
                <input type="hidden" class="form-control" name="_csrf"
                       value="<?= Yii::$app->request->getCsrfToken() ?>">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input id="email" placeholder="Email Address" type="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" placeholder="Username" type="text" name="username" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" placeholder="Password" type="password" name="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Sign up</button>
                <p>
                    Already signed up?
                    <a href="/auth/login" type="button">Log in now</a>
                </p>
            </form>
        </div>
    </div>
</div>
