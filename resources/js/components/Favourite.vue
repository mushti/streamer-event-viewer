<template>
    <div class="modal fade" tabindex="-1" role="dialog" id="favoriteModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <label>Type in the username of your favorite Twitch streamer</label>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                            <input type="text" v-model="username" class="form-control">
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary btn-block" @click="save">Save</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                username: ''
            }
        },

        mounted() {
            if (this.$store.state.user.favorite) {
                this.username = this.$store.state.user.favorite.username;
            }
        },

        methods: {
            save () {
                axios.post(this.$url + '/api/favorite', {
                        _method: 'PUT',
                        username: this.username
                    }).then(response => {
                        this.$store.commit('updateFavourite', response.data);
                        this.$parent.favorite = response.data;
                        $('#favoriteModal').modal('toggle');
                    });
            }
        }
    }
</script>
