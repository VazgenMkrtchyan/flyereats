<script>
    $( document ).ready( function() {

        //validation
        $( "#form-val" ).validate({
            rules: {
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                username: {
                    required: true,
                    minlength: 4,
                    remote: {
                        url: "<?php echo route('validation.uniqueUsername'); ?>",
                        data: {
                            exceptId: "<?php echo isset($administrator->id) ? $administrator->id : ''; ?>"
                        },
                        type: "POST"
                    }
                },
                password: {
                    required: "<?php echo isset($administrator) ? 'false' : 'true'; ?>" == "true",
                    minlength: 4
                },
                password_confirmation: {
                    equalTo: "#password"
                },
                email: {
                    required: true,
                    email: true,
                    remote: {
                        url: "<?php echo route('validation.uniqueEmail'); ?>",
                        data: {
                            exceptId: "<?php echo isset($administrator->id) ? $administrator->id : ''; ?>"
                        },
                        type: "POST"
                    }
                }
            },

            messages: {
                first_name: {
                    required: "<?php echo trans('back.first_name') . trans('back.required_not_empty'); ?>"
                },
                last_name: {
                    required: "<?php echo trans('back.last_name') . trans('back.required_not_empty'); ?>"
                },
                username: {
                    required: "<?php echo trans('back.username') . trans('back.required_not_empty'); ?>",
                    minlength: "<?php echo trans('back.username') . trans('back.required_length'); ?>",
                    remote: "<?php echo trans('back.username_taken'); ?>"
                },
                password: {
                    required: "<?php echo trans('back.password') . trans('back.required_not_empty'); ?>",
                    minlength: "<?php echo trans('back.password') . trans('back.required_length'); ?>"
                },
                password_confirmation: {
                    equalTo: "<?php echo trans('back.passwords_not_match'); ?>"
                },
                email: {
                    required: "<?php echo trans('back.email') . trans('back.required_not_empty'); ?>",
                    remote: "<?php echo trans('back.username') . trans('back.required_length'); ?>"
                }
            }
        });

    })
</script>