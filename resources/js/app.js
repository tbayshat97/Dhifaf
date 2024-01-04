require("./bootstrap");

import store from "./store.js";
import shopData from "./data.js";
import VueRouter from "vue-router";
import swal from "sweetalert2";
import Vue from "vue";
import VueAwesomeSwiper from "vue-awesome-swiper";
import "swiper/swiper-bundle.css";
import Select2 from "v-select2-component";
import FlashMessage from "@smartweb/vue-flash-message";
import axios from "axios";
import VueAxios from "vue-axios";
import VueSocialauth from "vue-social-auth";
import Lingallery from "lingallery";
import VLazyImage from "v-lazy-image/v2";

Vue.component("VLazyImage", VLazyImage);

Vue.component("lingallery", Lingallery);

Vue.use(VueAxios, axios);

Vue.use(VueRouter);

Vue.use(VueAwesomeSwiper /* { default options with global component } */);

Vue.component("Select2", Select2);
new Vue({
    // ...
});
Vue.use(FlashMessage);

Vue.use(VueSocialauth, {
    providers: {
        facebook: {
            clientId: "161205152617362",
            client_secret: "826c2924256f0e82f4fc112bf64d31fa",
            redirectUri: "/auth/facebook/callback" // Your client app URL
        }
    }
});

//Translation
Vue.prototype.translate = require("./VueTranslation/Translation").default.translate;

// General Components
Vue.component(
    "topbar-component",
    require("./components/header/TopBar.vue").default
);
Vue.component(
    "header-component",
    require("./components/general/Header.vue").default
);
Vue.component(
    "header1-component",
    require("./components/header/Header1.vue").default
);
Vue.component(
    "header-right-component",
    require("./components/header/HeaderRight.vue").default
);
Vue.component(
    "main-slider-component",
    require("./components/general/MainSlider.vue").default
);
Vue.component(
    "follow-component",
    require("./components/general/FollowUs.vue").default
);
Vue.component(
    "quantityInput-component",
    require("./components/general/QuantityInput.vue").default
);

Vue.component(
    "gallery-component",
    require("./components/general/Gallery.vue").default
);
Vue.component(
    "gallery-page",
    require("./components/general/GalleryPage.vue").default
);
Vue.component(
    "bottom-menu",
    require("./components/general/BottomMenu.vue").default
);
Vue.component(
    "footer-text",
    require("./components/general/FooterText.vue").default
);
Vue.component(
    "about-sections",
    require("./components/general/AboutSections.vue").default
);
Vue.component(
    "contact-us",
    require("./components/general/ContactUs.vue").default
);

//Auth Components
Vue.component(
    "login-component",
    require("./components/auth/Login.vue").default
);
Vue.component(
    "register-component",
    require("./components/auth/Register.vue").default
);
Vue.component(
    "verify-component",
    require("./components/auth/Verify.vue").default
);
Vue.component(
    "forgot-component",
    require("./components/auth/Forgot.vue").default
);
Vue.component(
    "verify-forgot-component",
    require("./components/auth/VerifyForgot.vue").default
);
Vue.component(
    "reset-component",
    require("./components/auth/Reset.vue").default
);

//Brands Components
Vue.component(
    "luxury-brands",
    require("./components/brands/LuxuryBrands.vue").default
);
Vue.component(
    "luxury-home",
    require("./components/brands/LuxuryHome.vue").default
);
Vue.component(
    "brands-section",
    require("./components/brands/Brands.vue").default
);
Vue.component(
    "brands-page",
    require("./components/brands/BrandsPage.vue").default
);

//Influencers Components
Vue.component(
    "influencers-list",
    require("./components/influencers/InfluencersList.vue").default
);
Vue.component(
    "influencers-card",
    require("./components/influencers/Influencers.vue").default
);

//Products Components
Vue.component(
    "product-card",
    require("./components/products/ProductCard.vue").default
);
Vue.component(
    "product-one",
    require("./components/general/ProductOne.vue").default
);
Vue.component(
    "division-card",
    require("./components/products/Division.vue").default
);
Vue.component("offer-card", require("./components/products/Offer.vue").default);
Vue.component(
    "single-product",
    require("./components/products/SingleProduct.vue").default
);
Vue.component(
    "related-products",
    require("./components/products/RelatedProducts.vue").default
);
Vue.component(
    "cart-component",
    require("./components/products/Cart.vue").default
);
Vue.component(
    "checkout-component",
    require("./components/products/Checkout.vue").default
);
Vue.component(
    "featured-component",
    require("./components/products/FeaturedList.vue").default
);
Vue.component(
    "toprated-component",
    require("./components/products/TopRatedList.vue").default
);
Vue.component(
    "newarrivals-component",
    require("./components/products/NewArrivalsList.vue").default
);
Vue.component(
    "newarrivals-grid",
    require("./components/products/NewArrivalsGrid.vue").default
);
Vue.component(
    "wishlist-component",
    require("./components/products/Wishlist.vue").default
);
Vue.component(
    "favorite-component",
    require("./components/products/Favorite.vue").default
);
Vue.component(
    "search-result",
    require("./components/products/AllProducts.vue").default
);
Vue.component(
    "cross-selling",
    require("./components/products/CrossSelling.vue").default
);
Vue.component(
    "up-selling",
    require("./components/products/UpSelling.vue").default
);

//Categories Components
Vue.component(
    "category-card",
    require("./components/products/categories/Category.vue").default
);
Vue.component(
    "category-shop",
    require("./components/products/categories/Shop.vue").default
);
Vue.component("brand-shop", require("./components/brands/Shop.vue").default);
Vue.component(
    "influencer-shop",
    require("./components/influencers/Shop.vue").default
);

//Profile Pages
Vue.component(
    "edit-profile",
    require("./components/my-profile/MyProfile.vue").default
);
Vue.component(
    "my-orders",
    require("./components/my-profile/MyOrders.vue").default
);
Vue.component(
    "manage-address",
    require("./components/my-profile/ManageAddress.vue").default
);
Vue.component(
    "notifications-page",
    require("./components/my-profile/Notifications.vue").default
);
Vue.component(
    "update-username",
    require("./components/my-profile/UpdateUsername.vue").default
);
Vue.component(
    "verify-update",
    require("./components/my-profile/VerifyUpdate.vue").default
);
Vue.component(
    "shop-sidebar",
    require("./components/general/ShopSidebar.vue").default
);

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home"
        },
        {
            path: "/single-product/:slug",
            name: "single-product"
        },
        {
            path: "/show-order/:id",
            name: "show-order"
        },
        {
            path: "/division/:slug",
            name: "single-division"
        },
        {
            path: "/gallery/:id",
            name: "single-gallery"
        },
        {
            path: "/category-shop/:slug",
            name: "category-shop"
        },
        {
            path: "/brand-shop/:slug",
            name: "brand-shop"
        },
        {
            path: "/luxury/:slug",
            name: "home-luxury"
        },
        {
            path: "/influencer-shop/:slug",
            name: "influencer-shop"
        },
        {
            path: "/all-products",
            name: "all-products"
        }
    ]
});

window.onpopstate = function() {
    location.reload();
};

const app = new Vue({
    el: "#app",
    router,
    store: new Vuex.Store(store)
});
