<? $this->load->view('layouts/header', ['this_user'=>$this_user] ); ?>
       
                    <!-- ROW-3 -->

                    <!-- ROW-4 -->
                    <div class="row row-desc">
                        <div class="col-lg-12 col-md-12">
                            <div class="card card-body">
                                <div class="table-responsive content vscroll h-300">
                                    <table class="table card-table table-vcenter text-center">
                                        <thead>
                                            <tr>
                                                <th><?=lang('txt209')?></th>
                                                <th><?=lang('txt149')?></th>
                                                <th><?=lang('txt202')?></th>
                                                <th><?=lang('txt210')?></th>
                                                <th><?=lang('txt211')?></th>
                                                <th><?=lang('txt147')?> USD</th>
                                                <th><?=lang('txt212')?> USD</th>
                                            </tr>
                                            
                                        </thead>
                                        <tbody>
                                        <?foreach ($tokens as $key => $token) {?>
                                            <tr>
                                                <td><?=$token['symbol']?></td>
                                                <td><?=$token['name']?></td>
                                                <td><?=$token['available']?></td>
                                                <td><?=$token['reserved']?></td>
                                                <td><?=$token['total']?></td>
                                                <td><?=$token['price']?></td>
                                                <td>$<?=$token['cost']?></td>
                                                
                                            </tr>
                                        <?}?>
                                       
                                           <!-- <tr>
                                                <td>GPS</td>
                                                <td>Grid Pay Share</td>
                                                <td>500</td>
                                                <td>4500</td>
                                                <td>5000</td>
                                                <td>50</td>
                                                <td>0.01</td>
                                            </tr>-->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ROW-4 END -->
                </div>
            </div>
            <!-- CONTAINER END -->


<? $this->load->view('layouts/footer'); ?>


</body>

</html>