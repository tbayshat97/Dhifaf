<template>
  <div class="product single_product_card">
    <figure class="product-media">
      <span class="product-label label-new" v-if="product.product_is_new"
        >New</span
      >
      <span
        class="product-label label-sale"
        v-if="product.product_sale_price"
        >{{ product.product_sale_price_percentage }}</span
      >
      <span class="product-label label-top" v-if="product.product_is_featured"
        >Top</span
      >
      <span
        class="product-label label-out"
        v-if="product.product_stock_status.value !== 1"
        >Out Of Stock</span
      >

      <a :href="'/single-product/' + product.product_slug">
        <v-lazy-image
          :src="product.product_image"
          class="product-image"
          :alt="product.product_name"
        />
      </a>
    </figure>

    <div class="product-body product-action-inner">
      <div class="ratings-container">
        <div class="ratings">
          <div
            class="ratings-val"
            :style="{ width: product.product_rate.total * 20 + '%' }"
          ></div>
          <span class="tooltip-text" v-if="product.ratings">{{
            product.product_rate.total
          }}</span>
        </div>
        <span class="ratings-text"
          >( {{ product.product_rate.total }} Reviews )</span
        >
      </div>
      <div v-if="product.product_brand" class="product-brand">
        {{ product.product_brand.brand_name }}
        <span v-if="product.product_sub_brand">{{
          product.product_sub_brand.brand_name
        }}</span>
      </div>
      <h3 class="product-title">
        <a
          :href="
            $router.resolve({
              name: 'single-product',
              params: { slug: product.product_slug },
            }).href
          "
          >{{ product.product_name }}
          <span v-if="product.product_sub_category.length > 0">{{
            product.product_sub_category[0].sub_category_name
          }}</span>
          <span v-else>{{ product.product_category[0].category_name }}</span>

          <span v-if="product.product_size">{{
            product.product_size.name
          }}</span>
        </a>
      </h3>

      <div class="product-price" key="outPrice">
        <div class="product-price" v-if="product.product_sale_price">
          <span class="new-price">{{
            formatPrice(product.product_sale_price)
          }}</span>
          <span class="old-price">{{
            formatPrice(product.product_price)
          }}</span>
        </div>
        <div v-else class="product-price">
          <span class="out-price">{{
            formatPrice(product.product_price)
          }}</span>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    product: Object,
    loaded: Boolean,
  },
  data: function () {
    return {
      maxPrice: 0,
      minPrice: 99999,
    };
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
  },
};
</script>
