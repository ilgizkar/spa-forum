<template>
    <v-card>
        <v-container fluid>
            <v-card-title>
                <div>
                    <div class="headline">
                        {{ data.title }}
                    </div>
                </div>
                <v-spacer></v-spacer>
                <v-btn color="success">{{ data.reply_count }} ответов</v-btn>
            </v-card-title>
            <v-card-subtitle>
               <span class="grey--text">
                    {{ data.user }}, {{ data.created_at }}
               </span>
            </v-card-subtitle>

            <v-card-text v-html="body"></v-card-text>
            <v-card-actions v-if="own">
                <v-btn icon small @click="edit">
                    <v-icon color="orange">mdi-pencil</v-icon>
                </v-btn>
                <v-btn icon small @click="destroy">
                    <v-icon color="red">mdi-delete</v-icon>
                </v-btn>
            </v-card-actions>
        </v-container>
    </v-card>
</template>

<script>
    export default {
        props: ['data'],
        data() {
            return {
                own: User.own(this.data.id),
                errors: {}
            }
        },
        computed: {
            body() {
                return md.parse(this.data.body)
            }
        },
        methods: {
            destroy() {
                axios.delete(`/api/question/${this.data.slug}`)
                    .then(res => this.$router.push('/forum'))
                    .catch(error => this.errors = error.response.data)
            },
            edit() {
                EventBus.$emit('startEditing')
            }
        }
    }
</script>

<style scoped>

</style>
