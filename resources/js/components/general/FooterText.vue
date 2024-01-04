<template>
    <div>
        <p v-if="section.data">{{ section.data.section_data.content }}</p>
    </div>
</template>

<script>
export default {
    data() {
        return {
            section: ""
        };
    },
    mounted() {
        // Footer Text
        axios
            .get("/api/customer/section/show?key=2")
            .then(response => {
                this.section = response.data;
            })
            .catch(error => {
                console.error(error);
            });
    }
};
</script>
