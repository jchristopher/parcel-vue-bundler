<template>

	<div class="parcel-vue-bundler-app">
		<h2>{{ msg }}</h2>
	</div>

</template>

<script>
export default {
	name: 'MbnApp',
	data () {
		return {
			msg: '🎉 Parcel Powered Vue Bundler WordPress Plugin! 🤓'
		}
	}
}
</script>

<style lang="scss">
	.parcel-vue-bundler-app {
		background: #fff;
		margin: 5em auto 0;
		max-width: 600px;
		padding: 2em;
		text-align: center;
		font-weight: bold;

		h2 {
			font-size: 1.8em;
		}
	}
</style>
