<template>
    <div class="row align-items-center">
        <div class="col-md-5 left">
            <h3>{{ translate('layout.get_info')}}</h3>
            <h4>{{ contacts.content }}</h4>
            <h5>{{ translate('layout.get_info')}}</h5>
            <div class="contact-row" v-for="(location, index) in contacts.contact_locations" :key="index">
                <img src="/website/images/location.svg" alt="">
                <p>{{ location.country }}: <span>{{ location.street }} – {{ location.area }} – {{ location.city }}</span></p>
            </div>
            <hr>
            <div class="contact-row" v-for="(info, index) in contacts.contact_infos" :key="index">
                <img src="/website/images/phone.svg" alt="">
                <p>{{ info.title }}: <span><a :href="`tel:${info.phone}`">{{ info.phone }}</a></span></p>
            </div>
            <hr>
            <h5>email</h5>
            <div class="contact-row" v-for="(email, index) in contacts.contact_emails" :key="index">
                <img src="/website/images/email.svg" alt="">
                <p><span>{{ email.email }}</span></p>
            </div>
            <!-- <hr> -->
            <!-- <h5>{{translate('layout.working_hours')}}</h5>
            <div class="contact-row">
                <img src="/website/images/hours.svg" alt="">
                <p>Office:  <span>Sunday—Thursday 9:00AM–5:00PM</span></p>
            </div>
            <div class="contact-row">
                <img src="/website/images/hours.svg" alt="">
                <p>Office:  <span>Sunday—Thursday 9:00AM–5:00PM</span></p>
            </div> -->
        </div>
        <div class="col-md-7 right">
            <h3>{{ translate('layout.get_a_quote')}}</h3>
            <form @submit.prevent="addQoute">
                <div class="row">
                    <input type="text" v-model="name" :placeholder="translate('layout.your_name')" required>
                </div>
                <div class="row">
                    <input type="email" v-model="email" :placeholder="translate('layout.email')" required>
                </div>
                <div class="row">
                    <textarea :placeholder="translate('layout.message')" v-model="message" required></textarea>
                </div>
                <div class="row">
                    <button>submit</button>
                </div>
                <FlashMessage
                    :position="'right bottom'"
                    :time="0"
                ></FlashMessage>
            </form>
            <div class="social-media">
                <follow-component></follow-component>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            name: '',
            email: '',
            message: '',
            contacts: []
        }      
    },
    mounted() {
        axios
        .get("/api/customer/contact-us")
        .then(response => {
            this.contacts = response.data.data;
        })
        .catch(error => {
            console.error(error);
        });
    },
    methods: {
        addQoute(e) {
            e.preventDefault();
            const token = localStorage.getItem("token")
            let data = {
                name : this.name,
                email: this.email,
                message: this.message,
            }
            const headers = {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            }
            axios.post('/api/customer/quote', data, {
                headers: headers
            })
            .then((response) => {
                this.flashMessage.show({
                    status: 'success',
                    message: 'Qoute Successfully Sent'
                });
            })
            .catch((error) => {
                console.log('Failed', error);
            })
        },
    }
};
</script>