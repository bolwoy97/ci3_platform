<? $this->load->view('layouts/header', ['this_user'=>$this_user] ); ?>


<!-- ROW-4 -->

<div class="row row-desc">

    <div class="col-md-12 col-lg-4">
        <div class="card">
            <div class="card-body">

                <?if($this_user['is_grid']>0 && $this_user['is_grid']<3){?>
                <div class="alert alert-warning">
                    <?=lang('txt135')?>
                </div>
                <?
                                $payment_url = base_url().'grid_activate_pm/';
                                $back_url = base_url().'wallet/';
                                $sum = 1;
                            ?>
                <form id="perf_form" role="form" action="<?=$GLOBALS['env']['pm_form']['action']?>" method="POST">
                    <input type="hidden" name="PAYEE_ACCOUNT" value="<?=$GLOBALS['env']['pm_form']['PAYEE_ACCOUNT']?>">
                    <input type="hidden" name="PAYEE_NAME" value="<?=$GLOBALS['env']['pm_form']['PAYEE_NAME']?>">
                    <input type="hidden" name="PAYMENT_UNITS" value="<?=$GLOBALS['env']['pm_form']['PAYMENT_UNITS']?>">
                    <input type="hidden" name="STATUS_URL" value="<?= $payment_url ;?>">
                    <input type="hidden" name="PAYMENT_URL" value="<?= $back_url;?>">
                    <input type="hidden" name="NOPAYMENT_URL" value="<?= $back_url;?>">
                    <input type="hidden" name="PAYMENT_ID" value="<?= $this_user['id'];?>">
                    <input type="hidden" name="PAYMENT_AMOUNT" value="<?= $sum;?>">
                    <input type='submit' class="btn btn-primary mt-4 btn-block" value='Активация'>
                </form>
                <?}else{?>
                <div class="form-group has-success">
                    <label class="form-label"><?=lang('txt136')?></label>
                    <input type="text" class="form-control  " :placeholder="user_bal_usd" readonly>
                </div>
                <div class="form-group">
                    <label class="form-label"><?=lang('txt137')?></label>
                    <input id="add_sum" type="number" step="0.01" value="10" class="form-control " placeholder="0">
                </div>
                <div class="form-group ">
                    <label class="form-label mt-0"><?=lang('txt138')?></label>
                    <select id="add_cur" class="form-control select2 custom-select">
                        <option value="usd">PERFECT MONEY</option>
                        <option value="btc">BITCOIN</option>
                        <option value="eth">ETH</option>
                        <option value="usdt">USDT (ERC20)</option>
                        <option value="fchng">FCHANGE</option>

                    </select>
                </div>
                <input type='button' class="btn btn-primary mt-4 btn-block" value='<?=lang('txt164')?>' id='add_subm'>
                <?}?>

            </div>
        </div>
    </div><!-- COL END -->
    <div class="col-md-12 col-lg-4">
        <div class="card">
            <div class="card-body">
                <form id="with_form" action="operations/WithdrawController/new_with/" method="post">
                    <div class="form-group has-success">
                        <label class="form-label"><?=lang('txt129')?> USD</label>
                        <input type="text" class="form-control  " placeholder="<?=$this_user['wal_usd']?>" readonly
                            disabled>
                    </div>
                    <div class="form-group">
                        <label class="form-label"><?=lang('txt139')?></label>
                        <input type="number" step="0.01" min="0.01" name="sum" class="form-control " placeholder="0">
                    </div>
                    <div class="form-group ">
                        <label class="form-label mt-0"><?=lang('txt140')?></label>
                        <select name="cur" class="form-control select2 custom-select">
                            <option value="bal_usd"><?=lang('txt136')?></option>
                            <option value="usd">PERFECT MONEY</option>
                            <option value="btc">BITCOIN</option>
                            <!--<option value="usdt">USDT (ERC20)</option>
                                <option value="eth">ETH</option>-->
                            
                        </select>
                    </div>
                    <input type='button' onclick="ask_with();" class="btn btn-danger mt-4 btn-block"
                        value='<?=lang('txt204')?>' id='click3'>
                </form>
            </div>
        </div>
    </div><!-- COL END -->

    <?if(true){?>
    <div class="col-md-12 col-lg-4">
        <div class="card">
            <div class="card-body" id="buy_tok">
                
                    <div class="form-group has-success">
                        <label class="form-label" title="<?=lang('txt165_15')?>"><?=lang('txt165_14')?> YRD
                            <span class=" badge badge-dark badge-pill"> ?</span></label>
                        <input type="text" class="form-control  " :placeholder="buy_tok.bal_tok" readonly>
                    </div>
                    <div class="form-group">
                        <label class="form-label" title="<?=lang('txt165_16')?>"><?=lang('txt165_17')?>
                            <span class=" badge badge-dark badge-pill"> ?</span></label>
                        <input type="text" class="form-control " :placeholder="buy_tok.user_status" readonly>
                    </div>
                    <div class="form-group  has-danger">
                        <label class="form-label" title="<?=lang('txt165_18')?>"><?=lang('txt165_19')?> <span
                                class=" badge badge-dark badge-pill"> ?</span><span class="badgetext badge badge-pill">
                                <?=lang('txt165_20')?> <span class=" badge badge-dark badge-pill"
                                    title="<?=lang('txt165_21')?>"> ?</span></span></label>
                        <div class="row gutters-xs">
                            <div class="col-6">
                            <!--  @input="gen_buy_tok_usd_sum()" -->
                                <input type="number" step="0.01"  min="0.01" class="form-control" placeholder="YRD" 
                                v-model="buy_tok.tok_sum" readonly value="">
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" v-model="buy_tok.usd_sum" placeholder="0" readonly>
                            </div>
                        </div>
                    </div>
                    <button type='button' class="btn btn-info mt-4 btn-block" id='click2' 
                    v-on:click="buy_tok_ask()" :disabled="buy_tok.bal_tok >=1"
                    ><?=lang('txt165_22')?>
                        {{buy_tok.tok_price}}$</button>
                
            </div>
        </div>
    </div>
    <?}else{?>
    <div class="col-md-12 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="form-group has-success">
                    <label class="form-label"><?=lang('txt141')?> YRD</label>
                    <input type="text" class="form-control  " placeholder="0" readonly>
                </div>
                <div class="form-group">
                    <label class="form-label"><?=lang('txt142')?> </label>
                    <input type="text" class="form-control " placeholder="0$">
                </div>
                <div class="form-group">
                    <label class="form-label"><?=lang('txt143')?> </label>
                    <input type="text" class="form-control " placeholder="0$">
                </div>
                <ul class="list-group">
                    <input type="text" class="form-control  " placeholder="0 ордеров" readonly disabled>
                </ul>
            </div>
        </div>
    </div><!-- COL END -->
    <?}?>

</div>

<!-- -->
<div class="row row-desc">
    <div class="col-lg-12 col-md-12">
        <div class="card card-body">
            <div class="panel panel-primary">
                <div class=" tab-menu-heading">
                    <div class="tabs-menu1 ">
                        <!-- Tabs -->
                        <ul class="nav panel-tabs">
                            <li><a href="#tab5" class="active" data-toggle="tab"><?=lang('txt144')?></a></li>
                            <li><a href="#tab6" data-toggle="tab"><?=lang('txt145')?></a></li>
                            <li><a href="#tab7" data-toggle="tab"><?=lang('txt146')?></a></li>
                            <li><a href="#tab8" data-toggle="tab"><?=lang('txt165_14')?></a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body tabs-menu-body">
                    <div class="tab-content">
                        <div class="tab-pane active " id="tab5">
                            <div class="table-responsive content vscroll h-600">
                                <table class="table card-table table-vcenter " >
                                    <thead>
                                        <tr>
                                            <th><?=lang('txt120')?></th>
                                            <th><?=lang('txt118')?></th>
                                            <th><?=lang('txt147')?></th>
                                            <th class="text-right"><?=lang('txt148')?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="ref_oper in ref_opers">
                                            <td>{{ref_oper.date}}</td>
                                            <td><a href="#">{{ref_oper.detail}}</a></td>
                                            <td>{{ref_oper.rate}}</td>
                                            <td class="text-right">{{ref_oper.sum}}$</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                         
                        </div>
                        <div class="tab-pane " id="tab6">
                            <div class="table-responsive content vscroll h-600">
                                <table class="table card-table table-vcenter ">
                                    <thead>
                                        <tr>
                                            <th><?=lang('txt120')?></th>
                                            <th><?=lang('txt149')?></th>
                                            <th class="text-right"><?=lang('txt148')?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?foreach ($operations as $key => $rec) {
													?>
                                        <tr>
                                            <td><?=$rec['date']?></td>
                                            <td><?=strtoupper($rec['cur'])?></td>
                                            <td class="text-right"><?=$rec['sum']?>$</td>
                                        </tr>
                                        <?
												}?>
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>
                        <div class="tab-pane " id="tab7">
                            <div class="table-responsive content vscroll h-600">
                                <table class="table card-table table-vcenter ">
                                    <thead>
                                        <tr>
                                            <th><?=lang('txt120')?></th>
                                            <th><?=lang('txt149')?></th>
                                            <th><?=lang('txt148')?></th>
                                            <th class="text-right"><?=lang('txt150')?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?foreach ($withdrawals as $key => $with) {?>
                                        <tr>
                                            <td><?=$with['date']?></td>
                                            <td><?=strtoupper($with['cur'])?></td>
                                            <td><?=$with['sum']?>$</td>
                                            <td class="text-info text-right"><?=$with['status_show']?></td>
                                        </tr>
                                        <?}?>

                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <div class="tab-pane" id="tab8">
                            <div class="table-responsive content vscroll h-600">
                                <table class="table card-table table-vcenter ">
                                    <thead>
                                        <tr>
                                            <th><?=lang('txt120')?></th>
                                            <th><?=lang('txt165_19')?></th>
                                            <th><?=lang('txt147')?> USD</th>
                                            <th><?=lang('txt148')?> USD</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="buy_tok_order in buy_tok_orders">
                                            <td>{{buy_tok_order.buy_date}}</td>
                                            <td>{{buy_tok_order.buy_tok}}</td>
                                            <td>{{buy_tok_order.buy_price}}</td>
                                            <td>{{buy_tok_order.buy_usd}}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                         
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ROW-4 END -->
</div>
</div>
<!-- CONTAINER END -->

<? $this->load->view('layouts/footer'); ?>


<script>
$(function() {
    $("#add_subm").on("click", function(e) {
        var cur = $('#add_cur').val();
        var sum = $('#add_sum').val();
        if (cur == 'fchng') {
            window.location.href = "fchange_form?sum=" + sum;
        }
        Swal.fire({
            title: `<?=lang('txt152')?>`,
            html: `<h3><?=lang('txt151')?> </h3>`,
            showConfirmButton: false,
        })
        var params = {
            cur: cur,
            sum: sum,
        }
        $.post("operations/AdditionController/get_addition", params, function(data) {
            Swal.fire({
                title: `<?=lang('txt152')?>`,
                html: ` ${data} `,
                showConfirmButton: (cur != 'usd'),
            })
        });

        return;
    })
})
</script>



<script>
function ask_with() {
    Swal.fire({
        title: ``,
        html: `<h3><?=lang('txt153')?></h3>`,
        showCancelButton: true,
        confirmButtonText: '<?=lang('
        txt103 ')?>',
        cancelButtonText: '<?=lang('
        txt104 ')?>',
    }).then((result) => {
        if (result.value) {
            $('#with_form').submit();
        }
    })
}
</script>


<script>
    
    
var app = new Vue({
    el: '#app',
    data() {
        return {
            loading: false,
            user_bal_usd:0,
            buy_tok:{
                bal_tok: 0,
                user_status:'',
                tok_price: 0,
                tok_sum:'',
                usd_sum:0,
                buy_fee:0,
            },

            buy_tok_orders:{},
            ref_opers: {},
        }
    },
    methods: {
        async  update(){
            if (this.loading) {
                return
            }
            this.loading = true
            let res = await request('api/HomeApiController/wallet/', 'POST', {

            })
            //console.log(res)
            
            this.buy_tok.tok_price = res.tok_price
            this.buy_tok.bal_tok = res.user_tok_bal
            this.buy_tok.user_status = res.user_status
            this.user_bal_usd = res.user_bal_usd
            this.buy_tok_orders = res.buy_tok_orders
            this.buy_tok.buy_fee = res.buy_tok.buy_fee
            this.ref_opers = res.ref_opers

            this.loading = false
            return res
        },

        gen_buy_tok_usd_sum(){
            
            this.buy_tok.usd_sum = this.buy_tok.tok_sum * this.buy_tok.tok_price;
            this.buy_tok.usd_sum = (this.buy_tok.usd_sum + this.buy_tok.usd_sum/100 * this.buy_tok.buy_fee).toFixed(2)
        },
        
        buy_tok_ask(){
            if(this.buy_tok.bal_tok >=1){return;}
            Swal.fire({
                    title: ``,
                    html: `<h3><?=lang('txt165_23')?></h3>`,
                    showCancelButton: true,
                    confirmButtonText: '<?=lang('txt103')?>',
                    cancelButtonText: '<?=lang('txt104')?>',
                }).then((result) => {
                    if (result.value) {
                        //$('#buy_tok_form').submit();
                        this.buy_send()
                    }
                })
                return;
        },

        async buy_send() {
            Swal.fire({
                title: ``,
                html: `<h3><?=lang('txt105')?> </h3>`,
                showConfirmButton: false,
            })
            let res = await request('operations/OrderController/buy_tok', 'POST', {
                buy_tok: this.buy_tok.tok_sum,
                buy_price: this.buy_tok.tok_price,
            })
            //console.log(res)
            if (res.errors) {
                Swal.fire({
                    icon: 'error',
                    html: `<h3>${res.errors.join('<br>')} </h3>`,
                })
            } else if (res.success) {
                Swal.fire({
                    icon: 'success',
                    html: `<h3>${res.success.join('<br>')} </h3>`,
                })
            }
            this.buy_tok.tok_sum = ''
            //this.update()
        },

    },
    async mounted(){
        await this.update()
        this.buy_tok.tok_sum = 1
        this.gen_buy_tok_usd_sum()
        setInterval(() => {
            this.update()
        }, 3000);
    },

})


</script>

</body>

</html>