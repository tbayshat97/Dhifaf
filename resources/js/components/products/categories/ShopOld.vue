<template>
  <div class="page-content">
    <div class="container">
      <div class="row mt-3">
        <div class="col-lg-9 skeleton-body skel-shop-products loaded">
          <div class="toolbox">
            <div class="toolbox-left">
              <div class="toolbox-info">
                Showing
                <span>9 of 35</span> Products
              </div>
            </div>
            <div class="toolbox-right">
              <div class="toolbox-sort">
                <label for="sortby">Sort by:</label>
                <div class="select-custom">
                  <select name="sortby" id="sortby" class="form-control">
                    <option value="default">Default</option>
                    <option value="featured">Most Popular</option>
                    <option value="rating">Most Rated</option>
                    <option value="new">Date</option>
                  </select>
                </div>
              </div>

            </div>
          </div>
          <div class="products mb-3">
            <div class="row">
              <product-card
                v-for="(item, index) in products.data"
                :key="index"
                :item="item"
                :deleteItem="0"
              ></product-card>
            </div>
          </div>
          <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
              <li class="page-item disabled">
                <a
                  href="/"
                  aria-current="page"
                  class="page-link page-link-prev active link-active"
                  ><span aria-hidden="true"
                    ><i class="icon-long-arrow-left"></i></span
                  >Prev
                </a>
              </li>
              <li class="page-item">
                <a
                  href="/"
                  aria-current="page"
                  class="page-link active link-active"
                  >1</a
                >
              </li>
              <li class="page-item">
                <a href="/" class="page-link">2</a>
              </li>
              <li class="page-item">
                <a href="/" class="page-link">3</a>
              </li>
              <li class="page-item-total pl-3">of 4</li>
              <li class="page-item">
                <a href="/" class="page-link page-link-next">
                  Next
                  <span aria-hidden="true"
                    ><i class="icon-long-arrow-right"></i></span
                ></a>
              </li>
            </ul>
          </nav>
        </div>
        <aside sticky-container="" class="col-lg-3 order-lg-first">
          <div class="vue-sticky-placeholder" style="padding-top: 0px"></div>
          <div
            sticky-offset="{ top: 69 }"
            class="vue-sticky-el"
            style="
              position: static;
              top: auto;
              bottom: auto;
              left: auto;
              width: auto;
              z-index: 10;
            "
          >
            <div class="sidebar-filter-overlay"></div>
            <div class="sidebar-shop sidebar">
              <div class="">
                <div class="widget widget-clean">
                  <label>Filters:</label>
                  <a href="#" class="sidebar-filter-clear">Clean All</a>
                </div>
                <div class="widget widget-collapsible">
                  <h3 class="widget-title mb-2">
                    <a href="#" class="collapsed">Category</a>
                  </h3>
                  <div id="widget-1" class="" style="">
                    <div class="widget-body pt-0">
                      <div class="filter-items filter-items-count">
                        <div
                          class="filter-item"
                          v-for="(category, index) in attributes.categories"
                          :key="index"
                        >
                          <a :href="category.category_slug">
                            {{ category.category_name }}</a
                          >
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="widget widget-collapsible">
                  <h3 class="widget-title mb-2">
                    <a href="#widget-2" class="">Size</a>
                  </h3>
                  <div class="show" style="">
                    <div class="widget-body pt-0">
                      <div class="filter-items">
                        <div class="filter-item">
                          <div class="custom-control custom-checkbox">
                            <input
                              type="checkbox"
                              id="size-0"
                              class="custom-control-input"
                            />
                            <label for="size-0" class="custom-control-label"
                              >XS</label
                            >
                          </div>
                        </div>
                        <div class="filter-item">
                          <div class="custom-control custom-checkbox">
                            <input
                              type="checkbox"
                              id="size-1"
                              class="custom-control-input"
                            />
                            <label for="size-1" class="custom-control-label"
                              >S</label
                            >
                          </div>
                        </div>
                        <div class="filter-item">
                          <div class="custom-control custom-checkbox">
                            <input
                              type="checkbox"
                              id="size-2"
                              class="custom-control-input"
                            />
                            <label for="size-2" class="custom-control-label"
                              >M</label
                            >
                          </div>
                        </div>
                        <div class="filter-item">
                          <div class="custom-control custom-checkbox">
                            <input
                              type="checkbox"
                              id="size-3"
                              class="custom-control-input"
                            />
                            <label for="size-3" class="custom-control-label"
                              >L</label
                            >
                          </div>
                        </div>
                        <div class="filter-item">
                          <div class="custom-control custom-checkbox">
                            <input
                              type="checkbox"
                              id="size-4"
                              class="custom-control-input"
                            />
                            <label for="size-4" class="custom-control-label"
                              >XL</label
                            >
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="widget widget-collapsible">
                  <h3 class="widget-title mb-2">
                    <a href="#widget-3" class="">Colour</a>
                  </h3>
                  <div class="show" style="">
                    <div class="widget-body pt-0">
                      <div class="filter-colors">
                        <a
                          href="/"
                          class=""
                          style="background-color: rgb(204, 153, 102)"
                          ><span class="sr-only">Brown</span></a
                        ><a
                          href="/"
                          class=""
                          style="background-color: rgb(51, 153, 204)"
                          ><span class="sr-only">Blue</span></a
                        ><a
                          href="/"
                          class=""
                          style="background-color: rgb(153, 102, 204)"
                          ><span class="sr-only">Purple</span></a
                        ><a
                          href="/"
                          class=""
                          style="background-color: rgb(51, 51, 51)"
                          ><span class="sr-only">Black</span></a
                        ><a
                          href="/"
                          class=""
                          style="background-color: rgb(102, 153, 51)"
                          ><span class="sr-only">Green</span></a
                        ><a
                          href="/"
                          class=""
                          style="background-color: rgb(204, 51, 51)"
                          ><span class="sr-only">Red</span></a
                        ><a
                          href="/"
                          class=""
                          style="background-color: rgb(153, 153, 153)"
                          ><span class="sr-only">Grey</span></a
                        >
                      </div>
                    </div>
                  </div>
                </div>
                <div class="widget widget-collapsible">
                  <h3 class="widget-title mb-2">
                    <a href="#widget-4" class="">Brand</a>
                  </h3>
                  <div class="show" style="">
                    <div class="widget-body pt-0">
                      <div class="filter-items">
                        <div class="filter-item">
                          <div class="custom-control custom-checkbox">
                            <input
                              type="checkbox"
                              id="brand-0"
                              class="custom-control-input"
                            />
                            <label for="brand-0" class="custom-control-label"
                              >Next</label
                            >
                          </div>
                        </div>
                        <div class="filter-item">
                          <div class="custom-control custom-checkbox">
                            <input
                              type="checkbox"
                              id="brand-1"
                              class="custom-control-input"
                            />
                            <label for="brand-1" class="custom-control-label"
                              >River Island</label
                            >
                          </div>
                        </div>
                        <div class="filter-item">
                          <div class="custom-control custom-checkbox">
                            <input
                              type="checkbox"
                              id="brand-2"
                              class="custom-control-input"
                            />
                            <label for="brand-2" class="custom-control-label"
                              >Geox</label
                            >
                          </div>
                        </div>
                        <div class="filter-item">
                          <div class="custom-control custom-checkbox">
                            <input
                              type="checkbox"
                              id="brand-3"
                              class="custom-control-input"
                            />
                            <label for="brand-3" class="custom-control-label"
                              >New Balance</label
                            >
                          </div>
                        </div>
                        <div class="filter-item">
                          <div class="custom-control custom-checkbox">
                            <input
                              type="checkbox"
                              id="brand-4"
                              class="custom-control-input"
                            />
                            <label for="brand-4" class="custom-control-label"
                              >UGG</label
                            >
                          </div>
                        </div>
                        <div class="filter-item">
                          <div class="custom-control custom-checkbox">
                            <input
                              type="checkbox"
                              id="brand-5"
                              class="custom-control-input"
                            />
                            <label for="brand-5" class="custom-control-label"
                              >F&amp;F</label
                            >
                          </div>
                        </div>
                        <div class="filter-item">
                          <div class="custom-control custom-checkbox">
                            <input
                              type="checkbox"
                              id="brand-6"
                              class="custom-control-input"
                            />
                            <label for="brand-6" class="custom-control-label"
                              >Nike</label
                            >
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="widget widget-collapsible">
                  <h3 class="widget-title mb-2">
                    <a href="#widget-5" class="">Price</a>
                  </h3>
                  <div class="show" style="">
                    <div class="widget-body pt-0">
                      <div class="filter-price">
                        <div
                          class="
                            filter-price-text
                            d-flex
                            justify-content-between
                          "
                        >
                          <span>
                            Price Range:
                            <span id="filter-price-range">{{
                              priceRangeText
                            }}</span>
                          </span>
                          <nuxt-link :to="priceFilterRoute" class="pr-2"
                            >Filter</nuxt-link
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
                  </div>
                </div>
              </div>
            </div>
          </div>
        </aside>
      </div>
    </div>
  </div>
</template>

<script>
import carousel from "vue-owl-carousel";
import Select2 from "v-select2-component";
import "vue-range-component/dist/vue-range-slider.css";
import VueRangeSlider from "vue-range-component";
export default {
  components: {
    carousel,
    Select2,
    VueRangeSlider,
  },
  data() {
    return {
      category: [],
      attributes: [],
      sortByLatest: ["asc", "desc"],
      sortBy: "",
      priceRange: [],
      checkedSubCategories: [],
      products: [],
      defaultProduct: true,
      filterProduct: false,
      brands: [],
    };
  },
  mounted() {
    const token = localStorage.getItem("token");
    const headers = {
      "Content-Type": "application/json",
      Authorization: `Bearer ${token}`,
    };
    // Category products api
    axios
      .get("/api/customer/product/category/slug/" + this.$route.params.slug, {
        headers,
      })
      .then((response) => {
        this.category = response.data.data;
        this.brands = response.data.data.products;
      })
      .catch((error) => {
        console.error(error);
      });

    // Attributes api
    axios
      .get("/api/customer/search/attributes")
      .then((response) => {
        this.attributes = response.data.data;
        this.priceRange = [
          this.attributes.price_range.min,
          this.attributes.price_range.max,
        ];
      })
      .catch((error) => {
        console.error(error);
      });
  },
  created() {
    this.priceFilter();
    this.getResults();
  },
  methods: {
    getResults(page) {
      if (typeof page === "undefined") {
        page = 1;
      }
      axios
        .get(
          "/api/customer/product/category/slug/" +
            this.$route.params.slug +
            "?page=" +
            page
        )
        .then((response) => {
          this.products = response.data.data.products;
          this.total = response.data.data.products.pagination.total;
          this.count = response.data.data.products.pagination.count;
          this.per_page = response.data.data.products.pagination.per_page;
        })
        .catch((error) => {
          console.error(error);
        });
    },
    priceFilter() {
      this.bgStyle = {
        backgroundColor: "#ffffff",
        boxShadow: "inset 0.5px 0.5px 3px 1px rgba(0,0,0,.36)",
      };
      this.tooltipStyle = {
        backgroundColor: "#cea74e",
        borderColor: "#cea74e",
      };
      this.processStyle = {
        backgroundColor: "#cea74e",
      };
    },
  },
};
</script>
