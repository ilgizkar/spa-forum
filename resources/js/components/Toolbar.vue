<template>
    <v-toolbar color="indigo" dark>
        <v-toolbar-title>
            <router-link class="white--text" to="/">SPA Форум</router-link>
        </v-toolbar-title>
        <v-spacer></v-spacer>
        <app-notification v-if="loggedIn"></app-notification>
        <div class="hidden-sm-and-up ml-3">
            <div class="text-center">
                <v-menu offset-y>
                    <template v-slot:activator="{ on }">
                        <v-app-bar-nav-icon v-on="on"></v-app-bar-nav-icon>
                    </template>
                    <v-list>
                        <v-list-item  v-for="item in items" v-if="item.show" :key="item.title">
                            <router-link
                                :to="item.to"
                            >
                                <v-btn text>{{ item.title }}</v-btn>
                            </router-link>
                        </v-list-item>
                    </v-list>
                </v-menu>
            </div>
        </div>
        <div class="hidden-sm-and-down">

            <router-link
                v-for="item in items"
                :key="item.title"
                :to="item.to"
                v-if="item.show"
            >
                <v-btn text>{{ item.title }}</v-btn>
            </router-link>

        </div>
    </v-toolbar>
</template>

<script>
    import AppNotification from "./AppNotification";
    export default {
        components: {AppNotification},
        data() {
            return {
                loggedIn: User.loggedIn(),
                items: [
                    {title:'Форум', to:'/forum', show:true},
                    {title:'Задать вопрос', to:'/ask', show:User.loggedIn()},
                    {title:'Категории', to:'/category', show:User.admin()},
                    {title:'Войти', to:'/login', show:!User.loggedIn()},
                    {title:'Выйти', to:'/logout', show:User.loggedIn()},
                ]
            }
        },
        created() {
            EventBus.$on('logout', () => {
                User.logout()
            })
        }
    }
</script>

<style scoped>

</style>
