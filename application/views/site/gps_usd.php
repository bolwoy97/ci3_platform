<? $this->load->view('layouts/header', ['this_user'=>$this_user] ); ?>

<!-- ROW-3 -->
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> GPS - USD <span class="text-right"> <?=lang('txt68')?> {{tok2_price}}</span></h4>
            </div>
            <div class="card-body">
                <div>
                    <div class="flot-chart h-300" id="flotChart_new" style="color:black;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header text-center">
                <h5 class="card-title"><?=lang('txt69')?></h5>
            </div>
            <div class="card-body">
                <div class="table-responsive content h-300">
                    <table class="table card-table table-vcenter text-center">
                    <thead>
                            <tr>
                                <th><?=lang('txt71')?></th>
                                <th><?=lang('txt72')?></th>
                                <th><?=lang('txt73')?></th>
                                <th class="text-"><?=lang('txt70')?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="order in all_orders">
                                <th><small> {{order.buy_date}}</small></th>
                                <th>{{order.buy_price}}</th>
                                <th>{{order.buy_tok}}YRD</th>
                                <th class="text-">{{(order.buy_tok*order.buy_price).toFixed(2)}}USD</th></small>
                            </tr>
                            <tr v-if="all_orders.length >= 100">
                                <th></th>
                                <th><button type="button" class="btn btn-info  btn-sm mb-1"
                                        v-on:click="limits.all_orders += 100;"><?=lang('txt79')?></button></th>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- ROW-3 END -->

<!-- ROW-4 -->
<div class="row row-desc">
    <div class="col-lg-8 col-md-12">
        <div class="card card-body">
            <div class="panel panel-primary">
                <div class=" tab-menu-heading">
                    <div class="tabs-menu1 ">
                        <!-- Tabs -->
                        <ul class="nav panel-tabs">
                            <li><a href="#my_orders" class="active" data-toggle="tab"><?=lang('txt74')?></a></li>
                            <li><a href="#all_orders" data-toggle="tab"><?=lang('txt75')?></a></li>
                            <li><a href="#my_history" data-toggle="tab"><?=lang('txt76')?></a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body tabs-menu-body">
                    <div class="tab-content">
                        <div class="tab-pane active " id="my_orders">
                            <div class="table-responsive content h-600">
                                <table class="table card-table table-vcenter text-center" >
                                    <thead>
                                        <tr>
                                            <th><?=lang('txt71')?></th>
                                            <th><?=lang('txt215')?></th>
                                            <th><?=lang('txt73')?></th>
                                            <th><?=lang('txt72')?></th>
                                            <th><?=lang('txt70')?></th>
                                            <th><?=lang('txt100')?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="user_order in user_orders">
                                            <th>{{user_order.buy_date}}</th>
                                            <th>{{user_order.show_type}}</th>
                                            <th>{{user_order.buy_tok}} YRD</th>
                                            <th>{{user_order.sell_price}}</th>
                                            <th>{{(user_order.buy_tok*user_order.sell_price).toFixed(2)}} USD</th>
                                            <th>{{user_order.sell_usd}} USD</th>

                                        </tr>
                                        <tr v-if="user_orders.length >= 100">
                                            <th>
                                            </th>
                                            <th><button type="button" class="btn btn-info  btn-sm mb-1"
                                            v-on:click="limits.user_orders += 100;"><?=lang('txt79')?></button>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane " id="all_orders">
                            <div class="table-responsive content h-600">
                                <table class="table card-table table-vcenter text-center" >
                                    <thead>
                                        <tr>
                                            <th><?=lang('txt72')?></th>
                                            <th><?=lang('txt73')?></th>
                                            <th class="text-"><?=lang('txt70')?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="stage in stages_tok2">
                                            <th>{{stage.price}}</th>
                                            <th>{{stage.sell_tok}} GPS</th>
                                            <th class="text-">{{(stage.sell_tok*stage.price).toFixed(2)}} USD</th>
                                        </tr>
                                        <tr v-if="stages_tok2.length >= 100">
                                            <th></th>
                                            <th><button type="button" class="btn btn-info  btn-sm mb-1"
                                            v-on:click="limits.stages_tok2 += 100;"><?=lang('txt79')?></button>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>
                        <div class="tab-pane " id="my_history">
                            <div class="table-responsive content  h-600">
                                <table class="table card-table table-vcenter text-center" >
                                    <thead>
                                        <tr>
                                            <th><?=lang('txt71')?></th>
                                            <th><?=lang('txt215')?></th>
                                            <th><?=lang('txt216')?> GPS</th>
                                            <th><?=lang('txt72')?></th>
                                            <th><?=lang('txt70')?></th>
                                            <th><?=lang('txt100')?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="closed_order in user_closed_orders">
                                            <th> <small> {{closed_order.sell_date}}</small></th>
                                            <th>{{closed_order.show_type}}</th>
                                            <th>{{closed_order.buy_tok}} GPS</th>
                                            <th>{{closed_order.sell_price}} USD</th>
                                            <th>{{closed_order.buy_tok*closed_order.sell_price}} USD</th>
                                            <th>{{closed_order.sell_usd}} USD</th>
                                        </tr>
                                        <tr v-if="user_closed_orders.length >= 100">
                                            <th></th>
                                            <th><button type="button" class="btn btn-info  btn-sm mb-1"
                                            v-on:click="limits.user_closed_orders += 100;"><?=lang('txt79')?></button>
                                            </th>
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
    <?if($this_user['is_tester'] || $this_user['is_suser']){?>
    <?}?>
    <div class="col-md-12 col-lg-4">
        <div class="card card-body">
            <div class="panel panel-primary">
                <div class=" tab-menu-heading">
                    <div class="tabs-menu1 ">
                        <!-- Tabs -->
                        <ul class="nav panel-tabs">
                            <li><a href="#buy" class="active" data-toggle="tab"><?=lang('txt101')?></a></li>
                            <li><a href="#sell" data-toggle="tab"><?=lang('txt217')?></a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body tabs-menu-body">
                    <div class="tab-content">
                        <div class="tab-pane active " id="buy">
                            <div>
                                <ul class="list-group mb-4">
                                </ul>
                                <div class="form-group  has-danger">
                                    <label class="form-label" title="<?=lang('txt218')?>"><?=lang('txt72')?> GPS <span
                                            class=" badge badge-dark badge-pill"> ?</span><span
                                            class="badgetext badge badge-pill"
                                            title="<?=lang('txt219')?>"><?=lang('txt202')?> <span
                                                class=" badge badge-dark badge-pill"> ?</span></span></label>
                                    <div class="row gutters-xs">
                                        <div class="col-6">
                                            <input type="text" class="form-control  " :placeholder="tok2_price"
                                                readonly>
                                        </div>
                                        <div class="col-6">
                                            <input type="text" class="form-control" :value="buy_stage.tok_left"
                                                placeholder="0" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group has-danger">
                                    <label class="form-label" title="<?=lang('txt220')?>"><?=lang('txt216')?> GPS 
                                    <span class=" badge badge-dark badge-pill"> ?</span></label>
                                    <input type="number" min="0.01" step="0.01" v-model="buy_tok" @input="gen_buy_usd_sum()"
                                        class="form-control  " placeholder="0">
                                </div>
                                <div class="form-group  has-danger">
                                    <label class="form-label" title="<?=lang('txt221')?>"><?=lang('txt87')?>
                                        <span class=" badge badge-dark badge-pill"> ?</span><span
                                            class="badgetext badge badge-pill"><?=lang('txt100')?> <span
                                                class=" badge badge-dark badge-pill"
                                                title="<?=lang('txt88')?>"> ?</span></span></label>
                                    <div class="row gutters-xs">
                                        <div class="col-6">
                                            <input type="number" min="0.01" step="0.01" v-model="buy_usd" @input="gen_buy_tok_sum()"
                                                class="form-control " placeholder="0">
                                        </div>
                                        <div class="col-6">
                                            <input type="text" v-model="buy_usd_and_fee" class="form-control  "
                                                placeholder="0" readonly>
                                            <label title="<?=lang('txt222')?>"><small><?=lang('txt179')?>:{{user_bal_usd}} $
                                                    <span class=" badge badge-dark badge-pill"> ?</span></small></label>
                                        </div>
                                    </div>
                                </div>
                                <div v-if="buy_errors">
                                    <p v-for="error in buy_errors" class="alert alert-warning">{{error}}</p>
                                </div>
                                <?if($this_user['info']['tok_bal']>=1){?>
                                    <button type='button' v-on:click="buy_ask()"
                                    class="btn btn-primary mt-4 btn-block"><?=lang('txt101')?> GPS</button>
                                <?}?>
                                
                            </div>
                        </div>
                        <div class="tab-pane " id="sell">
                            <div>
                                <ul class="list-group mb-4">
                                </ul>
                                <div class="form-group  has-danger">
                                    <label class="form-label"
                                        title="<?=lang('txt223')?>"><?=lang('txt91')?> <span
                                            class=" badge badge-dark badge-pill"> ?</span><span
                                            class="badgetext badge badge-pill"
                                            title="<?=lang('txt224')?>">
                                            <?=lang('txt93')?>
                                             <span class=" badge badge-dark badge-pill"> ?</span></span></label>
                                    <div class="row gutters-xs">
                                        <div class="col-6">
                                        
                                            <input type="number" min="0.01" step="0.01" v-model="sell_price" @input="gen_sell_usd()"
                                            <?if($this_user['info']['tok_bal']<1){?> readonly <?}?>    class="form-control " placeholder="0">
                                        
                                        </div>
                                        <div class="col-6">
                                            <input type="text" class="form-control is-valid"
                                                :placeholder="sell_stage.price" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group has-danger">
                                    <label class="form-label"
                                        title="<?=lang('txt225')?>"><?=lang('txt216')?> GPS <span
                                            class=" badge badge-dark badge-pill"> ?</span><span
                                            class="badgetext badge badge-pill"
                                            title="<?=lang('txt226')?>">
                                            <?=lang('txt179')?> {{user_bal_tok2}} GPS <span class=" badge badge-dark badge-pill"> ?</span></span></label>
                                    <input type="number" min="0.01" step="0.01" v-model="sell_tok" @input="gen_sell_usd()" class="form-control  "
                                        placeholder="0">
                                </div>
                                <div class="form-group  has-danger">
                                    <label class="form-label" title="<?=lang('txt227')?>"><?=lang('txt95')?>
                                         <span class=" badge badge-dark badge-pill"> ?</span><span
                                            class="badgetext badge badge-pill"
                                            title="<?=lang('txt226')?>"><?=lang('txt228')?>
                                            <span class=" badge badge-dark badge-pill"> ?</span></span></label>
                                    <div class="row gutters-xs">
                                        <div class="col-6">
                                            <input type="text" v-model="sell_usd" class="form-control "
                                                placeholder="0" readonly>
                                            <label
                                                title="Сумма, которая будет зачислена на кошелек после продажи"><small>
                                                <?=lang('txt203')?>: {{sell_usd_fee}}$ <span
                                                        class=" badge badge-dark badge-pill">
                                                        ?</span></small></label>
                                        </div>
                                        <div class="col-6">
                                            <input type="text" class="form-control is-valid"
                                                :value="sell_stage.tok_left" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div v-if="sell_errors">
                                    <p v-for="error in sell_errors" class="alert alert-warning">{{error}}</p>
                                </div>
                                <?if($this_user['info']['tok_bal']>=1){?>
                                <button type='button' v-on:click="sell_ask()"
                                    class="btn btn-danger mt-4 btn-block"><?=lang('txt217')?> GPS</button>
                                <?}?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- COL END -->
   
</div>
<!-- ROW-4 END -->
</div>
</div>
<!-- CONTAINER END -->

<? $this->load->view('layouts/footer'); ?>
<script src="assets/js/index1.js"></script>

<script>
var app = new Vue({
    el: '#app',
    data() {
        return {
            tok2_price: 0,
            user_bal_usd: 0,
            user_bal_tok2: 0,
            buy_stage: {},
            buy_errors: {},
            buy_tok: 0,
            buy_usd: 0,
            buy_usd_and_fee: 0,

            sell_tok: 0,
            sell_price: 0,
            sell_stage: {},
            sell_errors: [],
            sell_usd: 0,
            sell_usd_fee: 0,

            all_orders: {},
            user_orders: {},
            user_closed_orders: {},
            stages_tok2: {},

            rate_chart:false,

            limits:{
                all_orders: 100,
                user_orders: 100,
                user_closed_orders: 100,
                stages_tok2: 100,
            },
        }
    },
    methods: {
        async update() {
            if (this.loading) {
                return
            }
            this.loading = true
            let res = await request('api/HomeApiController/gps_usd/', 'POST', {
                buy_tok: this.buy_tok,
                buy_price: this.tok2_price,
                sell_tok: this.sell_tok,
                sell_price: this.sell_price,
                limits: this.limits,
                get_chart: (!this.rate_chart)?1:0, 

            })
            //console.log(res)

            if(typeof res.update_timeout !== 'undefined'){
                setTimeout(() => {
                    this.update()
                }, res.update_timeout);
            }
            
            this.user_bal_usd = res.user_bal_usd
            this.user_bal_tok2 = res.user_bal_tok2
            
            this.buy_stage = res.buy_stage
            this.buy_errors = res.buy_errors

            this.sell_stage = res.sell_stage
            this.sell_errors = res.sell_errors

            this.all_orders = res.all_orders
            this.user_orders = res.user_orders
            this.user_closed_orders = res.user_closed_orders
            this.stages_tok2 = res.stages_tok2
            
            if(typeof res.rate_chart !== 'undefined'){
                this.rate_chart = res.rate_chart
                this.build_chart()
            }else if(this.tok2_price != res.tok2_price){
                this.rate_chart = false;
            }
            
            this.tok2_price = res.tok2_price


            this.loading = false
            return res
        },

        gen_buy_usd_sum() {
            this.buy_usd = (this.buy_tok * this.tok2_price).toFixed(2)
            this.buy_usd_and_fee = (this.buy_usd / 100 * 105).toFixed(2)
        },
        gen_buy_tok_sum() {
            this.buy_tok = (this.buy_usd / this.tok2_price).toFixed(2)
            this.buy_usd_and_fee = (this.buy_usd / 100 * 105).toFixed(2)
        },

        buy_ask() {
            Swal.fire({
                title: ``,
                html: `<h3><?=lang('txt101')?> GPS ?</h3>`,
                showCancelButton: true,
                confirmButtonText: '<?=lang('txt103')?>',
                cancelButtonText: '<?=lang('txt104')?>',
            }).then((result) => {
                if (result.value) {
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
            let res = await request('operations/OrderController/buy_tok2_order', 'POST', {
                buy_tok: this.buy_tok,
                buy_price: this.tok2_price,
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

            this.buy_tok = 0
            //this.update()
        },

        gen_sell_usd() {
            this.sell_usd = (this.sell_tok * this.sell_price).toFixed(2)
            this.sell_usd_fee = (this.sell_usd - this.sell_usd / 100 * 5).toFixed(2)
        },

        sell_ask() {
            Swal.fire({
                title: ``,
                html: `<h3><?=lang('txt217')?> GPS ?</h3>`,
                showCancelButton: true,
                confirmButtonText: '<?=lang('txt103')?>',
                cancelButtonText: '<?=lang('txt104')?>',
            }).then((result) => {
                if (result.value) {
                    this.sell_send()
                }
            })
            return;
        },

        async sell_send() {
            Swal.fire({
                title: ``,
                html: `<h3><?=lang('txt105')?> </h3>`,
                showConfirmButton: false,
            })
            let res = await request('operations/OrderController/sell_tok2_order', 'POST', {
                sell_tok: this.sell_tok,
                sell_price: this.sell_price,
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

            this.sell_tok = 0
            this.sell_price = 0
            //this.update()
        },

        build_chart(){
                    $('#flotChart_new').html('')
                    if(this.rate_chart!=false){ 
                        build_apex_hart('flotChart_new',this.rate_chart) 
                    }
        },

    },
    computed: {
        // геттер вычисляемого значения
        /*  get_sell_usd: function () {
              return this.sell_tok * this.sell_price
          }*/

    },
    async mounted() {
        let f_res = await this.update()
        /*this.rate_chart = f_res.rate_chart;
        this.build_chart()*/
        setInterval(() => {
            this.update()
        }, 20000);
        
    },

})
</script>


</body>

</html>