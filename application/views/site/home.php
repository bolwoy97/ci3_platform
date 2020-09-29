<? $this->load->view('layouts/header',['this_user'=>$this_user]); ?>

<!--<div class="alert alert-warning">
    <p>* testers only </p>
</div>
 ROW-3 -->
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">

                <h4 class="card-title"> YRD - USD <span class="text-right"> <?=lang('txt68')?> <?=$tok_price?></span>
                </h4>
            </div>
            <div class="card-body">
                <div id="rate_chart">
                    <!--<div class="flot-chart h-300" id="testChart"></div>-->
                    <div class="flot-chart h-300" id="flotChart"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card" id="orders_list">
            <div class="card-header text-center">
                <h5 class="card-title"><?=lang('txt69')?></h5>
            </div>
            <div class="card-body">
                <div class="table-responsive content vscroll h-300">
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
                            <tr v-for="order in orders">
                                <th><small> {{order.buy_date}}</small></th>
                                <th>{{order.buy_price}}</th>
                                <th>{{order.buy_tok}}YRD</th>
                                <th class="text-">{{order.buy_usd}}USD</th></small>
                            </tr>
                            <tr v-if="orders.length >= 10">
                                <th></th>
                                <th><button type="button" class="btn btn-info  btn-sm mb-1"
                                        v-on:click="update(orders.length+100)"><?=lang('txt79')?></button></th>
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
                            <li><a href="#tab5" class="active" data-toggle="tab"><?=lang('txt74')?></a></li>
                            <li><a href="#tab6" data-toggle="tab"><?=lang('txt75')?></a></li>
                            <li><a href="#tab7" data-toggle="tab"><?=lang('txt76')?></a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body tabs-menu-body">
                    <div class="tab-content">
                        <div class="tab-pane active " id="tab5">
                            <div class="table-responsive content vscroll h-600">
                                <table class="table card-table table-vcenter text-center" id="user_orders_list">
                                    <thead>
                                        <tr>
                                            <th><?=lang('txt71')?></th>
                                            <th><?=lang('txt77')?></th>
                                            <th><?=lang('txt73')?></th>
                                            <th><?=lang('txt70')?></th>
                                            <th><?=lang('txt78')?></th>
                                            <th><?=lang('txt70')?></th>
                                            <!-- <th><?=lang('txt104')?></th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="user_order in user_orders">
                                            <th>{{user_order.buy_date}}</th>
                                            <th>{{user_order.buy_price}}</th>
                                            <th>{{user_order.buy_tok}} YRD</th>
                                            <th>{{user_order.buy_usd}} USD</th>
                                            <th>{{user_order.sell_price}}</th>
                                            <th>{{user_order.sell_usd}} USD</th>

                                        </tr>
                                        <tr v-if="user_orders.length >= 10">
                                            <th>
                                            </th>
                                            <th><button type="button" class="btn btn-info  btn-sm mb-1"
                                                    v-on:click="update(user_orders.length+100)"><?=lang('txt79')?></button>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!--<div class="pagination-wrapper">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination mb-4 ml-5">
                                        <li class="page-item">
                                            <a aria-label="Next" class="page-link" href="#"><i
                                                    class="fa fa-angle-left"></i></a>
                                        </li>
                                        <li class="page-item active">
                                            <a class="page-link" href="#">1</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">2</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">3</a>
                                        </li>
                                        <li class="page-item">
                                            <a aria-label="Next" class="page-link" href="#"><i
                                                    class="fa fa-angle-right"></i></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>-->
                        </div>
                        <div class="tab-pane " id="tab6">
                            <div class="table-responsive content vscroll h-600">
                                <table class="table card-table table-vcenter text-center" id="stages_list">
                                    <thead>
                                        <tr>
                                            <th><?=lang('txt72')?></th>
                                            <th><?=lang('txt73')?></th>
                                            <th class="text-"><?=lang('txt70')?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="stage in stages">
                                            <th>{{stage.price}}</th>
                                            <th>{{stage.cur_tok}}</th>
                                            <th class="text-">{{(stage.cur_tok*stage.price).toFixed(2)}}</th>
                                        </tr>
                                        <tr v-if="stages.length >= 10">
                                            <th></th>
                                            <th><button type="button" class="btn btn-info  btn-sm mb-1"
                                                    v-on:click="update(stages.length+100)"><?=lang('txt79')?></button>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!--<div class="pagination-wrapper">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination mb-4 ml-5">
                                        <li class="page-item">
                                            <a aria-label="Next" class="page-link" href="#"><i
                                                    class="fa fa-angle-left"></i></a>
                                        </li>
                                        <li class="page-item active">
                                            <a class="page-link" href="#">1</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">2</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">3</a>
                                        </li>
                                        <li class="page-item">
                                            <a aria-label="Next" class="page-link" href="#"><i
                                                    class="fa fa-angle-right"></i></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>-->
                        </div>
                        <div class="tab-pane " id="tab7">
                            <div class="table-responsive content vscroll h-600">
                                <table class="table card-table table-vcenter text-center" id="user_closed_orders_list">
                                    <thead>
                                        <tr>
                                            <th><?=lang('txt71')?></th>
                                            <th><?=lang('txt77')?></th>
                                            <th><?=lang('txt73')?></th>
                                            <th><?=lang('txt70')?></th>
                                            <th><?=lang('txt78')?></th>
                                            <th><?=lang('txt70')?></th>
                                            <!-- <th><?=lang('txt104')?></th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="closed_order in closed_orders">
                                            <th> <small><?=lang('txt80')?>- {{closed_order.buy_date}}<br>
                                                    <?=lang('txt81')?>- {{closed_order.sell_date}}</small></th>
                                            <th>{{closed_order.buy_price}}</th>
                                            <th>{{closed_order.buy_tok}} YRD</th>
                                            <th>{{closed_order.buy_usd}} USD</th>
                                            <th>{{closed_order.sell_price}}</th>
                                            <th>{{closed_order.sell_usd}} USD</th>
                                            <!-- <th><?=lang('txt104')?></th>-->
                                        </tr>
                                        <tr v-if="closed_orders.length >= 10">
                                            <th></th>
                                            <th><button type="button" class="btn btn-info  btn-sm mb-1"
                                                    v-on:click="update(closed_orders.length+100)"><?=lang('txt79')?></button>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!--<div class="pagination-wrapper">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination mb-4 ml-5">
                                        <li class="page-item">
                                            <a aria-label="Next" class="page-link" href="#"><i
                                                    class="fa fa-angle-left"></i></a>
                                        </li>
                                        <li class="page-item active">
                                            <a class="page-link" href="#">1</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">2</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">3</a>
                                        </li>
                                        <li class="page-item">
                                            <a aria-label="Next" class="page-link" href="#"><i
                                                    class="fa fa-angle-right"></i></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?if($this_user['is_tester']>=1 || $this_user['is_suser']>=1){?>
    <?}?>
    <div class="col-md-12 col-lg-4">
        <div class="card" id="buy_order">
            <div class="card-body">
                <form action="operations/OrderController/buy_order/" method="post">
                    <input type="hidden" name="buy_tok" :value="inputs.buy_tok">
                    <input type="hidden" name="buy_price" :value="buy_stage.price">
                    <input type="hidden" name="sell_price" :value="inputs.sell_price">

                    <ul class="list-group mb-4">
                    </ul>
                    <div class="form-group  has-danger">
                        <label class="form-label" title="<?=lang('txt82')?>"><?=lang('txt72')?> YRD <span
                                class=" badge badge-dark badge-pill"> ?</span><span class="badgetext badge badge-pill"
                                title="<?=lang('txt83')?>"><?=lang('txt202')?> <span class=" badge badge-dark badge-pill">
                                    ?</span></span></label>
                        <div class="row gutters-xs">
                            <div class="col-6">
                                <input type="text" class="form-control  " :placeholder="buy_stage.price" readonly>
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control  " :placeholder="buy_stage.tok_left +' YRD'"
                                    readonly>
                            </div>
                        </div>
                    </div>
                    <!--<div class="form-group has-success">
                        <label class="form-label"><?=lang('txt72')?> YRD </label>
                        <input type="text" class="form-control  " :placeholder="buy_stage.price" readonly>
                    </div>
                    <div class="form-group has-success">
                        <label class="form-label">Осталось </label>
                        <input type="text" class="form-control  " :placeholder="buy_stage.tok_left +' YRD'" readonly>
                    </div>-->
                    <div class="form-group has-danger">
                        <label class="form-label"><?=lang('txt84')?> YRD <span class=" badge badge-dark badge-pill"
                                title="<?=lang('txt85')?>"> ?</span>
                        </label>
                        <input v-model="inputs.buy_tok" @input="input_buy( 'tok',inputs.buy_tok)" type="number"
                            step="0.01" class="form-control  " placeholder="0">
                    </div>

                    <div class="form-group  has-danger">
                        <label class="form-label" ><?=lang('txt87')?> <span title="<?=lang('txt86')?>"
                                class=" badge badge-dark badge-pill"> ?</span><span class="badgetext badge 
                                badge-pill">
                                <?=lang('txt203')?> <span class=" badge badge-dark badge-pill" title="<?=lang('txt88')?>">
                                    ?</span></span></label>
                        <div class="row gutters-xs">
                            <div class="col-6">
                                <input v-model="inputs.buy_usd" @input="input_buy( 'usd',inputs.buy_usd)" type="number"
                                    step="0.01" class="form-control " placeholder="0">
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control  " :placeholder="inputs.buy_usd_and_fee"
                                    readonly>
                                <label title="<?=lang('txt89')?>"><small><?=lang('txt90')?>: {{user_bal_usd}}$ <span
                                            class=" badge badge-dark badge-pill"> ?</span></small></label>
                            </div>
                        </div>
                    </div>



                    <div class="form-group  has-danger">
                        <label class="form-label"><?=lang('txt91')?> <span class=" badge badge-dark badge-pill"
                                title="<?=lang('txt92')?>"> ?</span><span
                                class="badgetext badge badge-pill"><?=lang('txt93')?> <span
                                    class=" badge badge-dark badge-pill" title="<?=lang('txt94')?>">
                                    ?</span></span></label>
                        <div class="row gutters-xs">
                            <div class="col-6">
                                <input v-model="inputs.sell_price" @input="input_sell( 'price',inputs.sell_price)"
                                    type="number" step="0.01" class="form-control " placeholder="0">
                            </div>
                            <div class="col-6">
                                <input type="text"
                                    :class="'form-control '+(!errors && sell_stage.stage_tok>=inputs.sell_price?'is-valid':'')"
                                    :placeholder="'$ '+sell_stage.price" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group  has-danger">
                        <label class="form-label"><?=lang('txt95')?> <span class=" badge badge-dark badge-pill"
                                title="<?=lang('txt96')?> 10%"> ?</span>
                            <span class="badgetext badge badge-pill"><?=lang('txt97')?> <span
                                    class=" badge badge-dark badge-pill" title="<?=lang('txt98')?>">
                                    ?</span></span></label>
                        <div class="row gutters-xs">
                            <div class="col-6">
                                <input v-model="inputs.sell_usd" @input="input_sell( 'usd',inputs.sell_usd)"
                                    type="number" step="0.01" class="form-control " placeholder="0">
                                <label title="<?=lang('txt99')?>">
                                    <small><?=lang('txt100')?>: {{inputs.sell_usd_and_fee}}$
                                        <span class=" badge badge-dark badge-pill"> ?</span></small></label>

                            </div>
                            <div class="col-6">
                                <input type="text"
                                    :class="'form-control '+(!errors && sell_stage.stage_tok>=inputs.sell_price?'is-valid':'')"
                                    :placeholder="sell_stage.stage_tok+' YRD'" readonly>
                            </div>
                        </div>
                    </div>
                    <div v-if="errors">
                        <p v-for="error in errors" class="alert alert-warning">{{error}}</p>
                    </div>
                    <!-- v-if="!errors" v-on:click="buy()" -->
                    <input type='button' v-on:click="buy()" class="btn btn-primary mt-4 btn-block"
                        value='<?=lang('txt101')?> Yard'>
                </form>
            </div>
        </div>
    </div><!-- COL END -->

</div>
<!-- ROW-4 END -->
</div>
</div>
<!-- CONTAINER END -->


<? $this->load->view('layouts/footer'); ?>

<script>
new Vue({
    el: '#buy_order',
    data() {
        return {
            loading: false,
            //tok_price: 0,
            user_bal_usd: 0,
            inputs: {
                buy_tok: '',
                buy_usd: '',
                buy_usd_and_fee: 0,
                sell_price: '',
                sell_usd: '',
                sell_usd_and_fee: 0,
            },
            buy_stage: {
                price: 0
            },
            sell_stage: {
                price: 0
            },
            errors: {},
        }
    },
    methods: {

        async update() {
            if (this.loading) {
                return
            }
            this.loading = true
            let res = await request('operations/OrderController/buy_order_info/', 'POST', {
                buy_tok: this.inputs.buy_tok,
                buy_price: this.buy_stage.price,
                sell_price: this.inputs.sell_price,
            })
            //console.log(res)
            //this.tok_price = res.tok_price
            //console.log('t-1')
            this.user_bal_usd = res.user_bal_usd
            this.buy_stage = res.buy_stage
            this.sell_stage = res.sell_stage
            this.errors = res.errors;
            this.loading = false
            return res;
        },

        input_buy(cur, sum) {
            sum = parseFloat(sum)
            if (sum <= 0 || isNaN(sum)) {
                this.inputs['buy_usd'] = this.inputs['buy_tok'] = ''
                return
            }
            let input = cur == 'tok' ? sum * this['buy_stage'].price : sum / this['buy_stage'].price
            this.inputs['buy_' + (cur == 'tok' ? 'usd' : 'tok')] = input.toFixed(2)
            let fee = 5
            input = parseFloat(this.inputs['buy_usd'])
            let input_fee = input / 100 * 5
            let input_and_fee = input + input_fee
            this.inputs['buy_usd_and_fee'] = input_and_fee.toFixed(2)
            //this.update()
        },

        input_sell(type, sum) {
            sum = parseFloat(sum)

            if (sum <= 0 || isNaN(sum) || isNaN(this.inputs['buy_tok'])) {
                this.inputs['sell_price'] = this.inputs['sell_usd'] = ''
                return
            }
            buy_tok = parseFloat(this.inputs['buy_tok'])
            if (type == 'price') {
                let sell_usd = (sum * buy_tok)
                //sell_usd =  sell_usd - sell_usd/100*10
                this.inputs['sell_usd'] = sell_usd.toFixed(2)
            } else {
                let sell_price = (sum / buy_tok)
                //sell_price =  sell_price + sell_price/100*10
                this.inputs['sell_price'] = sell_price.toFixed(2)
            }
            this.inputs['sell_usd_and_fee'] = (this.inputs['sell_usd'] - this.inputs['sell_usd'] /
                100 * 10).toFixed(2)
            // this.update()
        },

        async buy() {
            /*let res = await this.update()
            if( res.errors){return;}*/
            Swal.fire({
                title: ``,
                html: `<h3><?=lang('txt102')?></h3>`,
                showCancelButton: true,
                confirmButtonText: '<?=lang('txt103')?>',
                cancelButtonText: '<?=lang('txt104')?>',
            }).then((result) => {
                if (result.value) {

                    this.buy_send()

                }
            })
            return;
            /*this.update().then(() => {
            });*/
            //this.update()
        },

        async buy_send() {
            Swal.fire({
                title: ``,
                html: `<h3><?=lang('txt105')?> </h3>`,
                showConfirmButton: false,
            })
            let res = await request('operations/OrderController/buy_order/', 'POST', {
                buy_tok: this.inputs.buy_tok,
                buy_price: this.buy_stage.price,
                sell_price: this.inputs.sell_price,
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
            this.inputs.buy_tok = 0
            this.inputs.sell_price = 0
            //this.update()
        },

    },
    async mounted() {
        this.update()
        setInterval(() => {
            this.update()
        }, 4000);
    },

})

new Vue({
    el: '#orders_list',
    data() {
        return {
            orders: {},
        }
    },
    methods: {
        async update(lim = 100) {
            let res = await request('operations/OrderController/get_orders/', 'POST', {
                lim: lim,
            })
            this.orders = res
        },
    },
    async mounted() {
        this.update()
        /* setInterval(() => {
             this.update(this.orders.length)
         }, 1000);*/
    },
})

new Vue({
    el: '#user_orders_list',
    data() {
        return {
            user_orders: {},
        }
    },
    methods: {
        async update(lim = 100) {
            let res = await request('operations/OrderController/get_user_orders/', 'POST', {
                statuses: ['open'],
                lim: lim,
            })
            this.user_orders = res
        },
    },
    async mounted() {
        this.update()
        /*setInterval(() => {
            this.update()
        }, 100000);*/
    },
})

new Vue({
    el: '#stages_list',
    data() {
        return {
            stages: {},
        }
    },
    methods: {
        async update(lim = 100) {
            let res = await request('operations/OrderController/get_stages/', 'POST', {
                lim: lim,
            })
            this.stages = res
        },
    },
    async mounted() {
        this.update()
        /*setInterval(() => {
            this.update()
        }, 100000);*/
    },
})

new Vue({
    el: '#user_closed_orders_list',
    data() {
        return {
            closed_orders: {},
        }
    },
    methods: {
        async update(lim = 100) {
            let res = await request('operations/OrderController/get_user_orders/', 'POST', {
                statuses: ['closed'],
                lim: lim,
            })
            this.closed_orders = res
        },
    },
    async mounted() {
        this.update()
        /*setInterval(() => {
            this.update()
        }, 100000);*/
    },
})
</script>

<script>
/*
new Vue({
    el: '#rate_chart',
    data() {
        return {
        }
    },
    methods: {
        async update() {
            let res = await request('api/Rate_chartController/', 'POST', { })
            build_chart(res)
        },
    },
    async mounted() {
        this.update()
        setInterval(() => {
            //this.update()
        }, 100000);
    },
})
*/

</script>


<?if( true /*$this_user['is_tester']>=1*/){?>
    <script>

    $(document).ready(function() {
        
        new Vue({
            el: '#rate_chart',
            data() {
                return {
                    chart_data:false,
                }
            },
            methods: {
                async update() {
                    let res = await request('api/Rate_chartController/LightweightChart', 'POST', { })
                    this.chart_data = res;
                    build_LightweightChart('flotChart',res) 
                },
            },
            async mounted() {
                this.update()
                
                window.addEventListener("resize", ()=>{
                    $('#flotChart').html('')
                    if(this.chart_data!=false){
                        build_LightweightChart('flotChart',this.chart_data) 
                    }
                    
                });
            },
        })

        
      /*  new Vue({
            el: '#rate_chart',
            data() {
                return {
                }
            },
            methods: {
                async update() {
                    let res = await request('api/Rate_chartController/LightweightChart_test', 'POST', { })
                    build_LightweightChart('testChart',res) 
                },
            },
            async mounted() {
                this.update()
            },
        })*/

        //build_LightweightChart('flotChart',test_chart_data) 
    });
    </script>
<?}else{?>
    <script>
    function rate_chart() {
        $.getJSON("uploads/json/rate_chart.json", function(data) {
            //console.log(data)
            build_chart(data)
        });
    }
    $(document).ready(function() {
        rate_chart()
    });
    </script>
<?}?>

</body>

</html>