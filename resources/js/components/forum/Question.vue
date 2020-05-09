<template>
    <v-card
        class="mt-4"
    >
        <v-card-title primary-title>
            <div>
                <h3 class="headline mb-0">
                    <router-link :to="data.path">
                        {{ data.title}}
                    </router-link>
                </h3>
            </div>
        </v-card-title>
        <v-card-subtitle>
            <div class="grey--text">от {{ data.user}}, {{ data.created_at}}</div>
        </v-card-subtitle>
        <v-card-text>
            {{ data.body}}
        </v-card-text>
    </v-card>
</template>

<script>
    export default {
        props: ['data']
    }
</script>

<style scoped>

</style>
