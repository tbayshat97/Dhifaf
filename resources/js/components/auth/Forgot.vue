<template>
    <div class="form">
        <img src="/website/images/logo.svg" alt="">
        <h3>{{ translate('layout.enter_your_mobile_number') }}</h3>
        <form @submit.prevent="handleSubmit">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-6">
                    <input type="text" name="username" v-model="username" :placeholder="translate('layout.enter_your_mobile_number')" required>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12">
                    <button class="btn" type="submit">{{ translate('layout.submit') }}</button>
                </div>
            </div>
            <FlashMessage :position="'right bottom'" :time="0"></FlashMessage>
        </form>
    </div>
</template>

<script>

export default {
    props: ['router'],
    data() {
        return {
            username:""
        };
    },
    methods: {
        handleSubmit(e) {
            e.preventDefault();
            var verify = '/verify-forgot';
            let username = this.username;
            axios.post("/api/customer/forget-password", {
                username: this.username,
            })
            .then(response => {
                console.log('response', response);
                if(response.data.code == 200) {
                    this.$router.push({path:verify,query: {username: username}});
                    window.location.reload();
                }
                else if(response.data.code == 400) {
                    this.flashMessage.show({
                        status: 'error',
                        message: this.translate('layout.The_selected_mobile_number_is_invalid')
                    });
                }
            })
            .catch(error => {
                console.log('error', error);
            });
        }
    },
}
</script>
