<template>
    <v-toolbar>
<!--    <v-app-bar-nav-icon></v-app-bar-nav-icon>-->
        <v-toolbar-title>SPA Форум</v-toolbar-title>
        <v-spacer></v-spacer>
        <div class="hidden-sm-and-down">

            <router-link
                v-for="item in items"
                :key="item.title"
                :to="item.to"
                v-if="item.show"
            >
                <v-btn text small color="primary">{{ item.title }}</v-btn>
            </router-link>

        </div>
    </v-toolbar>
</template>

<script>
    export default {
        data() {
            return {
                items: [
                    {title:'Форум', to:'/forum', show:true},
                    {title:'Задать вопрос', to:'/ask', show:User.loggedIn()},
                    {title:'Категории', to:'/category', show:User.loggedIn()},
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
