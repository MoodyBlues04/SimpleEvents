<div class="col-md-8">
    <div class="card">
        <div class="card-header">Login</div>
        <div class="card-body">
            <form action="/auth/login" method="POST">
                <input type="hidden" class="form-control" name="_csrf"
                       value="<?= Yii::$app->request->getCsrfToken() ?>">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input id="email" placeholder="Email Address" type="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" placeholder="Password" type="password" name="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <p>
                    Don,t Have an Account?
                    <a href="/auth/signup" type="button">Sign up now</a>
                </p>
            </form>
        </div>
    </div>
</div>
