<script>
    $( document ).ready( function() {

        $( "#search_filters" ).find( "select" ).change( function(){
            $( "#search_filters" ).submit();
        });

    })
</script>