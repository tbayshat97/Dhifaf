<template>
  <div class="mb-5">
    <div
      class="row gallery-item"
      v-for="(gallery, index) in galleries"
      :key="index"
    >
      <div
        class="col-md-4"
        v-for="(image, index) in gallery.album_image"
        :key="index"
      >
        <a :href="image" class="img-pop-up img-gal">
          <div
            class="single-gallery-image"
            :style="`background: url(` + image + `);`"
          ></div>
        </a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      galleries: [],
    };
  },
  mounted() {
    const token = localStorage.getItem("token");
    const headers = {
      "Content-Type": "application/json",
      Authorization: `Bearer ${token}`,
    };
    axios
      .get("/api/customer/gallery/album/" + this.$route.params.id, {
        headers,
      })
      .then((response) => {
        this.galleries = response.data.data;
      })
      .catch((error) => {
        console.error(error);
      });
  },
};
</script>
