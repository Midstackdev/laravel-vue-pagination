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

                   <pagination :meta="meta" v-on:pagination:switched="getUsers"></pagination>
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

        mounted() {
            this.getUsers()
        },

        methods: {
            getUsers(page = 1) {
                axios.get('/api/users', {
                    params: {
                        page
                    }
                }).then((res) => {
                    this.users = res.data.data
                    this.meta = res.data.meta
                })
            }
        }
    }
</script>
