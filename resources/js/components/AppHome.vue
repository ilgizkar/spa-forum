<template>
    <v-app>
        <v-content>
            <toolbar></toolbar>
            <v-container>
                <router-view></router-view>
            </v-container>
            <app-footer></app-footer>
        </v-content>
    </v-app>
</template>

<script>
    import toolbar from './Toolbar'
    import AppFooter from './AppFooter'
    import Login from "./login/Login";
    export default {
        components: {toolbar, AppFooter, Login}
    };
</script>
