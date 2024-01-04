<template>
    <div class="row mb-5">
        <div class="col-md-3" v-for="(gallery, index) in galleries" :key="index">
            <div class="influencer">
                <a :href="$router.resolve({name: 'single-gallery', params: { id: gallery.id }}).href">
                    <img :src="gallery.image" class="img-fluid"/>
                    <h5 class="name">{{ gallery.title }}</h5>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                galleries: []
            }      
        },
        mounted() {
            axios
            .get("/api/customer/galleries")
            .then(response => {
                this.galleries = response.data.data;
            })
            .catch(error => {
                console.error(error);
            });
        }
    };
</script>