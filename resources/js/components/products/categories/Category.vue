<template>
    <main class="main">
        <div
            class="page-header page-header-big text-center"
            :style="
                `margin-bottom: 0;background-image:url('` +
                    divisionHeader.division_header +
                    `')`
            "
        >
            <h1 class="page-title text-white">
                {{ divisionHeader.division_name }}
            </h1>
        </div>
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/">{{ translate("layout.home") }}</a>
                    </li>
                    <li class="breadcrumb-item active">
                        {{ divisionHeader.division_name }}
                    </li>
                </ol>
            </div>
        </nav>
        <div class="page-content">
            <div class="container">
                <div v-if="divisions">
                    <swiper
                        class="swiper"
                        :options="swiperOptions"
                        ref="mySwiper"
                    >
                        <swiper-slide
                            v-for="(division, index) in divisions"
                            :key="index"
                        >
                            <div class="">
                                <div class="banner banner-cat banner-badge">
                                    <a
                                        :href="
                                            $router.resolve({
                                                name: 'category-shop',
                                                params: {
                                                    slug: division.category_slug
                                                }
                                            }).href
                                        "
                                        class=""
                                        ><img
                                            alt="Banner"
                                            :src="division.category_image"
                                            class="fade-in"
                                    /></a>
                                    <a
                                        :href="
                                            $router.resolve({
                                                name: 'category-shop',
                                                params: {
                                                    slug: division.category_slug
                                                }
                                            }).href
                                        "
                                        class="banner-link"
                                        ><h3 class="banner-title">
                                            {{ division.category_name }}
                                        </h3>
                                        <span class="banner-link-text"
                                            >Shop Now</span
                                        ></a
                                    >
                                </div>
                            </div>
                        </swiper-slide>
                    </swiper>
                </div>
            </div>
        </div>

        <div class="page-content">
            <div class="container">
                <div class="toolbox">
                    <div class="toolbox-left">
                        <div class="toolbox-info">
                            Showing
                            <span
                                >{{ products.length }} of {{ totalCount }}</span
                            >
                            Products
                        </div>
                    </div>
                    <div class="toolbox-right">
                        <div class="toolbox-sort">
                            <label for="sortby">Sort by:</label>
                            <div class="select-custom">
                                <select
                                    name="sortby"
                                    id="sortby"
                                    class="form-control"
                                    @change.prevent="getProducts"
                                    v-model="orderBy"
                                >
                                    <option value="default">Default</option>
                                    <option value="featured"
                                        >Most Popular</option
                                    >
                                    <option value="rating">Most Rated</option>
                                    <option value="new">Date</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="products mb-3 content-overlay">
                    <p
                        class="no-results"
                        v-if="products.length === 0 && loaded"
                    >
                        No products matching your selection.
                    </p>
                    <div class="row">
                        <template v-if="!loaded">
                            <div
                                class="col-6 col-md-4 col-lg-4 col-xl-3"
                                v-for="item in fakeArray"
                                :key="item"
                            >
                                <div class="skel-pro"></div>
                            </div>
                        </template>
                        <template>
                            <div
                                class="col-6 col-md-4 col-lg-4 col-xl-3"
                                v-for="(product, index) in products"
                                :key="index"
                            >
                                <product-one :product="product"></product-one>
                            </div>
                        </template>
                    </div>
                </div>

                <div class="load-more-container text-center">
                    <a
                        href="#"
                        class="btn btn-outline-darker btn-load-more"
                        @click.prevent="loadMore"
                        v-if="loadMoreLoading || hasMore"
                    >
                        More Products
                        <i
                            class="icon-refresh"
                            :class="{ 'load-more-rotating': loadMoreLoading }"
                        ></i>
                    </a>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
// Import Swiper Vue.js components
import { Swiper, SwiperSlide, directive } from "vue-awesome-swiper";

// Import Swiper styles
import "swiper/swiper-bundle.css";
import Select2 from "v-select2-component";
import "vue-range-component/dist/vue-range-slider.css";
import VueRangeSlider from "vue-range-component";
export default {
    data() {
        return {
            divisions: [],
            category: [],
            attributes: [],
            sortByLatest: ["asc", "desc"],
            sortBy: "",
            priceRange: [],
            checkedSubCategories: [],
            products: [],
            defaultProduct: true,
            filterProduct: false,

            perPage: 24,
            totalCount: 0,
            page: 1,
            orderBy: "default",
            isSidebar: true,
            loaded: false,
            loadMoreLoading: false,
            fakeArray: [1, 2, 3, 4, 5, 6, 7, 8],

            swiperOptions: {
                pagination: {
                    el: ".swiper-pagination"
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                    clickable: true
                },
                spaceBetween: 50,
                loop: true,
                breakpoints: {
                    1440: {
                        slidesPerView: 8,
                        spaceBetween: 10
                    },
                    1200: {
                        slidesPerView: 6,
                        spaceBetween: 15
                    },
                    767: {
                        slidesPerView: 2,
                        spaceBetween: 20
                    },
                    586: {
                        slidesPerView: 1,
                        spaceBetween: 20
                    }
                }
            },
            divisionHeader: ""
        };
    },
    components: {
        Swiper,
        SwiperSlide,
        Select2,
        VueRangeSlider
    },
    computed: {
        hasMore: function() {
            return this.perPage <= this.totalCount;
        }
    },
    created: function() {
        this.getProducts();
    },
    methods: {
        onSwiper(swiper) {
            console.log(swiper);
        },
        onSlideChange() {
            console.log("slide change");
        },
        pervSlide() {
            this.$refs.mySwiper.$swiper.slidePrev();
        },
        nextSlide() {
            this.$refs.mySwiper.$swiper.slideNext();
        },
        priceFilter() {
            this.bgStyle = {
                backgroundColor: "#ffffff",
                boxShadow: "inset 0.5px 0.5px 3px 1px rgba(0,0,0,.36)"
            };
            this.tooltipStyle = {
                backgroundColor: "#cea74e",
                borderColor: "#cea74e"
            };
            this.processStyle = {
                backgroundColor: "#cea74e"
            };
        },
        getProducts: async function(samePage = false, loadMore = false) {
            if (!loadMore) this.loaded = false;
            if (!loadMore) this.perPage = 24;
            await axios
                .get("/api/customer/product/get/all", {
                    params: {
                        //type: this.type,
                        orderBy: this.orderBy,
                        page: this.page,
                        perPage: this.perPage,
                        division: this.$route.params.slug
                    }
                })
                .then(response => {
                    this.products = response.data.data.products.data;
                    this.totalCount =
                        response.data.data.products.pagination.total;
                    this.loaded = true;
                    if (samePage) {
                        scrollToPageContent();
                    }
                })
                .catch(error => ({ error: JSON.stringify(error) }));
        },

        loadMore: function() {
            if (this.perPage < this.totalCount) {
                this.perPage += 24;
                this.page += 0;
                this.loadMoreLoading = true;
                setTimeout(() => {
                    this.getProducts(false, true);
                    this.loadMoreLoading = false;
                }, 400);
            }
        },
        scrollToPageContent: function() {
            let to = document.querySelector(".page-content").offsetTop - 74;
            if (isSafariBrowser() || isEdgeBrowser()) {
                let pos = window.pageYOffset;
                let timerId = setInterval(() => {
                    if (pos <= to) clearInterval(timerId);
                    window.scrollBy(0, -120);
                    pos -= 120;
                }, 1);
            } else {
                window.scrollTo({
                    top: to,
                    behavior: "smooth"
                });
            }
        }
    },
    mounted() {
        const token = localStorage.getItem("token");
        const headers = {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`
        };
        axios
            .get("/api/customer/division/slug/" + this.$route.params.slug, {
                headers
            })
            .then(response => {
                this.divisions = response.data.data.categories;
                this.divisionHeader = response.data.data.division;
                //this.products = response.data.data.products;
                this.category = response.data.data;
            })
            .catch(error => {
                console.error(error);
            });

        // Attributes api
        axios
            .get("/api/customer/search/attributes")
            .then(response => {
                this.attributes = response.data.data;
                this.priceRange = [
                    this.attributes.price_range.min,
                    this.attributes.price_range.max
                ];
            })
            .catch(error => {
                console.error(error);
            });
    }
};
</script>
