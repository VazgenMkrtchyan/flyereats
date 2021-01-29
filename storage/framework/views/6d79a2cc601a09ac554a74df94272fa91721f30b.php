<?php echo $__env->make('admin.js.dropdowns', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script>
    $( document ).ready( function() {
        //initializes make/model dropdown
        dropdownInit( "<?php echo route('api_models'); ?>", "#make", "#model", "<?php echo Input::get('model'); ?>", "<?php echo trans('front.all_models'); ?>", "<?php echo trans('front.all_models'); ?>", "activeL", "", "<?php echo trans('front.loading'); ?>" );


        //VALIDATION
        var formVal = $( "#form-val" );

        formVal.validate({
            rules: {
                zip: {
                    minlength: 4,
                    remote: {
                        url: "<?php echo route('validation.validZIP'); ?>",
                        type: "POST"
                    }
                }
            },

            messages: {
                zip: {
                    remote: "<?php echo trans('front.enter_valid_zip'); ?>"
                }
            }
        });

    })
</script>