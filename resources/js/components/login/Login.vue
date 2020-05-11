<template>
    <v-container>
        <v-row
            align="center"
            justify="center"
        >
            <v-col
                cols="12"
                sm="8"
                md="4"
            >
                <v-card class="elevation-12">
                    <v-form
                        @submit.prevent="login"
                    >
                        <v-toolbar
                            color="primary"
                            dark
                            flat
                        >
                            <v-toolbar-title>Авторизация</v-toolbar-title>
                        </v-toolbar>
                        <v-card-text>
                            <v-text-field
                                v-model="form.email"
                                label="E-mail"
                                type="email"
                                required
                            ></v-text-field>

                            <v-text-field
                                v-model="form.password"
                                label="Пароль"
                                type="password"
                                required
                            ></v-text-field>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn
                                color="success"
                                class="mr-4"
                                type="submit"
                            >
                                Войти
                            </v-btn>
                            <router-link to="/signup">
                                <v-btn class="mr-4" color="primary">Регистрация</v-btn>
                            </router-link>
                        </v-card-actions>
                    </v-form>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>


<script>
    export default {
        data: () => ({
            form: {
                email: '',
                password: ''
            },
        }),
        created() {
            if(User.loggedIn()) {
                this.$router.push({name:'forum'})
            }
        },
        methods: {
            login () {
                User.login(this.form)
            }
        },
    }
</script>

<style scoped>

</style>
