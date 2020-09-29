
<?//require_once('application\views\layouts/head.php')?>
<? $this->load->view('layouts/head'); ?>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1>Password reset</h1>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input name="password" type="password" class="form-control" placeholder="Password">
                        <small class="alert-danger"><?=form_error('password')?></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Confirm password</label>
                        <input name="rpassword" type="password" class="form-control" placeholder="Confirm password">
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