<template>
    <div class="mt-4">
        <v-card>
            <v-card-title>
                <div class="headlin">{{ data.user }}</div>
                <v-spacer></v-spacer>
                <like :reply="data"></like>
            </v-card-title>
            <v-card-subtitle>
                <div>{{ data.created_at }}</div>
            </v-card-subtitle>

            <edit-reply :body="data" v-if="editingReply"></edit-reply>
            <v-card-text v-else v-html="reply"></v-card-text>

            <v-card-actions v-if="own && !editingReply">
                <v-btn class="ml-2" icon small @click="edit">
                    <v-icon color="orange">mdi-pencil</v-icon>
                </v-btn>
                <v-btn class="ml-3" icon small @click="destroy">
                    <v-icon color="red">mdi-delete</v-icon>
                </v-btn>
            </v-card-actions>

        </v-card>
    </div>
</template>

<script>
    import Like from '../likes/Like'
    import EditReply from './EditReply'
    export default {
        props: ['data','index'],
        components: {EditReply, Like},
        data() {
            return {
                editingReply: false
            }
        },
        computed: {
            own() {
                return User.own(this.data.user_id) || User.admin()
            },
            reply() {
                return md.parse(this.data.reply)
            }
        },
        created() {
            this.listen()
        },
        methods: {
            listen() {
                EventBus.$on('hideEditReply', () => {
                    this.editingReply = false
                });
            },
            destroy() {
                EventBus.$emit('removeReply', this.index)
            },
            edit() {
                this.editingReply = true
            }
        }
    }
</script>

<style scoped>

</style>
