<template>
    <div class="header-top">
        <div class="container">
            <div class="header-left overflow-hidden mr-3 mr-sm-0">
                <div class="welcome-msg d-flex flex-nowrap">
                    <p v-if="section.data">
                        {{ section.data.section_data.content }}
                    </p>
                </div>
            </div>
            <div class="header-right">
                <ul class="top-menu">
                    <li>
                        <a href="#">Links</a>
                        <ul>
                            <li>
                                <div class="header-dropdown">
                                    <a href="#">{{ $store.state.currency }}</a>
                                    <div class="header-menu">
                                        <ul>
                                            <li
                                                v-if="
                                                    $store.state.currency ===
                                                        'USD'
                                                "
                                            >
                                                <a
                                                    href="/"
                                                    @click="
                                                        updateCurrency(
                                                            (curr = 'IQD')
                                                        )
                                                    "
                                                    >IQD</a
                                                >
                                            </li>
                                            <li v-else>
                                                <a
                                                    href="/"
                                                    @click="
                                                        updateCurrency(
                                                            (curr = 'USD')
                                                        )
                                                    "
                                                    >USD</a
                                                >
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="header-dropdown">
                                    <a href="#">English</a>
                                    <div class="header-menu">
                                        <ul>
                                            <li>
                                                <a href="/lang/en">English</a>
                                            </li>
                                            <li>
                                                <a href="/lang/ar">Arabic</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a v-if="!isLoggedIn" href="/login">{{
                                    translate("layout.login")
                                }}</a>
                                /
                                <a v-if="!isLoggedIn" href="/register">{{
                                    translate("layout.signup")
                                }}</a>
                                <div class="header-dropdown" v-if="isLoggedIn">
                                    <a href="#">Account</a>
                                    <div class="header-menu">
                                        <ul>
                                            <li>
                                                <a
                                                    class="dropdown-item profile-menu"
                                                    href="/my-profile"
                                                >
                                                    <img
                                                        v-if="image"
                                                        :src="image"
                                                        class="img-fluid"
                                                        alt=""
                                                    />
                                                    <img
                                                        v-else
                                                        src="/website/images/profile-img.png"
                                                        class="img-fluid"
                                                        alt=""
                                                    />
                                                    {{ first_name }}
                                                </a>
                                            </li>
                                            <li>
                                                <a
                                                    class="dropdown-item"
                                                    href="/notifications"
                                                    >{{
                                                        translate(
                                                            "layout.notifications"
                                                        )
                                                    }}</a
                                                >
                                            </li>
                                            <li>
                                                <a
                                                    class="dropdown-item"
                                                    href="/my-orders"
                                                    >{{
                                                        translate(
                                                            "layout.my_orders"
                                                        )
                                                    }}</a
                                                >
                                            </li>
                                            <li>
                                                <a
                                                    class="dropdown-item"
                                                    href="/manage-address"
                                                    >{{
                                                        translate(
                                                            "layout.manage_address"
                                                        )
                                                    }}</a
                                                >
                                            </li>
                                            <li>
                                                <a
                                                    class="dropdown-item"
                                                    @click="logout"
                                                    style="cursor: pointer"
                                                    >{{
                                                        translate(
                                                            "layout.logout"
                                                        )
                                                    }}</a
                                                >
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["language", "route_name"],
    data() {
        return {
            show_search: false,
            first_name: "",
            image: "",
            isLoggedIn: null,
            profile_information: [],
            section: "",
            title: ""
        };
    },
    mounted() {
        const token = localStorage.getItem("token");
        const headers = {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`
        };
        axios
            .get("/api/customer/section/show?key=1", {
                headers: headers
            })
            .then(response => {
                this.section = response.data;
            })
            .catch(error => {
                console.error(error);
            });
    },
    methods: {
        updateCurrency(curr) {
            this.$store.commit("updateCurrency", curr);
        }
    }
};
</script>
