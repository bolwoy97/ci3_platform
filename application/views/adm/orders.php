<?$this->load->view('layouts/adm/head');?>

<body>
    <!--================================-->
    <!-- Page Container Start -->
    <!--================================-->
    <div class="page-container">
        <!--================================-->
        <?
                $this->load->view('layouts/adm/sidebar', ['pn'=>'orders','this_user'=>$this_user]);
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
                        <div class="col-12 ">
                            <div class="card mg-b-40">
                                <div class="card-header">
                                    <div class="d-flex  align-items-center">
                                        <form action="" method="post">
                                            <input type="hidden" name="all" value="1">
                                            <button type="submit">All</button>
                                        </form>
                                        -|-
                                        <form action="" method="post">
                                            <input type="text" name="user" >
                                            <button type="submit">Get user orders</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--================================-->
                    <!-- Hoverable dataTable Start -->
                    <!--================================-->
                    <div class="col-12 ">
                        <div class="card mg-b-40">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="card-header-title tx-13 mb-0 text-uppercase">orders</h6>
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
                                <table id="basicDataTable" class="table hover responsive display nowrap">
                                    <thead>
                                        <tr>
                                            <th>User</th>
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
                                            <td><?=$order['usr_ob']['login']?></td>
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
                    <!--/ Hoverable dataTable End -->
                    <!--================================-->
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
    <div class="modal fade effect-scale" id="cancelOrder" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="admin/AdminActController/cancel_with" method="post">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                        <div class="d-sm-flex">
                            <!-- col -->
                            <div class="flex-fill">
                                <h5 class="tx-center">You cancel the withdrawal request for <br><strong
                                        id="cancelLogin">business-leader</strong>?</h5>
                                <div id="cancelSum" class="alert alert-danger tx-20 tx-center tx-uppercase"
                                    role="alert">
                                    $100
                                </div>
                                <?/*?><input name="coment" type="text" placeholder="Comment"
                                    class="alert alert-danger tx-20 tx-center " style="width:100%">
                                <?*/?>
                            </div>
                            <input id="cancelId" type="hidden" name="id">

                            <!-- col -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger btn-block mg-b-5 mg-sm-b-0 tx-uppercase">Cancel
                            withdrawal</button>
                    </div>
                </form>
                <!-- modal-footer -->
            </div>
            <!-- modal-content -->
        </div>
    </div>
    <!--/ Modal End-->
    <!--Modal Withdraw BTC-->
    <div class="modal fade effect-scale" id="confirmOrder" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="admin/AdminActController/confirm_with" method="post">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                        <div class="d-sm-flex">
                            <!-- col -->
                            <div class="flex-fill">
                                <h5 class="tx-center">Do you confirm withdrawal of funds for <br><strong
                                        id="confLogin">business-leader</strong>?</h5>
                                <div id="confSum" class="alert alert-success tx-20 tx-center tx-uppercase" role="alert">
                                    $250
                                </div>
                            </div>
                            <input id="confId" type="hidden" name="id">
                            <!-- col -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-block mg-b-5 mg-sm-b-0 tx-uppercase">Confirm
                            withdrawal</button>
                    </div>
                </form>
                <!-- modal-footer -->
            </div>
            <!-- modal-content -->
        </div>
    </div>
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
        $('#basicDataTable1').DataTable({
            responsive: true,
            language: {
                searchPlaceholder: 'Search...',
                sSearch: ''
            }
        });
        // Basic DataTable	
        $('#basicDataTable2').DataTable({
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

</body>

</html>