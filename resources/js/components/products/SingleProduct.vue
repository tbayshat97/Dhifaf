<template>
    <div class="page-content">
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="/">Shop</a>
                    </li>
                    <li class="breadcrumb-item active">
                        {{ product.product_name }}
                    </li>
                </ol>
            </div>
        </nav>
        <div class="container skeleton-body">
            <div class="product-details-top">
                <div class="row skel-pro-single loaded">
                    <div class="col-md-6">
                        <div class="skel-product-gallery"></div>
                        <div class="product-gallery product-gallery-carousel">
                            <div class="row m-0">
                                <!-- <lingallery
                  :addons="{ enableLargeView: true }"
                  :items="galleries"
                  width="500"
                  height="500"
                /> -->
                                <figure class="product-main-image">
                                    <span
                                        class="product-label label-new"
                                        v-if="product.product_is_new"
                                        >New</span
                                    >
                                    <span
                                        class="product-label label-sale"
                                        v-if="product.product_sale_price"
                                        >{{
                                            product.product_sale_price_percentage
                                        }}</span
                                    >
                                    <span
                                        class="product-label label-top"
                                        v-if="product.product_is_featured"
                                        >Top</span
                                    >
                                    <span
                                        class="product-label label-out"
                                        v-if="
                                            product.product_stock_status
                                                .value !== 1
                                        "
                                        >Out Of Stock</span
                                    >

                                    <a
                                        :href="
                                            '/single-product/' +
                                                product.product_slug
                                        "
                                    >
                                        <v-lazy-image
                                            :src="product.product_image"
                                            class="product-image"
                                            :alt="product.product_name"
                                            width="800"
                                            height="800"
                                        />
                                    </a>
                                </figure>
                                <div
                                    id="product-zoom-gallery"
                                    class="product-image-gallery"
                                >
                                    <a
                                        class="product-gallery-item h-100 h-lg-auto carousel-dot"
                                        :class="{
                                            active: currentIndex == index
                                        }"
                                        href="#"
                                        v-for="(smPicture,
                                        index) in product.product_gallery"
                                        :key="index"
                                        @click.prevent="changePicture(index)"
                                    >
                                        <img
                                            :src="product.product_image"
                                            alt="product side"
                                        />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="product-details">
                            <h5
                                class="single-product-brand"
                                v-if="product.product_brand"
                            >
                                <a
                                    :href="
                                        $router.resolve({
                                            name: 'brand-shop',
                                            params: {
                                                slug:
                                                    product.product_brand
                                                        .brand_slug
                                            }
                                        }).href
                                    "
                                >
                                    {{ product.product_brand.brand_name }}
                                    <span v-if="product.product_sub_brand">{{
                                        product.product_sub_brand.brand_name
                                    }}</span>
                                </a>
                            </h5>
                            <h1 class="product-title">
                                {{ product.product_name }}
                                <span
                                    v-if="
                                        product.product_sub_category.length > 0
                                    "
                                    >{{
                                        product.product_sub_category[0]
                                            .sub_category_name
                                    }}</span
                                >
                                <span v-else>{{
                                    product.product_category[0].category_name
                                }}</span>

                                <span v-if="product.product_size">{{
                                    product.product_size.name
                                }}</span>
                            </h1>

                            <div class="ratings-container">
                                <div class="ratings">
                                    <div
                                        class="ratings-val"
                                        :style="{
                                            width:
                                                product.product_reviews.length *
                                                    20 +
                                                '%'
                                        }"
                                    ></div>
                                    <span class="tooltip-text">{{
                                        product.product_reviews.length
                                    }}</span>
                                </div>
                                <span class="ratings-text mt-0"
                                    >({{ product.product_reviews.length }}
                                    {{ translate("layout.reviews") }})</span
                                >
                            </div>
                            <div
                                class="product-price"
                                v-if="product.product_sale_price == null"
                            >
                                <span class="out-price">{{
                                    formatPrice(product.product_price)
                                }}</span>
                            </div>
                            <div class="product-price" v-else>
                                <span class="new-price"
                                    >${{
                                        product.product_sale_price.toFixed(2)
                                    }}</span
                                >
                                <span class="old-price"
                                    >${{
                                        product.product_price.toFixed(2)
                                    }}</span
                                >
                            </div>
                            <div
                                v-if="product.product_group"
                                class="product-details-footer product-group-data"
                            >
                                <div
                                    class="product-nav product-nav-dots"
                                    v-for="(group,
                                    index) in product.product_group"
                                    :key="index"
                                >
                                    <a
                                        :alt="group.product_slug"
                                        href="javascript:;"
                                        @click="
                                            getSWProduct(group.product_slug)
                                        "
                                        :class="
                                            group.product_slug ===
                                            product.product_slug
                                                ? 'active'
                                                : ''
                                        "
                                    >
                                        <img
                                            :src="group.product_switcher"
                                            :alt="group.product_slug"
                                        />
                                    </a>
                                </div>
                            </div>
                            <div
                                v-if="product.product_color"
                                class="details-filter-row details-row-size"
                            >
                                <label>Color:</label
                                ><span
                                    :style="
                                        `background:` +
                                            product.product_color.code
                                    "
                                ></span>
                            </div>
                            <div
                                v-if="product.product_size"
                                class="details-filter-row details-row-size"
                            >
                                <label>Size:</label>
                                <span>{{ product.product_size.name }}</span>
                            </div>

                            <!---->
                            <div class="details-filter-row details-row-size">
                                <label for="qty">Qty:</label>
                                <quantityInput-component
                                    :product="product"
                                    class="cart-product-quantity"
                                    @change-qty="changeQty"
                                ></quantityInput-component>
                            </div>
                            <div class="product-details-action">
                                <button
                                    class="btn-product btn-cart"
                                    @click="addToCart(product, productQty)"
                                >
                                    <span>{{
                                        translate("layout.add_to_cart")
                                    }}</span>
                                </button>

                                <button
                                    class="btn-product btn-cart ml-5"
                                    @click="buyNow(product)"
                                >
                                    <span>{{
                                        translate("layout.buy_now")
                                    }}</span>
                                </button>

                                <div class="details-action-wrapper">
                                    <a
                                        href="#"
                                        title="Wishlist"
                                        class="btn-product btn-wishlist"
                                        ><span>Add to Wishlist</span></a
                                    >
                                </div>
                            </div>
                            <div class="product-details-footer">
                                <div class="social-icons social-icons-sm">
                                    <span class="social-label">Share:</span>
                                    <a
                                        href="javascript:;"
                                        title="Facebook"
                                        target="_blank"
                                        class="social-icon"
                                        ><i class="icon-facebook-f"></i
                                    ></a>
                                    <a
                                        href="javascript:;"
                                        title="Twitter"
                                        target="_blank"
                                        class="social-icon"
                                        ><i class="icon-twitter"></i
                                    ></a>
                                    <a
                                        href="javascript:;"
                                        title="Instagram"
                                        target="_blank"
                                        class="social-icon"
                                        ><i class="icon-instagram"></i
                                    ></a>
                                    <a
                                        href="javascript:;"
                                        title="Pinterest"
                                        target="_blank"
                                        class="social-icon"
                                        ><i class="icon-pinterest"></i
                                    ></a>
                                </div>
                            </div>
                            <div
                                class="
                  product-details-footer product-code
                  w-100
                  text-truncate
                  mb-1
                "
                            >
                                <span
                                    >{{ translate("layout.item_code") }}:
                                    {{ product.product_code }}</span
                                >
                                <span
                                    >{{ translate("layout.item_barcode") }}:
                                    {{ product.product_barcode }}</span
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-details-tab">
                <nav>
                    <div
                        class="nav nav-pills justify-content-center"
                        id="nav-tab"
                        role="tablist"
                    >
                        <button
                            class="nav-link active"
                            id="nav-description-tab"
                            data-toggle="tab"
                            data-target="#nav-description"
                            type="button"
                            role="tab"
                            aria-controls="nav-description"
                            aria-selected="true"
                        >
                            {{ translate("layout.description") }}
                        </button>
                        <button
                            class="nav-link"
                            id="nav-reviews-tab"
                            data-toggle="tab"
                            data-target="#nav-reviews"
                            type="button"
                            role="tab"
                            aria-controls="nav-reviews"
                            aria-selected="false"
                            @click="isReview(product.product_id)"
                            v-if="product.product_reviews"
                        >
                            {{ translate("layout.reviews") }} ({{
                                product.product_reviews.length
                            }})
                        </button>
                        <button
                            class="nav-link"
                            id="nav-ingredients-tab"
                            data-toggle="tab"
                            data-target="#nav-ingredients"
                            type="button"
                            role="tab"
                            aria-controls="nav-ingredients"
                            aria-selected="false"
                        >
                            {{ translate("layout.ingredients") }}
                        </button>
                        <button
                            class="nav-link"
                            id="nav-how-to-use-tab"
                            data-toggle="tab"
                            data-target="#nav-how-to-use"
                            type="button"
                            role="tab"
                            aria-controls="nav-how-to-use"
                            aria-selected="false"
                        >
                            {{ translate("layout.how_to_use") }}
                        </button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div
                        class="tab-pane fade show active"
                        id="nav-description"
                        role="tabpanel"
                        aria-labelledby="nav-description-tab"
                    >
                        <p class="mb-1">
                            {{ product.product_description }}
                        </p>
                    </div>
                    <div
                        class="tab-pane fade"
                        id="nav-reviews"
                        role="tabpanel"
                        aria-labelledby="nav-reviews-tab"
                    >
                        <div
                            class="col-lg-6 reviews"
                            v-for="(review, index) in product.product_reviews"
                            :key="index"
                        >
                            <div>
                                <img :src="review.customer.image" alt="" />
                            </div>
                            <div class="product-reviews w-100">
                                <div class="col-md-12">
                                    <div class="col-md-10 name">
                                        <h5>
                                            {{ review.customer.first_name }}
                                            {{ review.customer.last_name }}
                                        </h5>
                                        <span
                                            >{{ review.review_rate }}
                                            <span
                                                class="bx bxs-star checked"
                                            ></span
                                        ></span>
                                    </div>
                                    <p>{{ review.review_created_at }}</p>
                                    <p>{{ review.review_note }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="add-review" v-if="!is_review">
                            <h3>{{ translate("layout.add_your_review") }}</h3>
                            <form
                                @submit.prevent="addReview(product.product_id)"
                            >
                                <rate :length="5" v-model="rate" />
                                <textarea
                                    v-model="note"
                                    :placeholder="
                                        translate('layout.add_your_review')
                                    "
                                ></textarea>
                                <button type="submit">
                                    {{ translate("layout.submit") }}
                                </button>
                            </form>
                        </div>
                    </div>
                    <div
                        class="tab-pane fade"
                        id="nav-ingredients"
                        role="tabpanel"
                        aria-labelledby="nav-ingredients-tab"
                    >
                        <p class="mb-1">
                            {{ product.product_ingredients }}
                        </p>
                    </div>
                    <div
                        class="tab-pane fade"
                        id="nav-how-to-use"
                        role="tabpanel"
                        aria-labelledby="nav-how-to-use-tab"
                    >
                        <p class="mb-1">
                            {{ product.product_how_to_use }}
                        </p>
                    </div>
                </div>
            </div>

            <FlashMessage :position="'right bottom'" :time="0"></FlashMessage>
        </div>
    </div>
</template>

<script>
import rate from "vue-rate";
import "vue-rate/dist/vue-rate.css";
import VueSocialSharing from "vue-social-sharing";
Vue.use(rate);
Vue.use(VueSocialSharing);

export default {
    props: ["language"],
    data() {
        return {
            galleries: [],
            gallery: {
                src: null,
                thumbnail: null,
                id: null
            },
            product: "",
            note: "",
            rate: "",
            is_review: false,
            isLoggedIn: localStorage.getItem("token") != null,
            productQty: 1,
            sharing: {
                url: "",
                title: "",
                description: "",
                media: ""
            },
            networks: [
                {
                    network: "facebook",
                    name: "Facebook",
                    icon: "bx bxl-facebook",
                    color: "transparent"
                },
                {
                    network: "twitter",
                    name: "Twitter",
                    icon: "bx bxl-twitter",
                    color: "transparent"
                },
                {
                    network: "whatsapp",
                    name: "Whatsapp",
                    icon: "bx bxl-whatsapp",
                    color: "transparent"
                }
            ]
        };
    },
    mounted() {
        this.getProduct();
    },
    methods: {
        formatPrice(value) {
            let total = value;
            if (this.$store.state.currency === "IQD") {
                total = 1459.93 * value;
            }
            var formatter = new Intl.NumberFormat("en-US", {
                style: "currency",
                currency: this.$store.state.currency,
                minimumFractionDigits: 2
            });
            return formatter.format(total);
        },
        getProduct() {
            // Product
            const token = localStorage.getItem("token");
            const headers = {
                "Content-Type": "application/json",
                Authorization: `Bearer ${token}`,
                "Accept-Language": `${this.language}`
            };
            axios
                .get("/api/customer/product/slug/" + this.$route.params.slug, {
                    headers
                })
                .then(response => {
                    this.product = response.data.data;

                    this.gallery.src = this.product.product_image;
                    this.gallery.thumbnail = this.product.product_image;
                    this.gallery.id = 0;
                    this.galleries.push({ ...this.gallery });

                    this.product.product_gallery.forEach((image, index) => {
                        this.gallery.src = image;
                        this.gallery.thumbnail = image;
                        this.gallery.id = index + 1;
                        this.galleries.push({ ...this.gallery });
                    });
                    console.log("this.items", this.galleries);
                })
                .catch(error => {
                    console.error(error);
                });
        },
        getSWProduct(item) {
            // Product
            const token = localStorage.getItem("token");
            const headers = {
                "Content-Type": "application/json",
                Authorization: `Bearer ${token}`,
                "Accept-Language": `${this.language}`
            };
            axios
                .get("/api/customer/product/slug/" + item, {
                    headers
                })
                .then(response => {
                    this.product = response.data.data;

                    this.gallery.src = this.product.product_image;
                    this.gallery.thumbnail = this.product.product_image;
                    this.gallery.id = 0;
                    this.galleries.push({ ...this.gallery });

                    this.product.product_gallery.forEach((image, index) => {
                        this.gallery.src = image;
                        this.gallery.thumbnail = image;
                        this.gallery.id = index + 1;
                        this.galleries.push({ ...this.gallery });
                    });
                    console.log("this.items", this.galleries);
                })
                .catch(error => {
                    console.error(error);
                });
        },
        changeQty: function(current) {
            this.productQty = current;
        },
        addToCart(item) {
            //console.log("this.productQtyCart", this.productQty);
            console.log(this.productQty);
            item.quantity = this.productQty;
            this.$store.commit("addToCart", item);
        },
        addReview(id) {
            const token = localStorage.getItem("token");
            let data = {
                rate_type: "product",
                rate_type_id: id,
                rate: this.rate,
                note: this.note
            };
            const headers = {
                "Content-Type": "application/json",
                Authorization: `Bearer ${token}`
            };
            axios
                .post("/api/customer/review", data, {
                    headers: headers
                })
                .then(response => {
                    this.flashMessage.show({
                        status: "success",
                        message: "Review Successfully Added"
                    });
                    this.getProduct();
                    this.isReview(id);
                })
                .catch(error => {
                    console.log("Failed", error);
                });
        },
        isReview(id) {
            const token = localStorage.getItem("token");
            let data = {
                rate_type: "product",
                rate_type_id: id
            };
            const headers = {
                "Content-Type": "application/json",
                Authorization: `Bearer ${token}`
            };
            axios
                .post("/api/customer/review/is-review", data, {
                    headers: headers
                })
                .then(response => {
                    this.is_review = response.data.data.is_review;
                })
                .catch(error => {});
        },
        addToWishlist(id) {
            const token = localStorage.getItem("token");
            let data = {
                product_id: id
            };
            const headers = {
                "Content-Type": "application/json",
                Authorization: `Bearer ${token}`
            };
            axios
                .post("/api/customer/wishlist", data, {
                    headers: headers
                })
                .then(response => {
                    this.flashMessage.show({
                        status: "success",
                        message: "Wishlist Product Successfully Added"
                    });
                })
                .catch(error => {
                    console.log("Failed", error);
                });
        },
        addToFavorite(id) {
            const token = localStorage.getItem("token");
            let data = {
                product_id: id
            };
            const headers = {
                "Content-Type": "application/json",
                Authorization: `Bearer ${token}`
            };
            axios
                .post("/api/customer/favorite", data, {
                    headers: headers
                })
                .then(response => {
                    this.flashMessage.show({
                        status: "success",
                        message: "Favorite Product Successfully Added"
                    });
                })
                .catch(error => {
                    console.log("Failed", error);
                });
        },
        buyNow(item) {
            if (!this.isLoggedIn) {
                window.location.href = "/register";
            } else {
                localStorage.removeItem("cart");
                localStorage.removeItem("cartCount");
                this.$store.commit("addToCart", item);
                window.location.href = "/checkout";
            }
        }
    }
};
</script>
