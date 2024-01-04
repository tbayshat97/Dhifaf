{{-- extend layout --}}
@extends('layouts.websiteLayoutMaster')

{{-- page title --}}
@section('title', 'Home')

{{-- vendor styles --}}
@section('vendor-style')

@endsection

{{-- page style --}}
@section('page-style')
@endsection

{{-- page content --}}
@section('content')

    <!--Header Image-->
    <section class="luxury_shop">
        <div class="inner_header">
            <div class="header_image">
                <img src="/website/images/luxury_shop_image.jpg" alt="">
            </div>
            <div class="header_title">
                <h2>Aqua Di Gio</h2>
                <p>Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr, Sed Diam Nonumy Eirmod Tempor Invidunt Ut Laet Dolore Ma Gna Aliquyam Erat.</p>
            </div>
            <div class="header_breadcrump">
                <div class="container-fluid">
                    <ul>
                        <li>
                            <a href="#">Home</a>
                        </li>
                        <li>
                            <span>Aqua Di Gio</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Header Image-->

    <section class="luxury_new_arrivals section_padding">
        <div class="container-fluid">
            <div class="row">
                <div class="mobile-filter"><i class='bx bx-filter-alt'></i></div>
                <div class="col-lg-3" id="sidebar">
                    <div class="filters mb-5">
                        <h3>Filter by Category </h3>
                        <div class="single-element-widget mt-30">
                            <div class="switch-wrap d-flex justify-content-end align-items-center">
                                <p>01. Sample Checkbox</p>
                                <div class="primary-checkbox">
                                    <input type="checkbox" id="default-checkbox">
                                    <label for="default-checkbox"></label>
                                </div>
                            </div>
                            <div class="switch-wrap d-flex justify-content-end align-items-center">
                                <p>01. Sample Checkbox</p>
                                <div class="primary-checkbox">
                                    <input type="checkbox" id="default-checkbox">
                                    <label for="default-checkbox"></label>
                                </div>
                            </div>
                            <div class="switch-wrap d-flex justify-content-end align-items-center">
                                <p>01. Sample Checkbox</p>
                                <div class="primary-checkbox">
                                    <input type="checkbox" id="default-checkbox">
                                    <label for="default-checkbox"></label>
                                </div>
                            </div>
                            <div class="switch-wrap d-flex justify-content-end align-items-center">
                                <p>01. Sample Checkbox</p>
                                <div class="primary-checkbox">
                                    <input type="checkbox" id="default-checkbox">
                                    <label for="default-checkbox"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="filters">
                        <h3>Filter by Price</h3>
                        <div class="widget price-widget">
                            <div class="wrapper">
                                <fieldset class="filter-price">
                                    <div class="price-field">
                                        <input type="range" name="minPrice" value="0" id="lower">
                                        <input type="range" name="maxPrice" value="100" id="upper">
                                    </div>
                                    <div class="price-wrap">
                                        <div class="price-wrap-1">
                                            <input id="one">
                                            <label for="one">JD</label>
                                        </div>
                                        <div class="price-wrap_line">-</div>
                                        <div class="price-wrap-2">
                                            <input id="two">
                                            <label for="two">JD</label>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <!--./Price Filter -->
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row align-items-center mb-2">
                        <div class="col-lg-6">
                            <h3>Shop</h3>
                            <h5>Showing 1–12 Of 24 Results</h5>
                        </div>
                        <div class="col-lg-6 text-right">
                            <div class="default-select" id="default-select_2">
                                <select>
                                    <option value=" 1">English</option>
                                    <option value="1">Spanish</option>
                                    <option value="1">Arabic</option>
                                    <option value="1">Portuguise</option>
                                    <option value="1">Bengali</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <product-card></product-card>
                        <product-card></product-card>
                        <product-card></product-card>
                        <product-card></product-card>
                        <product-card></product-card>
                        <product-card></product-card>
                    </div>
                </div>
            </div>
        </div>
    </section>

@push('scripts')
<script>
    //Price Filter
    var lowerSlider = document.querySelector('#lower');
    var upperSlider = document.querySelector('#upper');

    document.querySelector('#two').value = upperSlider.value;
    document.querySelector('#one').value = lowerSlider.value;

    var lowerVal = parseInt(lowerSlider.value);
    var upperVal = parseInt(upperSlider.value);
    upperSlider.oninput = function () {
        lowerVal = parseInt(lowerSlider.value);
        upperVal = parseInt(upperSlider.value);
        if (upperVal < lowerVal + 4) {
            lowerSlider.value = upperVal - 4;
            if (lowerVal == lowerSlider.min) {
                upperSlider.value = 4;
            }
        }
        document.querySelector('#two').value = this.value
    };

    lowerSlider.oninput = function () {
        lowerVal = parseInt(lowerSlider.value);
        upperVal = parseInt(upperSlider.value);
        if (lowerVal > upperVal - 4) {
            upperSlider.value = lowerVal + 4;
            if (upperVal == upperSlider.max) {
                lowerSlider.value = parseInt(upperSlider.max) - 4;
            }
        }
        document.querySelector('#one').value = this.value
    };

    //Mobile Filter
    $('.mobile-filter').on('click', function(e) {
      $('#sidebar').toggleClass("show-filter"); //you can list several class names 
      e.preventDefault();
    });
</script>
@endpush
@endsection