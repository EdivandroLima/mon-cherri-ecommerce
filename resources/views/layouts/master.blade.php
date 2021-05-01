<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link href="{{asset('favicon.png')}}" rel="apple-touch-icon"/>
    <link href="{{asset('favicon.png')}}" rel="icon"/>
    <title>{{env('APP_NAME')}} - @yield('title')</title>
    <!-- Fonts-->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css"
          integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">

    <!-- -------- font-awesome ------- -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- google font-family  -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=poppins"> -->
    <!-- css file  -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('slick/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('slick/slick-theme.css')}}">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{asset('css/plugin.css')}}">
    <!-- Bootstap CSS -->
{{--	<link rel="stylesheet" href="https://www.annimexweb.com/items/belle/assets/css/bootstrap.min.css">--}}
<!-- Main Style CSS -->
    <link href="{{asset('css/noty.min.css')}}" rel="stylesheet"/>

    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
</head>
<body>

<div class="search" style="z-index: 200 !important;">
    <div class="search__form">
        <form class="search-bar__form" id="bs_search_form" action="">
            <h3 class="mb-4"><strong>{{__('Search what are you looking for')}}</strong></h3>
            <input class="search__input" type="search" name="keyword" style="width: 69%"
                   placeholder="{{__('Search entire store...')}}" aria-label="Search" required>
            <select class="bs_search_input" id="bs_searchCategory" style="width: 29%;border:0" required>
                <option value="">{{ __('Select Category') }}</option>
                <?php
                $categories = App\Category::all();
                ?>
                @foreach($categories as $category)
                    <option value="{{$category->slug}}">{{ __(ucwords($category->title)) }}</option>
                @endforeach
            </select>
            <button class="go-btn search__button" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
        </form>
        <button type="button" class="search-trigger close-btn"><i class="fa fa-times" aria-hidden="true"></i></button>
    </div>
</div>
<!--End Search Form Drawer-->

<!--Header-->


<div class="animated d-flex" style="background-color: #7a5630;">
    <div class="container-fluid">
        <div class="row align-items-center">
            <!--Desktop Logo-->
            <div style="float: left" class="logo col-md-2 col-lg-3 d-none d-lg-block">
                <a href="{{url('/')}}">
                    <h4 style="color: white;"><i class="fa fa-phone" style="color: white;" aria-hidden="true"></i>
                        &nbsp; {{__('Contact Us')}}: 1-800-763-9823</h4>
                </a>
            </div>
            <!--End Desktop Logo-->

            <div class="col-6 col-sm-6 col-md-6 col-lg-3 d-block d-lg-none mobile-logo">
                <div style="float: left" class="logo">
                    <a href="{{url('/')}}">
                        <h4 style="color: white;"><i class="fa fa-phone" style="color: white;" aria-hidden="true"></i>
                            &nbsp; {{__('Contact Us')}}: 1-800-763-9823</h4>
                    </a>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-6 col-lg-9" style="float: right;">
                <div class="site-cart site-cart1" onclick="document.getElementById('header-cart').slideToggle();"
                     id="top_cart">
                    @include('partials.top_cart')
                </div>
                <div class="site-cart site-cart3 h-setting pr-3">
                    <a href="#" class="site-header__cart3" title="Cart">
                        <i class="fa fa-cog" style="color: white;" aria-hidden="true"></i>
                    </a>
                    <!--Setting Popup-->
                    <div id="header-cart" class="site-header3 block block-cart">
                        <ul class="mini-products-list">
                            <li>
                                <div class="language">
                                    <span>{{__('select currency')}}</span>
                                    <ul>
                                        @foreach(currency()->getCurrencies() as $currency)
                                            <li>
                                                <a href="{{url()->current().'?currency='.$currency['code']}}">{{$currency['code']}} {{$currency['symbol']}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <div class="language">
                                    <span>{{__('select language')}}</span>
                                    <ul>
                                        @foreach($languages as $language => $name)
                                            <li>
                                                <a href="{{url()->current().'?lang='.$language}}">{{ strtoupper($name)  }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!--End Setting Popup-->
                </div>
                <div class="site-cart site-cart2 h-user pr-3">
                    <a href="#;" class="site-header__cart2" title="Cart">
                        <i class="fa fa-user" style="color: white;" aria-hidden="true"></i>
                    </a>
                    <!--Minicart Popup-->
                    <div id="header-cart" class="site-header2  block-cart">
                        <ul class="mini-products-list">
                            @guest
                                <li><h3>{{__('Login to Your Account')}}</h3></li>
                                <li>
                                    <div class="u-login">
                                        <a href="{{route('login')}}" class="btn rounded">{{__('login')}}</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="attribute">
                                        <span>{{__('New user')}}?</span>
                                        <a href="{{route('register')}}">
                                            <b class="text-black">{{__('register now')}}</b>
                                        </a>
                                    </div>
                                </li>
                            @else
                                <li><h3>{{ucwords(auth()->user()->name)}}</h3></li>
                                <li>
                                    <div class="u-login">
                                        <a class="btn rounded" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                                <li>
                                    <div class="attribute">
                                        <a href="{{url('/my-account/dashboard')}}">
                                            <b class="text-black">{{__('My Account')}}</b>
                                        </a>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                    <!--End Minicart Popup-->
                </div>
            </div>
        </div>
    </div>
</div>


<!--Header-->
<div class="header-wrap animated d-flex">
    <div class="container-fluid">
        <div class="row align-items-center">
            <!--Desktop Logo-->
            <div class="logo col-md-2 col-lg-2 d-none d-lg-block">
                <a href="{{url('/')}}">
                    <img src="{{asset('images/logo.png')}}" alt="">
                </a>
            </div>
            <!--End Desktop Logo-->
            <div class="col-2 col-sm-3 col-md-3 col-lg-9">
                <div class="d-block d-lg-none">
                    <button type="button" class="btn--link site-header__menu js-mobile-nav-toggle mobile-nav--open">
                        <!-- <i class="fa fa-times" aria-hidden="true"></i> -->
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </button>
                </div>
                <!--Desktop Menu-->
                <nav class="grid__item" id="AccessibleNav"><!-- for mobile -->
                    <ul id="siteNav" class="site-nav medium center hidearrow">
                        <li class="lvl1 parent megamenu"><a href="{{url('/')}}">Home</a>
                        </li>
                        <li class="lvl1 parent megamenu"><a href="#">About US</a>
                        </li>

                        @php  $categories = App\Category::all() @endphp
                        @foreach($categories as $category)
                            <li class="lvl1 parent megamenu {{count($category->subcategories)?'dropdown':''}}">
                                <a href="{{url('/shop',$category->slug)}}">{{ucwords($category->title)}}
                                    @if(count($category->subcategories))
                                        <i class="fa fa-angle-double-down"></i>
                                    @endif
                                </a>
                                @if(count($category->subcategories))
                                    <ul class="dropdown">
                                        @foreach($category->subcategories as $subcategories)
                                            <li>
                                                <a href="{{url('/shop?subcategory='.$subcategories->slug,$category->slug)}}"
                                                   class="site-nav">{{ucwords($subcategories->title)}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </nav>
                <!--End Desktop Menu-->
            </div>
            <div class="col-7 col-sm-6 col-md-6 col-lg-1 d-block d-lg-none mobile-logo">
                <div class="logo">
                    <a href="{{url('/')}}">
                        <img src="{{asset('images/logo.png')}}" alt="">
                    </a>
                </div>
            </div>
            <div class="col-3 col-sm-3 col-md-3 col-lg-1">


                <div class="site-header__search">
                    <button type="button" class="search-trigger"><i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!--End Header-->
<!--Mobile Menu-->
<div class="mobile-nav-wrapper" role="navigation">
    <div class="closemobileMenu">
        <i class="fa fa-times" aria-hidden="true"></i> {{__('Close Menu')}}
    </div>
    <ul id="MobileNav" class="mobile-nav">
        <li class="lvl1 parent megamenu"><a href="{{url('/')}}">{{__('Home')}}</a></li>
        <li class="lvl1 parent megamenu"><a href="#">{{__('About Us')}}</a></li>
        @php  $categories = App\Category::all() @endphp
        @foreach($categories as $category)
            <li class="lvl1 parent megamenu {{count($category->subcategories)?'dropdown':''}}">
                <a href="javascript:void(0)">{{__($category->title)}}
                    @if(count($category->subcategories))
                        <i class="anm fa fa-angle-double-down"></i>
                    @endif
                </a>
                @if(count($category->subcategories))
                    <ul class="dropdown">
                        @foreach($category->subcategories as $subcategory)
                            <li><a href="{{url('/shop?subcategory=',$subcategory->slug)}}"
                                   class="site-nav">{{ucwords($subcategory->title)}}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
        <li class="lvl1 parent megamenu"><a href="{{url('/contact')}}">{{__('Contact')}}</a></li>
    </ul>
</div>

@yield('content')
@include('layouts.footer')
<span id="site-scroll" style="display: inline;" class="__web-inspector-hide-shortcut__"><i
        class="fa fa-arrow-up"></i></span>
<!-- JS Library-->
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script src="{{asset('slick/slick.js')}}" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">


    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }


    //  ------ Sliders -----

    $(document).on('ready', function () {
        $(".lazy").slick({
            lazyLoad: 'ondemand', // ondemand progressive anticipated
            infinite: true,
            autoplay: true,
            autoplaySpeed: 2000,
        });
        $(".arival-slider").slick({
            dots: true,
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    }
                }]
        });

        $(".mobile-brand-slide").slick({
            dots: true,
            infinite: true,
            dots: false,
            slidesToShow: 2,
            responsive: [
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    }
                }]
        });

        $(".mobile-blog-slide").slick({
            lazyLoad: 'ondemand', // ondemand progressive anticipated
            infinite: true,
            dots: false,
            slidesToShow: 1,
            responsive: [
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                }]
        });
    });
</script>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script data-cfasync="false"
        src="https://www.annimexweb.com/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script src="https://www.annimexweb.com/items/belle/assets/js/vendor/jquery-3.3.1.min.js"></script>
<script src="{{asset('js/Vendor/jqurey-3.3.1.min.js')}}"></script>
<script src="{{asset('js/Vendor/jqurey.cookie.js')}}"></script>
<script src="{{asset('js/Vendor/modernizr-3.6.0.min.js')}}"></script>
<script src="{{asset('js/Vendor/wow.min.js')}}"></script>
<!-- Including Javascript -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/plugins.js')}}"></script>
<script src="{{asset('js/popper.js')}}"></script>
<script src="{{asset('js/lazysizes.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
<!-- Photoswipe Gallery -->
<script src="{{asset('js/Vendor/photoswipe.min.js')}}"></script>
<script src="{{asset('js/Vendor/photoswipe-ui-default.min.js')}}"></script>


<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/bootstrap.esm.min.js')}}"></script>

<script src="{{asset('js/noty.min.js')}}"></script>
@include('partials.success')
@include('partials.error')
@yield('javascript')
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '.add_to_cart', function () {
            var this_item = $(this).children('i');
            start_spinner(this_item);
            var bs_product = $(this).attr('data-product_id');
            var bs_size = $(this).attr('data-product_size');
            var bs_qty = $(this).attr('data-product_quantity');
            $.ajax({
                url: '<?=url("addToCart")?>',
                method: 'POST',
                data: {product: bs_product, qty: bs_qty, size: bs_size, "_token": "<?=csrf_token()?>"},
                success: function (data) {
                    notify(data);
                    top_cart();
                    stop_spinner(this_item);
                }
            });
        });
        $(document).on('click', '.add_to_compare', function () {
            var this_item = $(this).children('i');
            start_spinner(this_item);
            var bs_product = $(this).attr('data-product_id');
            $.ajax({
                url: '<?=url("addToCompare")?>',
                method: 'POST',
                data: {product: bs_product, "_token": "<?=csrf_token()?>"},
                success: function (data) {
                    notify(data);
                    stop_spinner(this_item);
                }
            });
        });
        $(document).on('click', '.add_to_wishlist', function () {
            var this_item = $(this).children('i');
            start_spinner(this_item);
            var bs_product = $(this).attr('data-product_id');
            $.ajax({
                url: '<?=url("addToWishlist")?>',
                method: 'POST',
                data: {product: bs_product, "_token": "<?=csrf_token()?>"},
                success: function (data) {
                    notify(data);
                    stop_spinner(this_item);
                }
            });
        });
        $(document).on('click', '.remove_item', function () {
            var route = $(this).attr('data-route');
            $.ajax({
                url: route,
                method: 'GET',
                success: function (data) {
                    notify(data);
                    top_cart();
                }
            })
        });
        // set value and submit filter form
        $(document).on('click', '.filter_item', function () {
            var filter_id = $(this).attr('data-filter-id');
            document.getElementById(filter_id).checked = true;
            document.getElementById('filter_form').submit();
        });

        // disable button on submit any form
        $(document).on('submit', '.bs_form', function () {
            $('.bs_form_btn').attr('disabled', 'true');
        });

        // show-top-cart
        // $(document).on("click", '.top_cart', function () {
        //     $("#header-cart").slideToggle();
        // });
        // search function
        $(document).on('change', '#bs_searchCategory', function () {
            search_action();
        })

        function search_action() {
            var bs_cat = $("#bs_searchCategory option:selected").val();
            $("#bs_search_form").attr('action', '<?=url("/shop")?>/' + bs_cat);
        }

        search_action();

        $(document).on('change', '.bs_countries', function () {
            var bs_cont = $(this).val();
            country_states(bs_cont);
        });

        function country_states(bs_cont) {
            if (bs_cont != "" && bs_cont != null) {
                $.ajax({
                    url: "<?=url('bs_country_states')?>",
                    method: 'POST',
                    data: {country: bs_cont, '_token': '<?=csrf_token()?>'},
                    success: function (data) {
                        $('.bs_states').html(data.html);
                    }
                });
            }
        }

        country_states($("#country").val());

        $(document).on('change', '.bs_states', function () {
            var bs_st = $(this).val();
            state_cities(bs_st);
        });

        function state_cities(bs_st) {
            if (bs_st != "" && bs_st != null) {
                $.ajax({
                    url: "<?=url('bs_state_cites')?>",
                    method: 'POST',
                    data: {state: bs_st, '_token': '<?=csrf_token()?>'},
                    success: function (data) {
                        $('.bs_cities').html(data.html);
                    }
                });
            }
        }

        state_cities($("#state").val());

        function top_cart() {
            $.ajax({
                url: '<?=url("show_topCart")?>',
                method: 'POST',
                data: {"_token": "<?=csrf_token()?>"},
                success: function (data) {
                    $("#top_cart").html(data.html)
                }
            });
        }

        function notify(data) {
            new Noty({
                type: data.message_type,
                layout: 'centerRight',
                theme: 'nest',
                text: data.message,
                timeout: '4000',
                progressBar: true,
                killer: true,
            }).show();
        }

        function price_slider() {

            <?php
            $currency_symbol = '$';
            if ($found_currency = currency()->find(currency()->getUserCurrency())) {
                $currency_symbol = $found_currency->symbol;
            }
            ?>

            $("#slider-range").slider({
                range: true,
                min: 10,
                max: 10000,
                values: [0, 500],
                slide: function (event, ui) {
                    $("#amount").val("<?=$currency_symbol?>" + ui.values[0] + " - <?=$currency_symbol?>" + ui.values[1]);

                    document.getElementById('price_min').value = ui.values[0];
                    document.getElementById('price_max').value = ui.values[1];
                }
            });
            <?php
            if(request()->get('price_min') && request()->get('price_max')){
            $min_uprice = currency(request()->get('price_min'), 'USD', currency()->getUserCurrency());
            $max_uprice = currency(request()->get('price_max'), 'USD', currency()->getUserCurrency());
            ?>
            $("#amount").val("<?=$min_uprice?>" + " - " + "<?=$max_uprice?>");
            <?php
            }else{
            ?>
            $("#amount").val("<?=$currency_symbol?>" + $("#slider-range").slider("values", 0) + " - <?=$currency_symbol?>" + $("#slider-range").slider("values", 1));
            <?php
            }
            ?>

        }

        price_slider();

        function start_spinner(this_item) {
            this_item.attr('class', '');
            this_item.addClass('fa fa-spinner fa-spin bs_spinner');
        }

        function stop_spinner(this_item) {
            this_item.attr('class', '');
            this_item.addClass('fa fa-check');
        }

    });
</script>
</body>
</html>