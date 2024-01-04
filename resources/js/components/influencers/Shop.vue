<template>
<div>
    <!--Header Image-->
    <section class="shop influencer-page">
        <div class="inner_header">
            <div class="header_image">
                <img :src="influencer.influencer_profile.header" alt="">
            </div>
            <div class="header_title">
                <h2>{{ influencer.influencer_profile.first_name }} {{ influencer.influencer_profile.last_name }}</h2>
                <p>{{ influencer.influencer_profile.bio }}</p>
                <div class="influencer-buttons">
                    <button>Follow</button>
                    <button>Get Notify</button>
                    <a href="#" target="_blank"><i class="bx bxl-facebook"></i></a>
                    <a href="#" target="_blank"><i class="bx bxl-twitter"></i></a>
                    <a href="#" target="_blank"><i class="bx bxl-instagram"></i></a>
                </div>
            </div>
            <div class="header_breadcrump">
                <div class="container-fluid">
                    <ul>
                        <li>
                            <a href="#">Home</a>
                        </li>
                        <li>
                            <span>{{ influencer.influencer_profile.first_name }} {{ influencer.influencer_profile.last_name }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Header Image-->
    <section class="luxury_new_arrivals section_padding">
        <div class="container-fluid">
            <div class="row">
                <div class="mobile-filter"><i class='bx bx-filter-alt'></i></div>
                <div class="col-lg-3" id="sidebar">
                    <div class="filters mb-5">
                        <h3>Filter by Category </h3>
                        <div class="single-element-widget mt-30">
                            <div class="switch-wrap d-flex justify-content-end align-items-center">
                                <p>01. Sample Checkbox</p>
                                <div class="primary-checkbox">
                                    <input type="checkbox" id="default-checkbox">
                                    <label for="default-checkbox"></label>
                                </div>
                            </div>
                            <div class="switch-wrap d-flex justify-content-end align-items-center">
                                <p>01. Sample Checkbox</p>
                                <div class="primary-checkbox">
                                    <input type="checkbox" id="default-checkbox">
                                    <label for="default-checkbox"></label>
                                </div>
                            </div>
                            <div class="switch-wrap d-flex justify-content-end align-items-center">
                                <p>01. Sample Checkbox</p>
                                <div class="primary-checkbox">
                                    <input type="checkbox" id="default-checkbox">
                                    <label for="default-checkbox"></label>
                                </div>
                            </div>
                            <div class="switch-wrap d-flex justify-content-end align-items-center">
                                <p>01. Sample Checkbox</p>
                                <div class="primary-checkbox">
                                    <input type="checkbox" id="default-checkbox">
                                    <label for="default-checkbox"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="filters">
                        <h3>Filter by Price</h3>
                        <div class="widget price-widget">
                            <div class="wrapper">
                                <fieldset class="filter-price">
                                    <div class="price-field">
                                        <input type="range" name="minPrice" value="0" id="lower">
                                        <input type="range" name="maxPrice" value="100" id="upper">
                                    </div>
                                    <div class="price-wrap">
                                        <div class="price-wrap-1">
                                            <input id="one">
                                            <label for="one">JD</label>
                                        </div>
                                        <div class="price-wrap_line">-</div>
                                        <div class="price-wrap-2">
                                            <input id="two">
                                            <label for="two">JD</label>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <!--./Price Filter -->
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row align-items-center mb-2">
                        <div class="col-lg-6">
                            <h3>Shop</h3>
                            <h5>Showing 1–9 Of 24 Results</h5>
                        </div>
                        <div class="col-lg-6 text-right">
                            <div class="default-select" id="default-select_2">
                                <select>
                                    <option value=" 1">English</option>
                                    <option value="1">Arabic</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <product-card  v-for="(item, index) in influencer.influencer_products" :key="index" :item="item" :deleteItem="0"></product-card>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</template>

<script>
    export default {
        data() {
            return {
                influencer: [],
            };
        },
         mounted() {
            const token = localStorage.getItem("token")
            const headers = {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            }
            axios.get("/api/customer/Influencer/slug/" + this.$route.params.slug, {
                headers
            })
            .then(response => {
                this.influencer = response.data.data;
                console.log('influencer', this.influencer );
            })
            .catch(error => {
                console.error(error);
            });
        },
    };
</script>