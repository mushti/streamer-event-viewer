<template>
    <nav class="navbar navbar-twitch bg-twitch navbar-expand-sm fixed-top">
        <router-link class="navbar-brand" to="/" exact>
            <img :src="$url + '/images/twitch-logo.svg'" class="mr-2" width="26" height="26"> Streamer Event Viewer
        </router-link>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle p-0" href="#" id="user-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img :src="$store.state.user.avatar" width="30" height="30" class="mr-1 rounded"> {{ $store.state.user.name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="user-menu">
                        <a href="#" class="dropdown-item" @click.prevent="logout">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
    export default {
        methods: {
            logout () {
                axios.post(this.$url + '/logout')
                    .then(response => {
                        this.$store.commit('logout');
                        this.$router.push({ name: 'login' });
                    });
            }
        }
    }
</script>
