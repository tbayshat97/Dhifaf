<template>
    <div id="sign_in" class="form-tab">
        <h3>{{ translate("layout.login") }}</h3>
        <form @submit.prevent="handleSubmit">
            <div class="form-group">
                <label for="username">{{
                    translate("layout.mobile_number")
                }}</label>
                <input
                    type="tel"
                    :placeholder="translate('layout.mobile_number')"
                    v-model="username"
                    class="form-control"
                    id="username"
                    required
                />
            </div>
            <div class="form-group">
                <label for="password">{{ translate("layout.password") }}</label>
                <input
                    type="password"
                    :placeholder="translate('layout.password')"
                    v-model="password"
                    class="form-control"
                    id="password"
                    required
                />
            </div>
            <div class="form-footer">
                <button type="submit" class="btn btn-outline-primary-2">
                    <span>{{ translate("layout.login") }}</span>
                    <i class="icon-long-arrow-right"></i>
                </button>
                <div class="custom-control custom-checkbox">
                    <input
                        type="checkbox"
                        id="signin-remember-2"
                        class="custom-control-input"
                    />
                    <label for="signin-remember-2" class="custom-control-label"
                        >Remember Me</label
                    >
                </div>
                <a href="/forgot-password" class="forgot-link">{{
                    translate("layout.forgot_password")
                }}</a>
            </div>
            <FlashMessage :position="'right bottom'" :time="0"></FlashMessage>
        </form>
        <div class="form-choice">
            <p class="text-center">
                {{ translate("layout.or_continue_with") }}
            </p>
            <div class="row">
                <div class="col-sm-4">
                    <a href="javascript:;" class="btn btn-login btn-g"
                        ><i class="icon-google"></i>
                        Login With Google
                    </a>
                </div>
                <div class="col-sm-4">
                    <a href="javascript:;" class="btn btn-login btn-f"
                        ><i class="icon-facebook-f"></i>
                        Login With Facebook
                    </a>
                </div>
                <div class="col-sm-4">
                    <a href="javascript:;" class="btn btn-login btn-a"
                        ><i class="icon-apple"></i>
                        Login With Apple
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            username: "",
            password: "",
            sections: []
        };
    },
    methods: {
        handleSubmit(e) {
            e.preventDefault();
            var home = "/";
            axios
                .post("/api/customer/login", {
                    username: this.username,
                    password: this.password
                })
                .then(response => {
                    console.log("response", response);
                    if (response.data.code == "200") {
                        this.flashMessage.show({
                            status: "info",
                            message: this.translate("layout.please_wait")
                        });
                        localStorage.setItem(
                            "user",
                            JSON.stringify(response.data.data)
                        );
                        localStorage.setItem(
                            "token",
                            response.data.data.token.access_token
                        );
                        this.$emit("loggedIn");
                        this.$router.push({ path: home });
                        window.location.reload();
                    } else {
                        (this.loading = false),
                            this.flashMessage.show({
                                status: "error",
                                message: this.translate(
                                    "layout.the_email_or_password_is_incorrect"
                                )
                            });
                    }
                })
                .catch(error => {
                    this.flashMessage.show({
                        status: "error",
                        message: this.translate(
                            "layout.the_email_or_password_is_incorrect"
                        )
                    });
                    if (error.response.data.code == "205") {
                        window.location.reload();
                    }
                });
        },
        forgotPassword() {
            axios
                .post("/api/customer/forget-password", {
                    username: this.username,
                    password: this.password
                })
                .then(response => {
                    console.log("response", response);
                })
                .catch(error => {
                    console.log("error", error);
                });
        }
    }
};
</script>
