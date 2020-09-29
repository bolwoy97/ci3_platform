<? $this->load->view('layouts/auth/header'); ?>

<div class="container-login100">
                    <div class="wrap-login100 p-6">
                        <form action="" method="post" class="login100-form validate-form">
                            <span class="login100-form-title">
                                <?=lang('txt59')?>
                            </span>
                           
                            
                               <div class="text-center pt-3">
                                <p class="text-dark mb-3"><?=lang('txt60')?> <a  class="text-warning ml-1"><?=$spons_login?></a></p>
                            </div>
                            
                            <div class="wrap-input100 validate-input">
                                <input class="input100" type="text" name="login" value="<?= set_value('login')?>" placeholder="<?=lang('txt61')?>">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </span>
                            </div>
                            <small class="alert-danger"><?=form_error('login')?></small>

                            <div class="wrap-input100 validate-input">
                                <input class="input100" type="text" name="email" value="<?= set_value('email')?>" placeholder="<?=lang('txt62')?>">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fas fa-envelope" aria-hidden="true"></i>
                                </span>
                            </div>
                            <small class="alert-danger"><?=form_error('email')?></small>

                            <div class="wrap-input100">
                                <input class="input100" type="password" name="password" value="<?= set_value('password')?>" placeholder="<?=lang('txt63')?>">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fas fa-key" aria-hidden="true"></i>
                                </span>
                            </div>
                            <small class="alert-danger"><?=form_error('password')?></small>

                            <div class="wrap-input100">
                                <input class="input100" type="password" name="rpassword" value="<?= set_value('rpassword')?>" placeholder="<?=lang('txt64')?>">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fas fa-key" aria-hidden="true"></i>
                                </span>
                            </div>
                            <small class="alert-danger"><?=form_error('rpassword')?></small>

                            <label class="custom-control custom-checkbox mt-4">
                                <input name="terms"  type="checkbox" class="custom-control-input">
                                <span class="custom-control-label"><?=lang('txt64')?> <a href="land/terms" target="blank"> <?=lang('txt66')?></a></span>
                            </label>
                            <small class="alert-danger"><?=form_error('terms')?></small>

                            <? $this->load->view('layouts/messages'); ?>
                            <div class="container-login100-form-btn">
                                <button type="submit" class="login100-form-btn btn-primary">
                                    <?=lang('txt59')?>
                                </button>
                            </div>
                            <div class="text-center pt-3">
                                <p class="text-dark mb-0"><?=lang('txt67')?><a href="login" class="text-primary ml-1"><?=lang('txt56')?></a></p>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- CONTAINER CLOSED -->
            </div>
        </div>
        <!-- END PAGE -->

    </div>
    <!-- BACKGROUND-IMAGE CLOSED -->

<? $this->load->view('layouts/auth/footer'); ?>
