<script>
    $( document ).ready( function() {

        //VALIDATION
        $( '#form-val' ).validate({
            rules: {
                name: {
                    required: true,
                    remote: {
                        url: "<?php echo route('validation.uniqueDetailName'); ?>",
                        data: {
                            table: "makes",
                            exceptId: "<?php echo Route::input('id'); ?>"
                        },
                        type: 'POST'
                    }
                },
                order: {
                    number: true,
                    min: 0
                }
            },

            messages: {
                name: {
                    required: "<?php echo trans('back.name') . trans('back.required_not_empty'); ?>",
                    remote: "<?php echo trans('back.name_taken'); ?>"
                }
            }
        });

    })
</script>