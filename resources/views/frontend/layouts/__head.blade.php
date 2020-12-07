<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" >
<meta name="author" content="Ansonika">
<link href="{!!asset('assets/frontend/fontawesome-5.5/css/all.min.css')!!}" rel="stylesheet">
<link href="{!!asset('assets/frontend/slick/slick.css')!!}" rel="stylesheet">
<link href="{!!asset('assets/frontend/slick/slick-theme.css')!!}" rel="stylesheet">
<link href="{!!asset('assets/frontend/magnific-popup/magnific-popup.css')!!}" rel="stylesheet">
<link href="{!!asset('assets/frontend/css/bootstrap.min.css')!!}" rel="stylesheet">
<link href="{!!asset('assets/frontend/css/templatemo-style.css')!!}" rel="stylesheet">
<link href="{!!asset('assets/frontend/css/app.css')!!}" rel="stylesheet">
<link href="{!!asset('assets/frontend/css/custom.css')!!}" rel="stylesheet">
<!DOCTYPE html>
<html lang="en">
<head>
    <!--Offer Alert ================================ -->
    <div class="offer-alert">
        <div class="offer-alert__container container">
            <span class="hero__title title-page">{{$page->brand}}</span>
        </div>
    </div>

    <!--Hero ====================================== -->
    <!--
	The Town
	https://templatemo.com/tm-525-the-town
	-->
</head>
<header class="hero container-fluid border-bottom">
    <nav class="hero-nav container px-4 px-lg-0 mx-auto">
        <ul class="nav w-100 list-unstyled align-items-center p-0">
            <li class="hero-nav__item">
                <img class="hero-nav__logo" src="{{asset($page->logo)}}">
            </li>
            <li id="hero-menu" class="flex-grow-1 hero__nav-list hero__nav-list--mobile-menu ft-menu">
                <ul class="hero__menu-content nav flex-column flex-lg-row ft-menu__slider animated list-unstyled p-2 p-lg-0">
                    <li class="flex-grow-1">
                        <ul class="nav nav--lg-side list-unstyled align-items-center p-0">
                            @foreach($menu->menuDetail as $detail)
                            <li class="hero-nav__item">
                                <a href="#{{$detail->link}}" class="hero-nav__link">{{$detail->name}}</a>
                            </li>
                            @endforeach

                        </ul>
                    </li>
                </ul>
                <button onclick="document.querySelector('#hero-menu').classList.toggle('ft-menu--js-show')"
                        class="ft-menu__close-btn animated">
                    <svg class="bi bi-x" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 010 .708l-7 7a.5.5 0 01-.708-.708l7-7a.5.5 0 01.708 0z"
                              clip-rule="evenodd" />
                        <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 000 .708l7 7a.5.5 0 00.708-.708l-7-7a.5.5 0 00-.708 0z"
                              clip-rule="evenodd" />
                    </svg>
                </button>
            </li>
            <li class="d-lg-none flex-grow-1 d-flex flex-row-reverse hero-nav__item">
                <button onclick="document.querySelector('#hero-menu').classList.toggle('ft-menu--js-show')"
                        class="text-center px-2">
                    <i class="fas fa-bars"></i>
                </button>
            </li>
        </ul>
    </nav>
    <div class="hero__content container mx-auto">
        <div class="row px-0 mx-0 align-items-center">
            <div class="col-lg-6 px-0">
                <h1 class="hero__title mb-3 text-header">{!! $head->title !!}
                </h1>
                <p class="hero__paragraph mb-5">
                    {!! $head->content !!}
                </p>
                <div class="hero__btns-container">
                    <a class="hero__btn btn btn-primary mb-2 mb-lg-0" href="#">
                        Get Free App
                    </a>
                    <a class="hero__btn btn btn-secondary mx-lg-3" href="#">
                        Go Premium
                    </a>
                </div>
            </div>
            @foreach($files as $file)
            <div class="col-lg-5 mt-5 mt-lg-0 mx-0">
                <div class="hero__img-container">
                    <img src="{{asset($file)}}" class="hero__img w-100">
                </div>
            </div>
            @endforeach
        </div>
    </div>
</header>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">

<link rel="dns-prefetch" href="https://fonts.gstatic.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous">
<link rel="preload" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" as="fetch" crossorigin="anonymous">
<script type="text/javascript">
    !function (e, n, t) {
        "use strict";
        var o = "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap", r = "__3perf_googleFonts_c2536";
        function c(e) {
            (n.head || n.body).appendChild(e)
        }
        function a() {
            var e = n.createElement("link");
            e.href = o, e.rel = "stylesheet", c(e)
        }
        function f(e) {
            if (!n.getElementById(r)) {
                var t = n.createElement("style");
                t.id = r, c(t)
            }
            n.getElementById(r).innerHTML = e
        }
        e.FontFace && e.FontFace.prototype.hasOwnProperty("display") ? (t[r] && f(t[r]), fetch(o).then(function (e) {
            return e.text()
        }).then(function (e) {
            return e.replace(/@font-face {/g, "@font-face{font-display:swap;")
        }).then(function (e) {
            return t[r] = e
        }).then(f).catch(a)) : a()
    }(window, document, localStorage);
</script>
<!-- BASE CSS -->




<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-11097556-8']);
    _gaq.push(['_trackPageview']);

    (function () {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-155240324-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-155240324-1');
</script>

