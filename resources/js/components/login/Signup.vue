<template>
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
                    @submit.prevent="signup"
                >
                <v-toolbar
                    color="primary"
                    dark
                    flat
                >
                    <v-toolbar-title>Регистрация</v-toolbar-title>
                </v-toolbar>
                <v-card-text>
                        <v-text-field
                            v-model="form.name"
                            label="Имя*"
                            type="text"
                            required
                        ></v-text-field>
                    <span class="red--text" v-if="errors.name">{{errors.name[0]}}</span>

                        <v-text-field
                            v-model="form.email"
                            label="E-mail*"
                            type="email"
                            required
                        ></v-text-field>
                    <span class="red--text" v-if="errors.email">{{errors.email[0]}}</span>

                        <v-text-field
                            v-model="form.password"
                            label="Пароль*"
                            type="password"
                            required
                        ></v-text-field>
                    <span class="red--text" v-if="errors.password">{{errors.password[0]}}</span>

                        <v-text-field
                            v-model="form.password_confirmation"
                            label="Повторите пароль*"
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
                        Зарегистрироваться
                    </v-btn>
                    <router-link to="/login">
                        <v-btn class="mr-4" color="primary">Войти</v-btn>
                    </router-link>
                </v-card-actions>
                </v-form>
            </v-card>
        </v-col>
    </v-row>
</template>

<script>
    export default {
        data: () => ({
            form: {
                email: '',
                password: '',
                name: '',
                password_confirmation: ''
            },
            errors: {}
        }),
        created() {
            if(User.loggedIn()) {
                this.$router.push({name:'forum'})
            }
        },
        methods: {
            signup() {
                axios.post('/api/auth/signup', this.form)
                    .then(res => {
                        User.responseAfterLogin(res)
                        this.$router.push({name: 'forum'})
                    })
                    .catch(error => this.errors = error.response.data.errors)
            }
        }
    }
</script>

<style scoped>

</style>
