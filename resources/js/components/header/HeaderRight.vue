<template>
  <div class="header-right">
    <div class="wishlist">
      <a href="/wishlist" class="" title="Wishlist">
        <div class="icon">
          <i class="icon-gift"></i>
          <span class="wishlist-count badge">0</span>
        </div>
        <p>Wishlist</p>
      </a>
    </div>
    <div class="wishlist">
      <a href="/favorite" class="" title="Favorite">
        <div class="icon">
          <i class="icon-heart-o"></i>
          <span class="wishlist-count badge">0</span>
        </div>
        <p>Favorite</p>
      </a>
    </div>
    <div class="dropdown cart-dropdown">
      <a href="/cart" class="dropdown-toggle">
        <div class="icon">
          <i class="icon-shopping-cart"></i>
          <span class="cart-count">{{ $store.state.cartCount }}</span>
        </div>
        <p>Cart</p>
      </a>
      <div
        class="dropdown-menu dropdown-menu-right"
        v-if="$store.state.cartCount > 0"
        key="hasCart"
      >
        <div class="dropdown-cart-products">
          <div
            class="product"
            v-for="(product, index) in $store.state.cart"
            :key="index"
          >
            <div class="product-cart-details">
              <h4 class="product-title">
                <a :href="'/single-product/' + product.product_slug">{{
                  product.product_name
                }}</a>
              </h4>

              <span class="cart-product-info">
                <span class="cart-product-qty">{{ product.quantity }}</span>
                x
                {{
                  product.product_sale_price
                    ? formatPrice(product.product_sale_price)
                    : formatPrice(product.product_price)
                }}
              </span>
            </div>
            <figure class="product-image-container">
              <a
                :to="'/single-product/' + product.product_slug"
                class="product-image"
              >
                <img :src="product.product_image" alt="product" />
              </a>
            </figure>
            <a
              href="#"
              class="btn-remove"
              title="Remove Product"
              @click.prevent="removeFromCart(product)"
            >
              <i class="icon-close"></i>
            </a>
          </div>
        </div>

        <div class="dropdown-cart-total">
          <span>Total</span>

          <span class="cart-total-price">{{ formatPrice(totalPrice) }}</span>
        </div>

        <div class="dropdown-cart-action">
          <a href="/cart" class="btn btn-primary">View Cart</a>
          <a href="/checkout" class="btn btn-outline-primary-2">
            <span>Checkout</span>
            <i class="icon-long-arrow-right"></i>
          </a>
        </div>
      </div>
      <div class="dropdown-menu dropdown-menu-right" v-else key="noCart">
        <p class="text-center">No products in the cart.</p>
      </div>
    </div>
  </div>
</template>
<script>
export default {
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
    removeFromCart(item) {
      this.$store.commit("removeFromCart", item);
    },
  },
  computed: {
    totalPrice() {
      let total = 0;
      for (let item of this.$store.state.cart) {
        total += item.totalPrice;
      }

      return total.toFixed(2);
    },
    fullRoute() {
      return this.route;
    },
  },
};
</script>
