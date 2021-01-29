<script>
    $( document ).ready( function(){

        //validation
        $('#form-val').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 6
                },
                password_confirmation: {
                    equalTo: "#password"
                }
            },

            messages: {
                email: {
                    required: "<?php echo trans('front.email') . trans('front.required_not_empty'); ?>"
                },
                password: {
                    required: "<?php echo trans('front.password') . trans('front.required_not_empty'); ?>",
                    minlength: "<?php echo trans('front.password') . trans('front.required_length'); ?>"
                },
                password_confirmation: {
                    equalTo: "<?php echo trans('front.passwords_not_match'); ?>"
                }
            }
        });

    })
</script>