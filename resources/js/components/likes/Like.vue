<template>
    <div>
        <v-btn small icon>
            <v-icon
                v-if="liked"
                color="red"
                @click="dislike"
            >mdi-heart</v-icon>
            <v-icon
                v-else
                color="red"
                @click="like"
            >mdi-heart-outline</v-icon>
            {{ count }}
        </v-btn>

    </div>
</template>

<script>
    export default {
        props: ['reply'],
        data() {
            return {
                liked: this.reply.likedMe,
                count: this.reply.like_count,
            }
        },
        methods: {
            like() {
                if(User.loggedIn()) {
                    axios.post(`/api/like/${this.reply.id}`)
                        .then(res => {
                            this.liked = true;
                            this.incr();
                        })
                }
            },
            dislike() {
                if(User.loggedIn()) {
                    axios.delete(`/api/like/${this.reply.id}`)
                        .then(res => {
                            this.liked = false;
                            this.dicr();
                        })
                }
            },
            incr() {
                this.count++
            },
            dicr() {
                this.count--
            }
        }
    }
</script>

<style scoped>

</style>
