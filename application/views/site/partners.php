<? $this->load->view('layouts/header', ['this_user'=>$this_user] ); ?>


<div class="row">
						<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
							<div class="card">
								<div class="card-body text-center">
									<i class="far fa-users text-success fa-3x text-primary-shadow"></i>
									<h6 class="mt-4 mb-2"><?=lang('txt106')?></h6>
									<h2 class="mb-2 number-font"><?=$counts['all']?></h2>
									<p class="text-muted"><?=lang('txt107')?></p>
								</div>
							</div>
						</div><!-- COL END -->
						<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
							<div class="card">
								<div class="card-body text-center">
									<i class="far fa-user-check text-primary fa-3x text-success-shadow"></i>
									<h6 class="mt-4 mb-2"><?=lang('txt108')?></h6>
									<h2 class="mb-2  number-font"><?=$counts['active']?></h2>
									<p class="text-muted"><?=lang('txt109')?></p>
								</div>
							</div>
						</div><!-- COL END -->
						<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
							<div class="card">
								<div class="card-body text-center">
									<i class="far fa-user-minus text-danger fa-3x text-info-shadow"></i>
									<h6 class="mt-4 mb-2"><?=lang('txt110')?></h6>
									<h2 class="mb-2 number-font"><?=$counts['passive']?></h2>
									<p class="text-muted"><?=lang('txt111')?></p>
								</div>
							</div>
						</div><!-- COL END -->
						<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
							<div class="card">
								<div class="card-body text-center">
									<i class="far fa-network-wired text-info fa-3x text-info-shadow"></i>
									<h6 class="mt-4 mb-2"><?=lang('txt112')?></h6>
									<h2 class="mb-2  number-font"><?=count($partners)?></h2>
									<p class="text-muted"><?=lang('txt113')?></p>
								</div>
							</div>
						</div><!-- COL END -->
					</div>
					<label class="form-label"><?=lang('txt114')?></label>
					<figure class="highlight clip-widget" id="avatarsq1">
						<pre><?=$reflink?></pre>
						<div onclick="copyToClipboard('<?=$reflink?>')" class="clipboard-icon" data-clipboard-target="#avatarsq1"><i class="fa fa-clipboard"></i>
						</div>
					</figure>
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title"><?=lang('txt115')?></h3>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="example"
											class="table table-striped table-bordered text-nowrap w-100">
											<thead>
												<tr>
													<th class="wd-15p"><?=lang('txt116')?></th>
													<th class="wd-15p"><?=lang('txt117')?></th>
													<th class="wd-20p"><?=lang('txt118')?></th>
													<th class="wd-15p"><?=lang('txt119')?></th>
													<th class="wd-10p"><?=lang('txt120')?></th>
													<th class="wd-25p"><?=lang('txt121')?></th>
												</tr>
											</thead>
											<tbody>
                                                <?
                                                    foreach ($partners as $key2 => $user) {?>
                                                    <tr>
													<td><?=$user['lvl']+1?></td>
													<td><?=$user['name']?> <?=$user['lastname']?></td>
													<td><?=$user['login']?></td>
                                                    <td><?=(isset($user['spons']['login']))
                                                    ?$user['spons']['login']: $this_user['login']?></td>
													<td><?=$user['date']?></td>
                                                    <td>email: <?=$user['email']?>
                                                    <br>telegram: <?=$user['tg']?>
                                                    <br>viber: <?=$user['viber']?>
													</td>
												</tr>
                                                <?}?>
												
											</tbody>
										</table>
									</div>
								</div>
								<!-- TABLE WRAPPER -->
							</div>
							<!-- SECTION WRAPPER -->
						</div>
					</div>
					<!-- ROW-1 CLOSED -->

				</div>
			</div>

<? $this->load->view('layouts/footer'); ?>


</body>

</html>