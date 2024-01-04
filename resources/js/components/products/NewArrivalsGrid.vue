<template>
    <main class="main">
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
export default {
    props: ["page_type"],
    data() {
        return {
            products: [],
            perPage: 24,
            type: this.page_type,
            totalCount: 0,
            page: 1,
            orderBy: "default",
            isSidebar: true,
            loaded: false,
            loadMoreLoading: false,
            fakeArray: [1, 2, 3, 4, 5, 6, 7, 8]
        };
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
        getProducts: async function(samePage = false, loadMore = false) {
            if (!loadMore) this.loaded = false;
            await axios
                .get("/api/customer/product/get/all", {
                    params: {
                        type: this.type,
                        orderBy: this.orderBy,
                        page: this.page
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
                this.page += 1;
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
    }
};
</script>
