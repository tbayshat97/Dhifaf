<template>
    <div>
        <section class="luxury_about section_padding">
            <div class="container-fluid">
                <div class="row" v-if="luxury.brand_about">
                    <div class="col-lg-6">
                        <img :src="luxury.brand_about.big_image" class="img-fluid w-100" alt="pic">
                    </div>
                    <div class="col-lg-6 section_padding right_section">
                        <h3>{{ luxury.brand_about.title }}</h3>
                        <p>{{ luxury.brand_about.description }}</p>
                        <a href="#" class="luxury-button">Shop Now<i class='bx bx-right-arrow-alt'></i></a>
                        <img :src="luxury.brand_about.small_image" alt="pic">
                    </div>
                </div>
            </div>
        </section>

        <section class="luxury_category section_padding">
            <div class="container-fluid">
                <div class="row">
 
                    <div class="col-lg-6 luxury_category_block" v-for="(category, index) in luxury.brand_category" :key="index">
                        <div class="luxury_category_content">
                            <a :href="$router.resolve({name: 'category-shop', params: { slug: category.category_slug }}).href">
                                <h3 class="luxury_category_title">{{ category.category_name }}</h3>
                                <img :src="category.category_image" alt="pic">
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!--New Arrivals-->
        <section class="single_product_list_slider luxury_new_arrivals section_padding">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section_tittle">
                            <h2 class="text-center">New Arrivals</h2>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center justify-content-between">
                    <product-card v-for="(newArrival, index) in luxury.brand_new_arrivals" :key="index" :item="newArrival"></product-card>
                </div>
            </div>
        </section>
        <!--New Arrivals-->

        <!--Top Sellers-->
        <section class="single_product_list_slider luxury_new_arrivals section_padding">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section_tittle">
                            <h2 class="text-center">Top Sellers</h2>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center justify-content-between">
                    <product-card v-for="(topSeller, index) in luxury.brand_best_seller" :key="index" :item="topSeller"></product-card>
                </div>
            </div>
        </section>
        <!--Top Sellers-->

        <section class="luxury_footer_image section_padding pb-0" v-if="luxury.brand_banner">
            <img :src="luxury.brand_banner.banner_image" alt="pic" style="width: 100%">
        </section>
    </div>
</template>

<script>
    export default {
        props: ['someUnrelatedVar'],
        data() {
            return {
                luxury: '',
            };
        },
        mounted() {
            axios.get("/api/customer/luxury-brand/slug/" + this.$route.params.slug)
            .then(response => {
                this.luxury = response.data.data;
            })
            .catch(error => {
                console.error(error);
            });
        },
    };
</script>