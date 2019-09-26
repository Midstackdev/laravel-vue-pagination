<template>
	<div class="media mb-2">
	  <img class="mr-3" src="https://via.placeholder.com/64" alt="Generic placeholder image">
	  <div class="media-body">
	    <h5 class="mt-0">{{user.name}}</h5>
	    {{user.email}}
	  </div>
	</div>
</template>

<script>
	export default {
		props:['user'],
	}
</script>