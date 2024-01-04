<template>
    <main class="main shop-market">
        <div class="page-header text-center">
            <div class="container">
                <h1 class="page-title">
                    {{ categoryHeader.category_name }}
                </h1>
            </div>
        </div>
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">Category</a>
                    </li>
                    <li class="breadcrumb-item active">
                        {{ categoryHeader.category_name }}
                    </li>
                </ol>
            </div>
        </nav>
        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div
                        class="col-lg-9 skeleton-body skel-shop-products"
                        :class="{ loaded: loaded }"
                    >
                        <div class="toolbox">
                            <div class="toolbox-left">
                                <div class="toolbox-info">
                                    Showing
                                    <span
                                        >{{ products.length }} of
                                        {{ totalCount }}</span
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
                                            <option value="default"
                                                >Default</option
                                            >
                                            <option value="featured"
                                                >Most Popular</option
                                            >
                                            <option value="rating"
                                                >Most Rated</option
                                            >
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
                                        <product-one
                                            :product="product"
                                        ></product-one>
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
                                    :class="{
                                        'load-more-rotating': loadMoreLoading
                                    }"
                                ></i>
                            </a>
                        </div>
                    </div>
                    <aside class="col-lg-3 order-lg-first" sticky-container>
                        <div v-sticky="!isSidebar" sticky-offset="{ top: 69 }">
                            <button
                                class="sidebar-fixed-toggler"
                                @click="toggleSidebar"
                                v-if="isSidebar"
                            >
                                <i class="icon-cog"></i>
                            </button>

                            <div
                                class="sidebar-filter-overlay"
                                @click="hideSidebar"
                            ></div>
                            <shop-sidebar
                                :is-sidebar="isSidebar"
                                :categories="categories"
                                :sub-categories="subCategories"
                                :brands="brands"
                                :sizes="sizes"
                                :colors="colors"
                                :prices="prices"
                            ></shop-sidebar>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import carousel from "vue-owl-carousel";
import Select2 from "v-select2-component";
import "vue-range-component/dist/vue-range-slider.css";
import VueRangeSlider from "vue-range-component";
import Sticky from "vue-sticky-directive";

export default {
    components: {
        carousel,
        Select2,
        VueRangeSlider
    },
    directives: {
        Sticky
    },
    data() {
        return {
            category: [],
            categoryHeader: "",
            categories: [],
            subCategories: [],
            attributes: [],
            sortByLatest: ["asc", "desc"],
            sortBy: "",
            priceRange: [],
            checkedSubCategories: [],
            products: [],
            defaultProduct: true,
            filterProduct: false,
            brands: [],
            perPage: 24,
            totalCount: 0,
            page: 1,
            orderBy: "default",
            colors: [],
            prices: [],
            sizes: [],
            loaded: false,
            loadMoreLoading: false,
            fakeArray: [1, 2, 3, 4, 5, 6, 7, 8],
            isSidebar: false
        };
    },
    mounted() {
        const token = localStorage.getItem("token");
        const headers = {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`
        };
        // Category products api
        axios
            .get(
                "/api/customer/product/category/slug/" +
                    this.$route.params.slug,
                {
                    headers
                }
            )
            .then(response => {
                this.categoryHeader = response.data.data.category;
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
    },
    computed: {
        hasMore: function() {
            return this.perPage <= this.totalCount;
        }
    },
    watch: {
        $route: function() {
            this.getProducts();
        }
    },
    destroyed: function() {
        window.removeEventListener("resize", this.resizeHandler);
    },
    created() {
        this.priceFilter();
        this.getProducts();
    },
    methods: {
        getProducts: async function(samePage = false, loadMore = false) {
            if (!loadMore) this.loaded = false;
            if (!loadMore) this.perPage = 24;
            await axios
                .get("/api/customer/product/get/all", {
                    params: {
                        ...this.$route.query,
                        //type: this.type,
                        orderBy: this.orderBy,
                        page: this.page,
                        perPage: this.perPage,
                        category: this.$route.params.slug
                    }
                })
                .then(response => {
                    this.brands = response.data.data.filtersData.brands;
                    this.categories = response.data.data.filtersData.categories;
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

        // loadMore: function() {
        //     if (this.perPage < this.totalCount) {
        //         this.perPage += 24;
        //         this.page += 1;
        //         this.loadMoreLoading = true;
        //         setTimeout(() => {
        //             //this.products = [];
        //             this.getProducts(true, true);
        //             this.loadMoreLoading = false;
        //         }, 400);
        //     }
        // },
        toggleSidebar: function() {
            if (
                document
                    .querySelector("body")
                    .classList.contains("sidebar-filter-active")
            ) {
                document
                    .querySelector("body")
                    .classList.remove("sidebar-filter-active");
            } else {
                document
                    .querySelector("body")
                    .classList.add("sidebar-filter-active");
            }
        },

        hideSidebar: function() {
            document
                .querySelector("body")
                .classList.remove("sidebar-filter-active");
        },
        resizeHandler: function() {
            if (window.innerWidth > 991) this.isSidebar = false;
            else this.isSidebar = true;
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
        }
    }
};
</script>
