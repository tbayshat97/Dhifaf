<template>
    <div>
        <carousel
            v-if="related.length > 0"
            :autoplay="true"
            :nav="true"
            :dots="false"
            :margin="25"
            :responsive="{
                0: { items: 1 },
                600: { items: 2 },
                1000: { items: 5 }
            }"
        >
            <div class="related" v-for="(item, index) in related" :key="index">
                <product-card
                    :item="item"
                    :deleteItem="0"
                    :isSingleCard="1"
                ></product-card>
            </div>
        </carousel>
    </div>
</template>
<script>
import carousel from "vue-owl-carousel";
export default {
    data() {
        return {
            related: []
        };
    },
    components: {
        carousel
    },
    mounted() {
        // Related Product
        const token = localStorage.getItem("token");
        const headers = {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`
        };
        axios
            .get(
                "/api/customer/product/related/slug/" + this.$route.params.slug,
                {
                    headers
                }
            )
            .then(response => {
                this.related = response.data.data;
            })
            .catch(error => {
                console.error(error);
            });
    }
};
</script>
