<template>
    <main role="main" class="container-fluid mt-3">
        <stream v-if="favorite" :streamer="favorite" :events="events"></stream>

        <div v-else class="row justify-content-center">
            <div class="col-md-4">
                <div class="text-center">
                    Please <a href="#" data-toggle="modal" data-target="#favoriteModal">select your favorite streamer</a> to proceed.
                </div>
            </div>
        </div>

        <favourite></favourite>
    </main>
</template>

<script>
    import Favourite from './Favourite';
    import Stream from './Stream';

    export default {
        components: {
            Favourite,
            Stream
        },

        data() {
            return {
                favorite: null,
                events: []
            }
        },

        mounted() {
            this.favorite = this.$store.state.user.favorite;

            if (!this.favorite) {
                $('#favoriteModal').modal('toggle');
            }
        },

        watch: {
            favorite: function (current, previous) {
                if (previous) {
                    if (current.twitch_id != previous.twitch_id) {
                        Echo.leave('streamers.' + previous.twitch_id);
                        this.events = [];
                    }
                }
                Echo.channel('streamers.' + current.twitch_id)
                    .listen('.streamer.followed', (e) => {
                        this.events.push(e.message);
                        if (this.events.length > 10) {
                            this.events.shift();
                        }
                    });
            }
        }
    }
</script>
