<template>
    <div>
        <carousel 
            v-if="cross.length > 0"  
            :autoplay="true" :nav="true" 
            :dots="false" 
            :margin="25"
            :responsive="{0:{items:1},600:{items:2},1000:{items:4}}">
            <div class="cross" v-for="(item, index) in cross" :key="index">
                <product-card :item="item" :deleteItem="0" :isSingleCard="1"></product-card>
            </div>
        </carousel>
    </div>
</template>

<script>
import carousel from 'vue-owl-carousel'
export default {
  props: ["pushProductsIds"],
  data() {
    return {
      cross: [],
    };
  },
  components: {
    carousel
  },
  mounted() {
    let data = {
        product_id: this.pushProductsIds
    }
     axios.post("/api/customer/cross-sale/products", data)
      .then((response) => {
        this.cross = response.data.data;
      })
      .catch((error) => {
        console.error(error);
      });
  },
};
</script>