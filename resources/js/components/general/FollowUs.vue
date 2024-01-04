<template>
    <div class="social-icons">
        <a
            :href="follow.link"
            target="_blank"
            v-for="(follow, index) in followUs"
            :key="index"
            class="social-icon"
        >
            <i :class="'icon-' + follow.key"></i>
        </a>
    </div>
</template>

<script>
export default {
    data() {
        return {
            followUs: []
        };
    },
    mounted() {
        axios
            .get("/api/customer/follow-us")
            .then(response => {
                this.followUs = response.data.data;
            })
            .catch(error => {
                console.error(error);
            });
    }
};
</script>
