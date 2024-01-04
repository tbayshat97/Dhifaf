<template>
  <div class="mb-3 mb-lg-5">
    <div class="container-fluid">
      <carousel
        v-if="banners.length > 0"
        :autoplay="true"
        :nav="false"
        :dots="false"
        :margin="5"
        :responsive="{
          0: { items: 1 },
          600: { items: 2 },
          1000: { items: 4 },
        }"
      >
        <div
          class="banner banner-overlay"
          v-for="(banner, index) in banners"
          :key="index"
        >
          <a :href="banner.banner_cta">
            <img
              class="bg-transparent fade-in"
              :src="banner.banner_image"
              height="260"
            />
            <div class="banner-content">
              <h3 class="banner-title text-white">
                {{ banner.banner_name }}
              </h3>
            </div>
          </a>
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
      banners: [],
    };
  },
  components: {
    carousel,
  },
  mounted() {
    axios
      .get("/api/customer/banners")
      .then((response) => {
        this.banners = response.data.data;
      })
      .catch((error) => {
        console.error(error);
      });
  },
};
</script>
