<template>
    <div class="row align-items-center">
        <influencers-card                   
            :influencer="influencer"
            v-for="(influencer, index) in influencers.slice(0, 8)"
            :key="index">
        </influencers-card>
    </div>
</template>

<script>

export default {
  data() {
    return {
      influencers: [],
    };
  },
  mounted() {
      axios
      .get("/api/customer/Influencers")
      .then(response => {
          this.influencers = response.data.data;
      })
      .catch(error => {
          console.error(error);
      });
  },
}
</script>