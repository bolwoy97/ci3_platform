<?$this->load->view('layouts/adm/head');?>

<body>
    <!--================================-->
    <!-- Page Container Start -->
    <!--================================-->
    <div class="page-container" id="app">
        <!--================================-->
        <?
                $this->load->view('layouts/adm/sidebar', ['pn'=>'users','this_user'=>$this_user]);
            ?>
        <!--================================-->
        <!-- Page Content Start -->
        <!--================================-->
        <div class="page-content">
            <!--================================-->
            <?
                $this->load->view('layouts/adm/header');
            ?>
            <!--================================-->
            <!-- Page Inner Start -->
            <!--================================-->
            <div class="page-inner">
                <!-- Wrapper -->
                <div class="wrapper">
                    <!--================================-->
                    <!-- Breadcrumb Start -->
                    <!--================================-->
                    <div class="pageheader pd-t-25 pd-b-10">
                        <? 
                        $this->load->view('layouts/messages');
                    ?>
                    </div>
                    <!--/ Breadcrumb End -->
                    <!--================================-->
                    <!-- dataTables Start -->
                    <!--================================-->


                    <div class="row clearfix">
                        <!--================================-->
                        <div class="col-lg-12">
                            <form action="admin/AdminActController/user/<?=$user['id']?>" method="post">
                                <div class="card mg-b-30 ">
                                    <div class=" text-center mg-t-20">
                                        <p class="tx-gray-500 small"><?=$user['login']?></p>
                                        <p class="tx-gray-500 small">
                                            <?=$user['email']?>
                                            <input type="text" name="email">
                                        </p>


                                    </div>
                                    <div class="card-body">
                                        <!-- <?if($user['is_active']<=0){?>
                                        <form action="admprs-<?=$user['id']?>" method="post">

                                            <input type="hidden" name="activate" value="1">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success ">Activate user</button>
                                    </div>
                                    </form>
                                    <?}?>-->

                                        <table class="table mb-0">
                                            <tbody>
                                                <tr>
                                                    <td>Balance:</td>
                                                    <td>$<?=round($user['bal_usd'],2)?></td>
                                                    <td>
                                                        <input type="number" step="0.01" min="0.01" name="bal_usd">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Wallet:</td>
                                                    <td>$<?=round($user['wal_usd'],2)?></td>
                                                    <td>
                                                        <input type="number" step="0.01" min="0.01" name="wal_usd">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Capital YRD:</td>
                                                    <td><?=round($user['info']['tok_bal'],3)?> YRD</td>
                                                </tr>

                                                <tr>
                                                    <td>Status acc:</td>
                                                    <td><?=$user['info']['tok_bal_status']?></td>
                                                </tr>

                                                <tr>
                                                    <td>Is Grid:</td>
                                                    <?if($user['is_grid']){?>
                                                    <td><i class="fa fa-check-circle tx-success mr-3"></i></td>
                                                    <?}else{?>
                                                    <td><i class="fa fa-do-not-enter tx-danger mr-3"></i></td>
                                                    <?}?>

                                                </tr>
                                                <tr>
                                                    <td>Sign In:</td>
                                                    <?if($user['ban_enter']){?>
                                                    <td><i class="fa fa-do-not-enter tx-danger mr-3"></i></td>
                                                    <?}else{?>
                                                    <td><i class="fa fa-check-circle tx-success mr-3"></i></td>
                                                    <?}?>
                                                    <td>
                                                        <select name="ban_enter">
                                                            <option value="">--</option>
                                                            <option value="0">Allow</option>
                                                            <option value="1">Deny</option>
                                                        </select>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>is Admin:</td>
                                                    <?if($user['is_admin']){?>
                                                    <td><i class="fa fa-check-circle tx-success mr-3"></i></td>
                                                    <?}else{?>
                                                    <td><i class="fa fa-do-not-enter tx-danger mr-3"></i></td>
                                                    <?}?>
                                                    <td>
                                                        <select name="is_admin">
                                                            <option value="">--</option>
                                                            <option value="0">Not admin</option>
                                                            <option value="1">Admin</option>
                                                        </select>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>is Tester:</td>
                                                    <?if($user['is_tester']){?>
                                                    <td><i class="fa fa-check-circle tx-success mr-3"></i></td>
                                                    <?}else{?>
                                                    <td><i class="fa fa-do-not-enter tx-danger mr-3"></i></td>
                                                    <?}?>
                                                    <td>
                                                        <select name="is_tester">
                                                            <option value="">--</option>
                                                            <option value="0">Not tester</option>
                                                            <option value="1">Tester</option>
                                                        </select>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>USD witdraw adr:</td>
                                                    <td><?=$user['adr_with_usd']?></td>
                                                    <td><input type="text" name="adr_with_usd"></td>
                                                </tr>
                                                <tr>
                                                    <td>BTC witdraw adr:</td>
                                                    <td><?=$user['adr_with_btc']?></td>
                                                    <td><input type="text" name="adr_with_btc"></td>
                                                </tr>
                                                <tr>
                                                    <td>ETH witdraw adr:</td>
                                                    <td><?=$user['adr_with_eth']?></td>
                                                    <td><input type="text" name="adr_with_eth"></td>
                                                </tr>
                                                <tr>
                                                    <td>USDT witdraw adr:</td>
                                                    <td><?=$user['adr_with_usdt']?></td>
                                                    <td><input type="text" name="adr_with_usdt"></td>
                                                </tr>

                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td><input type="Submit"></td>
                                                </tr>
                                            </tbody>
                                        </table>


                                        <div class="media align-items-center pb-1 mb-2">
                                            <div class="media-body ml-2">
                                                <a href="javascript:void(0)" class="tx-semibold tx-danger"
                                                    data-toggle="tooltip" title="" data-placement="top"
                                                    data-original-title="Can not be edited">
                                                    <?foreach($upline as $up){?>
                                                    /<a
                                                        href="admin/AdminController/user/<?=$up['id']?>"><?=$up['login']?></a>
                                                    <?}?>
                                                </a><br>
                                                <div class="tx-gray-500 small">Uplines</div>
                                            </div>
                                        </div>

                                    </div>
                            </form>

                            <form action="admin/AdminActController/set_sponsor/<?=$user['id']?>" method="post">
                                <table class="table mb-0">
                                    <tbody>
                                        <tr>
                                            <td>Sponsor:</td>
                                            <td>
                                                <?if(isset($upline[0]['login'])){echo $upline[0]['login'];}?>
                                            </td>
                                            <td>
                                                <input type="text" name="spons_login">
                                                <button type="Submit">Change</button>
                                            </td>
                                        </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-lg-12">
                        <div class="card mg-b-30">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="card-header-title tx-13 mb-0 text-uppercase">Orders
                                    </h6>
                                    <div class="text-right">
                                        <div class="d-flex">
                                            <div class="dropdown" data-toggle="dropdown">
                                                <a href=""><i class="ti-more-alt"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="" class="dropdown-item"><i data-feather="info"
                                                            class="wd-16 mr-2"></i>Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pd-0">
                                <div class="data-table">
                                    <table id="basicDataTable2" class="table hover responsive display nowrap">
                                        <thead>
                                            <tr>
                                                <th>YRD </th>
                                                <th>Buy Date</th>
                                                <th>buy price</th>
                                                <th>buy sum</th>
                                                <th>sell Date</th>
                                                <th>sell price</th>
                                                <th>sell sum</th>
                                                <th>status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?foreach($orders as $k => $order){?>
                                            <tr>
                                                <td><?=$order['buy_tok']?></td>
                                                <td><?=$order['buy_date']?></td>
                                                <td><?=$order['buy_price']?></td>
                                                <td><?=$order['buy_usd']?></td>
                                                <td><?=$order['sell_date']?></td>
                                                <td><?=$order['sell_price']?></td>
                                                <td><?=$order['sell_usd']?></td>
                                                <td><?=$order['status']?></td>
                                            </tr>
                                            <?}?>

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="card mg-b-30">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="card-header-title tx-13 mb-0 text-uppercase">Orders GPS
                                    </h6>
                                    <div class="text-right">
                                        <div class="d-flex">
                                            <div class="dropdown" data-toggle="dropdown">
                                                <a href=""><i class="ti-more-alt"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="" class="dropdown-item"><i data-feather="info"
                                                            class="wd-16 mr-2"></i>Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pd-0">
                                <div class="data-table">
                                    <table id="basicDataTable5" class="table hover responsive display nowrap">
                                        <thead>
                                            <tr>
                                                <th>Type </th>
                                                <th>GPS </th>
                                                <th>Buy Date</th>
                                                <th>buy price</th>
                                                <th>buy sum</th>
                                                <th>sell Date</th>
                                                <th>sell price</th>
                                                <th>sell sum</th>
                                                <th>status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?foreach($orders_tok2 as $k => $order){?>
                                            <tr>
                                                <td><?=$order['show_type']?></td>
                                                <td><?=$order['buy_tok']?></td>
                                                <td><?=$order['buy_date']?></td>
                                                <td><?=$order['buy_price']?></td>
                                                <td><?=$order['buy_usd']?></td>
                                                <td><?=$order['sell_date']?></td>
                                                <td><?=$order['sell_price']?></td>
                                                <td><?=$order['sell_usd']?></td>
                                                <td><?=$order['status']?></td>
                                            </tr>
                                            <?}?>

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="card mg-b-30">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="card-header-title tx-13 mb-0 text-uppercase">Additions</h6>
                                    <div class="text-right">
                                        <div class="d-flex">
                                            <div class="dropdown" data-toggle="dropdown">
                                                <a href=""><i class="ti-more-alt"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="" class="dropdown-item"><i data-feather="info"
                                                            class="wd-16 mr-2"></i>Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pd-0">
                                <div class="data-table">
                                    <table id="basicDataTable3" class="table hover responsive display nowrap">
                                        <thead class="tx-10 tx-uppercase bd-t">
                                            <tr>
                                                <th>Date</th>
                                                <th>Currency</th>
                                                <th>Sum</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?foreach($adds as $add){?>
                                            <tr>
                                                <td><?=$add['date']?></td>
                                                <td><?=$add['cur']?></td>
                                                <td><?=round($add['sum'],2)?>$</td>

                                            </tr>
                                            <?}?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="card mg-b-30">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="card-header-title tx-13 mb-0 text-uppercase">Withdrawals</h6>
                                    <div class="text-right">
                                        <div class="d-flex">
                                            <div class="dropdown" data-toggle="dropdown">
                                                <a href=""><i class="ti-more-alt"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="" class="dropdown-item"><i data-feather="info"
                                                            class="wd-16 mr-2"></i>Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mg-b-40">
                                <div class="card-body pd-0">
                                    <table id="basicDataTable" class="table hover responsive display nowrap">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Currency</th>
                                                <th>Sum</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?foreach($withs as $k=>$with){?>
                                            <tr>
                                                <td><?=$with['date']?></td>
                                                <td><?=$with['cur']?></td>
                                                <td><?=round($with['sum'],2)?>$</td>
                                                <td><?=$with['status_show']?></td>
                                            </tr>
                                            <?}?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="card mg-b-30">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="card-header-title tx-13 mb-0 text-uppercase">Partners</h6>
                                    <div class="text-right">
                                        <div class="d-flex">
                                            <div class="dropdown" data-toggle="dropdown">
                                                <a href=""><i class="ti-more-alt"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="" class="dropdown-item"><i data-feather="info"
                                                            class="wd-16 mr-2"></i>Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mg-b-40">
                                <div class="card-body pd-0">
                                    <table v-if="partners.length > 0" id="partners_table"
                                        class="table hover responsive display nowrap">
                                        <thead>
                                            <tr>
                                                <th>lvl</th>
                                                <th>login</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr v-for="(partner, idx1) in partners">
                                                <td>{{partner.lvl}}</td>
                                                <td>{{partner.login}}</td>
                                                <td>{{partner.date}}</td>
                                            </tr>

                                        </tbody>

                                    </table>
                                    <button v-else v-on:click="load_partners()" type="button">Load partners</button>
                                </div>
                            </div>
                        </div>

                        <div class="card mg-b-30">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="card-header-title tx-13 mb-0 text-uppercase">referal acruals</h6>
                                    <div class="text-right">
                                        <div class="d-flex">
                                            <div class="dropdown" data-toggle="dropdown">
                                                <a href=""><i class="ti-more-alt"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="" class="dropdown-item"><i data-feather="info"
                                                            class="wd-16 mr-2"></i>Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mg-b-40">
                                <div class="card-body pd-0">
                                    <table v-if="refs.length > 0" id="refs_table"
                                        class="table hover responsive display nowrap">
                                        <thead>
                                            <tr>
                                                <th>date</th>
                                                <th>login</th>
                                                <th>sum</th>
                                                <th>lvl</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr v-for="(ref_oper, idx1) in refs">
                                                <td>{{ref_oper.date}}</td>
                                                <td><a href="#">{{ref_oper.detail}}</a></td>
                                                <td>{{parseFloat(ref_oper.sum).toFixed(2)}}$</td>
                                                <td>{{ref_oper.lvl}}</td>
                                            </tr>

                                        </tbody>

                                    </table>
                                    <button v-else v-on:click="load_refs()" type="button">Load referal acruals</button>
                                </div>
                            </div>
                        </div>


                        <div class="card mg-b-30">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="card-header-title tx-13 mb-0 text-uppercase">capital</h6>
                                    <div class="text-right">
                                        <div class="d-flex">
                                            <div class="dropdown" data-toggle="dropdown">
                                                <a href=""><i class="ti-more-alt"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="" class="dropdown-item"><i data-feather="info"
                                                            class="wd-16 mr-2"></i>Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mg-b-40">
                                <div class="card-body pd-0">
                                    <table  id="basicDataTable4"
                                        class="table hover responsive display nowrap">
                                        <thead>
                                            <tr>
                                                <th>date</th>
                                                <th>AMOUNT</th>
                                                <th>PRICE</th>
                                                <th>sum</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?foreach ($tok_buys as $key => $tok_buy) {?>
                                                <tr>
                                                <td><?=$tok_buy['buy_date']?></td>
                                                <td><?=$tok_buy['buy_tok']?></td>
                                                <td><?=$tok_buy['buy_price']?></td>
                                                <td><?=$tok_buy['buy_usd']?></td>
                                                </tr>
                                            <?}?>
                                            

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                <!--/ dataTables End -->
            </div>
            <!--/ Wrapper End -->
        </div>
        <!--/ Page Inner End -->
        <!--================================-->
        <!-- Page Footer Start -->
        <!--================================-->
        <footer class="page-footer">
            <div class="pd-t-4 pd-b-0 pd-x-20">
                <div class="tx-10 tx-uppercase tx-gray-500 tx-spacing-1">
                    <p class="pd-y-10 mb-0">Copyright&copy; 2019 </p>
                </div>
            </div>
        </footer>
        <!--/ Page Footer End -->
    </div>
    </div>
    <!--Modal Withdraw BTC-->

    <!--/ Modal End-->
    <!--/ Page Content End -->
    <!--/ Page Container End -->
    <!--================================-->
    <!-- Scroll To Top Start-->
    <!--================================-->
    <a href="" data-click="scroll-top" class="btn-scroll-top fade"><i class="fal fa-arrow-up"></i></a>
    <!--/ Scroll To Top End -->
    <!--================================-->
    <!-- Footer Script -->
    <!--================================-->

    <?$this->load->view('layouts/adm/scripts');?>

    <script>
    $(document).ready(function() {
        // Basic DataTable	
        $('#basicDataTable').DataTable({
            responsive: false,
            language: {
                searchPlaceholder: 'Search...',
                sSearch: ''
            }
        });
        // Basic DataTable	
        /*$('#basicDataTable1').DataTable({
            responsive: true,
            language: {
                searchPlaceholder: 'Search...',
                sSearch: ''
            }
        });*/
        // Basic DataTable	
        $('#basicDataTable2').DataTable({
            responsive: true,
            language: {
                searchPlaceholder: 'Search...',
                sSearch: ''
            }
        });

        $('#basicDataTable4').DataTable({
            responsive: true,
            language: {
                searchPlaceholder: 'Search...',
                sSearch: ''
            }
        });

        $('#basicDataTable5').DataTable({
            responsive: true,
            language: {
                searchPlaceholder: 'Search...',
                sSearch: ''
            }
        });

        $('#scrollableTable').DataTable({
            responsive: true,
            language: {
                searchPlaceholder: 'Search...',
                sSearch: ''
            },
            "order": [
                [1, "desc"]
            ],
            "scrollY": "450px",
            "scrollCollapse": true,
            "paging": false
        });

        $(function() {
            if (Clipboard.isSupported()) {
                new Clipboard('.clipboard-example-btn');
            } else {
                $('.clipboard-example-btn').prop('disabled', true);
            }
        });

    });
    </script>

    <script>
    var confirmWith = function(id, sum, login) {
        $("#confId").val(id);
        $("#confSum").html("$" + sum);
        $("#confLogin").html(login);
    }

    var cancelWith = function(id, sum, login) {
        $("#cancelId").val(id);
        $("#cancelSum").html("$" + sum);
        $("#cancelLogin").html(login);
    }
    </script>

    <input type="hidden" id="this_user_id" value="<?= $user['id']?>">

    <script>
    var this_user_id = $('#this_user_id').val();

    new Vue({
        el: '#app',
        data() {
            return {
                partners: {},
                refs: {},
            }
        },
        methods: {
            async load(params) {
                let res = await request('api/AdmApiController/user/' + this_user_id, 'POST',
                    params)
                //console.log(res)
                if (typeof res.partners !== 'undefined') {
                    this.partners = res.partners;
                } else if (typeof res.refs !== 'undefined') {
                    this.refs = res.refs;
                }
            },

            load_partners() {
                this.load({
                    data: 'partners'
                }).then(() => {
                    $('#partners_table').DataTable({
                        responsive: true,
                        language: {
                            searchPlaceholder: 'Search...',
                            sSearch: ''
                        }
                    });
                })
            },

            load_refs() {
                this.load({
                    data: 'refs'
                }).then(() => {
                    $('#refs_table').DataTable({
                        responsive: true,
                        language: {
                            searchPlaceholder: 'Search...',
                            sSearch: ''
                        }
                    });
                })
            },

        },
        async mounted() {

        },
    })
    </script>


</body>

</html>