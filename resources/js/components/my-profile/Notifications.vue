<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <h3>{{translate('layout.notifications')}}</h3>
            </div>
        </div>
        <div class="row clear-row">
            <div class="col-md-11">
                <p class="text-right clear-all" @click="deleteAllNotification()">{{translate('layout.clear_all')}}</p>
            </div>
        </div>
        <div class="row notification" v-for="(notification, index) in notifications" :key="index">
            <div class="col-10 col-md-10 d-flex align-items-start">
                <img src="/website/images/favicon.png" alt="">
                <div>
                    <h4>{{ notification.notification_title }}</h4>
                    <p>{{ notification.notification_content }}</p>
                    <span>{{ notification.notification_created_at_readable }}</span>
                </div>
            </div>
            <div class="col-1 col-md-1 text-right">
                <i @click="deleteSingleNotification(notification.notification_id)" class="bx bx-trash"></i>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            notifications: []
        }      
    },
    methods: {
        getNotifications() {
            const token = localStorage.getItem("token")
            const headers = {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            }
            axios
            .get("/api/customer/notification", {
                headers: headers
            })
            .then(response => {
                this.notifications = response.data.data;
            })
            .catch(error => {
                console.error(error);
            });
        },
        deleteSingleNotification(id) {
            const token = localStorage.getItem("token")
            const headers = {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            }
            axios.delete('/api/customer/notification/' + id, {
                headers: headers
            })
            .then((response) => {
                this.getNotifications();
            })
            .catch((error) => {
                console.log('Failed', error);
            })
        },
        deleteAllNotification() {
            const token = localStorage.getItem("token")
            const headers = {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            }
            axios
            .get("/api/customer/notification/delete-all", {
                headers: headers
            })
            .then(response => {
                this.getNotifications();
            })
            .catch(error => {
                console.error(error);
            });
        },
    },
    mounted() {
        this.getNotifications();
    }
};
</script>