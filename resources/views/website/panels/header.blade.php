@php
$route_name = Route::currentRouteName();
@endphp

<header class="header header-2 header-intro-clearance">
    <topbar-component></topbar-component>
    <div class="header-middle">
        <div class="container">
            <div class="header-left"><button class="mobile-menu-toggler" onclick="mobileMenu()"><span class="sr-only">Toggle mobile
                        menu</span> <i class="icon-bars"></i></button>
                <div
                    class="header-search">
                    <button type="button" data-toggle="modal" data-target="#myModal" class="search-toggle">
                        <i class="icon-search"></i>
                    </button>
                    {{-- <a href="#search-modal" onclick="openSearchModal()" role="button" class="search-toggle"><i class="icon-search"></i></a> --}}
                    <form action="#" method="get">
                        <div class="header-search-wrapper search-wrapper-wide"><label for="q"
                                class="sr-only">Search</label> <input type="text" name="q" id="q"
                                placeholder="Search product ..." required="required" class="form-control"> <button
                                type="submit" class="btn btn-primary"><span class="sr-only">Search</span> <i
                                    class="icon-search"></i></button></div>
                        <div class="live-search-list">
                        </div>
                    </form>
                </div>


            </div>
            <div class="header-center">
                <a href="/" aria-current="page" class="logo active link-active" style="width:100%"><img alt="Dhifaf"
                        width="400" class="bg-transparent fade-in" data-src="/website/images/logo.svg"
                        src="/website/images/logo.svg" lazy="loaded" style="margin: 0 auto;"></a>

            </div>
            <div class="header-right">
                <header-right-component></header-right-component>
            </div>
        </div>
    </div>
    <div class="sticky-wrapper" style="height: 54px;">
        <div class="header-bottom sticky-header">
            <div class="container">
                <div class="header-left">
                    <div class="dropdown category-dropdown"><a href="javascript:;" title="Browse Divisions"
                            class="dropdown-toggle">{{ __('layout.browse_divisions') }}</a>
                        <header1-component language='{{ app()->getLocale() }}' route_name={{ $route_name }}>
                        </header1-component>

                    </div>
                </div>
                <div class="header-center">
                    <nav class="main-nav">
                        <ul class="menu sf-arrows">
                            <li class="{{ (request()->segment(1) == '') ? 'active' : '' }}"><a href="/" aria-current="page"
                                    class="">{{ __('layout.home') }}</a>
                            </li>
                            <li class="nav-item ">
                            <li class="{{ (request()->segment(1) == 'new-arrivals') ? 'active' : '' }}">
                                <a href="{{ route('new-arrivals') }}" class="">{{ __('layout.new_arrivals') }}</a>
                            </li>
                            <li class="{{ (request()->segment(1) == 'brands') ? 'active' : '' }}">
                                <a href="{{ route('brands') }}" class="">{{ __('layout.brands') }}</a>
                            </li>
                            <li class="{{ (request()->segment(1) == 'gift-sets') ? 'active' : '' }}">
                                <a href="{{ route('giftSets') }}" class="">{{ __('layout.gift_sets') }}</a>

                            </li>
                            <li class="pr-3">
                                <a href="/" class=""><span>{{ __('layout.influencers') }}<span
                                            class="tip tip-new">{{ __('layout.soon') }}</span></span></a>

                            </li>
                            <li class="{{ (request()->segment(1) == 'hot-items') ? 'active' : '' }}">
                                <a href="{{ route('hotItems') }}" class=""><span>{{ __('layout.hot_items') }}</span></a>

                            </li>

                        </ul>
                    </nav>
                </div>
                <div class="header-right overflow-hidden">
                    <i class="la la-lightbulb-o"></i>
                    <p class="text-truncate">
                        Hot Items
                        <span class="highlight">&nbsp;Up
                            to
                            30%
                            Off</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</header>
{{-- <header-component language='{{ app()->getLocale() }}' route_name={{ $route_name }}></header-component> --}}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        </div>
        <div class="modal-body">

          <h1>Search</h1>
          <form class="navbar-form " role="search" action="{{ route('all-products') }}">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
          </form>


        </div>


      </div>
    </div>
  </div>
@push('scripts')

    <script>
        function mobileMenu(){
            document.querySelector('body').classList.add('mmenu-active');
        }
        $(document).ready(function() {
            // executes when HTML-Document is loaded and DOM is ready

            // breakpoint and up
            $(window).resize(function() {
                if ($(window).width() >= 980) {

                    // when you hover a toggle show its dropdown menu
                    $(".navbar .dropdown-toggle").hover(function() {
                        $(this).parent().toggleClass("show");
                        $(this).parent().find(".dropdown-menu").toggleClass("show");
                    });

                    // hide the menu when the mouse leaves the dropdown
                    $(".navbar .dropdown-menu").mouseleave(function() {
                        $(this).removeClass("show");
                    });

                    // do something here
                }
            });
            // document ready
        });
    </script>

@endpush
