<template>
  <div
    v-bind:class="
      isSingleCard == 1 ? 'single_product_card' : 'mb-3 col-lg-3 col-sm-6'
    "
  >
    <div class="product">
      <figure class="product-media">
        <span class="product-label label-new" v-if="item.product_is_new"
          >New</span
        >
        <span class="product-label label-sale" v-if="item.product_sale_price">{{
          item.product_sale_price_percentage
        }}</span>
        <span class="product-label label-top" v-if="item.product_is_featured"
          >Top</span
        >
        <span
          class="product-label label-out"
          v-if="item.product_stock_status === 2"
          >Out Of Stock</span
        >
        <a
          :href="
            $router.resolve({
              name: 'single-product',
              params: { slug: item.product_slug },
            }).href
          "
        >
          <img
            :src="item.product_image"
            :alt="item.product_name"
            class="product-image"
          />
        </a>
      </figure>
      <div class="product-body">
        <div class="ratings-container">
          <div class="ratings">
            <div
              class="ratings-val"
              :style="{
                width: item.product_rate.total * 20 + '%',
              }"
            ></div>
            <span class="tooltip-text">{{ item.product_rate.total }}</span>
          </div>
          <span class="ratings-text"
            >( {{ item.product_rate.total }} Reviews )</span
          >
        </div>
        <div class="product-brand">
          {{ item.product_brand.brand_name }}
          <span v-if="item.product_sub_brand">{{
            item.product_sub_brand.brand_name
          }}</span>
        </div>
        <h3 class="product-title">
          <a
            :href="
              $router.resolve({
                name: 'single-product',
                params: { slug: item.product_slug },
              }).href
            "
            >{{ item.product_name }}
            <span v-if="item.product_sub_category.length > 0">{{
              item.product_sub_category[0].sub_category_name
            }}</span>
            <span v-else>{{ item.product_category[0].category_name }}</span>

            <span v-if="item.product_size">{{ item.product_size.name }}</span>
          </a>
        </h3>
        <div class="product-price" v-if="item.product_sale_price == null">
          <span class="out-price">{{ formatPrice(item.product_price) }}</span>
        </div>
        <div class="product-price" v-else>
          <span class="new-price">{{
            formatPrice(item.product_sale_price)
          }}</span>
          <span class="old-price">{{ formatPrice(item.product_price) }}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    deleteItem: Number,
    isSingleCard: Number,
    item: Object,
    callbackFavorite: Function,
    callbackWishlist: Function,
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
        minimumFractionDigits: 2,
      });
      return formatter.format(total);
    },
    addToCart(item) {
      console.log("test");
      this.$store.commit("addToCart", item);
    },
    removeItemWishlist(id) {
      const token = localStorage.getItem("token");
      const headers = {
        "Content-Type": "application/json",
        Authorization: `Bearer ${token}`,
      };
      axios
        .delete("/api/customer/wishlist/" + id, {
          headers: headers,
        })
        .then((response) => {
          this.flashMessage.show({
            status: "success",
            message: "Product Successfully Removed",
          });
          if (this.callbackWishlist) {
            this.callbackWishlist();
          }
        })
        .catch((error) => {
          console.log("Failed", error);
        });
    },
    removeItemFavorite(id) {
      const token = localStorage.getItem("token");
      const headers = {
        "Content-Type": "application/json",
        Authorization: `Bearer ${token}`,
      };
      axios
        .delete("/api/customer/favorite/" + id, {
          headers: headers,
        })
        .then((response) => {
          this.flashMessage.show({
            status: "success",
            message: "Product Successfully Removed",
          });
          if (this.callbackFavorite) {
            this.callbackFavorite();
          }
        })
        .catch((error) => {
          console.log("Failed", error);
        });
    },
  },
};
</script>
