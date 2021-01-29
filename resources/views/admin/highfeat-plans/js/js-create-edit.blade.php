<script>
    $( document ).ready( function() {

        //VALIDATION
        $( '#form-val' ).validate({
            rules: {
                price: {
                    number: true,
                    min: 0
                },
                duration: {
                    required: true,
                    number: true,
                    min: 1
                },
                order: {
                    number: true,
                    min: 0
                }
            }
        });

    })
</script>