<template>
    <v-container fluid grid-list-md>
        <v-layout row wrap>
            <v-flex xs8>
                <question
                v-for="question in questions"
                :key="question.path"
                :data=question
                ></question>
                <div class="text-xs-center">
                    <v-pagination
                        v-model="meta.current_page"
                        :length="pagiCount"
                        @input="changePage"
                    ></v-pagination>
                </div>
            </v-flex>
            <v-flex pa-4>
                <app-sidebar></app-sidebar>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    import AppSidebar from "./AppSidebar";
    import question from './Question'
    export default {
        components: {question, AppSidebar},
        data() {
            return {
                questions: [],
                meta: {},
                pagiCount: 1
            }
        },
        created() {

            axios.get('/api/question')
                .then(res => {
                    this.questions = res.data.data
                    this.meta = res.data.meta
                    this.pagiCount = Math.ceil(this.meta.total/this.meta.to);
                })
                .catch(error => console.log(error.response.data))
        },
        methods: {
            changePage(page) {
                axios.get(`/api/question?page=${page}`)
                    .then(res => {
                        this.questions = res.data.data
                        this.meta = res.data.meta
                    })
                    .catch(error => console.log(error.response.data))
            }
        }
    }
</script>

<style scoped>

</style>
