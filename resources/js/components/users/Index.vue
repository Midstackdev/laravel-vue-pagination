<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Users</div>

                <div class="card-body">
                   <User 
                    v-for="user in users"
                    :user="user"
                    :key="user.id"
                   />

                   <pagination v-if="meta.current_page" :meta="meta" v-on:pagination:switched="switchPage"></pagination>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import User from './partials/User'
    import Pagination from '../pagination/Pagination'

    export default {
        components: {
            User,
            Pagination
        },
        data() {
            return {
                users: [],
                meta: {}
            }
        },

        watch: {
            '$route.query' (query) {
                this.getUsers(query.page)
            }
        },

        mounted() {
            this.getUsers()
        },

        methods: {
            getUsers(page = this.$route.query.page) {
                axios.get('/api/users', {
                    params: {
                        page
                    }
                }).then((res) => {
                    this.users = res.data.data
                    this.meta = res.data.meta
                })
            },

            switchPage(page) {
                this.$router.replace({
                    name: 'user.index',
                    query: {
                        page
                    }
                })
            }
        }
    }
</script>
