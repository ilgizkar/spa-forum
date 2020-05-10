<template>
    <div>
        <reply
            v-for="(reply, index) in content"
            v-if="content"
            :key="reply.id"
            :data="reply"
            :index="index"
        ></reply>
    </div>
</template>

<script>
    import Reply from './Reply'
    export default {
        props: ['question'],
        data() {
            return {
                content: this.question.replies
            }
        },
        components: {Reply},
        created() {
            this.listen()
        },
        methods: {
            listen() {
                EventBus.$on('newReply', (reply) => {
                    this.content.unshift(reply)
                    this.question.reply_count++
                });

                EventBus.$on('removeReply', (index) => {
                    axios.delete(`/api/question/${this.question.slug}/reply/${this.content[index].id}`)
                        .then(res => {
                            this.content.splice(index, 1);
                            this.question.reply_count--
                        })
                });

                Echo.private('App.User.' + User.id())
                    .notification((notification) => {
                        this.question.replies.unshift(notification.reply)
                        this.question.reply_count++
                    });

                Echo.channel('deleteReplyChannel')
                    .listen('DeleteReply',(e) => {
                        for(let index = 0 ;index < this.question.replies.length;index++){
                            if(this.question.replies[index].id == e.id){
                                this.question.replies.splice(index,1)
                            }
                        }
                        this.question.reply_count--
                    })
            }
        }
    }
</script>

<style scoped>

</style>
