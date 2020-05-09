<template>
    <div>
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
                content: this.body.reply
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
            }
        }
    }
</script>

<style scoped>

</style>
