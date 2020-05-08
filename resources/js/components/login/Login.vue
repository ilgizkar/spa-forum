<template>
    <v-form
        @submit.prevent="login"
    >
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

        <v-btn
            color="success"
            class="mr-4"
            type="submit"
        >
            Войти
        </v-btn>
    </v-form>
</template>

<script>
    export default {
        data: () => ({
            form: {
                email: '',
                password: ''
            },
        }),

        methods: {
            login () {
                User.login(this.form)
            }
        },
    }
</script>

<style scoped>

</style>
