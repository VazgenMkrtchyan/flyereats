<script>
    $( document ).ready( function() {

        //VALIDATION
        $( '#form-val' ).validate({
            rules: {
                name: {
                    required: true
                },
                description: {
                    required: true
                },
                order: {
                    number: true,
                    min: 0
                }
            },

            messages: {
                name: {
                    required: "{{ trans('back.name') . trans('back.required_not_empty') }}"
                },
                description: {
                    required: "{{ trans('back.description') . trans('back.required_not_empty') }}"
                }
            }
        });

    })
</script>