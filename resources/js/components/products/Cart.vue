<template>
  <div>
    <div class="page-content">
      <div class="cart">
        <div class="container">
          <div class="row" v-if="$store.state.cartCount > 0" key="hasCart">
            <div class="col-lg-9">
              <table class="table table-cart table-mobile">
                <thead>
                  <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th></th>
                  </tr>
                </thead>

                <tbody>
                  <tr
                    v-for="(product, index) in $store.state.cart"
                    :key="index"
                  >
                    <td class="product-col">
                      <div class="product">
                        <figure class="product-media">
                          <a :href="'/single-product/' + product.product_slug">
                            <img :src="product.product_image" alt="Product" />
                          </a>
                        </figure>

                        <h3 class="product-title">
                          <a
                            :href="'/single-product/' + product.product_slug"
                            >{{ product.product_name }}</a
                          >
                        </h3>
                      </div>
                    </td>
                    <td class="price-col" v-if="product.product_sale_price">
                      {{ formatPrice(product.product_sale_price) }}
                    </td>
                    <td class="price-col" v-else>
                      {{ formatPrice(product.product_price) }}
                    </td>
                    <td class="quantity-col">
                      <quantityInput-component
                        :product="product"
                        @change-qty="changeQty"
                        class="cart-product-quantity"
                      ></quantityInput-component>
                    </td>
                    <td class="total-col">
                      {{ formatPrice(product.totalPrice) }}
                    </td>
                    <td class="remove-col">
                      <button
                        @click.prevent="removeFromCart(product)"
                        class="btn-remove"
                      >
                        <i class="icon-close"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>

              <div class="cart-bottom">
                <div class="cart-discount">
                  <form action="#">
                    <div class="input-group">
                      <input
                        type="text"
                        class="form-control"
                        required
                        placeholder="coupon code"
                      />
                      <div class="input-group-append">
                        <button class="btn btn-outline-primary-2" type="submit">
                          <i class="icon-long-arrow-right"></i>
                        </button>
                      </div>
                    </div>
                  </form>
                </div>

                <a
                  href="#"
                  class="btn btn-outline-dark-2"
                  @click.prevent="updateCart({ cartItems: cartItems })"
                >
                  <span>UPDATE CART</span>
                  <i class="icon-refresh"></i>
                </a>
              </div>
            </div>

            <aside class="col-lg-3">
              <div class="summary summary-cart">
                <h3 class="summary-title">Cart Total</h3>

                <table class="table table-summary">
                  <tbody>
                    <tr class="summary-subtotal">
                      <td>Subtotal:</td>
                      <td>{{ formatPrice(totalPrice) }}</td>
                    </tr>

                    <tr class="summary-shipping">
                      <td>Shipping:</td>
                      <td>{{ formatPrice(shippingCost) }}</td>
                    </tr>

                    <tr class="summary-total">
                      <td>Total:</td>
                      <td>{{ formatPrice(totalPrice) }}</td>
                    </tr>
                  </tbody>
                </table>

                <a
                  href="/checkout"
                  class="btn btn-outline-primary-2 btn-order btn-block"
                  >PROCEED TO CHECKOUT</a
                >
              </div>

              <a href="/" class="btn btn-outline-dark-2 btn-block mb-3">
                <span>CONTINUE SHOPPING</span>
                <i class="icon-refresh"></i>
              </a>
            </aside>
          </div>

          <div class="row" v-else key="noCart">
            <div class="col-12">
              <div class="cart-empty-page text-center">
                <i class="cart-empty icon-shopping-cart"></i>
                <p class="px-3 py-2 cart-empty mb-3">
                  No products added to the cart
                </p>
                <p class="return-to-shop mb-0">
                  <a href="/shop/sidebar/list" class="btn btn-primary"
                    >RETURN TO SHOP</a
                  >
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// Import Swiper Vue.js components
import { Swiper, SwiperSlide, directive } from "vue-awesome-swiper";

// Import Swiper styles
import "swiper/swiper-bundle.css";

export default {
  props: ["route"],
  data() {
    return {
      toggle: false,
      name: null,
      user_type: 0,
      proceedToCheckout: false,
      isLoggedIn: localStorage.getItem("token") != null,
      queueProducts: [],
      checkProductsCart: {
        product_id: null,
        qty: null,
      },
      current: this.product.quantity ? this.product.quantity : 1,
      pushProductsIds: [],
      productQtyCheck: [],
      cross: [],
      swiperOptions: {
        pagination: {
          el: ".swiper-pagination",
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
          clickable: true,
        },
        spaceBetween: 50,
        breakpoints: {
          1440: {
            slidesPerView: 3,
            spaceBetween: 10,
          },
          1200: {
            slidesPerView: 3,
            spaceBetween: 15,
          },
          767: {
            slidesPerView: 2,
            spaceBetween: 20,
          },
          586: {
            slidesPerView: 1,
            spaceBetween: 20,
          },
        },
      },
    };
  },
  components: {
    Swiper,
    SwiperSlide,
  },
  mounted() {
    this.setDefaults();
    let pushProductsIds = this.pushProductsIds;
    this.$store.state.cart.map(function (entry, index) {
      pushProductsIds.push(entry.product_id);
    });

    let data = {
      product_id: this.pushProductsIds,
    };
    axios
      .post("/api/customer/cross-sale/products", data)
      .then((response) => {
        this.cross = response.data.data;
      })
      .catch((error) => {
        console.error(error);
      });

    this.updateCart();
    this.checkProducts();
  },
  watch: {
    product: function () {
      this.current = this.product.quantity ? this.product.quantity : 1;
    },
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
      this.updateCartPlus();
      this.checkProducts();
      this.$store.commit("addToCart", item);
    },
    updateQty(item) {
      this.updateCartMinus();
      this.checkProducts();
      this.$store.commit("updateQty", item);
    },
    removeFromCart(item) {
      this.$store.commit("removeFromCart", item);
      this.updateCart();
      this.checkProducts();
    },
    setDefaults() {
      if (this.isLoggedIn) {
        let user = JSON.parse(localStorage.getItem("user"));
        this.name = user.name;
        this.user_type = user.is_admin;
      }
    },
    removeQuantity(item) {
      item--;
    },
    checkProducts() {
      const token = localStorage.getItem("token");
      let data = {
        products: this.queueProducts,
      };
      console.log("data", data);
      const headers = {
        "Content-Type": "application/json",
        Authorization: `Bearer ${token}`,
      };
      axios
        .post("/api/customer/order/cart", data, {
          headers: headers,
        })
        .then((response) => {
          this.productQtyCheck = response.data.data;
          let checkedValues = [];
          this.productQtyCheck.products.forEach((product) => {
            checkedValues.push(product.can_buy);
          });

          this.proceedToCheckout = !checkedValues.includes(false);
        })
        .catch((error) => {
          console.log("Failed", error);
        });
    },
    updateCart() {
      this.queueProducts = [];
      let queueProducts = this.queueProducts;
      let checkProductsCart = this.checkProductsCart;
      this.$store.state.cart.map(function (entry, index) {
        queueProducts.push(
          (checkProductsCart = {
            product_id: entry.product_id,
            qty: entry.quantity,
          })
        );
      });
    },
    updateCartPlus() {
      this.queueProducts = [];
      let queueProducts = this.queueProducts;
      let checkProductsCart = this.checkProductsCart;
      this.$store.state.cart.map(function (entry, index) {
        queueProducts.push(
          (checkProductsCart = {
            product_id: entry.product_id,
            qty: entry.quantity + 1,
          })
        );
      });
    },
    updateCartMinus() {
      this.queueProducts = [];
      let queueProducts = this.queueProducts;
      let checkProductsCart = this.checkProductsCart;
      this.$store.state.cart.map(function (entry, index) {
        queueProducts.push(
          (checkProductsCart = {
            product_id: entry.product_id,
            qty: entry.quantity - 1,
          })
        );
      });
    },
    onSwiper(swiper) {
      console.log(swiper);
    },
    onSlideChange() {
      console.log("slide change");
    },
    pervSlide() {
      this.$refs.mySwiper.$swiper.slidePrev();
    },
    nextSlide() {
      this.$refs.mySwiper.$swiper.slideNext();
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
    shippingCost() {
      let cost = 0;
      return cost.toFixed(2);
    },

    fullRoute() {
      return this.route;
    },
  },
};
</script>
<style>
.removeBtn {
  color: red;
  cursor: pointer;
  font-size: 30px;
}
</style>
