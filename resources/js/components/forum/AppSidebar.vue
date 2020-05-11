<template>
    <v-card>
        <v-toolbar color="cyan" dark dense class="mt-2">
            <v-toolbar-title>Категории</v-toolbar-title>
        </v-toolbar>

        <v-list v-if="visible" dense>
            <v-list-item-group color="primary">
                <v-list-item
                    v-for="category in categories"
                    :key="category.id"
                >
                    <v-list-item-content>
                        <v-list-item-title v-text="category.name" class="grey--text"></v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list-item-group>
        </v-list>
        <v-progress-circular
            class="centered"
            v-else
            :width="2"
            color="primary"
            indeterminate
        ></v-progress-circular>
    </v-card>
</template>

<script>
    export default {
        data: () => ({
            categories: [],
            visible:false
        }),
        created() {
            axios.get('/api/category')
                .then(res => {
                    this.categories = res.data.data
                    this.visible = true
                })
        },
    }
</script>

<style scoped>
    .centered {
        margin: auto;
        position: absolute;
        top: 0; left: 0; bottom: 0; right: 0;
    }
</style>
