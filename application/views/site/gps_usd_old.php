<? $this->load->view('layouts/header', ['this_user'=>$this_user] ); ?>
       
                   <!-- ROW-3 -->
                   <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title"> GPS - USD <span class="text-right">рынок в разработке</span></h4>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <div class="flot-chart h-300" id="flotChart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header text-center">
                                    <h5 class="card-title">История ордеров</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive content vscroll h-300">
                                        <table class="table card-table table-vcenter text-center">
                                            <thead>
                                                <tr>
                                                    <th>Дата</th>
                                                    <th>Цена</th>
                                                    <th>Объем</th>
                                                    <th class="text-">Сумма</th>
                                                </tr>
                                            </thead>
                                            <tbody>
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
                                                <li><a href="#my_orders" class="active" data-toggle="tab">Мои ордера</a></li>
                                                <li><a href="#all_orders" data-toggle="tab">Все ордера</a></li>
                                                <li><a href="#my_history" data-toggle="tab">Моя история</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="panel-body tabs-menu-body">
                                        <div class="tab-content">
                                            <div class="tab-pane active " id="my_orders">
                                            </div>
                                            <div class="tab-pane " id="all_orders">
                                            </div>
                                            <div class="tab-pane " id="my_history">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4">
                           <div class="card card-body">
										<div class="panel panel-primary">
											<div class=" tab-menu-heading">
												<div class="tabs-menu1 ">
													<!-- Tabs -->
													<ul class="nav panel-tabs">
														<li ><a href="#buy" class="active" data-toggle="tab">Купить</a></li>
														<li><a href="#sell" data-toggle="tab">Продать</a></li>
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
                                        <label class="form-label" title="Текущая цена для покупки">Цена GPS <span class=" badge badge-dark badge-pill"  > ?</span><span class="badgetext badge badge-pill" title="Доступно GPS для покупки по текущей цене">Доступно <span class=" badge badge-dark badge-pill" > ?</span></span></label>
                                        <div class="row gutters-xs">
                                            <div class="col-6">
                                                <input type="text" class="form-control  " placeholder="0" readonly>
                                            </div>
                                            <div class="col-6">
                                                <input type="text" class="form-control  " placeholder="0" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group has-danger">
                                        <label class="form-label" title="Количество GPS которое будет куплено">Количество GPS <span class=" badge badge-dark badge-pill" > ?</span></label>
                                        <input type="text" class="form-control  " placeholder="0">
                                    </div>
                                    <div class="form-group  has-danger">
                                        <label class="form-label" title="Сумма без учета 5% сбора за покупку">Сумма покупки <span class=" badge badge-dark badge-pill"> ?</span><span class="badgetext badge badge-pill">С комиссией <span class=" badge badge-dark badge-pill" title="Сумма, которая будет списана с баланса"> ?</span></span></label>
                                        <div class="row gutters-xs">
                                            <div class="col-6">
                                                <input type="text" class="form-control " placeholder="0">
                                            </div>
                                            <div class="col-6">
                                                <input type="text" class="form-control  " placeholder="0" readonly>
                                                <label title="Текущий баланс для покупки"><small>Баланс: 0$ <span class=" badge badge-dark badge-pill" > ?</span></small></label>
                                            </div>
                                        </div>
                                    </div>
                                    <input type='button' class="btn btn-primary mt-4 btn-block" value='Купить GPS' id='click2'>
                                </div>
													</div>
													<div class="tab-pane " id="sell">
														<div>
                                    <ul class="list-group mb-4">
                                    </ul>
                                    <div class="form-group  has-danger">
                                        <label class="form-label" title="Цена должна быть подтверждена в поле 'Доступная цена'">Цена продажи <span class=" badge badge-dark badge-pill" > ?</span><span class="badgetext badge badge-pill" title="Цена по которой можно разместить ордер на продажу, с учетом его количества GPS">Доступная цена <span class=" badge badge-dark badge-pill" > ?</span></span></label>
                                        <div class="row gutters-xs">
                                            <div class="col-6">
                                                <input type="text" class="form-control " placeholder="0">
                                            </div>
                                            <div class="col-6">
                                                <input type="text" class="form-control is-valid" placeholder="0" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group has-danger">
                                        <label class="form-label" title="Количество GPS на которое откроется ордер">Количество GPS <span class=" badge badge-dark badge-pill" > ?</span></label>
                                        <input type="text" class="form-control  " placeholder="0">
                                    </div>
                                    <div class="form-group  has-danger">
                                        <label class="form-label" title="Сумма без учета 10% сбора за закрытие ордера">Сумма продажи <span class=" badge badge-dark badge-pill" > ?</span><span class="badgetext badge badge-pill" title="Количество GPS, которое можно разместить на продажу по доступной цене">Доступный объем <span class=" badge badge-dark badge-pill" > ?</span></span></label>
                                        <div class="row gutters-xs">
                                            <div class="col-6">
                                                <input type="text" class="form-control " placeholder="0">
                                                <label title="Сумма, которая будет зачислена на кошелек после продажи"><small>С комиссией: 0$ <span class=" badge badge-dark badge-pill" > ?</span></small></label>
                                            </div>
                                            <div class="col-6">
                                                <input type="text" class="form-control is-valid" placeholder="0" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <input type='button' class="btn btn-danger mt-4 btn-block" value='Продать GPS' id='click2'>
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

</body>

</html>