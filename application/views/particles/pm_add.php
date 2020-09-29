 <!--==============================================-->

 <h4><?=lang('txt162')?> $<?= $sum;?> <?=lang('txt163')?> <?=strtoupper($cur);?>?</h4>

 <form id="perf_form" role="form" action="<?=$GLOBALS['env']['pm_form']['action']?>" method="POST">
     <input type="hidden" name="PAYEE_ACCOUNT" value="<?=$GLOBALS['env']['pm_form']['PAYEE_ACCOUNT']?>">
     <input type="hidden" name="PAYEE_NAME" value="<?=$GLOBALS['env']['pm_form']['PAYEE_NAME']?>">
     <input type="hidden" name="PAYMENT_UNITS" value="<?=$GLOBALS['env']['pm_form']['PAYMENT_UNITS']?>">
     <input type="hidden" name="STATUS_URL" value="<?= $payment_url ;?>">
     <input type="hidden" name="PAYMENT_URL" value="<?= $back_url;?>">
     <input type="hidden" name="NOPAYMENT_URL" value="<?= $back_url;?>">
     <input type="hidden" name="PAYMENT_ID" value="<?= $this_user['id'];?>">
     <input type="hidden" name="PAYMENT_AMOUNT" value="<?= $sum;?>">
     <button type='submit' class="swal2-confirm swal2-styled"
     style="display: inline-block; border-left-color: rgb(48, 133, 214); border-right-color: rgb(48, 133, 214);"
      ><?=lang('txt164')?></button>
 </form>

 <!--==============================================-->