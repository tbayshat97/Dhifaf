<template>
  <div class="mb-3 mb-lg-5" v-if="newArraivals.length > 0">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="section_tittle text-center">
            <h2>{{ translate("layout.new_arrivals") }}</h2>
          </div>
        </div>
      </div>
      <carousel
        v-if="newArraivals.length > 0"
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
        <div
          class="newArraivals"
          v-for="(item, index) in newArraivals"
          :key="index"
        >
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
      newArraivals: [],
    };
  },
  components: {
    carousel,
  },
  mounted() {
    axios
      .get("/api/customer/product/get/new")
      .then((response) => {
        this.newArraivals = response.data.data;
      })
      .catch((error) => {
        console.error(error);
      });
  },
};
</script>
