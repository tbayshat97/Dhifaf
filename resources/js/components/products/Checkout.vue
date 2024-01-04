<template>
  <div class="row">
    <div class="page-content">
      <div class="checkout">
        <div class="container">
          <div class="checkout-discount">
            <form action="#">
              <input
                type="text"
                class="form-control"
                required
                id="checkout-discount-input"
              />
              <label for="checkout-discount-input" class="text-truncate">
                Have a coupon?
                <span>Click here to enter your code</span>
              </label>
            </form>
          </div>

          <form action="#">
            <div class="row">
              <div class="col-lg-9">
                <h2 class="checkout-title">Billing Details</h2>

                <div class="row">
                  <div class="col-sm-6">
                    <label>First Name *</label>
                    <input type="text" class="form-control" required />
                  </div>

                  <div class="col-sm-6">
                    <label>Last Name *</label>
                    <input type="text" class="form-control" required />
                  </div>
                </div>

                <label>Company Name (Optional)</label>
                <input type="text" class="form-control" />

                <label>{{ translate("layout.governorate") }} *</label>
                <select
                  id="governorate"
                  v-model="governorate"
                  class="form-control"
                >
                  <option :value="null" disabled>
                    {{ translate("layout.governorate") }}
                  </option>
                  <option
                    v-for="(governorate, index) in governorates"
                    :key="index"
                    :value="governorate.id"
                  >
                    {{ governorate.title }}
                  </option>
                </select>
                <div class="row">
                  <div class="col-sm-6">
                    <label>{{ translate("layout.city") }} *</label>
                    <select
                      id="city"
                      v-model="city"
                      v-on:change="getArea($event)"
                      class="form-control"
                    >
                      <option :value="null" disabled>
                        {{ translate("layout.city") }}
                      </option>
                      <option
                        v-for="(city, index) in cities"
                        :key="index"
                        :value="city.id"
                      >
                        {{ city.name }}
                      </option>
                    </select>
                  </div>

                  <div class="col-sm-6">
                    <label>{{ translate("layout.area") }} *</label>
                    <select id="area" v-model="area" class="form-control">
                      <option :value="null" disabled>
                        {{ translate("layout.area") }}
                      </option>
                      <option
                        v-for="(area, index) in areas"
                        :key="index"
                        :value="area.id"
                      >
                        {{ area.name }}
                      </option>
                    </select>
                  </div>
                </div>
                <label>Street address *</label>
                <input
                  type="text"
                  class="form-control"
                  placeholder="House number and Street name"
                  required
                />
                <input
                  type="text"
                  class="form-control"
                  placeholder="Appartments, suite, unit etc ..."
                  required
                />

                <div class="row">
                  <div class="col-sm-6">
                    <label>Postcode / ZIP *</label>
                    <input type="text" class="form-control" required />
                  </div>

                  <div class="col-sm-6">
                    <label>Phone *</label>
                    <input type="tel" class="form-control" required />
                  </div>
                </div>

                <label>Email address *</label>
                <input type="email" class="form-control" required />

                <div class="custom-control custom-checkbox">
                  <input
                    type="checkbox"
                    class="custom-control-input"
                    id="checkout-create-acc"
                  />
                  <label class="custom-control-label" for="checkout-create-acc"
                    >Create an account?</label
                  >
                </div>

                <div class="custom-control custom-checkbox">
                  <input
                    type="checkbox"
                    class="custom-control-input"
                    id="checkout-diff-address"
                  />
                  <label
                    class="custom-control-label"
                    for="checkout-diff-address"
                    >Ship to a different address?</label
                  >
                </div>

                <label>Order notes (optional)</label>
                <textarea
                  class="form-control"
                  cols="30"
                  rows="4"
                  placeholder="Notes about your order, e.g. special notes for delivery"
                ></textarea>
              </div>

              <aside class="col-lg-3">
                <div class="summary">
                  <h3 class="summary-title">Your Order</h3>

                  <table class="table table-summary">
                    <thead>
                      <tr>
                        <th>Product</th>
                        <th>Total</th>
                      </tr>
                    </thead>

                    <tbody>
                      <tr
                        v-for="(product, index) in $store.state.cart"
                        :key="index"
                      >
                        <td>
                          <a
                            :href="'/single-product/' + product.product_slug"
                            >{{ product.product_name }}</a
                          >
                        </td>
                        <td>{{ formatPrice(product.totalPrice) }}</td>
                      </tr>

                      <tr class="summary-subtotal">
                        <td>Subtotal:</td>
                        <td>{{ formatPrice(totalPrice) }}</td>
                      </tr>

                      <tr>
                        <td>Shipping:</td>
                        <td>{{ formatPrice(0) }}</td>
                      </tr>
                      <tr class="summary-total">
                        <td>Total:</td>
                        <td>{{ formatPrice(totalPrice) }}</td>
                      </tr>
                    </tbody>
                  </table>

                  <button
                    type="submit"
                    class="btn btn-outline-primary-2 btn-order btn-block"
                  >
                    <span class="btn-text">Place Order</span>
                    <span class="btn-hover-text">Proceed to Checkout</span>
                  </button>
                </div>
              </aside>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- <div class="col-lg-12">
      <form class="checkout-form">
        <h3>{{ translate("layout.checkout") }}</h3>
        <div class="row">
          <div class="col-md-6">
            <input
              type="text"
              v-model="name"
              :placeholder="translate('layout.name')"
            />
          </div>
          <div class="col-md-6">
            <select id="city" v-model="city" v-on:change="getArea($event)">
              <option :value="null" disabled>
                {{ translate("layout.city") }}
              </option>
              <option
                v-for="(city, index) in cities"
                :key="index"
                :value="city.id"
              >
                {{ city.name }}
              </option>
            </select>
          </div>
          <div class="col-md-6">
            <select id="area" v-model="area">
              <option :value="null" disabled>
                {{ translate("layout.area") }}
              </option>
              <option
                v-for="(area, index) in areas"
                :key="index"
                :value="area.id"
              >
                {{ area.name }}
              </option>
            </select>
          </div>
          <div class="col-md-6">
            <select id="governorate" v-model="governorate">
              <option :value="null" disabled>
                {{ translate("layout.governorate") }}
              </option>
              <option
                v-for="(governorate, index) in governorates"
                :key="index"
                :value="governorate.id"
              >
                {{ governorate.title }}
              </option>
            </select>
          </div>
          <div class="col-md-6">
            <input
              type="text"
              v-model="mahala"
              :placeholder="translate('layout.mahala')"
            />
          </div>
          <div class="col-md-6">
            <input
              type="text"
              v-model="zoqaq"
              :placeholder="translate('layout.zoqaq')"
            />
          </div>
          <div class="col-md-6">
            <input
              type="text"
              v-model="dar"
              :placeholder="translate('layout.dar')"
            />
          </div>
          <div class="col-md-6">
            <input
              type="tel"
              v-model="phone_number"
              :placeholder="translate('layout.phone_number')"
            />
          </div>
        </div>
        <div class="checkout-actions">
          <a href="#">{{ translate("layout.create_an_account") }}</a>
          <a href="#">{{ translate("layout.ship_to_different_address") }}</a>
        </div>
        <h3 class="cart">{{ translate("layout.your_order") }}</h3>
        <div class="row m-0">
          <div class="cart-product">
            <div class="row m-0">
              <div class="col-3 col-sm-1 col-md-1 d-flex">
                <img
                  src="/website/images/single-product-2.png"
                  class="img-fluid"
                />
              </div>
              <div class="col-12 col-sm-10 col-md-11">
                <div class="row">
                  <div class="col-6 col-sm-6 col-md-6">
                    <h4>Name <span>x1</span></h4>
                    <p class="size">
                      {{ translate("layout.size") }}
                      <span class="text-color">39</span>
                    </p>
                  </div>
                  <div class="col-6 col-sm-6 col-md-6 text-right">
                    <p class="text-color">150 JOD</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row m-0">
          <div class="cart-product">
            <div class="row m-0">
              <div class="col-3 col-sm-1 col-md-1 d-flex">
                <img
                  src="/website/images/single-product-2.png"
                  class="img-fluid"
                />
              </div>
              <div class="col-12 col-sm-10 col-md-11">
                <div class="row">
                  <div class="col-6 col-sm-6 col-md-6">
                    <h4>Name <span>x1</span></h4>
                    <p class="size">
                      {{ translate("layout.size") }}
                      <span class="text-color">39</span>
                    </p>
                  </div>
                  <div class="col-6 col-sm-6 col-md-6 text-right">
                    <p class="text-color">150 JOD</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <hr />
        <section id="cart-total">
          <div class="row m-0">
            <div class="col-12 col-sm-12 col-md-12">
              <div class="cart-total">
                <table class="table cart-total-table mt-0">
                  <tbody>
                    <tr>
                      <td>
                        <h6>{{ translate("layout.subtotal") }}</h6>
                      </td>
                      <td class="text-right text-color">100 JOD</td>
                    </tr>
                    <tr>
                      <td>
                        <h6>{{ translate("layout.shipping") }}</h6>
                      </td>
                      <td class="text-right">
                        <div>
                          <input
                            type="radio"
                            name="exampleRadios"
                            id="exampleRadios1"
                            value="option1"
                            checked
                          />
                          <label for="exampleRadios1" class="text-color">
                            Flat Rate: $6
                          </label>
                        </div>
                        <div>
                          <input
                            type="radio"
                            name="exampleRadios"
                            id="exampleRadios2"
                            value="option2"
                          />
                          <label for="exampleRadios2" class="text-color">
                            Premium Shipping: $15
                          </label>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <h6>{{ translate("layout.total") }}</h6>
                      </td>
                      <td class="text-right text-color">100 JOD</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </section>
        <hr />
        <h3>{{ translate("layout.payment") }}</h3>
        <div class="form-check payment">
          <input
            class=""
            type="radio"
            name="payment"
            id="direct-bank-transfer"
            checked
          />
          <label for="direct-bank-transfer">
            <h6 class="pink-text">
              {{ translate("layout.cash_on_delivery") }}
            </h6>
          </label>
          <p>
            Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit, Sed Do
            Eiusmod Tempor Cididunt Ut Labore Et Dolore Magna Aliqua.
          </p>
        </div>
        <div class="form-check agreement">
          <input type="checkbox" value="" id="terms-and-conditions" />
          <label for="terms-and-conditions">
            <h6>
              {{ translate("layout.checkout_text") }}
              <span
                ><a href="#"
                  >{{ translate("layout.terms_and_conditions") }} *</a
                ></span
              >
            </h6>
          </label>
        </div>
        <div class="form-row">
          <div class="col-sm-6 col-md-6 col-lg-6">
            <button type="submit" class="submit">
              {{ translate("layout.place_order") }}
            </button>
          </div>
        </div>
      </form>
    </div> -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: "",
      city: "null",
      area: "null",
      governorate: "null",
      mahala: "",
      zoqaq: "",
      dar: "",
      phone_number: "",
      additional_info: "",
      show_address: "",
      address: null,
      cities: [],
      areas: [],
      addresses: [],
      governorates: [],
      address_id: null,
    };
  },
  mounted() {
    const token = localStorage.getItem("token");
    const headers = {
      "Content-Type": "application/json",
      Authorization: `Bearer ${token}`,
    };
    axios
      .get("/api/customer/city")
      .then((response) => {
        this.cities = response.data.data;
      })
      .catch((error) => {
        console.error(error);
      });

    axios
      .get("/api/customer/governorate")
      .then((response) => {
        this.governorates = response.data.data;
      })
      .catch((error) => {
        console.error(error);
      });

    axios
      .get("/api/customer/profile", {
        headers: headers,
      })
      .then((response) => {
        this.show_address = response.data.data.customer_address;
        this.name = this.show_address.name ?? "";
        this.city = this.show_address.city_id.id ?? "";
        this.area = this.show_address.area_id.id ?? "";
        this.governorate = this.show_address.governorate_id.id ?? "";
        this.mahala = this.show_address.mahala ?? "";
        this.zoqaq = this.show_address.zoqaq ?? "";
        this.dar = this.show_address.dar ?? "";
        this.phone_number = this.show_address.phone_number ?? "";

        axios
          .get("/api/customer/area/" + this.city)
          .then((response) => {
            this.areas = response.data.data;
          })
          .catch((error) => {
            console.error(error);
          });
      })
      .catch((error) => {
        console.error("error", error);
      });
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
    getArea(event) {
      var id = event.target.value;
      axios
        .get("/api/customer/area/" + id)
        .then((response) => {
          this.areas = response.data.data;
          console.log("this.areas", this.areas);
        })
        .catch((error) => {
          console.error(error);
        });
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
  },
};
</script>
