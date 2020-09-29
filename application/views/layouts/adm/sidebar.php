<!-- Page Sidebar Start -->
<!--================================-->
<div class="page-sidebar">
    <div class="logo">
        <a class="logo-img" href="/">
            <img class="desktop-logo" src="/assets/img/logo.svg" alt="">
        </a>
        <i class="ion-ios-close-empty" id="sidebar-toggle-button-close"><svg xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" class="feather feather-x wd-20">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg></i>
    </div>
    <!--================================-->
    <!-- Sidebar Menu Start -->
    <!--================================-->
    <div class="page-sidebar-inner">
        <div class="page-sidebar-menu">
            <ul class="accordion-menu">
                <li class="mg-l-20-force mg-t-25-force menu-navigation"></li>
               

                <?if($this_user['is_tester']){?>
                <li class="<?=($pn=='statistics')?'active':''?>">
                    <a href="admin/AdminController/statistics"><i data-feather="credit-card"></i>
                        <span>Statistics</span>
                        <?if($pn=='statistics'){?><i class="accordion-icon fal fa-angle-right"></i>
                        <?}?></a>
                </li>
              
                <li class="<?=($pn=='orders')?'active':''?>">
                    <a href="admin/AdminController/orders"><i data-feather="users"></i>
                        <span>Orders</span>
                        <?if($pn=='orders'){?><i class="accordion-icon fal fa-angle-right"></i>
                        <?}?></a>
                </li>
                
                <li class="<?=($pn=='comp_ord_by_open_fee')?'active':''?>">
                    <a href="admin/AdminController/comp_ord_by_open_fee"><i data-feather="users"></i>
                        <span>Lost fees</span>
                        <?if($pn=='comp_ord_by_open_fee'){?><i class="accordion-icon fal fa-angle-right"></i>
                        <?}?></a>
                </li>

                <li class="<?=($pn=='additions')?'active':''?>">
                    <a href="admin/AdminController/additions"><i data-feather="users"></i>
                        <span>Additions</span>
                        <?if($pn=='additions'){?><i class="accordion-icon fal fa-angle-right"></i>
                        <?}?></a>
                </li>

                <?}?>

                <li class="<?=($pn=='users')?'active':''?>">
                    <a href="admin/AdminController/users"><i data-feather="users"></i>
                        <span>Users</span>
                        <?if($pn=='users'){?><i class="accordion-icon fal fa-angle-right"></i>
                        <?}?></a>
                </li>

                <li class="<?=($pn=='withdrawals')?'active':''?>">
                    <a href="admin/AdminController/withdrawals"><i data-feather="credit-card"></i>
                        <span>Withdrawals</span>
                        <?if($pn=='withdrawals'){?><i class="accordion-icon fal fa-angle-right"></i>
                        <?}?></a>
                </li>

                <!--<li class="<?=($pn==4)?'active':''?>">
                    <a href="adm_user-0"><i data-feather="users"></i>
                        <span>User</span>
                        <?if($pn==3){?><i class="accordion-icon fal fa-angle-right"></i>
                        <?}?></a>
                </li>
                <li class="<?=($pn=='adm_verifications')?'active':''?>">
                    <a href="adm_verifications"><i data-feather="users"></i>
                        <span>Verifications</span>
                        <?if($pn=='adm_verifications'){?><i class="accordion-icon fal fa-angle-right"></i>
                        <?}?></a>
                </li>
                <li class="<?=($pn==2)?'active':''?>">
                    <a href="adm_news"><i data-feather="monitor"></i>
                        <span>News</span>
                        <?if($pn==3){?><i class="accordion-icon fal fa-angle-right"></i>
                        <?}?></a>
                </li>-->

                <li class="">
                    <a href="home"><i data-feather="log-out"></i>
                        <span>Go back</a>
                </li>
            </ul>
        </div>
    </div>
    <!--/ Sidebar Menu End -->
    <!--================================-->
</div>
<!--/ Page Sidebar End -->