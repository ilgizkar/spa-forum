<template>
    <div>
        <v-alert v-if="errors" type="error" :value="true">
            Заполните все поля!
        </v-alert>
        <v-form @submit.prevent="create">
            <v-toolbar
                color="grey"
                dark
                flat
            >
                <v-toolbar-title>Создание вопроса</v-toolbar-title>
            </v-toolbar>
            <v-card-text>
                <v-text-field
                    v-model="form.title"
                    label="Заголовок"
                    type="text"
                    required
                ></v-text-field>

                <v-select
                    :items="categories"
                    item-text="name"
                    item-value="id"
                    v-model="form.category_id"
                    label="Категория"
                    autocomplete
                ></v-select>
                <vue-simplemde v-model="form.body" ref="markdownEditor" />
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    color="success"
                    class="mr-4"
                    type="submit"
                    :disabled="disabled"
                >
                    Опубликовать
                </v-btn>
            </v-card-actions>
        </v-form>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                form: {
                    title: '',
                    category_id: '',
                    body: ''
                },
                categories: [],
                errors: ''
            }
        },
        created() {
          axios.get('/api/category')
              .then(res => this.categories = res.data.data)
        },
        computed: {
            disabled() {
                return !(this.form.title && this.form.body && this.form.category_id)
            }
        },
        methods: {
            create() {
                axios.post('/api/question', this.form)
                    .then(res => this.$router.push(res.data.path))
                    .catch(error => this.errors = error.response.data)
            }
        }
    }
</script>

<style scoped>

</style>
