<template>
    <div>
        <button class="btn btn-primary ml-4" @click="followUser" v-text="buttonText"></button>
    </div>
</template>

<script>
    export default {
        props: ['userId', 'follows'],
        mounted() {
            console.log('Component mounted.')
        },
        data: function () {
            return {
                status: this.follows
            }
        },
        methods: {
            followUser() {
                axios.post(`${this.getBaseUrl()}/follow/` + this.userId)
                    .then(response => {
                        console.log(response.data);
                        this.status = !this.status;
                    })
                    .catch(errors => {
                        if (errors.response.status == 401) {
                        window.location = '/login';
                        }
                    });
            },
            getBaseUrl() {
                return window.location.protocol + "//" + window.location.host;
            }
        },
        computed: {
            buttonText() {
                return (this.status) ? 'Unfollow' : 'Follow';
            }
        }
    }
</script>
