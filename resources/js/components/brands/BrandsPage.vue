<template>
  <div class="brands-page">
    <div class="section_tittle text-center">
      <h2>{{ translate("layout.our_luxury_brands") }}</h2>
    </div>
    <div class="row">
      <div
        v-for="(brand, index) in luxury_brands"
        :key="index"
        class="mb-3 col-lg-3 col-sm-6 luxury-brands"
      >
        <a
          :href="
            $router.resolve({
              name: 'home-luxury',
              params: { slug: brand.brand_slug },
            }).href
          "
          class="brand"
          ><img :src="brand.brand_image" alt=""
        /></a>
      </div>
    </div>
    <div class="brands-filter"></div>
    <div class="section_tittle text-center">
      <h2>{{ translate("layout.brands") }}</h2>
    </div>
    <div class="row">
      <div
        v-for="(brand, index) in brands"
        :key="index"
        class="mb-3 col-lg-2 col-sm-6 brands"
      >
        <a
          :href="
            $router.resolve({
              name: 'brand-shop',
              params: { slug: brand.brand_slug },
            }).href
          "
          class="brand"
        >
          <img :src="brand.brand_image" alt="" />
        </a>
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
  data() {
    return {
      brands: [],
      luxury_brands: [],
    };
  },

  mounted() {
    axios
      .get("/api/customer/brand/normal")
      .then((response) => {
        this.brands = response.data.data;
      })
      .catch((error) => {
        console.error(error);
      });

    axios
      .get("/api/customer/brand/luxury")
      .then((response) => {
        this.luxury_brands = response.data.data;
      })
      .catch((error) => {
        console.error(error);
      });
  },
};
</script>
