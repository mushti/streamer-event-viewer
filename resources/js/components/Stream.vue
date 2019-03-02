<template>
    <div class="row justify-content-center">
		<div class="col-md-3">
			<div class="card mb-3">
				<div class="card-header">
					Streamer
					<a href="#" class="float-right" data-toggle="modal" data-target="#favoriteModal">Change</a>
				</div>
				<img v-if="streamer.cover" :src="streamer.cover" class="card-img-top rounded-0" :alt="streamer.name">
				<div class="card-body">
					<div class="media">
						<img :src="streamer.avatar" class="rounded mr-3" width="44" height="44" :alt="streamer.name">
						<div class="media-body">
							<h5 class="mt-0 mb-0">{{ streamer.name }}</h5>
							<p class="card-text text-secondary">@{{ streamer.username }}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card mb-3" style="overflow: hidden">
				<div class="card-header">Live Stream</div>
				<iframe :src="'https://player.twitch.tv/?channel=' + streamer.username" height="400px" width="100%"
					frameborder="0" scrolling="yes" allowfullscreen="true" class="card-img-top">
				</iframe>
			</div>
		</div>
		<div class="col-md-3">
			<div class="card mb-3" style="overflow: hidden">
				<iframe :src="'https://www.twitch.tv/embed/' + streamer.username + '/chat'" height="447px" width="100%"
					frameborder="0" scrolling="no" id="chat_embed">
				</iframe>
			</div>
		</div>
	</div>
</template>

<script>
    export default {
    	props: [
    		'streamer'
    	],

        mounted() {

        }
    }
</script>
