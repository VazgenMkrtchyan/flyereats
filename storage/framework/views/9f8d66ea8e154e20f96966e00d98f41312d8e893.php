<!-- ASKS FOR DELETE CONFIRMATION -->
<script>
	$(document).ready(function() {
// Jquery function which listens for click events on elements which have a data-delete attribute
		$( "[data-delete]" ).click( function(event){
			event.preventDefault();
// If the user confirm the delete
			if ( confirm( $( this ).data( "confirm" ) ) ) {
// Get the route URL
				var url = $( this ).prop( "href" );
// Get the token
				var token = $( this ).data( "delete" );
// Create a form element
				var form = $( "<form>", { action: url, method: "post" } );
// Add the DELETE hidden input method
				var inputMethod = $( "<input>", { type: "hidden", name: "_method", value: "DELETE" });
// Add the token hidden input
				var inputToken = $( "<input>", { type: "hidden", name: "_token", value: token } );
// Append the inputs to the form, hide the form, append the form to the <body>, SUBMIT!
				form.append( inputMethod, inputToken ).hide()
						.appendTo( "body" ).submit();
			}
		});

	});
</script>