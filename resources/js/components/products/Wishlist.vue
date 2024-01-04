<template>
    <div class="row align-items-center justify-content-between">
        <product-card v-for="(item, index) in wishlists" :key="index" :item="item" :deleteItem="1" :callbackWishlist="getWishlist"></product-card>
        <FlashMessage
            :position="'right bottom'"
            :time="0"
        ></FlashMessage>
    </div>
</template>

<script>
export default {
    data() {
        return {
            wishlists: [],
        };
    },
    methods: {
        getWishlist() {
            const token = localStorage.getItem("token")
            const headers = {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            }
            axios
            .get("/api/customer/wishlist/list", {
                headers: headers
            })
            .then(response => {
                this.wishlists = response.data.data;
            })
            .catch(error => {
                console.error(error);
            });
        }
    },
    mounted() {
        this.getWishlist();
    },
}
</script>
