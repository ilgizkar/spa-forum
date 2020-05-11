<template>
    <div class="mt-4">
        <v-alert v-if="errors" type="error" :value="true">
            Поле не должно быть пустым!
        </v-alert>
        <vue-simplemde v-model="body" ref="markdownEditor" />
        <v-btn
            @click.prevent="send"
            color="success"
            class="mr-4"
        >Отправить</v-btn>
    </div>
</template>

<script>
    export default {
        props: ['questionSlug'],
        data() {
            return {
                 body: '',
                errors: ''
            }
        },
        methods: {
            send() {
                axios.post(`/api/question/${this.questionSlug}/reply`, {body: this.body})
                    .then(res => {
                        this.body = '';
                        EventBus.$emit('newReply', res.data.reply);
                        window.scrollTo(0,0)
                    })
                    .catch(error => this.errors = error.response.data)
            }
        }
    }
</script>

<style scoped>

</style>
