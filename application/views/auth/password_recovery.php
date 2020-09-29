
<?//require_once('application\views\layouts/head.php')?>
<? $this->load->view('layouts/head'); ?>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1>Password recovery</h1>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input name="email" type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
                        <small class="alert-danger"><?=form_error('email')?></small>
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