<? $this->load->view('layouts/head'); ?>

<body class="app sidebar-mini Left-menu-Default Sidemenu-left-icons dark-mode">

    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <img src="assets/images/loader.svg" class="loader-img" alt="Loader">
    </div>
    <!-- /GLOBAL-LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">

            <!--APP-HEADER-->
            <div class="app-header header-search-icon">
                <div class="header-style1">
                    <a class="header-brand header-brand1" href="index.html">
                        <img src="assets/images/brand/logo-blue.svg" class="header-brand-img desktop-logo" alt="logo">
                        <img src="assets/images/brand/logo-1.png" class="header-brand-img mobile-logo" alt="logo">
                    </a><!-- LOGO -->
                </div>
                <div class="app-sidebar__toggle" data-toggle="sidebar">
                    <a class="open-toggle" href="/null"><i class="fe fe-chevrons-left"></i></a>
                    <a class="close-toggle" href="/null"><i class="fe fe-x"></i></a>
                </div>
                <div class="d-flex  ml-auto header-right-icons">
                    <div class="dropdown d-md-flex">
                        <a class="nav-link icon full-screen-link nav-link-bg">
                            <i class="fe fe-minimize fullscreen-button"></i>
                        </a>
                    </div>

                    <div class="dropdown profile-1">
                        <a class="nav-link icon" data-toggle="dropdown">
                            <i class="fal fa-globe"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="set_lang/en"> English
                            </a>
                            <a class="dropdown-item" href="set_lang/ru"> Русский
                            </a>
                        </div>
                    </div>
                    
                    <!-- FULL-SCREEN -->
                    <div class="dropdown d-md-flex notifications">
                        <a class="nav-link icon" data-toggle="dropdown">
                            <i class="fe fe-bell"></i>
                            <span class="nav-unread badge badge-warning badge-pill">1</span>
                        </a>
                    </div>
                    <div class="dropdown profile-1">
                        <a class="nav-link icon" data-toggle="dropdown">
                            <i class="far fa-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <div class="dropdown-divider m-0"></div>
                            <a class="dropdown-item" href="wallet">
                                <span class="float-right"></span>
                                <i class="dropdown-icon fa fa-briefcase"></i> <?=lang('txt165_1')?>
                            </a>
                            <a class="dropdown-item" href="settings">
                                <i class="dropdown-icon  fa fa-cog"></i> <?=lang('txt165_2')?>
                            </a>
                            <div class="dropdown-divider mt-0"></div>
                            <a class="dropdown-item" href="https://t.me/YARD_SUPPORT" target="blank">
                                <i class="dropdown-icon fab fa-telegram-plane"></i> <?=lang('txt165_3')?>
                            </a>
                            <a class="dropdown-item" href="logout">
                                <i class="dropdown-icon far fa-sign-out-alt"></i> <?=lang('txt165_4')?>
                            </a>
                        </div>
                    </div><!-- SIDE-MENU -->
                </div>
            </div>
            <!--APP-HEADER-->

            <!--APP-SIDEBAR-->
            <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
            <aside class="app-sidebar">
                <ul class="side-menu">
                    <li>
                        <h3><?=lang('txt165_6')?></h3>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" href="home"><span
                                class="side-menu__label"><?=lang('txt165_5')?></span><i
                                class="side-menu__icon far fa-chart-line"></i></a>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" href="gps_usd"><span class="side-menu__label">GPS - USD</span><i
                                class="side-menu__icon far fa-chart-line"></i></a>
                    </li>
                    
                    <li>
                        <h3><?=lang('txt165_7')?></h3>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" href="wallet"><span
                                class="side-menu__label"><?=lang('txt165_1')?></span><i
                                class="side-menu__icon far fa-wallet"></i></a>
                    </li>
                    <?if($this_user['is_tester']){?>
                        <?}?>
                    <li class="slide">
                        <a class="side-menu__item" href="portfolio">
                            <span class="side-menu__label"><?=lang('txt213')?></span><i 
                            class="side-menu__icon far fa-briefcase"></i></a>
                    </li>
                    
                    <li class="slide">
                        <a class="side-menu__item" href="settings"><span
                                class="side-menu__label"><?=lang('txt165_2')?></span><i
                                class="side-menu__icon fal fa-cog"></i></a>
                    </li>
                    <li>
                        <h3><?=lang('txt165_8')?></h3>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" href="partners"><span
                                class="side-menu__label"><?=lang('txt165_9')?></span><i
                                class="side-menu__icon far fa-users"></i></a>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="/null"><span
                                class="side-menu__label"><?=lang('txt165_10')?></span><i
                                class="side-menu__icon far fa-bell"></i></a>
                    </li>
                    <li>
                        <h3><?=lang('txt165_11')?></h3>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" href="agreement"><span
                                class="side-menu__label"><?=lang('txt165_12')?></span><i
                                class="side-menu__icon far fa-file-alt"></i></a>
                    </li>
                    <li>
                        <h3><?=lang('txt165_3')?></h3>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" href="https://t.me/YARD_SUPPORT" target="blank"><span
                                class="side-menu__label"><?=lang('txt165_13')?></span><i
                                class="side-menu__icon fab fa-telegram-plane"></i></a>
                    </li>
                </ul>
            </aside>
            <!--/APP-SIDEBAR-->

            <!-- Mobile Header -->
            <div class="mobile-header">
                <div class="container-fluid">
                    <div class="d-flex">
                        <div class="app-sidebar__toggle" data-toggle="sidebar">
                            <a class="open-toggle" href="/null"><i class="fe fe-chevrons-down"></i></a>
                            <a class="close-toggle" href="/null"><i class="fe fe-x"></i></a>
                        </div>
                        <a class="header-brand" href="index.html">
                            <img src="assets/images/brand/logo.png" class="header-brand-img desktop-logo" alt="logo">
                        </a>
                        <a class="header-brand header-brand1" href="index.html">
                            <img src="assets/images/brand/logo-white.png" class="header-brand-img desktop-logo"
                                alt="logo">
                        </a><!-- LOGO -->
                        <div class="d-flex order-lg-2 ml-auto header-right-icons">

                            <div class="dropdown profile-1">
                                <a class="nav-link icon" data-toggle="dropdown">
                                    <i class="fal fa-globe"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <a class="dropdown-item" href="set_lang/en"> English
                                    </a>
                                    <a class="dropdown-item" href="set_lang/ru"> Русский
                                    </a>
                                </div>
                            </div>

                            <div class="dropdown profile-1">
                                <a class="nav-link icon" data-toggle="dropdown">
                                    <i class="far fa-user"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <div class="dropdown-divider m-0"></div>
                                    <a class="dropdown-item" href="wallet">
                                        <span class="float-right"></span>
                                        <i class="dropdown-icon fa fa-briefcase"></i> <?=lang('txt165_1')?>
                                    </a>
                                    <a class="dropdown-item" href="settings">
                                        <i class="dropdown-icon  fa fa-cog"></i> <?=lang('txt165_2')?>
                                    </a>
                                    <div class="dropdown-divider mt-0"></div>
                                    <a class="dropdown-item" href="/null">
                                        <i class="dropdown-icon fab fa-telegram-plane"></i> <?=lang('txt165_3')?>
                                    </a>
                                    <a class="dropdown-item" href="logout">
                                        <i class="dropdown-icon far fa-sign-out-alt"></i> <?=lang('txt165_4')?>
                                    </a>
                                </div>
                            </div><!-- SIDE-MENU -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Mobile Header -->

            <!--app-content open-->
            <div class="app-content" id="app">
                <div class="side-app" >

                    <!-- PAGE-HEADER -->
                    <div class="page-header">

                    </div>
                    <!-- PAGE-HEADER END -->


                    <? $this->load->view('layouts/messages'); ?>

                    <div class="">
                        <div class="banner banner-color mt-0 row">
                            <div class="page-content col-xl-7 col-lg-6 col-md-12">
                                <h3 class="mb-1"><?=lang('txt165')?>, <span class="font-weight-bold text-primary">
                                        <?=$this->session->userdata('user')['login']?></span>!</h3>
                                <!--<p class="mb-0 fs-16">Мы рады сообщить об открытии рынка YRD – USD 6 сентября. Запуск рынка
                        будет происходить в два этапа. На первом этапе ограниченное число первых участников 
                        (30 участников приватсейла) смогут открывать ордера. За несколько минут до этого,
                        по техническим соображениям, будет приостановлена возможность регистрироваться и
                        пополнять балансы на время первого этапа. Второй этап открытия рынка для всех
                        участников начнется после анализа и настроек оборудования, которое будет
                        происходить параллельно с первым этапом. Перед вторым этапом регистрации 
                        и пополнения балансов будут снова восстановлены. 
                        Возможность вывода средств, будет открыта 10 сентября.</p>-->
                            </div>
                        </div>
                    </div>