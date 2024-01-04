<template>
<div>
    <section class="luxury_new_arrivals section_padding">
        <div class="container-fluid">
            <div class="row">
        <section class="section_padding">
            <div class="container-fluid">
                <div class="row">
                    <div class="mobile-filter">
                        <i class="bx bx-filter-alt"></i>
                    </div>
                    <div class="col-lg-2" id="sidebar">
                        <div class="filters mb-5">
                            <h3>Filter by Category</h3>
                            <div
                                class="radio_filter"
                                v-for="(category,
                                index) in attributes.categories"
                                :key="index"
                            >
                                <a :href="category.category_slug">
                                    <span
                                        v-if="
                                            $route.params.slug ==
                                                category.category_slug
                                        "
                                        class="selected"
                                    >
                                        {{ category.category_name }}
                                    </span>
                                    <span v-else>
                                        {{ category.category_name }}
                                    </span>
                                </a>
                                <div
                                    class="radio_filter_sub"
                                    v-for="(sub,
                                    index) in category.category_sub"
                                    :key="index"
                                >
                                    <template
                                        v-if="
                                            $route.params.slug ==
                                                category.category_slug
                                        "
                                    >
                                        <input
                                            type="radio"
                                            name="categorySubFilter"
                                            :id="
                                                `categorySub` +
                                                    sub.sub_category_id
                                            "
                                            :value="sub.sub_category_id"
                                            v-model="checkedSubCategories"
                                            @change="loadProducts()"
                                        />
                                        <label
                                            :for="
                                                `categorySub` +
                                                    sub.sub_category_id
                                            "
                                            class="form-check-label"
                                        >
                                            {{ sub.sub_category_name }}
                                        </label>
                                    </template>
                                </div>
                            </div>
                        </div>
                        <div class="filters mb-5">
                            <h3>Filter by Color</h3>
                            <div
                                class="radio_filter color"
                                v-for="(color, index) in attributes.colors"
                                :key="index"
                            >
                                <input
                                    type="radio"
                                    name="colorFilter"
                                    :id="`colorFilter` + color.id"
                                    :value="color.id"
                                />
                                <label
                                    :for="`colorFilter` + color.id"
                                    class="form-check-label"
                                >
                                    <span
                                        :style="`background:` + color.code"
                                    ></span>
                                </label>
                            </div>
                        </div>

                        <div class="filters mb-5">
                            <h3>Filter by Size</h3>
                            <div
                                class="radio_filter"
                                v-for="(size, index) in attributes.sizes"
                                :key="index"
                            >
                                <input
                                    type="radio"
                                    name="sizeFilter"
                                    :id="`sizeFilter` + size.id"
                                    :value="size.id"
                                />
                                <label
                                    :for="`sizeFilter` + size.id"
                                    class="form-check-label"
                                >
                                    <span class="sizeFilter">{{
                                        size.name
                                    }}</span>
                                </label>
                            </div>
                        </div>

                        <div class="filters">
                            <h3>Filter by Price</h3>
                            <vue-range-slider
                                :bg-style="bgStyle"
                                :tooltip-style="tooltipStyle"
                                :process-style="processStyle"
                                v-model="priceRange"
                                :min="attributes.price_range.min"
                                :max="attributes.price_range.max"
                            ></vue-range-slider>
                            <div class="row max_min_price">
                                <div class="col-md-6 text-left">
                                    <span
                                        ><span class="currency">IQD</span
                                        >{{ attributes.price_range.min }}</span
                                    >
                                </div>
                                <div class="col-md-6 text-right">
                                    <span
                                        ><span class="currency">IQD</span
                                        >{{ attributes.price_range.max }}</span
                                    >
                                </div>
                            </div>
                            <!--./Price Filter -->
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div class="row align-items-center mb-2">
                            <div class="col-lg-6">
                                <h3>Shop</h3>
                                <h5>Showing 1–9 Of 24 Results</h5>
                            </div>
                            <div class="col-lg-6 text-right">
                                <div class="default-select" id="filter_sort">
                                    <Select2
                                        v-model="sortBy"
                                        :options="sortByLatest"
                                        placeholder="Sort by Latest"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <product-card
                                v-for="(item, index) in searchResult"
                                :key="index"
                                :item="item"
                                :deleteItem="0">
                            </product-card>
                        </div>
                    </div>
                </div>
            </div>
        </section>
            </div>
        </div>
    </section>
</div>
</template>

<script>
    import Select2 from 'v-select2-component';
    import 'vue-range-component/dist/vue-range-slider.css'
    import VueRangeSlider from 'vue-range-component'
    export default {
        components: {
            Select2,
            VueRangeSlider
        },
        data() {
            return {
                category: [],
                attributes: [],
                sortByLatest: ['asc', 'desc'],
                sortBy: '',
                priceRange: [10, 20],
                categoriesSubFilter: [],
                searchResult: [],
                dataSearchResult: {
                    title: this.$route.query.title,
                    // brand: this.$route.query.brand,
                    // category: this.$route.query.category,
                    // sub_category: this.$route.query.sub_category,
                    // priceFrom: this.$route.query.priceFrom,
                    // priceTo: this.$route.query.priceTo,
                    // size: this.$route.query.size,
                    // color: this.$route.query.color,
                }
            };
        },
        mounted() {
            const token = localStorage.getItem("token")
            const headers = {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            }
            // Search Result
            axios.post('/api/customer/search', this.dataSearchResult, {
                    headers: headers
            })
            .then(response => {
                this.searchResult = response.data.data;
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

            // Categories and sub categories api
            axios.get("/api/customer/categories")
            .then(response => {
                this.categoriesSubFilter = response.data.data;
            })
            .catch(error => {
                console.error(error);
            });
        },
        created() {
            this.priceFilter();
        },
        methods: {
            priceFilter() {
                this.bgStyle = {
                backgroundColor: '#ffffff',
                boxShadow: 'inset 0.5px 0.5px 3px 1px rgba(0,0,0,.36)'
                }
                this.tooltipStyle = {
                backgroundColor: '#cea74e',
                borderColor: '#cea74e'
                }
                this.processStyle = {
                backgroundColor: '#cea74e',
                }
            },
        }
    }
</script>