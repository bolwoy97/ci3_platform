<? $this->load->view('layouts/auth/header'); ?>

            <div class="container-login100">
                <div class="wrap-login100 p-6">
                    <form class="login100-form validate-form" action="" method="POST">
                        <span class="login100-form-title">
                            <?=lang('txt55')?>
                        </span>
                        <div class="wrap-input100 validate-input" >
                            <input class="input100" type="text" name="login" value="<?= set_value('login')?>" placeholder="<?=lang('txt67_1')?>">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </span>
                        </div>
                        <small class="alert-danger"><?=form_error('login')?></small>

                        <div class="wrap-input100 validate-input" data-validate = "Password is required">
                            <input class="input100" type="password" name="password" value="<?= set_value('password')?>" placeholder="<?=lang('txt63')?>">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fas fa-key" aria-hidden="true"></i>
                            </span>
                        </div>
                        <small class="alert-danger"><?=form_error('password')?></small>
                        
                        <div class="text-right pt-1">
                        </div>
                        <? $this->load->view('layouts/messages'); ?>
                        <div class="container-login100-form-btn">
                            <button type="submit" class="login100-form-btn btn-primary">
                                <?=lang('txt56')?>
                            </button>
                        </div>
                    </form>
                    <a href="password_recovery"><?=lang('txt57')?></a>
                </div>
            </div>
            <!-- CONTAINER CLOSED -->
        </div>
    </div>
    <!-- End PAGE -->

</div>
<!-- BACKGROUND-IMAGE CLOSED -->

<? $this->load->view('layouts/auth/footer'); ?>
