<template>
    <div lass="intro-slider-container">
        <div class="swiper-carousel swiper-1">
            <div v-swiper:swiper2="carouselSetting2">
                <div class="swiper-wrapper">
                    <div
                        class="swiper-slide"
                        v-for="(item, index) in sliders"
                        :key="index"
                    >
                        <div
                            class="intro-slide"
                            :style="
                                `background-image:linear-gradient(to top, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),url('` +
                                    item.main_slider_image +
                                    `')`
                            "
                        >
                            <div class="container intro-content">
                                <h3 class="intro-subtitle">
                                    {{ item.main_slider_line_four }}
                                </h3>
                                <h1 class="intro-title">
                                    {{ item.main_slider_line_one }}
                                    <br />{{ item.main_slider_line_two }}
                                    <br />{{ item.main_slider_line_three }}
                                </h1>

                                <a
                                    :href="item.main_slider_btn_link"
                                    class="btn btn-primary"
                                >
                                    <span>{{ item.main_slider_btn_text }}</span>
                                    <i class="icon-long-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-dots swiper-dots-inner"></div>
            </div>
        </div>
    </div>
</template>
<script>
import carousel from "vue-owl-carousel";
export default {
    props: ["language"],
    data() {
        return {
            sliders: [],
            carouselSetting2: {
                loop: false,
                scrollbar: {
                    draggable: false
                },
                spaceBetween: 0,
                slidesPerView: 1,
                pagination: {
                    el: ".swiper-1 .swiper-dots",
                    clickable: true
                }
            }
        };
    },
    components: {
        carousel
    },
    mounted() {
        const lang = {
            "Accept-Language": this.language
        };
        axios
            .get("/api/customer/main-slider", {
                headers: lang
            })
            .then(response => {
                this.sliders = response.data.data;
            })
            .catch(error => {
                console.error(error);
            });
    }
};
</script>
