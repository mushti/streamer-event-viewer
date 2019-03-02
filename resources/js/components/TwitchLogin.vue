<template>
    <main role="main" class="container-fluid">
        <div class="row justify-content-center">
            <a :href="$url + '/login/twitch'" class="btn btn-twitch">Login with Twitch</a>
        </div>
    </main>
</template>

<script>
    export default {
        mounted() {
            if (this.$store.state.user) {
                this.$router.push({ name: 'stream' });
            }
        }
    }
</script>
