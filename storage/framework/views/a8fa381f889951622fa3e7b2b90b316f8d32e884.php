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
                            table: "models",
                            foreignKey: "make_id",
                            parentId: "<?php echo Route::input('makeId'); ?>",
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