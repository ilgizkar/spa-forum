<template>
    <div>
        <v-container fluid grid-list-md v-if="visible">
            <v-layout row wrap>
                <v-flex xs12 lg8>
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
    import AppSidebar from "./AppSidebar";
    import question from './Question'
    export default {
        components: {question, AppSidebar},
        data() {
            return {
                questions: [],
                meta: {},
                pagiCount: 1,
                visible:false
            }
        },
        created() {

            axios.get('/api/question')
                .then(res => {
                    this.questions = res.data.data
                    this.meta = res.data.meta
                    this.pagiCount = Math.ceil(this.meta.total/this.meta.to);
                    this.visible = true
                    NProgress.done()
                })
                .catch(error => console.log(error.response.data))
        },
        methods: {
            changePage(page) {
                NProgress.start()
                axios.get(`/api/question?page=${page}`)
                    .then(res => {
                        this.questions = res.data.data
                        this.meta = res.data.meta
                        NProgress.done()
                    })
                    .catch(error => console.log(error.response.data))
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
