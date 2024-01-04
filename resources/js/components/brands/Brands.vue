<template>
  <div class="swiper-carousel brands-border swiper-2 mb-3 mb-lg-5">
    <div v-swiper:swiper2="carouselSetting2">
      <div class="swiper-wrapper">
        <div class="swiper-slide" v-for="(brand, index) in brands" :key="index">
          <a
            :href="
              $router.resolve({
                name: 'brand-shop',
                params: { slug: brand.brand_slug },
              }).href
            "
            class="brand"
          >
            <img
              :src="brand.brand_image"
              class="bg-white"
              alt="Brand"
              width="150"
              height="30"
            />
          </a>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import carousel from "vue-owl-carousel";
export default {
  data() {
    return {
      brands: [],
      carouselSetting2: {
        loop: false,
        scrollbar: {
          draggable: false,
        },
        spaceBetween: 0,
        breakpoints: {
          992: {
            slidesPerView: 6,
          },
          768: {
            slidesPerView: 5,
          },
          576: {
            slidesPerView: 3,
          },
          480: {
            slidesPerView: 2,
          },
        },
      },
    };
  },
  components: {
    carousel,
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
  },
};
</script>
