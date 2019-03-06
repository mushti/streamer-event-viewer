<template>
    <main role="main" class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-4 text-center">
                <h1 class="mb-5">Streamer Event Viewer</h1>
                <a :href="$url + '/login/twitch'" class="btn btn-twitch px-3">
                    <img :src="$url + '/images/twitch-logo.svg'" class="mr-3" width="20" height="20"> Login with Twitch
                </a>
            </div>
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
