<template>
	<nav>
		<ul class="pagination">
			<li class="page-item" :class="{ 'disabled' : meta.current_page === 1}">
				<a class="page-link" href="#" @click.prevent="switched(meta.current_page - 1)">&laquo;</a>
			</li>

			<template v-if="section > 1">
				<li class="page-item">
					<a class="page-link" href="#" @click.prevent="switched(1)">1</a>
				</li>
				<li class="page-item">
					<a class="page-link" href="#" @click.prevent="goBackASection">...</a>
				</li>
			</template>

			<li class="page-item" v-for="page in pages" :class="{ 'active' : meta.current_page === page }">
				<a class="page-link" href="#" @click.prevent="switched(page)">{{ page }}</a>
			</li>

			<template v-if="section < sections">
				<li class="page-item">
					<a class="page-link" href="#" @click.prevent="goForwardASection">...</a>
				</li>
				<li class="page-item">
					<a class="page-link" href="#" @click.prevent="switched(meta.last_page)">{{meta.last_page}}</a>
				</li>
			</template>

			<li class="page-item" :class="{ 'disabled' : meta.current_page === meta.last_page}">
				<a class="page-link" href="#" @click.prevent="switched(meta.current_page + 1)">&raquo;</a>
			</li>
		</ul>

		<p>sections: {{sections}}</p>
		<p>section: {{section}}</p>
		<p>last page: {{lastPage}}</p>
	</nav>
</template>

<script>
	export default {
		props: ['meta'],

		data() {
			return {
				numberPerSection: 12
			}
		},

		computed: {
			section() {
				return Math.ceil(this.meta.current_page / this.numberPerSection)
			},

			sections() {
				return Math.ceil(this.meta.last_page / this.numberPerSection)
			},

			lastPage() {
				let lastPage = ((this.section - 1) * this.numberPerSection) + this.numberPerSection
				
				if(this.section === this.sections) {
					lastPage = this.meta.last_page
				}
				
				return lastPage
			},

			pages() {
				return _.range(
					(this.section - 1) * this.numberPerSection + 1, 
					this.lastPage + 1
				)
			}
		},

		methods: {
			switched (page) {
				if(page <= 0 || page > this.meta.last_page) {
					return
				}
				this.$emit('pagination:switched', page)
			},

			goBackASection() {
				this.switched(
					this.firstPageOfSection(this.section - 1)
				)
			},

			goForwardASection() {
				this.switched(
					this.firstPageOfSection(this.section + 1)
				)
			},

			firstPageOfSection(section) {
				return (section - 1) * this.numberPerSection + 1
			}
		}
	}
</script>