
<?//require_once('application\views\layouts/head.php')?>
<? $this->load->view('layouts/head'); ?>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1>Registration</h1>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Login</label>
                        <input name="login" type="text" value="<?= set_value('login')?>" class="form-control"  placeholder="Enter login">
                        <small class="alert-danger"><?=form_error('login')?></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input name="email" type="email" value="<?= set_value('email')?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
                        <small class="alert-danger"><?=form_error('email')?></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input name="password" type="password" value="<?= set_value('password')?>" class="form-control" placeholder="Password">
                        <small class="alert-danger"><?=form_error('password')?></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Confirm password</label>
                        <input name="rpassword" type="password" value="<?= set_value('rpassword')?>" class="form-control" placeholder="Confirm password">
                        <small class="alert-danger"><?=form_error('rpassword')?></small>
                    </div>
                    <? $this->load->view('layouts/messages'); ?>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <a href="login">login</a>
            </div>
        </div>
    </div>
</body>

</html>