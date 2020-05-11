<template>
    <div>
        <div  v-if="visible">
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
        <v-progress-circular
            class="centered"
            v-else
            :size="70"
            :width="7"
            color="primary"
            indeterminate
        ></v-progress-circular>
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
              editing: false,
              visible:false
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
                    .then(res => {
                        this.question = res.data.data
                        this.visible = true
                        NProgress.done()
                    })
            }
        }
    }
</script>

<style scoped>
    .centered {
        margin: auto;
        position: absolute;
        top: 0; left: 0; bottom: 0; right: 0;
    }
</style>
