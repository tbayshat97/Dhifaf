<template>
    <div class="row section_padding profile-row">
        <div class="col-md-6">
            <h3>{{ first_name }} {{ last_name }}</h3>
            <form @submit.prevent="updateProfile">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" :placeholder="translate('layout.first_name')" v-model="first_name" required>
                    </div>
                    <div class="col-md-6">
                        <input type="text" :placeholder="translate('layout.last_name')" v-model="last_name" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <input type="tel" :placeholder="translate('layout.mobile_number')" v-model="username" required>
                        <a href="/update-username" class="update_mobilenumber">{{ translate('layout.update_mobile_number') }}</a>
                    </div>
                    <div class="col-md-6">
                        <input :placeholder="translate('layout.date_of_birth')" type="text" onfocus="(this.type='date')" id="date" v-model="birthdate" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <select name="gender" id="" v-model="gender" required>
                            <option :value="null" disabled>{{ translate('layout.gender') }}</option>
                            <option :value="1">{{ translate('layout.male') }}</option>
                            <option :value="2">{{ translate('layout.female') }}</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <select name="city_id" id="" v-model="city_id" required>
                            <option :value="null" disabled>{{ translate('layout.city') }}</option>
                            <option v-for="(city, index) in cities" :key="index" :value="city.id">{{ city.name }}</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                         <button class="submit" type="submit">{{ translate('layout.save') }}</button>
                    </div>
                    <div class="col-md-6"></div>
                </div>
            </form>
            <h3>{{ translate('layout.change_password') }}</h3>
            <form @submit.prevent="updatePassword">
                <div class="row">
                    <div class="col-md-6">
                        <input type="password" :placeholder="translate('layout.old_password')" v-model="opassword" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <input type="password" :placeholder="translate('layout.new_password')" v-model="password" required>
                    </div>
                    <div class="col-md-6">
                        <input type="password" :placeholder="translate('layout.c_new_password')" v-model="rpassword" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button class="submit" type="submit">{{ translate('layout.save') }}</button>
                    </div>
                    <div class="col-md-6"></div>
                </div>
                <FlashMessage
                    :position="'right bottom'"
                    :time="0"
                ></FlashMessage>
            </form>
        </div>
        <div class="col-md-6">
            <div class="row edit-img">
                <input type="file" class="custom-file-input" id="profile-img" accept="image/*" @change="updateProfileImage" hidden>
                <label for="profile-img">
                    <img id="profile-image" :src="image" alt="">
                    <span><i class="fas fa-image"></i></span>
                </label>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            city_id: this.city_id,
            gender: this.gender,
            first_name: "",
            last_name: "",
            username: "",
            password: "",
            rpassword: "",
            opassword: "",
            birthdate: "",
            image: "",
            profile_information: [],
            cities: []
        };
    },
    mounted() {
        this.getProfile();
        axios
        .get("/api/customer/city")
        .then(response => {
            this.cities = response.data.data;
        })
        .catch(error => {
            console.error(error);
        });
    },
    methods: {
        getProfile() {
            const token = localStorage.getItem("token")
            const headers = {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            }
            axios
            .get("/api/customer/profile", {
                headers: headers
            })
            .then(response => {
                this.profile_information = response.data.data;
                this.first_name = this.profile_information.customer_profile.first_name;
                this.last_name = this.profile_information.customer_profile.last_name;
                this.birthdate = this.profile_information.customer_profile.birthdate;
                this.image = this.profile_information.customer_profile.image;
                this.username = this.profile_information.customer_username;
                this.gender = this.profile_information.customer_profile.gender.value;
                this.city_id = this.profile_information.customer_profile.city_id;
            })
            .catch(error => {
                console.error(error);
            });
        },
        updateProfile(e) {
            e.preventDefault();
            const token = localStorage.getItem("token")
            let data = {
                first_name : this.first_name,
                last_name : this.last_name,
                mobile_number : this.phone,
                birthdate: this.birthdate,
                gender: this.gender,
                city_id: this.city_id,
            }
            const headers = {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            }
            axios.post('/api/customer/profile', data, {
                headers: headers
            })
            .then((response) => {
                console.log('success', response);
                this.flashMessage.show({
                    status: 'success',
                    message: this.translate('layout.profile_successfully_updated')
                });
            })
            .catch((error) => {
                console.log('Failed', error);
            })
        },
        updateProfileImage () {
            const token = localStorage.getItem("token")
            var formData = new FormData();
            var imagefile = document.querySelector('#profile-img');
            formData.append("image", imagefile.files[0]);
            axios.post('/api/customer/profile', formData, {
                headers: {
                'Content-Type': 'multipart/form-data',
                'Accept': 'application/json',
                'Authorization': `Bearer ${token}`
                }
            })
            .then((ressponse) => {
            this.getProfile();
            this.flashMessage.show({
                status: 'success',
                message: this.translate('layout.profile_image_successfully_updated')
            });
            })
            .catch((error) => {
                console.log('Update Image Failed', error);
            })
        },
        updatePassword(e) {
            e.preventDefault();
            var login = '/login'
            if (this.password === this.rpassword && this.password.length > 0) {
                const token = localStorage.getItem("token")
                let data = {
                    old_password : this.opassword,
                    new_password : this.password,
                    confirm_password : this.rpassword,
                }
                const headers = {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                }
                axios.post('/api/customer/change-password', data, {
                    headers: headers
                })
                .then((response) => {
                    if (response.data.code === 400) {
                        this.flashMessage.show({
                        status: 'error',
                        message: this.translate('The new password must be at least 6 characters.')
                    });
                    } else if (response.data.code === 201) {
                        this.flashMessage.show({
                        status: 'error',
                        message: this.translate('Your old password is incorrect.')
                    });
                    } else {
                        this.flashMessage.show({
                        status: 'success',
                        message: this.translate('layout.password_successfully_updated')
                    });
                    this.$router.push({path:login});
                    window.location.reload();
                    }
                })
                .catch((error) => {
                    console.log('Failed', error);
                })
            } else {
                this.password = "";
                this.rpassword = "";
                this.flashMessage.show({
                status: "error",
                message: this.translate(
                    "Passwords do not match"
                ),
                });
            }
        },
    }
}
</script>
