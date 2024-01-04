<template>
    <div id="sign_in" class="form-tab">
        <h3>{{ translate("layout.register") }}</h3>
        <form @submit.prevent="handleSubmit">
            <div class="form-group">
                <label for="first_name">{{
                    translate("layout.first_name")
                }}</label>
                <input
                    type="text"
                    :placeholder="translate('layout.first_name')"
                    v-model="first_name"
                    class="form-control"
                    id="first_name"
                    required
                />
            </div>
            <div class="form-group">
                <label for="last_name">{{
                    translate("layout.last_name")
                }}</label>
                <input
                    type="text"
                    :placeholder="translate('layout.last_name')"
                    v-model="last_name"
                    class="form-control"
                    id="last_name"
                    required
                />
            </div>
            <div class="form-group">
                <label for="username">{{
                    translate("layout.mobile_number")
                }}</label>
                <input
                    type="text"
                    :placeholder="translate('layout.mobile_number')"
                    v-model="username"
                    class="form-control"
                    id="username"
                    required
                />
            </div>
            <div class="form-group">
                <label for="date">{{
                    translate("layout.date_of_birth")
                }}</label>
                <input
                    :placeholder="translate('layout.date_of_birth')"
                    type="text"
                    onfocus="(this.type='date')"
                    class="form-control"
                    id="date"
                    v-model="birthdate"
                    required
                />
            </div>
            <div class="form-group">
                <label for="date">{{ translate("layout.gender") }}</label>
                <select
                    name="gender"
                    id=""
                    v-model="gender"
                    class="form-control"
                    required
                >
                    <option :value="null" disabled>{{
                        translate("layout.gender")
                    }}</option>
                    <option :value="1">{{ translate("layout.male") }}</option>
                    <option :value="2">{{ translate("layout.female") }}</option>
                </select>
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
            <div class="form-group">
                <label for="rpassword">{{
                    translate("layout.confirm_password")
                }}</label>
                <input
                    type="password"
                    :placeholder="translate('layout.confirm_password')"
                    v-model="rpassword"
                    class="form-control"
                    id="rpassword"
                    required
                />
            </div>
            <div class="form-footer">
                <button type="submit" class="btn btn-outline-primary-2">
                    <span>{{ translate("layout.signup") }}</span>
                    <i class="icon-long-arrow-right"></i>
                </button>
            </div>

            <FlashMessage :position="'right bottom'" :time="0"></FlashMessage>
        </form>
    </div>
</template>

<script>
export default {
    props: ["router"],
    data() {
        return {
            city_id: "null",
            gender: "null",
            first_name: "",
            last_name: "",
            username: "",
            password: "",
            rpassword: "",
            birthdate: "",
            cities: []
        };
    },
    methods: {
        handleSubmit(e) {
            e.preventDefault();

            if (this.password === this.rpassword && this.password.length > 0) {
                e.preventDefault();
                var verify = "/verify-sms";
                let username = this.username;
                axios
                    .post("/api/customer/register", {
                        first_name: this.first_name,
                        last_name: this.last_name,
                        username: this.username,
                        password: this.password,
                        rpassword: this.rpassword,
                        city_id: this.city_id,
                        birthdate: this.birthdate,
                        gender: this.gender
                    })
                    .then(response => {
                        if (response.data.code == 200) {
                            this.flashMessage.show({
                                status: "success",
                                message: this.translate(
                                    "layout.successfully_registered"
                                )
                            });
                            this.$router.push({
                                path: verify,
                                query: { username: username }
                            });
                            window.location.reload();
                        } else if (response.data.errors.password) {
                            this.flashMessage.show({
                                status: "error",
                                message: this.translate(
                                    "layout.the_password_must_be_at_least_6_characters"
                                )
                            });
                        } else {
                            if (response.data.errors.first_name) {
                                this.flashMessage.show({
                                    status: "error",
                                    message: this.translate(
                                        "layout.the_fullname_field_is_required"
                                    )
                                });
                            }
                            if (response.data.errors.last_name) {
                                this.flashMessage.show({
                                    status: "error",
                                    message: this.translate(
                                        "layout.the_fullname_field_is_required"
                                    )
                                });
                            }
                            if (response.data.errors.username) {
                                this.flashMessage.show({
                                    status: "error",
                                    message: this.translate(
                                        "layout.the_phone_number_has_been_already_taken"
                                    )
                                });
                            }
                        }
                    })
                    .catch(error => {
                        console.error("error", error);
                    });
            } else {
                e.preventDefault();
                this.password = "";
                this.rpassword = "";
                this.flashMessage.show({
                    status: "error",
                    message: this.translate("layout.passwords_not_match")
                });
            }
        }
    },
    mounted() {
        axios
            .get("/api/customer/city")
            .then(response => {
                this.cities = response.data.data;
            })
            .catch(error => {
                console.error(error);
            });
    }
};
</script>
