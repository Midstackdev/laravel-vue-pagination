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
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import User from './partials/User'

    export default {
        components: {
            User
        },
        data() {
            return {
                users: []
            }
        },

        mounted() {
            axios.get('/api/users').then((res) => {
                this.users = res.data.data
            })
        }
    }
</script>
