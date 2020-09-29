<!DOCTYPE html>
<html lang="en">

<head>
<base href="<?= base_url('')?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Yard Exchange</title>
    <!-- favicon CSS -->
    <link rel="icon" type="image/png" sizes="32x32" href="favicon.png">
    <!-- fonts -->
    <link href="fonts/sfuidisplay.css" rel="stylesheet">
    <!-- Icon fonts -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="assets/land/css/plugins.min.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="assets/land/css/app.css">
    <!-- Your CSS -->
    <link rel="stylesheet" href="assets/land/css/custom.css">

</head>

<body class="theme-blue" data-spy="scroll" data-target="#navbar-nav" data-animation="false" data-appearance="darkblue">

    <main class="main">
        <header class="navbar navbar-sticky sticky-bg-color--darkblue navbar-expand-lg navbar-dark">
            <div class="container-fluid position-relative">
                <a class="navbar-brand" href="index.html">
                    <img class="navbar-brand__regular" src="assets/land/img/logo-white.png" alt="brand-logo">
                    <img class="navbar-brand__sticky" src="assets/land/img/logo-white.png" alt="sticky brand-logo">
                </a>
                <button class="navbar-toggler d-lg-none" type="button" data-toggle="navbarToggler" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="navbar-inner ml-lg-auto">
                    <button class="navbar-toggler d-lg-none" type="button" data-toggle="navbarToggler" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <nav>
                        <ul class="navbar-nav" id="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#about">О Yard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#advantages">Преимущества</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#algorithm">Алгоритмы</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#cabinet">Кабинет</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#markets">Рынки</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="d-flex flex-column flex-sm-row align-items-center d-sm-inline-block ml-lg-1 ml-xl-2 mr-5 mr-sm-6 m-lg-0">
                <a href="r-" class="btn btn-size--md btn-border btn-border--width--2 btn-border--color--primary color--white rounded--full btn-hover--3d btn-hover--splash d-none d-sm-inline-block">
                        <span class="btn__text d-flex align-items-center">Регистрация </span>
                    </a>
                    <a href="login" class="btn btn-size--md btn-bg--primary rounded--full btn-hover--3d btn-hover--splash">
                        <span class="btn__text d-flex align-items-center">
                            Войти
                        </span>
                    </a>
                </div>
            </div>
        </header>

        <section class="hero hero--v6 hero--full section--darkblue bg-gradient--darkblue--1 d-flex align-items-center hidden">
            <div class="background-holder background--bottom z-index1">
                <img src="assets/land/img/layout/21.png" alt="image" class="background-image-holder">
            </div>
            <div class="svg-shape svg-shape-wave d-none d-lg-block">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 620">
                    <defs>
                        <linearGradient id="wave-1-a" x1="91.821%" x2="8.258%" y1="-3.695%" y2="81.178%">
                            <stop offset="0%" stop-color="#22223d" />
                            <stop offset="100%" stop-color="#171883" />
                        </linearGradient>
                        <linearGradient id="wave-1-b" x1="90.535%" x2="10.832%" y1="4.232%" y2="85.759%">
                            <stop offset="0%" stop-color="#7679EC" stop-opacity="0" />
                            <stop offset="100%" stop-color="#5659E1" />
                        </linearGradient>
                    </defs>
                    <path class="svg-line" fill="url(#wave-1-a)" fill-rule="evenodd" stroke="url(#wave-1-b)" stroke-width="8" d="M-22.367223,829.365369 C1831.54878,305.444757 1878.51106,314.004559 1937.4923,348.861006 C2123.16473,458.588806 2144.25888,666.20199 2001.45303,970.525832 L2000.65244,972.231901 L-125.452084,994.056123 L-22.422471,829.450405 L-22.55,829.365369 Z" transform="translate(0 -310)" />
                </svg>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-10 col-lg-8 col-xl-8 mx-auto mx-lg-0 mb-3 mt-8 mt-lg-0 text-center text-lg-left z-index2">
                        <div class="hero-content">
                            <h1 class="hero__title font-w--600 mb-2 mb-lg-3">Лучшая биржа для роста цены токена</h1>
                            <p class="hero__description text-color--200 font-size--20 opacity--80 mb-3 mb-lg-5 mb-md-6">В основе биржи лежит иновационный алгоритм формирования спроса и предложения, который обеспечивает рост цены токенов.</p>

                            <div class="button-group d-flex flex-column flex-sm-row align-items-center d-sm-inline-block">
                            <a href="r-" class="btn btn-bg--primary rounded--full btn-hover--3d btn-hover--splash">
                                    <span class="btn__text">Регистрация</span>
                                </a>

                                <a href="login" class="btn btn-bg--darkblue rounded--full btn-hover--3d btn-hover--splash">
                                    <span class="btn__text">Войти</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-1 pos-abs-md-vertical-center pos-right text-center h4-font mr-md-3 mr-xl-2 z-index1">
                        <ul class="icon-group icon-group--vertical rounded--full justify-content-center mb-3 mb-md-10">
                            <li><a href="https://www.facebook.com/gridgroupofficial" target="_blank" class="color--primary"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="https://t.me/gridgroupofficiall" target="_blank" class="color--primary"><i class="fab fa-telegram-plane"></i></a></li>
                            <li><a href="https://instagram.com/gridgroup_official?igshid=1qcxwh4x360y1" target="_blank" class="color--primary"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="https://vk.com/gridofficial" target="_blank" class="color--primary"><i class="fab fa-vk"></i></a></li>
                            <li><a href="https://www.youtube.com/channel/UCt-fD7bhVEUN5fmy2Cz3s-g/" target="_blank" class="color--primary"><i class="fab fa-youtube"></i></a></li>
                        </ul>
                    </div>

                    <div class="col-xl-6 col-lg-7 position-relative pos-abs-xl-bottom-right z-index1 col-12 pb-md-5 pr-3 text-left">
                        <div class="ico-progress ico-progress--v1">
                            <div class="text-center text-lg-left">
                                <ul class="countdown d-flex mb-4  text-left">

                                    <li class=" mr-5 mr-sm-3">
                                        <span class="h3-font font-w--500 mb-1"><?=$active_users?></span><br>
                                        <span class="font-size--20 font-w--500 opacity--60">Участников</span>
                                    </li>

                                    <li class=" mr-2 ml-4 mr-sm-3">
                                        <span class="h3-font font-w--500 mb-1">0</span><br>
                                        <span class="font-size--20 font-w--500 opacity--60">Капитал USD</span>
                                    </li>

                                    <li class=" mr-2 ml-4 mr-sm-3">
                                        <span class="h3-font font-w--500 mb-1">0</span><br>
                                        <span class="font-size--20 font-w--500 opacity--60">Ордеров</span>
                                    </li>

                                    <li class=" mr-2 ml-4 mr-sm-3">
                                        <span class="h3-font font-w--500 mb-1">0</span><br>
                                        <span class="font-size--20 font-w--500 opacity--60">Рынков</span>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <section class="space about about--v1 section--darkblue bg-gradient--darkblue--2" id="about">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-5 mb-6 mb-lg-0">
                        <picture class="about__image">
                            <img src="assets/land/img/laptop-yrd.png" alt="illustration">
                        </picture>
                    </div>
                    <div class="col-12 col-lg-7 remove-space--bottom">
                        <div class="mb-5 mb-lg-7 text-center text-lg-left reveal">
                            <h2 class="h3-font font-w--600 mb-2">Для кого Yard Exchange?</h2>
                        </div>
                        <div class="d-md-flex mb-4 mb-lg-5 text-center text-md-left reveal">
                            <span class="mb-3 mb-lg-0 mr-md-5">
                            </span>
                            <div>
                                <h3 class="h6-font font-w--600 text-color--200 mb-1">Инвесторам</h3>
                                <p class="text-color--500">Уникальный алгоритм (Profit-oriented Algorithm) способствует росту цены токенов. Это отличная возможность инвестировать свои средства в токен YRD как крупным, так и мелким инвесторам. </p>
                            </div>
                        </div>
                        <div class="d-md-flex mb-4 mb-lg-5 text-center text-md-left reveal">
                            <span class="mb-3 mb-lg-0 mr-md-5">
                            </span>
                            <div>
                                <h3 class="h6-font font-w--600 text-color--200 mb-1">Лидерам МЛМ</h3>
                                <p class="text-color--500">Учитывая необходимость создавать реальный спрос мы внедрили систему бонусных партнерских вознаграждений, где каждый партнер может начать 
получать пассивный доход. Вознаграждения участникам платформы производятся за активное развитие, привлечение инвесторов и новых партнеров.</p>
                            </div>
                        </div>
                        <div class="d-md-flex mb-4 mb-lg-5 text-center text-md-left reveal">
                            <span class="mb-3 mb-lg-0 mr-md-5">
                            </span>
                            <div>
                                <h3 class="h6-font font-w--600 text-color--200 mb-1">Компаниям</h3>
                                <p class="text-color--500">Большинство компаний испытывают трудности с выводом токена на биржу и последующим ростом его цены. На это влияет отсутствие интереса у трейдеров, а так же сложности связаные с управлением капиталами маркетмейкерами. Этих трудностей у компаний на Yard не будет.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <section class="space--top space--bottom--2 section--darkblue process process--v1 bg-gradient--darkblue--3" id="advantages">
            <div class="background-holder background--bottom background--cover opacity--03">
                <img src="assets/land/img/layout/image-globe.jpg" alt="image" class="background-image-holder">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-10 col-md-8 mx-auto">
                        <div class="text-center mb-5 reveal">
                            <h2 class="h3-font font-w--600 mb-2">Наши преимущества</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="position-relative mt-xl-10 reveal">
                            <div class="pos-abs-center d-none d-lg-block">
                                <img src="assets/land/img/layout/process.svg" alt="process" class="svg process__circle d-inline-block">
                                <img src="assets/land/img/logo-1.png" alt="brand-logo" class="pos-abs-center">
                            </div>
                            <div class="d-sm-flex justify-content-between ml-6 ml-sm-0">
                                <div class="options options--left text-left mb-3 mb-sm-0 remove-space--bottom">
                                    <div class="option mb-3 mb-sm-10">
                                        <h3 class="h6-font text-sm-right text-uppercase font-w--700">Стимулирование <br>роста цены токена</h3>
                                        <span class="decor"></span>
                                    </div>
                                    <div class="option mb-3 mb-sm-10">
                                        <h3 class="h6-font text-sm-right text-uppercase font-w--700">Система бонусных <br>вознаграждений</h3>
                                        <span class="decor"></span>
                                    </div>
                                    <div class="option mb-3 mb-sm-10">
                                        <h3 class="h6-font text-sm-right text-uppercase font-w--700">Получайте доход <br>в любой точке мира</h3>
                                        <span class="decor"></span>
                                    </div>
                                </div>
                                <div class="process__circle--mobile position-relative d-none d-sm-flex d-lg-none align-items-center">
                                    <span class="mobile-logo">
                                        <img src="assets/land/img/logo-1.png" alt="brand-logo" class="pos-abs-center">
                                    </span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="options options--right text-right text-left remove-space--bottom">
                                        <div class="option mb-3 mb-sm-10">
                                            <h3 class="h6-font text-left text-uppercase font-w--700">Доступ к стартапам и <br>цифровым активам
                                            </h3>
                                            <span class="decor"></span>
                                        </div>
                                        <div class="option mb-3 mb-sm-10">
                                            <h3 class="h6-font text-left text-uppercase font-w--700">Уникальные <br>биржевые алгоритмы</h3>
                                            <span class="decor"></span>
                                        </div>
                                        <div class="option mb-3 mb-sm-10">
                                            <h3 class="h6-font text-left text-uppercase font-w--700"> Листинг токенов <br>сообществ и бизнеса</h3>
                                            <span class="decor"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="space section--darkblue bg-gradient--darkblue--4" id="algorithm">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-10 mx-auto mx-md-0">
                        <div class="mb-5 mb-lg-7 text-center text-md-left reveal">
                            <h2 class="h3-font font-w--600 mb-2">Особенности биржевых алгоритмов Yard</h2>
                            <p class="h6-font">В основе Yard лежат несколько видов биржевых алгоритмов. Profit-oriented Algorithm способствует росту цены YRD, контролируя формирование ордеров, управляя спросом и предложением. В тоже время, на рынке GRD - USD будет использоваться стандартный алгоритм, который используется на всех биржах. Эффективность алгоритмов усилена дополнительной мотивацией трейдеров - реферальными бонусами.</p>
                        </div>
                    </div>
                </div>
                <div class="position-relative">
                    <div class="vertical-border d-flex pos-abs-center h-100 w-100">
                        <span class="column-border"></span>
                    </div>
                    <div class="row horizontal-border justify-content-between mb-lg-5 pb-lg-5 reveal">
                        <div class="col-12 col-md-6 col-lg-5">
                            <div class="d-lg-flex mb-4 mb-lg-0 text-center text-md-left">
                                <span class="mb-3 mb-lg-0 mr-md-3">
                                    <img src="#" alt="">
                                </span>
                                <div>
                                    <h3 class="h5-font text-color--200 font-w--600 mb-2">Алгоритм P2P Demand</h3>
                                    <p class="text-color--500">Первый модуль алгоритма Profit-oriented Algorithm. Обеспечивает стабильное создание спроса на токен и как результат повышение его цены.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-5">
                            <div class="d-lg-flex mb-4 mb-lg-0 text-center text-md-left">
                                <span class="mb-3 mb-lg-0 mr-md-3">
                                    <img src="#" alt="">
                                </span>
                                <div>
                                    <h3 class="h5-font text-color--200 font-w--600 mb-2">Высокая доходность</h3>
                                    <p class="text-color--500">Utilizing the power of the global community and the sharing economy to tear down the barriers and revolutionize the old & inefficient financial systems.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row horizontal-border justify-content-between mb-lg-5 pb-lg-5 reveal">
                        <div class="col-12 col-md-6 col-lg-5">
                            <div class="d-lg-flex mb-4 mb-lg-0 text-center text-md-left">
                                <span class="mb-3 mb-lg-0 mr-md-3">
                                    <img src="#" alt="">
                                </span>
                                <div>
                                    <h3 class="h5-font text-color--200 font-w--600 mb-2">Алгоритм P2P Supply</h3>
                                    <p class="text-color--500">Второй модуль алгоритма Profit-oriented Algorithm. Он «мягко» контролирует создание предложений участников, способствуя уменьшению падения цены.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-5">
                            <div class="d-lg-flex mb-4 mb-lg-0 text-center text-md-left">
                                <span class="mb-3 mb-lg-0 mr-md-3">
                                    <img src="#" alt="">
                                </span>
                                <div>
                                    <h3 class="h5-font text-color--200 font-w--600 mb-2">Высокая доходность</h3>
                                    <p class="text-color--500">Using innovation and creativity, our community of architects, developers revolutionaries believe in the creation of a bid meets an ask.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="switchable pt-4 d-lg-flex align-items-md-center" id="cabinet">
                <div class="col-12 col-lg-6 mb-40 mb-lg-0 text-center mb-3 reveal">
                    <picture class="switchable__image">
                        <img src="assets/land/img/acc.png" alt="image" class="img-fluid">
                    </picture>
                </div>
                <div class="switchable__content">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 ml-md-auto">
                                <div class="mb-4 text-center text-sm-left reveal">
                                    <h2 class="h3-font font-w--600 mb-1">Удобный и функциональный личный кабинет</h2>
                                    <p class="h6-font">Доступность для каждого пользователя не имеющих специального опыта и навыков</p>
                                </div>
                                <ul class="pl-2 mb-6 text-left reveal">
                                    <li class="text-color--500 mb-1">
                                        <p>Удобное и быстрое пополнение баланса в два клика</p>
                                    </li>
                                    <li class="text-color--500 mb-1">
                                        <p>Используем проверенные платежные системы и криптовалюты</p>
                                    </li>
                                    <li class="text-color--500 mb-1">
                                        <p>Удобное отслеживание всей вашей структуры и ваших доходов</p>
                                    </li>
                                    <li class="text-color--500 mb-1">
                                        <p>История всех ордеров, отслеживайте и прогнозируйте ваш доход</p>
                                    </li>
                                    <li class="text-color--500 mb-1">
                                        <p>Изменение данных в онлайн режиме</p>
                                    </li>
                                    <li class="text-color--500 mb-1">
                                        <p>Быстрый вывод средств на ваши реквизиты</p>
                                    </li>
                                </ul>
                                <!-- 
                                <div class="button-group d-flex flex-column flex-sm-row align-items-center reveal">
                                    <div class="ml-sm-3 mb-sm-7">
                                        <a class="lightbox h6-font color--primary d-flex align-items-center justify-content-center" data-autoplay="true" data-vbtype="video" href="#">
                                            <i class="icon icon-button-circle-play color--primary font-size--26"></i>
                                           <span class="ml-1 font-w--700">Смотреть обзор</span></a>
                                    </div>
                                </div>
                                 -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="space token-sale-details token-sale-details--v1 section--darkblue bg-gradient--darkblue--3" id="markets">
            <div class="container">
                <div class="row align-items-end">
                    <div class="col-12 col-lg-12 col-xl-12 mx-auto mx-md-0 remove-space--bottom">
                        <div class="mb-5 mb-lg-7 text-center text-md-left reveal">
                            <h2 class="h3-font font-w--600 mb-2">Рынки Yard Exchange</h2>
                        </div>
                        <div class="d-flex flex-row mb-2 reveal">
                            <div class="card bg-color--blue-opacity--15 border--none p-2 p-md-4 mr-2 w-100">
                                <span class="body-font font-w--600 mb-1">Настройка рынка</span>
                                <span class="color--primary h4-font font-w--700">YRD - USD</span>
                            </div>
                            <div class="card bg-color--blue-opacity--15 border--none p-2 p-md-4 w-100">
                                <span class="body-font font-w--600 mb-1">Создание рынка</span>
                                <span class="color--primary h4-font font-w--700">GRD - USD</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="footer section--darkblue bg-gradient--darkblue--6">
            <div class="py-3">
                <div class="container">
                    <div class="row">
                        <div class="col text-center">
                        <ul class="icon-group icon-rounded icon-rounded-color--primary justify-content-center">
                                <li><a href="https://www.facebook.com/gridgroupofficial" target="_blank" class="color--primary"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="https://t.me/gridgroupofficiall" target="_blank" class="color--primary"><i class="fab fa-telegram-plane"></i></a></li>
                            <li><a href="https://instagram.com/gridgroup_official?igshid=1qcxwh4x360y1" target="_blank" class="color--primary"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="https://vk.com/gridofficial" target="_blank" class="color--primary"><i class="fab fa-vk"></i></a></li>
                            <li><a href="https://www.youtube.com/channel/UCt-fD7bhVEUN5fmy2Cz3s-g/" target="_blank" class="color--primary"><i class="fab fa-youtube"></i></a></li>
                        </ul>
                            <p class="text-color--500 font-size--14">Copyright © 2020 Yard Exchange. All Rights Reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </main>
    <script src="assets/land/js/plugins.min.js"></script>
    <script src="assets/land/js/app.js"></script>
</body>

</html>
