<template>
    <div  v-if="question">
        <edit-question
            :data = question
            v-if="editing"
        ></edit-question>
        <show-question
            v-else
            :data = question
        ></show-question>
        <v-container>
            <replies :question="question"></replies>
            <new-reply v-if="loggedIn" :questionSlug="question.slug"></new-reply>
        </v-container>
    </div>
</template>

<script>
    import EditQuestion from "./EditQuestion"
    import ShowQuestion from "./ShowQuestion";
    import Replies from "../reply/Replies";
    import NewReply from "../reply/NewReply";
    export default {
        components: {ShowQuestion, EditQuestion, Replies, NewReply},
        data() {
          return {
              question: '',
              editing: false
          }
        },
        computed: {
            loggedIn() {
                return User.loggedIn()
            }
        },
        created() {
            this.listen()
            this.getQuestion()
        },
        methods: {
            listen() {
                EventBus.$on('startEditing', () => {
                    this.editing = true
                })
                EventBus.$on('endEditing', () => {
                    this.editing = false
                })
            },
            getQuestion() {
                axios.get(`/api/question/${this.$route.params.slug}`)
                    .then(res => this.question = res.data.data)
            }
        }
    }
</script>

<style scoped>

</style>
