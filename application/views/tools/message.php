
<? $this->load->view('layouts/auth/header'); ?>


            <div class="container-login100">
                <div class="wrap-login100 p-6">
                    <form class="login100-form validate-form">
                        <span class="login100-form-title">
                            <?=$header?>
                        </span>
                        <div class="text-center text-muted text-uppercase">
                        <?=$text?>        
                    </div>
                        <div class="form-footer">
                            <a href="<?=$btn_link?>" class="btn btn-primary btn-block"><?=$btn_text?></a>
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