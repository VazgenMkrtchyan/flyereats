<script>
    $( document ).ready( function() {

        //VALIDATION
        $( '#form-val' ).validate({
            rules: {
                route_names: {
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
                route_names: {
                  required: "<?php echo trans('back.route_name') . trans('back.required_not_empty'); ?>"
                },
                description: {
                    required: "<?php echo trans('back.description') . trans('back.required_not_empty'); ?>",
                    remote: "<?php echo trans('back.name_taken'); ?>"
                }
            }
        });

    })
</script>