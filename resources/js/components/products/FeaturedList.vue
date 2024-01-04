<template>
  <div class="deal-container mb-3 mb-lg-5" v-if="featured.length > 0">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="section_tittle text-left">
            <h2>{{ translate("layout.featured_items") }}</h2>
          </div>
        </div>
      </div>
      <carousel
        v-if="featured.length > 0"
        :autoplay="true"
        :nav="true"
        :dots="false"
        :margin="25"
        :responsive="{
          0: { items: 1 },
          600: { items: 2 },
          1000: { items: 5 },
        }"
      >
        <div class="featured" v-for="(item, index) in featured" :key="index">
          <product-card
            :item="item"
            :deleteItem="0"
            :isSingleCard="1"
          ></product-card>
        </div>
      </carousel>
    </div>
  </div>
</template>

<script>
import carousel from "vue-owl-carousel";
export default {
  data() {
    return {
      featured: [],
    };
  },
  components: {
    carousel,
  },
  mounted() {
    axios
      .get("/api/customer/product/get/featured")
      .then((response) => {
        this.featured = response.data.data;
      })
      .catch((error) => {
        console.error(error);
      });
  },
};
</script>
