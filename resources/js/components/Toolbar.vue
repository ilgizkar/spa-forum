<template>
    <v-toolbar>
<!--    <v-app-bar-nav-icon></v-app-bar-nav-icon>-->
        <v-toolbar-title>SPA Forum</v-toolbar-title>
        <v-spacer></v-spacer>
        <div class="hidden-sm-and-down">
            <router-link to="/forum">
                <v-btn text small color="primary">Форум</v-btn>
            </router-link>
            <router-link to="/question">
                <v-btn text small color="primary">Задать вопрос</v-btn>
            </router-link>
            <router-link to="/category">
                <v-btn text small color="primary">Категории</v-btn>
            </router-link>
            <router-link to="/login">
                <v-btn text small color="primary">Войти</v-btn>
            </router-link>
        </div>
    </v-toolbar>
</template>

<script>
    export default {
        name: "Toolbar"
    }
</script>

<style scoped>

</style>
