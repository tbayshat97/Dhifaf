<template>
    <div class="form">
        <img src="/website/images/logo.svg" alt="">
        <h3>{{ translate('layout.verify_your_account') }}</h3>
        <form @submit.prevent="handleSubmit">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-6">
                    <input type="text" name="verification_code" v-model="verification_code" :placeholder="translate('layout.enter_your_code')" required>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12">
                    <button class="btn" type="submit">{{ translate('layout.submit') }}</button>
                </div>
            </div>
            <a class="small float-right resend_sms" href="" @click="resendCode">
                {{ translate('layout.resend_verification_code') }}
            </a>
            <FlashMessage :position="'right bottom'" :time="0"></FlashMessage>
        </form>
    </div>
</template>

<script>

export default {
    data() {
        return {
            username: this.$route.query.username,
            verification_code:""
        };
    },
    methods: {
        handleSubmit(e) {
            e.preventDefault();
            const token = localStorage.getItem("token")
            var reset = '/reset-password';
            let username = this.username;
            if (this.verification_code.length > 0) {
                const headers = {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                }
                axios
                    .post("/api/customer/verify-sms", {
                        username: this.username,
                        verification_code: this.verification_code
                    },
                    {
                         headers: headers
                    })
                    .then((response) => {
                        if(response.data.code == 200) {
                            this.$router.push({path:reset,query: {username: username}});
                            window.location.reload();
                        }
                        else if(response.data.code == 401) {
                            this.flashMessage.show({
                                status: 'error',
                                message: this.translate('layout.verification_code_is_not_valid')
                            });
                        }
                        else {
                            this.flashMessage.show({
                                status: 'error',
                                message: this.translate('layout.verification_code_is_not_valid')
                            });
                        }
                    })
                    .catch(error => {
                        this.flashMessage.show({
                            status: 'error',
                            message: this.translate('layout.verification_code_is_not_valid')
                        });
                        console.log('error', error);
                    });
            } else {
                this.verification_code = "";
                return alert("layout.verification_code_is_not_valid");
            }
        },
        resendCode(e) {
            e.preventDefault();
            const token = localStorage.getItem("token")
            let data = {
                username : this.username,
            }
            const headers = {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            }
            axios.post('/api/customer/resend-sms', data, {
                headers: headers
            })
            .then((response) => {
                    if(response.data.code == 200) {
                        this.flashMessage.show({
                        status: 'success',
                        message: this.translate('layout.verification_code_sent_via_phone')
                    });
                }
            })
            .catch((error) => {
                console.log('Failed', error);
            })
        },
        onComplete(v) {
            this.verification_code = v;
        }
    },
}
</script>
