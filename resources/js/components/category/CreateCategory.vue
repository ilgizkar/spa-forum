<template>
    <div>
        <v-alert v-if="errors" type="error" :value="true">
            Поле категории обязательно для заполнения!
        </v-alert>
        <v-form @submit.prevent="create">
            <v-toolbar
                color="grey"
                dark
                flat
            >
                <v-toolbar-title v-if="editSlug">Редактирование категории</v-toolbar-title>
                <v-toolbar-title v-else>Создание категории</v-toolbar-title>
            </v-toolbar>
            <v-card-text>

                <v-text-field
                    v-model="form.name"
                    label="Заголовок"
                    type="text"
                    required
                ></v-text-field>

            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    color="success"
                    class="mr-4"
                    type="submit"
                    :disabled="disabled"
                >
                    Сохранить
                </v-btn>
            </v-card-actions>
        </v-form>


        <v-card>
            <v-toolbar color="cyan" dark dense class="mt-2">
                <v-toolbar-title>Все категории</v-toolbar-title>
            </v-toolbar>

            <v-list dense>
                <v-list-item-group color="primary">
                    <v-list-item
                        v-for="(category, index) in categories"
                        :key="category.id"
                    >
                        <v-list-item-icon>
                            <v-btn icon @click="update(category, index)">
                                <v-icon color="orange">mdi-pencil</v-icon>
                            </v-btn>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title v-text="category.name" class="grey--text"></v-list-item-title>
                        </v-list-item-content>
                        <v-spacer></v-spacer>
                        <v-btn icon @click="destroy(category, index)">
                            <v-icon color="red">mdi-delete</v-icon>
                        </v-btn>
                    </v-list-item>
                </v-list-item-group>
            </v-list>
        </v-card>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                form: {
                    name: ''
                },
                categories: [],
                editSlug: null,
                errors: ''
            }
        },
        computed: {
            disabled() {
                return !(this.form.name)
            }
        },
        created() {
            if(!User.admin()) {
                this.$router.push('/forum')
            }
            axios.get('/api/category')
                .then(res => this.categories = res.data.data)
        },
        methods: {
            create() {
                this.editSlug ? this.edit() : this.newCat()
            },
            edit() {
                axios.patch(`/api/category/${this.editSlug}`, this.form)
                    .then(res => {
                        this.categories.unshift(res.data)
                        this.form.name = ''
                    })
                    .catch(error => this.errors = error.response.data.errors)
            },
            newCat() {
                axios.post('/api/category', this.form)
                    .then(res => {
                        this.categories.unshift(res.data)
                        this.form.name = ''
                    })
                    .catch(error => this.errors = error.response.data.errors)
            },
            update(category, index) {
                this.form.name = category.name;
                this.editSlug = category.slug;
                this.categories.splice(index, 1)
            },
            destroy(category, index) {
                axios.delete(`/api/category/${category.slug}`)
                    .then(res => this.categories.splice(index, 1))
            }
        }
    }
</script>

<style scoped>

</style>
