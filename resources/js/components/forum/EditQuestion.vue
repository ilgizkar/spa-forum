<template>
    <v-form @submit.prevent="update">
        <v-toolbar
            color="grey"
            dark
            flat
        >
            <v-toolbar-title>Редактирование вопроса</v-toolbar-title>
        </v-toolbar>
        <v-card-text>
            <v-text-field
                v-model="form.title"
                label="Заголовок"
                type="text"
                required
            ></v-text-field>

            <vue-simplemde v-model="form.body" ref="markdownEditor" />
        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
                color="success"
                class="mr-4"
                type="submit"
            >
                Сохранить
            </v-btn>
            <v-btn
                color="primary"
                class="mr-4"
                @click="back"
            >
                Назад
            </v-btn>
        </v-card-actions>
    </v-form>
</template>

<script>
    export default {
        props: ['data'],
        data() {
            return {
                errors: {},
                form: {
                    title: this.data.title,
                    body: this.data.body
                }
            }
        },
        methods: {
            update() {
                axios.patch(`/api/question/${this.data.slug}`, this.form)
                    .then(res => {
                        this.back();
                        this.data.title = this.form.title;
                        this.data.body = this.form.body;
                    })
                    .catch(error => this.errors = error.response.data)
            },
            back() {
                EventBus.$emit('endEditing')
            }
        }
    }
</script>

<style scoped>

</style>
