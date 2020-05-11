<template>
    <div>
        <v-alert v-if="errors" type="error" :value="true">
            Поле не должно быть пустым!
        </v-alert>
        <vue-simplemde v-model="content" ref="markdownEditor" />
        <v-btn
            @click.prevent="save"
            color="success"
            class="ml-2 mr-4 mb-4"
        >Сохранить</v-btn>
        <v-btn
            @click.prevent="hide"
            color="primary"
            class="ml-2 mb-4"
        >Закрыть</v-btn>
    </div>
</template>

<script>
    export default {
        props: ['body'],
        data() {
            return {
                content: this.body.reply,
                errors: ''
            }
        },
        methods:{
            hide() {
                EventBus.$emit('hideEditReply')
            },
            save() {
                axios.patch(`/api/question/${this.body.question_slug}/reply/${this.body.id}`, {body: this.content})
                    .then(res => {
                        this.body.reply = this.content;
                        this.hide();
                    })
                    .catch(error => this.errors = error.response.data)
            }
        }
    }
</script>

<style scoped>

</style>
