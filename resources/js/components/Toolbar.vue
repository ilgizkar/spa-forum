<template>
    <v-toolbar>
<!--    <v-app-bar-nav-icon></v-app-bar-nav-icon>-->
        <v-toolbar-title>SPA Forum</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-toolbar-items class="hidden-sm-and-down">
            <v-btn text small color="primary">Форум</v-btn>
            <v-btn text small color="primary">Задать вопрос</v-btn>
            <v-btn text small color="primary">Категории</v-btn>
            <v-btn text small color="primary">Логин</v-btn>
        </v-toolbar-items>
    </v-toolbar>
</template>

<script>
    export default {
        name: "Toolbar"
    }
</script>

<style scoped>

</style>
