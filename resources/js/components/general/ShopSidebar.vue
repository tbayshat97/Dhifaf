<template>
    <div class="sidebar-shop" :class="isSidebar ? 'sidebar-filter' : 'sidebar'">
        <div :class="{ 'sidebar-filter-wrapper': isSidebar }">
            <div class="widget widget-clean">
                <label>Filters:</label>
                <a
                    href="#"
                    class="sidebar-filter-clear"
                    @click.prevent="cleanAll"
                    >Clean All</a
                >
            </div>

            <div class="widget widget-collapsible">
                <h3 class="widget-title mb-2">
                    <a
                        href="#widget-1"
                        :class="{ collapsed: !toggleStates[0] }"
                        @click.prevent="toggleSlide(0)"
                        >Category</a
                    >
                </h3>

                <vue-slide-toggle
                    :open="toggleStates[0]"
                    class="show"
                    :duration="200"
                >
                    <div class="widget-body pt-0">
                        <div class="filter-items filter-items-count">
                            <div
                                class="filter-item"
                                v-for="(item, index) in categories"
                                :key="index"
                            >
                                <a
                                    href="#"
                                    :class="{ active: categorySelected(item) }"
                                    >{{ item.category_name }}</a
                                >
                                <!-- <span class="item-count">{{
                                    products.count
                                }}</span> -->
                            </div>
                        </div>
                        <div
                            class="filter-item"
                            v-for="(item, index) in subCategories"
                            :key="index"
                        >
                            <div
                                class="custom-control custom-checkbox"
                                v-if="item"
                            >
                                <input
                                    type="checkbox"
                                    class="custom-control-input"
                                    :id="'subCategories-' + index"
                                />
                                <label
                                    class="custom-control-label"
                                    :for="'subCategories-' + item.id"
                                    >{{ item.sub_category_name }}</label
                                >
                            </div>
                        </div>
                    </div>
                </vue-slide-toggle>
            </div>

            <div class="widget widget-collapsible" v-if="sizes.length > 0">
                <h3 class="widget-title mb-2">
                    <a
                        href="#widget-2"
                        :class="{ collapsed: !toggleStates[1] }"
                        @click.prevent="toggleSlide(1)"
                        >Size</a
                    >
                </h3>

                <vue-slide-toggle
                    :open="toggleStates[1]"
                    class="show"
                    :duration="200"
                >
                    <div class="widget-body pt-0">
                        <div class="filter-items">
                            <div
                                class="filter-item"
                                v-for="(item, index) in sizes"
                                :key="index"
                            >
                                <div class="custom-control custom-checkbox">
                                    <input
                                        type="checkbox"
                                        class="custom-control-input"
                                        :id="'size-' + index"
                                        @click="setSizeFilter(item)"
                                        :checked="sizeChecked(item)"
                                    />
                                    <label
                                        class="custom-control-label"
                                        :for="'size-' + item.id"
                                        >{{ item.name }}</label
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </vue-slide-toggle>
            </div>

            <div class="widget widget-collapsible" v-if="colors.length > 0">
                <h3 class="widget-title mb-2">
                    <a
                        href="#widget-3"
                        :class="{ collapsed: !toggleStates[2] }"
                        @click.prevent="toggleSlide(2)"
                        >Colour</a
                    >
                </h3>

                <vue-slide-toggle
                    :open="toggleStates[2]"
                    class="show"
                    :duration="200"
                >
                    <div class="widget-body pt-0">
                        <div class="filter-colors">
                            <a
                                :href="getColorUrl(item)"
                                :style="{ 'background-color': item.color }"
                                v-for="(item, index) in colors"
                                :key="index"
                                :class="{ selected: colorSelected(item) }"
                            >
                                <span class="sr-only">{{
                                    item.color_name
                                }}</span>
                            </a>
                        </div>
                    </div>
                </vue-slide-toggle>
            </div>

            <div class="widget widget-collapsible">
                <h3 class="widget-title mb-2">
                    <a
                        href="#widget-4"
                        :class="{ collapsed: !toggleStates[3] }"
                        @click.prevent="toggleSlide(3)"
                        >Brand</a
                    >
                </h3>

                <vue-slide-toggle
                    :open="toggleStates[3]"
                    class="show"
                    :duration="200"
                >
                    <div class="widget-body pt-0">
                        <div class="filter-items">
                            <div
                                class="filter-item"
                                v-for="(item, index) in brands"
                                :key="index"
                            >
                                <div class="custom-control custom-checkbox">
                                    <input
                                        type="checkbox"
                                        class="custom-control-input"
                                        :id="'brand-' + index"
                                        @click="setBrandFilter(item)"
                                        :checked="brandChecked(item)"
                                    />
                                    <label
                                        class="custom-control-label"
                                        :for="'brand-' + index"
                                        >{{ item.brand_name }}</label
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </vue-slide-toggle>
            </div>

            <div class="widget widget-collapsible">
                <h3 class="widget-title mb-2">
                    <a
                        href="#widget-5"
                        :class="{ collapsed: !toggleStates[4] }"
                        @click.prevent="toggleSlide(4)"
                        >Price</a
                    >
                </h3>

                <vue-slide-toggle
                    :open="toggleStates[4]"
                    class="show"
                    :duration="200"
                >
                    <div class="widget-body pt-0">
                        <div class="filter-price">
                            <div
                                class="filter-price-text d-flex justify-content-between"
                            >
                                <span>
                                    Price Range:
                                    <span id="filter-price-range">{{
                                        priceRangeText
                                    }}</span>
                                </span>
                                <a :href="priceFilterRoute" class="pr-2"
                                    >Filter</a
                                >
                            </div>

                            <vue-nouislider
                                :config="priceSliderConfig"
                                :values="priceValues"
                                id="price-slider"
                                v-if="loaded"
                            ></vue-nouislider>
                        </div>
                    </div>
                </vue-slide-toggle>
            </div>
        </div>
    </div>
</template>

<script>
import { VueSlideToggle } from "vue-slide-toggle";
import { VueNoUiSlider } from "vue-nouislider";
export default {
    components: {
        VueSlideToggle,
        VueNoUiSlider
    },
    props: {
        isSidebar: Boolean,
        categories: Array,
        brands: Array,
        sizes: Array,
        subBrands: Array,
        colors: Array,
        subCategories: Array,
        prices: Array
    },
    data: function() {
        return {
            loaded: true,
            priceValues: [0, 1000],
            priceSliderConfig: {
                connect: true,
                step: 50,
                margin: 100,
                range: {
                    min: 0,
                    max: 1000
                }
            },
            toggleStates: [true, true, true, true, true],
            filterData: []
        };
    },
    mounted() {
        console.log(this.$route.path);
    },
    computed: {
        priceRangeText: function() {
            return (
                this.$store.state.currency +
                " " +
                parseInt(this.priceValues[0]) +
                " — " +
                this.$store.state.currency +
                " " +
                parseInt(this.priceValues[1])
            );
        },
        priceFilterRoute: function() {
            return this.$router.resolve({
                name: "category-shop",
                params: {
                    slug: this.$route.params.slug
                },
                query: {
                    minPrice: this.priceValues[0],
                    maxPrice: this.priceValues[1]
                }
            }).href;
        }
    },
    created: function() {
        document
            .querySelector("body")
            .classList.remove("sidebar-filter-active");
        if (this.$route.query.minPrice && this.$route.query.maxPrice) {
            this.loaded = false;

            this.priceValues = [
                this.$route.query.minPrice,
                this.$route.query.maxPrice
            ];

            this.$nextTick(function() {
                this.loaded = true;
            });
        } else {
            this.loaded = false;
            this.$nextTick(function() {
                this.loaded = true;
            });
        }
    },
    methods: {
        cleanAll: function() {
            //console.log("category", this.category);
            this.loaded = false;
            this.priceValues = [0, 1000];
            this.$nextTick(function() {
                this.orderBy = "default";
                this.loaded = true;
                this.$router.push(this.$route.path);
            });
        },
        priceChecked: function(min, max) {
            let flag = false;
            if (this.$route.query.minPrice && this.$route.query.minPrice == min)
                flag = true;
            else return false;

            if (max) {
                if (
                    this.$route.query.maxPrice &&
                    this.$route.query.maxPrice == max
                )
                    flag = true;
                else return false;
            }
            return true;
        },
        toggleSlide: function(index) {
            this.toggleStates = this.toggleStates.reduce((acc, cur, id) => {
                if (id == index) return [...acc, !cur];
                else return [...acc, cur];
            }, []);
        },
        sizeChecked: function(item) {
            return (
                this.$route.query.size &&
                this.$route.query.size.split(",").includes(item.id)
            );
        },
        brandChecked: function(item) {
            return (
                this.$route.query.brand &&
                this.$route.query.brand.split(",").includes(item.brand_slug)
            );
        },
        categorySelected: function(item) {
            return (
                this.$route.query.category &&
                this.$route.query.category == item.slug
            );
        },
        colorSelected: function(item) {
            return (
                this.$route.query.color &&
                this.$route.query.color.split(",").includes(item.color_name)
            );
        },
        setSizeFilter: function(item) {
            let query = {};
            if (this.$route.query.page) {
                for (let key in this.$route.query) {
                    if (key !== "page") {
                        query[key] = this.$route.query[key];
                    }
                }
            } else {
                query = { ...this.$route.query };
            }

            if (!this.$route.query.size) {
                query = {
                    ...query,
                    size: item.id
                };
            } else if (this.$route.query.size.split(",").includes(item.id)) {
                query = {
                    ...query,
                    size: query.size
                        .split(",")
                        .filter(slug => slug !== item.id)
                        .join(",")
                };
            } else {
                query = {
                    ...query,
                    size: [...query.size.split(","), item.id].join(",")
                };
            }

            this.$router.push({
                path: this.$route.path,
                query: query
            });
        },
        setBrandFilter: function(item) {
            let query = {};
            if (this.$route.query.page) {
                console.log("dfdf", this.query);
                for (let key in this.$route.query) {
                    if (key !== "page") {
                        query[key] = this.$route.query[key];
                    }
                }
            } else {
                query = { ...this.$route.query };
            }

            if (!this.$route.query.brand) {
                query = {
                    ...query,
                    brand: item.brand_slug
                };
            } else if (
                this.$route.query.brand.split(",").includes(item.brand_slug)
            ) {
                query = {
                    ...query,
                    brand: query.brand
                        .split(",")
                        .filter(slug => slug !== item.brand_slug)
                        .join(",")
                };
            } else {
                query = {
                    ...query,
                    brand: [...query.brand.split(","), item.brand_slug].join(
                        ","
                    )
                };
            }

            this.$router.push({
                path: this.$route.path,
                query: query
            });
        },
        getColorUrl: function(item) {
            let query = {};

            if (!this.$route.query.color) {
                query = {
                    ...this.$route.query,
                    color: item.color_name
                };
            } else if (
                this.$route.query.color.split(",").includes(item.color_name)
            ) {
                query = {
                    ...this.$route.query,
                    color: this.$route.query.color
                        .split(",")
                        .filter(slug => slug !== item.color_name)
                        .join(",")
                };
            } else {
                query = {
                    ...this.$route.query,
                    color: [
                        ...this.$route.query.color.split(","),
                        item.color_name
                    ].join(",")
                };
            }

            let temp = {};
            if (query.page) {
                for (let key in query) {
                    if (key !== "page") {
                        temp[key] = query[key];
                    }
                }
            } else {
                temp = { ...query };
            }

            return {
                path: this.$route.path,
                query: temp
            };
        }
    }
};
</script>
