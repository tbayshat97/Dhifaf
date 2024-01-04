<template>
    <div class="row align-items-center justify-content-between">
        <product-card v-for="(item, index) in favorites" :key="index" :item="item" :deleteItem="2" :callbackFavorite="getFavorite"></product-card>
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
            favorites: [],
        };
    },
    methods: {
        getFavorite() {
            const token = localStorage.getItem("token")
            const headers = {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            }
            axios
            .get("/api/customer/favorite/list", {
                headers: headers
            })
            .then(response => {
                this.favorites = response.data.data;
            })
            .catch(error => {
                console.error(error);
            });
        }
    },
    mounted() {
        this.getFavorite();
    },
}
</script>
