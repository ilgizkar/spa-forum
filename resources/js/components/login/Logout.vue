<script>
    export default {
        created() {
            EventBus.$emit('logout');
        }
    }
</script>

<style scoped>

</style>
