<template>
    <div>
        <section class="section_one section_padding pt-0">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-end">
                    <div class="col-lg-8" id="about_right_image">
                        <img src="/website/images/about1.jpg" alt="">
                    </div>
                    <div class="col-lg-4" id="about_left_content">
                        <h2 v-if="section_one.data">{{ section_one.data.section_data.head }}<span>{{ section_one.data.section_data.title }}</span></h2>
                        <p v-if="section_one.data">{{ section_one.data.section_data.content }}</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section_two section_padding pt-0">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-end">
                    <div class="col-lg-8" id="about_right_image">
                        <img src="/website/images/about2.jpg" alt="">
                    </div>
                    <div class="col-lg-4" id="about_left_content">
                        <h4 v-if="section_two.data">{{ section_two.data.section_data.title }}</h4>
                        <p v-if="section_two.data">{{ section_two.data.section_data.content_1 }}</p>
                        <p v-if="section_two.data">{{ section_two.data.section_data.content_2 }}</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section_three section_padding">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-end">
                    <div class="col-lg-8" id="about_right_image">
                        <img src="/website/images/about3.jpg" alt="">
                    </div>
                    <div class="col-lg-4" id="about_left_content">
                        <h4 v-if="section_three.data">{{ section_three.data.section_data.title }}</h4>
                        <p v-if="section_three.data">{{ section_three.data.section_data.content }}</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section_our_gallery section_padding pt-0">
            <div class="container-fluid">
                <div class="section_tittle text-center"><h2>Our Gallery</h2></div>
                <div class="row">

                    <div class="col-md-3" v-for="(gallery, index) in galleries.slice(0,4)" :key="index">
                        <div class="influencer">
                            <a :href="$router.resolve({name: 'single-gallery', params: { id: gallery.id }}).href">
                                <img :src="gallery.image" class="img-fluid"/>
                                <h5 class="name">{{ gallery.title }}</h5>
                            </a>
                        </div>
                    </div>

                </div>
                <div class="row view_all" v-if="galleries.length >= 4">
                    <a href="/gallery-page">{{translate('layout.view_all')}}</a>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                section_one: '',
                section_two: '',
                section_three: '',
                galleries: []
            }      
        },
        mounted() {
            // Section One
            axios
            .get("/api/customer/about-section/show?key=1")
            .then(response => {
                this.section_one = response.data;
            })
            .catch(error => {
                console.error(error);
            });

            // Section Two
            axios
            .get("/api/customer/about-section/show?key=2")
            .then(response => {
                this.section_two = response.data;
            })
            .catch(error => {
                console.error(error);
            });

            // Section Three
            axios
            .get("/api/customer/about-section/show?key=3")
            .then(response => {
                this.section_three = response.data;
            })
            .catch(error => {
                console.error(error);
            });

            // Gallery
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