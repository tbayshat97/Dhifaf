<template>
    <div class="form">
        <img src="/website/images/logo.svg" alt="">
        <h3>{{ translate('layout.enter_new_username') }}</h3>
        <form @submit.prevent="handleSubmit">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-6">
                    <input type="text" name="username" v-model="username" :placeholder="translate('layout.mobile_number')" required>
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
    data() {
        return {
            username:""
        };
    },
    methods: {
        handleSubmit(e) {
            e.preventDefault();
            const token = localStorage.getItem("token")
            var verify = '/verify-update';
            let username = this.username;
            const headers = {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            }
            axios.post("/api/customer/profile/update-username", {username: this.username},
            {
                    headers: headers
            })
            .then(response => {
                if (response.data.code == 200) {
                    this.flashMessage.show({
                        status: "success",
                        message: this.translate('layout.successfully_updated'),
                    });
                    this.$router.push({path:verify,query: {username: username}});
                    window.location.reload();
                }
            })
            .catch(error => {
                console.log('error', error);
                this.flashMessage.show({
                    status: 'error',
                    message: this.translate('layout.mobile_number_is_not_valid')
                });
            });
        },
    },
}
</script>
