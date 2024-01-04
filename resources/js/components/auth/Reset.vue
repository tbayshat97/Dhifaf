<template>
    <div class="form">
        <img src="/website/images/logo.svg" alt="">
        <h3>{{ translate('layout.reset_password') }}</h3>
        <form @submit.prevent="handleSubmit">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-6">
                    <input type="password" :placeholder="translate('layout.new_password')" v-model="new_password" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-12 col-md-6">
                    <input type="password" :placeholder="translate('layout.confirm_password')" v-model="confirm_password" required />
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12">
                    <button class="submit" type="submit">{{ translate('layout.reset_password') }}</button>
                </div>
            </div>
            <FlashMessage
                :position="'right bottom'"
                :time="0"
            ></FlashMessage>
        </form>
    </div>
</template>

<script>
export default {
data() {
    return {
        username: this.$route.query.username,
        new_password: "",
        confirm_password: "",
    };
  },
  methods: {
    handleSubmit(e) {
        e.preventDefault();
        if (this.new_password === this.confirm_password && this.new_password.length > 0) {
        var login = '/login';
        axios.post("/api/customer/reset-password", {
            username: this.username,
            new_password: this.new_password,
            confirm_password: this.confirm_password
        })
        .then(response => {
            console.log('response', response);
            if (response.data.code == "200") {
                this.flashMessage.show({
                    status: 'info',
                    message: this.translate('layout.please_wait')
                });
                this.$router.push({path:login});
                window.location.reload();
            }
            else {
                this.flashMessage.show({
                status: 'error',
                message: this.translate('layout.the_password_must_be_at_least_6_characters')
                })
            }
        })
        .catch(error => {
            console.log('error', error);
        });
        } else {
            e.preventDefault();
            this.password = "";
            this.rpassword = "";
            this.flashMessage.show({
            status: "error",
            message: this.translate('layout.passwords_not_match'),
            });
      }
    },
  },
}
</script>