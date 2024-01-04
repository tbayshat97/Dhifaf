<template>
  <div class="col-lg-11 mb-3 mb-lg-5">
    <div class="row divisions">
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-12">
            <div class="division_block" v-if="divisions[0]">
              <a
                :href="
                  $router.resolve({
                    name: 'single-division',
                    params: { slug: divisions[0].division_slug },
                  }).href
                "
              >
                <div class="division_img">
                  <img :src="divisions[0].division_image" alt="" />
                </div>
                <div class="division_overlay"></div>
                <div class="division_text">
                  <h3>{{ divisions[0].division_name }}</h3>
                  <a
                    :href="
                      $router.resolve({
                        name: 'single-division',
                        params: { slug: divisions[0].division_slug },
                      }).href
                    "
                    >Shop Now</a
                  >
                </div>
              </a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="division_block" v-if="divisions[4]">
              <a
                :href="
                  $router.resolve({
                    name: 'single-division',
                    params: { slug: divisions[4].division_slug },
                  }).href
                "
              >
                <div class="division_img">
                  <img :src="divisions[4].division_image" alt="" />
                </div>
                <div class="division_overlay"></div>
                <div class="division_text">
                  <h3>{{ divisions[4].division_name }}</h3>
                  <a
                    :href="
                      $router.resolve({
                        name: 'single-division',
                        params: { slug: divisions[4].division_slug },
                      }).href
                    "
                    >Shop Now</a
                  >
                </div>
              </a>
            </div>
          </div>
          <div class="col-md-6">
            <div class="division_block" v-if="divisions[5]">
              <a
                :href="
                  $router.resolve({
                    name: 'single-division',
                    params: { slug: divisions[5].division_slug },
                  }).href
                "
              >
                <div class="division_img">
                  <img :src="divisions[5].division_image" alt="" />
                </div>
                <div class="division_overlay"></div>
                <div class="division_text">
                  <h3>{{ divisions[5].division_name }}</h3>
                  <a
                    :href="
                      $router.resolve({
                        name: 'single-division',
                        params: { slug: divisions[5].division_slug },
                      }).href
                    "
                    >Shop Now</a
                  >
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-6">
            <div class="division_block" v-if="divisions[2]">
              <a
                :href="
                  $router.resolve({
                    name: 'single-division',
                    params: { slug: divisions[2].division_slug },
                  }).href
                "
              >
                <div class="division_img">
                  <img :src="divisions[2].division_image" alt="" />
                </div>
                <div class="division_overlay"></div>
                <div class="division_text">
                  <h3>{{ divisions[2].division_name }}</h3>
                  <a
                    :href="
                      $router.resolve({
                        name: 'single-division',
                        params: { slug: divisions[2].division_slug },
                      }).href
                    "
                    >Shop Now</a
                  >
                </div>
              </a>
            </div>
          </div>
          <div class="col-md-6">
            <div class="division_block" v-if="divisions[3]">
              <a
                :href="
                  $router.resolve({
                    name: 'single-division',
                    params: { slug: divisions[3].division_slug },
                  }).href
                "
              >
                <div class="division_img">
                  <img :src="divisions[3].division_image" alt="" />
                </div>
                <div class="division_overlay"></div>
                <div class="division_text">
                  <h3>{{ divisions[3].division_name }}</h3>
                  <a
                    :href="
                      $router.resolve({
                        name: 'single-division',
                        params: { slug: divisions[3].division_slug },
                      }).href
                    "
                    >Shop Now</a
                  >
                </div>
              </a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="division_block" v-if="divisions[1]">
              <a
                :href="
                  $router.resolve({
                    name: 'single-division',
                    params: { slug: divisions[1].division_slug },
                  }).href
                "
              >
                <div class="division_img">
                  <img :src="divisions[1].division_image" alt="" />
                </div>
                <div class="division_overlay"></div>
                <div class="division_text">
                  <h3>{{ divisions[1].division_name }}</h3>
                  <a
                    :href="
                      $router.resolve({
                        name: 'single-division',
                        params: { slug: divisions[1].division_slug },
                      }).href
                    "
                    >Shop Now</a
                  >
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
      <!-- <template v-for="(division, index) in divisions">
                <div class="col-lg-4" :key="index" :class="{ 'col-lg-8': index==4 }">
                    <div class="division_block">
                        <div class="division_img">
                            <img :src="division.division_image" alt="">
                        </div>
                        <div class="division_overlay"></div>
                        <div class="division_text">
                            <h3>{{ division.division_name }}</h3>
                            <a :href="$router.resolve({name: 'single-division', params: { slug: division.division_slug }}).href">Shop Now</a>
                        </div>
                    </div>
                </div>
            </template> -->
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      divisions: [],
    };
  },
  mounted() {
    axios
      .get("/api/customer/division")
      .then((response) => {
        this.divisions = response.data.data;
      })
      .catch((error) => {
        console.error(error);
      });
  },
};
</script>
