<template id="template-index-suggestion">
	<div class="row background-login suggestion">
	  <div class="col s12 m12">
	    <div class="row">
			<div class="col s5 offset-s7">
			  <div class="card small">
			  	<div class="row">
			  		<div class="col s12 m12">
				    	<h3>Todos los lugares a los que necesitas que lleguen tus camiones.</h3>
				    	<p>Obtén una solución integral que simplifique  y organice la productividad de tu empresa.</p>
				    	<a href="{{ url('admin/planificador') }}"><button class="btn light-blue darken-4"> Empezar</button></a>
			  		</div>
			  	</div>
			  </div>				
			</div>
		</div>
	  </div>
	</div>
</template>

<script>
	export default {
		template: "#template-index-suggestion",
		data() {
			
		}, 
		methods: {
			
		},
		props: {

		}
	}
</script>