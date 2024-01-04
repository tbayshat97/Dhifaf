<template>
    <div class="row">
        <div class="col-md-12">
            <div class="section_tittle text-center"><h2>{{translate('layout.manage_address')}}</h2></div>
            <form action="" class="form_inputs">
                <div class="form-check" v-for="(address, index) in addresses" :key="index">
                    <input class="form-check-input" type="radio" :id="address.id" name="address" :value="address.id" :checked="address.is_active">
                    <label class="form-check-label" :for="address.id" @click="setActive(address.id)">
                        {{ address.name }} – {{ address.city_id.name }} – {{ address.area_id.name }}
                    </label>
                    <i class='bx bx-trash' @click="deleteAddress(address.id)"></i>
                    <i class='bx bx-edit' data-toggle="modal" data-target="#exampleModal" @click="openUpdateModal(address.id)"></i>
                </div>
                <h5 class="mt-5 mb-4">{{translate('layout.add_new_address')}}</h5>
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" v-model="name" :placeholder="translate('layout.name')">
                    </div>
                    <div class="col-md-6">
                        <select id="city" v-model="city" v-on:change="getArea($event)">
                            <option :value="null" disabled>{{translate('layout.city')}}</option>
                            <option v-for="(city, index) in cities" :key="index" :value="city.id">{{ city.name }}</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <select id="area" v-model="area">
                            <option :value="null" disabled>{{translate('layout.area')}}</option>
                            <option v-for="(area, index) in areas" :key="index" :value="area.id">{{ area.name }}</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <select id="governorate" v-model="governorate">
                            <option :value="null" disabled>{{translate('layout.governorate')}}</option>
                            <option v-for="(governorate, index) in governorates" :key="index" :value="governorate.id">{{ governorate.title }}</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <input type="text" v-model="mahala" :placeholder="translate('layout.mahala')">
                    </div>
                    <div class="col-md-6">
                        <input type="text" v-model="zoqaq" :placeholder="translate('layout.zoqaq')">
                    </div>
                    <div class="col-md-6">
                        <input type="text" v-model="dar" :placeholder="translate('layout.dar')">
                    </div>
                    <div class="col-md-6">
                        <input type="tel" v-model="phone_number" :placeholder="translate('layout.phone_number')">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button type="submit" @click="addAddress" class="submit">{{translate('layout.submit')}}</button>
                    </div>
                </div>
            </form>
            <FlashMessage
                :position="'right bottom'"
                :time="0"
            ></FlashMessage>
        </div>
        <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Address</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" class="form_inputs">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" v-model="update_name" :placeholder="translate('layout.name')">
                                </div>
                                <div class="col-md-6">
                                    <label for="city">City</label>
                                    <select id="city" v-model="update_city" v-on:change="getArea($event)">
                                        <option :value="null" disabled>{{translate('layout.city')}}</option>
                                        <option v-for="(city, index) in cities" :key="index" :value="city.id">{{ city.name }}</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="area">Area</label>
                                    <select id="area" v-model="update_area">
                                        <option :value="null" disabled>{{translate('layout.area')}}</option>
                                        <option v-for="(area, index) in areas" :key="index" :value="area.id">{{ area.name }}</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="governorate">Governorate</label>
                                    <select id="governorate" v-model="update_governorate">
                                        <option :value="null" disabled>{{translate('layout.governorate')}}</option>
                                        <option v-for="(governorate, index) in governorates" :key="index" :value="governorate.id">{{ governorate.title }}</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="area">Street Address</label>
                                    <input type="text" id="mahala" v-model="update_mahala" :placeholder="translate('layout.mahala')">
                                </div>
                                <div class="col-md-6">
                                    <label for="zoqaq">Zoqaq</label>
                                    <input type="text" id="zoqaq" v-model="update_zoqaq" :placeholder="translate('layout.zoqaq')">
                                </div>
                                <div class="col-md-6">
                                    <label for="dar">dar</label>
                                    <input type="text" id="dar" v-model="update_dar" :placeholder="translate('layout.dar')">
                                </div>
                                <div class="col-md-12">
                                    <label for="phone_number">phone_number</label>
                                    <input type="tel" id="phone_number" v-model="update_phone_number" :placeholder="translate('layout.phone_number')">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" @click.prevent="updateAddress(address_id)" class="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            name: '',
            city: 'null',
            area: 'null',
            governorate: 'null',
            mahala: '',
            zoqaq: '',
            dar: '',
            phone_number: '',
            additional_info: '',
            update_name: '',
            update_city: 'null',
            update_area: 'null',
            update_governorate: 'null',
            update_mahala: '',
            update_zoqaq: '',
            update_dar: '',
            update_phone_number: '',
            show_address: '',
            address: null,
            cities: [],
            areas: [],
            addresses: [],
            governorates: [],
            address_id: null,
        };
    },
    mounted() {
        const token = localStorage.getItem("token")
        const headers = {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${token}`
        }
        axios
        .get("/api/customer/city")
        .then(response => {
            this.cities = response.data.data;
        })
        .catch(error => {
            console.error(error);
        });

        axios
        .get("/api/customer/governorate")
        .then(response => {
            this.governorates = response.data.data;
        })
        .catch(error => {
            console.error(error);
        });

        this.getAddresses();
    },
    methods: {
        getAddresses() {
            const token = localStorage.getItem("token")
            const headers = {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            }
            axios
            .get("/api/customer/address", {
                headers: headers
            })
            .then(response => {
                this.addresses = response.data.data;
            })
            .catch(error => {
                console.error(error);
            });
        },
        addAddress(e) {
            e.preventDefault();
            const token = localStorage.getItem("token")
            let data = {
                name : this.name,
                city: this.city,
                governorate: this.governorate,
                area: this.area,
                mahala: this.mahala,
                zoqaq: this.zoqaq,
                dar: this.dar,
                phone_number: this.phone_number,
            }
            const headers = {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            }
            axios.post('/api/customer/address', data, {
                headers: headers
            })
            .then((response) => {
                this.flashMessage.show({
                    status: 'success',
                    message: 'Address Successfully Added'
                });
                this.getAddresses();
            })
            .catch((error) => {
                console.log('Failed', error);
            })
        },
        deleteAddress(id) {
            const token = localStorage.getItem("token")
            const headers = {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            }
            axios.delete('/api/customer/address/' + id, {
                headers: headers
            })
            .then((response) => {
                this.flashMessage.show({
                    status: 'success',
                    message: 'Address Successfully Removed'
                });
                this.getAddresses();
            })
            .catch((error) => {
                console.log('Failed', error);
            })
        },
        updateAddress(id) {
            let data = {
                name : this.update_name,
                city: this.update_city,
                area: this.update_area,
                governorate: this.update_governorate,
                mahala: this.update_mahala,
                zoqaq: this.update_zoqaq,
                dar: this.update_dar,
                phone_number: this.update_phone_number,
            }
            const token = localStorage.getItem("token")
            const headers = {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            }
            axios.put('/api/customer/address/' + id, data, {
                headers: headers
            })
            .then((response) => {
                this.flashMessage.show({
                    status: 'success',
                    message: 'Address Successfully Updated'
                });
                $('#exampleModal').modal('hide');
                this.getAddresses();
            })
            .catch((error) => {
                console.log('Failed', error);
            })
        },
        setActive(id) {
            const token = localStorage.getItem("token")
            const headers = {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            }
            axios.get('/api/customer/address/' + id, {
                headers: headers
            })
            .then((response) => {
                this.flashMessage.show({
                    status: 'success',
                    message: 'Current Address is Active'
                });
                this.getAddresses();
            })
            .catch((error) => {
                console.log('Failed', error);
            })
        },
        openUpdateModal(id) {
            this.address_id = id;
            const token = localStorage.getItem("token")
            const headers = {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            }
            axios.get('/api/customer/address/' + id, {
                headers: headers
            })
            .then((response) => {
                this.show_address = response.data.data;
                this.update_name = this.show_address.name;
                this.update_city = this.show_address.city_id.id;
                this.update_area = this.show_address.area_id.id;
                this.update_governorate = this.show_address.governorate_id.id;
                this.update_mahala = this.show_address.mahala;
                this.update_zoqaq = this.show_address.zoqaq;
                this.update_dar = this.show_address.dar;
                this.update_phone_number = this.show_address.phone_number;
                this.getAddresses();

                axios
                .get('/api/customer/area/' + this.update_city)
                .then(response => {
                    this.areas = response.data.data;
                })
                .catch(error => {
                    console.error(error);
                });

            })
            .catch((error) => {
                console.log('Failed', error);
            })
        },
        getArea(event) {
            var id = event.target.value;
            axios
            .get('/api/customer/area/' + id)
            .then(response => {
                console.log(response.data.data);
                this.areas = response.data.data;
            })
            .catch(error => {
                console.error(error);
            });
        },
    }
}
</script>
