<template>
    <div class="dropdown-menu">
        <nav class="side-nav">
            <ul class="menu-vertical sf-arrows">
                <li
                    class="item-lead megamenu-container"
                    v-for="(division, index) in divisions"
                    :key="index"
                >
                    <a
                        :href="
                            $router.resolve({
                                name: 'single-division',
                                params: {
                                    slug: division.division_slug
                                }
                            }).href
                        "
                        class="sf-with-ul"
                        >{{ division.division_name }}</a
                    >
                    <div class="megamenu">
                        <div class="row no-gutters">
                            <div class="col-md-8">
                                <div class="menu-col">
                                    <div class="row">
                                        <div
                                            class="col-md-6"
                                            v-for="(category,
                                            index) in division.division_categories"
                                            :key="index"
                                        >
                                            <div class="menu-title">
                                                <a
                                                    class="main-title text-uppercase"
                                                    :href="
                                                        $router.resolve({
                                                            name:
                                                                'category-shop',
                                                            params: {
                                                                slug:
                                                                    category.category_slug
                                                            }
                                                        }).href
                                                    "
                                                    >{{
                                                        category.category_name
                                                    }}</a
                                                >
                                            </div>
                                            <ul>
                                                <li
                                                    v-for="(subCategory,
                                                    index) in category.category_sub"
                                                    :key="index"
                                                >
                                                    <a
                                                        :href="
                                                            $router.resolve({
                                                                name:
                                                                    'category-shop',
                                                                params: {
                                                                    slug:
                                                                        category.category_slug
                                                                },
                                                                query: {
                                                                    subCategory:
                                                                        subCategory.sub_category_id
                                                                }
                                                            }).href
                                                        "
                                                        >{{
                                                            subCategory.sub_category_name
                                                        }}</a
                                                    >
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                v-if="division.division_banner"
                                class="col-md-4"
                            >
                                <div class="banner banner-overlay">
                                    <a
                                        :href="division.division_banner.cta"
                                        class="banner banner-menu"
                                        ><img
                                            alt="Banner"
                                            width="100%"
                                            height="auto"
                                            :src="
                                                division.division_banner.image
                                            "
                                            lazy="loaded"
                                            class="fade-in"
                                        />
                                        <div
                                            class="banner-content banner-content-center"
                                            style="background:transparent;"
                                        >
                                            <div
                                                class="banner-title text-white"
                                            >
                                                <span
                                                    ><strong>{{
                                                        division.division_banner
                                                            .name
                                                    }}</strong></span
                                                >
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</template>
<script>
import "vue-range-component/dist/vue-range-slider.css";
import VueRangeSlider from "vue-range-component";

export default {
    props: ["language", "route_name"],
    data() {
        return {
            show_search: false,
            first_name: "",
            image: "",
            isLoggedIn: null,
            profile_information: [],
            section: "",
            title: "",
            brand: "",
            category: "",
            sub_category: "",
            categories: [],
            brands: [],
            luxuryBrands: [],
            priceRange: [10, 220],
            subCategories: [],
            minPrice: "",
            maxPrice: "",
            searchResult: [],
            divisions: []
        };
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
                backgroundColor: "#fff",
                boxShadow: "inset 0.5px 0.5px 3px 1px rgba(0,0,0,.36)"
            };
            this.tooltipStyle = {
                backgroundColor: "#666",
                borderColor: "#666"
            };
            this.processStyle = {
                backgroundColor: "#999"
            };
        },
        logout() {
            localStorage.removeItem("token");
            localStorage.removeItem("user");
            window.location.href = "/";
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
            const token = localStorage.getItem("token");
            let data = {
                title: this.title,
                brand: this.brand,
                category: this.category,
                sub_category: this.sub_category,
                priceFrom: this.priceRange[0],
                priceTo: this.priceRange[1]
            };
            const headers = {
                "Content-Type": "application/json",
                Authorization: `Bearer ${token}`
            };
            axios
                .post("/api/customer/search", data, {
                    headers: headers
                })
                .then(response => {
                    this.searchResult = response.data.data;
                })
                .catch(error => {
                    console.log("Failed", error);
                });
        }
    },
    created() {
        this.priceFilter();
    },
    mounted() {
        const token = localStorage.getItem("token");
        const headers = {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`
        };
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

        this.isLoggedIn = localStorage.getItem("token") != null;
        this.getCategories();
        this.getBrands();

        // Divisions
        const lang = {
            "Accept-Language": this.language
        };
        axios
            .get("/api/customer/division", {
                headers: lang
            })
            .then(response => {
                this.divisions = response.data.data;
            })
            .catch(error => {
                console.error(error);
            });
    }
};
</script>
