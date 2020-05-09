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
    </div>
</template>

<script>
    import EditQuestion from "./EditQuestion"
    import ShowQuestion from "./ShowQuestion";
    export default {
        components: {ShowQuestion, EditQuestion},
        data() {
          return {
              question: '',
              editing: false
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
