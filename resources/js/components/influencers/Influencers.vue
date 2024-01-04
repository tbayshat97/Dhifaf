<template>
    <div class="col-6 col-md-3">
        <div class="influencer">
            <a :href="$router.resolve({name: 'influencer-shop', params: { slug: influencer.influencer_slug }}).href">
                <img :src="influencer.influencer_profile.image" class="img-fluid"/>
                <h5 class="name">{{ influencer.influencer_profile.first_name }} {{ influencer.influencer_profile.last_name }}</h5>
                <div class="overlay">
                    <p><i class='bx bx-right-arrow-alt'></i>View More</p>
                </div>
            </a>
        </div>
    </div>
</template>

<script>
export default {
    props: ['influencer'],
}
</script>