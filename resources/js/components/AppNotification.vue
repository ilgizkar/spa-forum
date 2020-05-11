<template>
    <div class="text-center">
        <v-menu offset-y>
            <template v-slot:activator="{ on }">
                <v-btn icon>
                    <v-icon v-on="on" :color="color">mdi-bell</v-icon>{{ unreadCount }}
                </v-btn>
            </template>
            <v-list>
                <v-list-item
                    v-for="(item, index) in unread"
                    :key="index"
                    @click=""
                >
                    <router-link :to="item.path">
                        <v-list-item-title @click="readNoti(item)">{{ item.question }}</v-list-item-title>
                    </router-link>
                </v-list-item>
<!--                <v-list-item-->
<!--                    v-for="(item, index) in read"-->
<!--                    :key="index"-->
<!--                    @click=""-->
<!--                >-->
<!--                    <v-list-item-title>{{ item.question }}</v-list-item-title>-->
<!--                </v-list-item>-->
            </v-list>
        </v-menu>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                read: [],
                unread: [],
                unreadCount: 0
            }
        },
        computed: {
            color() {
                return this.unreadCount > 0 ? 'red' : '';
            }
        },
        created() {
            if(User.loggedIn()) {
                this.getNotifications()
            }

            Echo.private('App.User.' + User.id())
                .notification((notification) => {
                    this.unread.unshift(notification)
                    this.unreadCount++
                });
        },
        methods: {
            getNotifications() {
                axios.post('/api/notifications')
                    .then(res => {
                        this.read = res.data.read;
                        this.unread = res.data.unread;
                        this.unreadCount = res.data.unread.length > 0 ? res.data.unread.length : '';
                    })
                    .catch(error => Exception.handle(error))
            },
            readNoti(noti) {
                axios.post('/api/markAsRead', {id: noti.id})
                    .then(res => {
                        this.unread.splice(noti, 1);
                        this.read.push(noti);
                        this.unreadCount--;
                    })
            }
        }
    }
</script>

<style scoped>

</style>
