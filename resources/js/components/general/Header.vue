<template>
    <header class="main_menu home_menu">
        <div class="topbar">
            <div class="container-fluid">
                <div class="row topbar-mobile">
                    <div class="col-12 col-md-4 d-flex align-items-center">
                        <div id="login_register">
                            <a v-if="!isLoggedIn" href="/register">{{translate('layout.signup')}}</a>
                            <a v-if="!isLoggedIn" href="/login">{{translate('layout.login')}}</a>
                        </div>
                        <div v-if="isLoggedIn">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-expanded="false">
                                <img v-if="image" :src="image" class="img-fluid" alt="">
                                <img v-else src="/website/images/profile-img.png" class="img-fluid" alt="">
                                {{ first_name }}
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li>
                                    <a class="dropdown-item profile-menu" href="/my-profile">
                                        <img v-if="image" :src="image" class="img-fluid" alt="">
                                        <img v-else src="/website/images/profile-img.png" class="img-fluid" alt="">
                                        {{ first_name }}
                                    </a>
                                </li>
                                <li><a class="dropdown-item" href="/notifications">{{translate('layout.notifications')}}</a></li>
                                <li><a class="dropdown-item" href="/my-orders">{{translate('layout.my_orders')}}</a></li>
                                <li><a class="dropdown-item" href="/manage-address">{{translate('layout.manage_address')}}</a></li>
                                <li><a class="dropdown-item" @click="logout" style="cursor: pointer">{{translate('layout.logout')}}</a></li>
                            </ul>
                        </div>
                        <div class="hearer_icon d-flex">
                            <a id="search_1" href="javascript:void(0)"><i class='bx bx-search' ></i></a>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 d-flex align-items-center justify-content-center">
                        <p v-if="section.data">{{ section.data.section_data.content }}</p>
                    </div>
                    <div class="col-12 col-md-4 justify-content-end d-flex align-items-center">
                        <follow-component></follow-component>
                        <ul class="d-flex align-items-center pl-2" id="currency_lang">
                            <li class="nav-item dropdown" v-if="language == 'en'">
                                <div aria-labelledby="lang">
                                    <a href="lang/ar">Ar</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown" v-else>
                                <div aria-labelledby="lang">
                                    <a href="lang/en">En</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="currency"
                                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    USD
                                </a>
                                <div class="dropdown-menu" aria-labelledby="currency">
                                    <a class="dropdown-item" href="#">IRQ</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="header">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="menu_icon"><i class="fas fa-bars"></i></span>
                            </button>

                            <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link" href="/" :class="{active:route_name === 'home'}">{{translate('layout.home')}}</a>
                                    </li>
                                    <li class="nav-item hover-menu">
                                        <a class="nav-link" href="#" :class="{active:route_name === 'new-arrivals'}">{{translate('layout.new_arrivals')}}</a>
                                    </li>
                                    <li class="nav-item hover-menu">
                                        <a class="nav-link" href="/brands" :class="{active:route_name === 'brands'}">{{translate('layout.brands')}}</a>
                                    </li>
                                    <li class="nav-item hover-menu">
                                        <a href="#" class="nav-link">Gift Sets</a>
                                    </li>
                                </ul>
                                <a class="navbar-brand" href="/"> <img src="/website/images/logo.svg" alt="logo"> </a>
                                <ul class="navbar-nav align-items-center">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" :class="{active:route_name === 'influencers'}">{{translate('layout.influencers')}}</a>
                                        <h5><span class="badge badge-secondary">{{translate('layout.soon')}}</span></h5>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/contact-us" :class="{active:route_name === 'contact-us'}">{{translate('layout.contact')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/sale-and-offers" :class="{active:route_name === 'sale-and-offers'}">{{translate('layout.sale-and-offers')}}</a>
                                    </li>
                                    <div class="header-links">
                                        <li class="nav-item header-icons">
                                            <a class="nav-link" href="/wishlist"><i class='bx bxs-gift' ></i></a>
                                        </li>
                                        <li class="nav-item header-icons">
                                            <a class="nav-link" href="/favorite"><i class='bx bxs-heart' ></i></a>
                                        </li>
                                        <li class="nav-item header-icons">
                                            <a class="nav-link cart" href="/cart"><span>{{ $store.state.cartCount }}</span><i class='bx bxs-basket' ></i></a>
                                        </li>
                                    </div>
                                </ul>
                                <div class="col-12 col-md-4 justify-content-end d-flex align-items-center mobile-menu-links">
                                    <follow-component></follow-component>
                                    <ul class="d-flex align-items-center pl-2">
                                        <li class="nav-item dropdown" v-if="language == 'en'">
                                            <div aria-labelledby="lang">
                                                <a href="lang/ar">Ar</a>
                                            </div>
                                        </li>
                                        <li class="nav-item dropdown" v-else>
                                            <div aria-labelledby="lang">
                                                <a href="lang/en">En</a>
                                            </div>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="currency"
                                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                USD
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="currency">
                                                <a class="dropdown-item" href="#">IRQ</a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="header bottom_header">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg navbar-light bottom_menu">
                            <div class="main-menu-item w-100">
                                <ul class="navbar-nav justify-content-center" :class="{ logged_in_user: isLoggedIn }">
                                    <li class="nav-item hover-menu dropdown" v-for="(division, index) in divisions" :key="index">
                                        <a :href="$router.resolve({name: 'single-division', params: {slug: division.division_slug}}).href" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ division.division_name }}</a>
                                        <i class='bx bxs-up-arrow'></i>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown" v-if="division.division_categories">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-8 d-flex flex-wrap">
                                                        <div class="col-md-2" v-for="(category, index) in division.division_categories" :key="index">
                                                            <a class="main-title text-uppercase" :href="$router.resolve({name: 'category-shop', params: {slug: category.category_slug}}).href">{{ category.category_name }}</a>
                                                            <ul class="nav flex-column">
                                                                <li class="nav-item" v-for="(subCategory, index) in category.category_sub" :key="index">
                                                                    <a href="#">{{ subCategory.sub_category_name }}</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 d-flex flex-wrap">
                                                        <div class="col-md-6"><img src="/website/images/placeholder.jpg" alt=""></div>
                                                        <div class="col-md-6"><img src="/website/images/placeholder.jpg" alt=""></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--  /.container  -->
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="search_input" id="search_input_box">
            <div class="container-fluid">
                <form class="search-inner">
                    <img src="/website/images/logo.svg" alt="">
                    <input type="text" class="form-control" id="search_input" placeholder="What are you looking for?" v-model="title">

                    <span class="ti-close" id="close_search" title="Close Search"></span>

                    <div v-if="show_search" class="advanced-search">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="brand">{{translate('layout.brand_name')}}</label>
                                <select v-model="brand" id="brand">
                                    <option :value="null" disabled>{{translate('layout.brand_name')}}</option>
                                    <option v-for="(brand, index) in brands" :key="`normal` + index" :value="brand.brand_id">{{ brand.brand_name }}</option>
                                    <option v-for="(brand, index) in luxuryBrands" :key="`luxury` + index" :value="brand.brand_id">{{ brand.brand_name }}</option>
                                </select>
                            </div>
                            <div class="col-md-6 price-filter">
                                {{translate('layout.price')}}
                                <vue-range-slider :bg-style="bgStyle" :tooltip-style="tooltipStyle" :process-style="processStyle" v-model="priceRange" :min="10" :max="220"></vue-range-slider>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="category">{{translate('layout.category')}}</label>
                                <select v-model="category" id="category">
                                    <option :value="null" disabled>{{translate('layout.category')}}</option>
                                    <option v-for="(category, index) in categories" :key="index" :value="category.category_id">{{ category.category_name }}</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="sub_category">{{translate('layout.subcategory')}}</label>
                                 <select v-model="sub_category" id="sub_category">
                                    <option value="">{{translate('layout.subcategory')}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="search-buttons">
                        <button type="submit" class="btn" @click="search">{{translate('layout.search')}}</button>
                        <button type="submit" class="btn" @click="showAdvancedSearch">{{translate('layout.advanced')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </header>
</template>
<script>
import 'vue-range-component/dist/vue-range-slider.css'
import VueRangeSlider from 'vue-range-component'

    export default {
        props: ['language', 'route_name'],
        data() {
            return {
                show_search: false,
                first_name: "",
                image: "",
                isLoggedIn : null,
                profile_information: [],
                section: '',
                title: '',
                brand: '',
                category: '',
                sub_category: '',
                categories: [],
                brands: [],
                luxuryBrands: [],
                priceRange: [10, 220],
                subCategories: [],
                minPrice: '',
                maxPrice: '',
                searchResult: [],
                divisions: []
            }
        },
        components: {
            VueRangeSlider
        },
        methods: {
            showAdvancedSearch(e) {
                e.preventDefault();
                this.show_search = !this.show_search;
            },
            priceFilter() {
                this.bgStyle = {
                backgroundColor: '#fff',
                boxShadow: 'inset 0.5px 0.5px 3px 1px rgba(0,0,0,.36)'
                }
                this.tooltipStyle = {
                backgroundColor: '#666',
                borderColor: '#666'
                }
                this.processStyle = {
                backgroundColor: '#999'
                }
            },
            logout() {
                localStorage.removeItem("token");
                localStorage.removeItem("user");
                window.location.href = '/';
            },
            getCategories() {
                axios
                .get("/api/customer/categories")
                .then(response => {
                    this.categories = response.data.data;
                })
                .catch(error => {
                    console.error(error);
                });
            },
            getBrands() {
                axios
                .get("/api/customer/brand/normal")
                .then(response => {
                    this.brands = response.data.data;
                })
                .catch(error => {
                    console.error(error);
                });
                axios
                .get("/api/customer/brand/luxury")
                .then(response => {
                    this.luxuryBrands = response.data.data;
                })
                .catch(error => {
                    console.error(error);
                });
            },
            search(e) {
                e.preventDefault();
                var allProducts = '/all-products';
                this.$router.push({path:allProducts,query: {
                    title : this.title,
                    brand: this.brand,
                    category: this.category,
                    sub_category: this.sub_category,
                    priceFrom: this.priceRange[0],
                    priceTo: this.priceRange[1],
                    size: 2,
                    color: 2
                }});
                window.location.reload();
            },
        },
        created() {
            this.priceFilter();
        },
        mounted() {
            const token = localStorage.getItem("token")
            const headers = {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            }
            axios
            .get("/api/customer/profile", {
                headers: headers
            })
            .then(response => {
                this.profile_information = response.data.data;
                this.first_name = this.profile_information.customer_profile.first_name;
                this.image = this.profile_information.customer_profile.image;
            })
            .catch(error => {
                console.error(error);
            });

            // Header Text
            axios
            .get("/api/customer/section/show?key=1", {
                headers: headers
            })
            .then(response => {
                this.section = response.data;
            })
            .catch(error => {
                console.error(error);
            });

            this.isLoggedIn = localStorage.getItem('token') != null
            this.getCategories();
            this.getBrands();

            // Divisions
            axios
            .get("/api/customer/division")
            .then(response => {
                this.divisions = response.data.data;
            })
            .catch(error => {
                console.error(error);
            });
        }
    };
</script>
