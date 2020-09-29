<? $this->load->view('layouts/auth/header'); ?>

            <div class="container-login100">
                <div class="wrap-login100 p-6">
                    <form class="login100-form validate-form" action="" method="POST">
                        <span class="login100-form-title">
                            Создайте логин
                        </span>
                        <div class="wrap-input100 validate-input" >
                            <input class="input100" type="text" name="login" placeholder="">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </span>
                        </div>
                        <small class="text text-danger"><?=form_error('login')?></small>
                        <div class="text-right pt-1">
                            </div>
                           
                        <? $this->load->view('layouts/messages'); ?>
                        <div class="container-login100-form-btn">
                            <button type="submit"   class="login100-form-btn btn-primary">
                                Войти
                            </button>
                        </div>
                        <!--<div class="container-login100-form-btn">
                            <button type="submit" name="keep" value="keep" class="login100-form-btn btn-primary">
                                Продолжить как "<?=$this_user['login']?>""
                            </button>
                        </div>-->
                        <div class="text-center pt-3">
                            <p class="text-dark mb-0">Доступ только для пользователей Grid Group</p>
                        </div>
                    </form>
                </div>
            </div>
            <!-- CONTAINER CLOSED -->
        </div>
    </div>
    <!-- End PAGE -->

</div>
<!-- BACKGROUND-IMAGE CLOSED -->

<? $this->load->view('layouts/auth/footer'); ?>