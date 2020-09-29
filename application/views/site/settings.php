<? $this->load->view('layouts/header', ['this_user'=>$this_user] ); ?>


<!-- ROW-1 OPEN -->
<div class="row">
    <div class="col-lg-8 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?=lang('txt122')?></h3>
            </div>
            <!--  -->
            <div class="card-body">
                <form action="UserSettingController/personals_reset/" method="post">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for="exampleInputname"><?=lang('txt123')?> *</label>
                                <input name="name" type="text" class="form-control"
                                    placeholder="<?=$this_user['name']?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for="exampleInputname1"><?=lang('txt124')?> *</label>
                                <input name="lastname" type="text" class="form-control"
                                    placeholder="<?=$this_user['lastname']?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for="exampleInputname"><?=lang('txt125')?> *</label>
                                <input name="country" type="text" class="form-control"
                                    placeholder="<?=$this_user['country']?> ">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for="exampleInputname1"><?=lang('txt126')?> *</label>
                                <input name="city" type="text" class="form-control"
                                    placeholder="<?=$this_user['city']?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" placeholder="<?=$this_user['email']?>" readonly>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for="exampleInputname">Telegram</label>
                                <input name="tg" type="text" class="form-control" placeholder="<?=$this_user['tg']?> ">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for="exampleInputname1">Viber</label>
                                <input name="viber" type="text" class="form-control"
                                    placeholder="<?=$this_user['viber']?>">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary mt-1"><?=lang('txt127')?></button>
                    </div>
                </form>
                <label class="form-label"><?=lang('txt114')?></label>
                <figure class="highlight clip-widget" id="avatarsq1">
                    <pre><?=$reflink?></pre>
                    <div onclick="copyToClipboard('<?=$reflink?>')" class="clipboard-icon"
                        data-clipboard-target="#avatarsq1"><i class="fa fa-clipboard"></i></div>
                </figure>
                <div class="row">
                    <div class="col-xl-6 col-lg-12 col-md-12 ">
                    <form action="UserSettingController/personals_reset/" method="post">
                        <div class="form-group">
                            <label for="exampleInputnumber"><?=lang('txt128')?> Bitcoin</label>
                            <input name="adr_with_btc" type="text" class="form-control"
                            <?=$this_user['adr_with_btc']==''?'':'disabled'?> placeholder="<?=$this_user['adr_with_btc']?>">
                        </div>
                        <?if($this_user['adr_with_btc']==''){?>
                        <button type="submit" class="btn btn-primary mt-1"><?=lang('txt127')?></button>
                        <?}?>
                    </form>
                    <form action="UserSettingController/personals_reset/" method="post">
                        <div class="form-group">
                            <label for="exampleInputnumber"><?=lang('txt128')?> USDT (ERC20)</label>
                            <input name="adr_with_usdt" type="text" class="form-control"
                            <?=$this_user['adr_with_usdt']==''?'':'disabled'?>  placeholder="<?=$this_user['adr_with_usdt']?>">
                        </div>
                        <?if($this_user['adr_with_usdt']==''){?>
                        <button type="submit" class="btn btn-primary mt-1"><?=lang('txt127')?></button>
                        <?}?>
                    </form>
                    </div>
                    <div class="col-xl-6 col-lg-12 col-md-12">
                    <form action="UserSettingController/personals_reset/" method="post">
                        <div class="form-group">
                            <label for="exampleInputnumber"><?=lang('txt129')?> Perfect Money USD</label>
                            <input name="adr_with_usd" type="text" class="form-control"
                            <?=$this_user['adr_with_usd']==''?'':'disabled'?>  placeholder="<?=$this_user['adr_with_usd']?>">
                        </div>
                        <?if($this_user['adr_with_usd']==''){?>
                        <button type="submit" class="btn btn-primary mt-1"><?=lang('txt127')?></button>
                        <?}?>
                    </form>
                    <form action="UserSettingController/personals_reset/" method="post">
                        <div class="form-group">
                            <label for="exampleInputnumber"><?=lang('txt129')?> ETH</label>
                            <input name="adr_with_eth" type="text" class="form-control"
                              <?=$this_user['adr_with_eth']==''?'':'disabled'?>  placeholder="<?=$this_user['adr_with_eth']?>">
                        </div>
                        <?if($this_user['adr_with_eth']==''){?>
                        <button type="submit" class="btn btn-primary mt-1"><?=lang('txt127')?></button>
                        <?}?>
                    </form>
                    </div>
                </div>

            </div>


        </div>
    </div>
    <div class="col-lg-4 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?=lang('txt130')?></h3>
            </div>
            <div class="card-body">
                <div class="media-list">
                    <div class="media mt-1 pb-2">
                        <div class="mediaicon">
                            <i class="fe fe-user" aria-hidden="true"></i>
                        </div>
                        <div class="media-body ml-5 mt-1">
                            <h6 class="mediafont text-dark mb-1"><?=$sponsor['name']?> <?=$sponsor['lastname']?></h6>
                            <span class="d-block"><?=$sponsor['login']?></span>
                        </div>
                    </div>
                    <div class="media mt-1 pb-2">
                        <div class="mediaicon">
                            <i class="fe fe-mail" aria-hidden="true"></i>
                        </div>
                        <div class="media-body ml-5 mt-1">
                            <span class="d-block"><?=$sponsor['email']?></span>
                        </div>
                    </div>
                    <div class="media mt-1 pb-2">
                        <div class="mediaicon">
                            <i class="fe fe-map-pin" aria-hidden="true"></i>
                        </div>
                        <div class="media-body ml-5 mt-1">
                            <h6 class="mediafont text-dark mb-1"><?=$sponsor['country']?></h6>
                            <span class="d-block"><?=$sponsor['city']?></span>
                        </div>
                    </div>
                    <div class="media mt-1 pb-2">
                        <div class="mediaicon">
                            <i class="fab fa-viber" aria-hidden="true"></i>
                        </div>
                        <div class="media-body ml-5 mt-1">
                            <h6 class="mediafont text-dark mb-1">Viber</h6>
                            <span class="d-block"><?=$sponsor['viber']?></span>
                        </div>
                    </div>
                    <div class="media mt-1 pb-2">
                        <div class="mediaicon">
                            <i class="fab fa-telegram-plane" aria-hidden="true"></i>
                        </div>
                        <div class="media-body ml-5 mt-1">
                            <h6 class="mediafont text-dark mb-1">Telegram</h6>
                            <span class="d-block"><?=$sponsor['tg']?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card panel-theme">
            <div class="card-header">
                <h3 class="card-title"><?=lang('txt131')?></h3>
            </div>
            <form action="UserSettingController/password_reset/" method="post">
                <div class="card-body no-padding">
                    <div class="form-group mb-0">
                        <label><?=lang('txt132')?></label>
                        <input name="old_password" type="password" class="form-control" placeholder="******">
                    </div>
                    <div class="form-group mb-0">
                        <label><?=lang('txt133')?></label>
                        <input name="password" type="password" class="form-control" placeholder="******">
                    </div>
                    <small class="alert-danger"></small>
                    <div class="form-group mb-0">
                        <label><?=lang('txt134')?></label>
                        <input name="rpassword" type="password" class="form-control" placeholder="******">
                    </div>
                    <small class="alert-danger"></small>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary mt-1"><?=lang('txt131')?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ROW-1 CLOSED -->

</div>
</div>

<? $this->load->view('layouts/footer'); ?>


</body>

</html>