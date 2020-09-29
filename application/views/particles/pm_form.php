 <!--==============================================-->

 <h4>Вы хотите совершить пополнение на $<?= $sum;?> с помощью <?=strtoupper($cur);?>?</h4>

 <form id="perf_form" role="form" action="https://perfectmoney.com/api/step1.asp" method="POST">

     <input type="hidden" name="PAYEE_ACCOUNT" value="U9538241">
     <input type="hidden" name="PAYEE_NAME" value="Grid Yard">
     <input type="hidden" name="PAYMENT_UNITS" value="USD">
     <input type="hidden" name="STATUS_URL" value="<?= $payment_url ;?>">
     <input type="hidden" name="PAYMENT_URL" value="<?= $back_url;?>">
     <input type="hidden" name="NOPAYMENT_URL" value="<?= $back_url;?>">
     <input type="hidden" name="PAYMENT_ID" value="<?= $this_user['id'];?>">
     <input type="hidden" name="PAYMENT_AMOUNT" value="<?= $sum;?>">
     <button type='submit' class="swal2-confirm swal2-styled"
     style="display: inline-block; border-left-color: rgb(48, 133, 214); border-right-color: rgb(48, 133, 214);"
      >Пополнить</button>
 </form>

 <!--==============================================-->