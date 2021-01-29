<script>
    $( document ).ready( function() {

        //validation
        $( '#form-val' ).validate({
            rules: {
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true,
                    remote: {
                        url: "<?php echo route('validation.uniqueEmail'); ?>",
                        data: {
                            exceptId: "<?php echo $user->id; ?>"
                        },
                        type: 'POST'
                    }
                },
                username: {
                    required: true,
                    minlength: 4,
                    remote: {
                        url: "<?php echo route('validation.uniqueUsername'); ?>",
                        data: {
                            exceptId: "<?php echo $user->id; ?>"
                        },
                        type: 'POST'
                    }
                },
                password: {
                    minlength: 4
                },
                password_confirmation: {
                    equalTo: "#password"
                }
            },

            messages: {
                first_name: {
                    required: "<?php echo trans('back.first_name') . trans('back.required_not_empty'); ?>"
                },
                last_name: {
                    required: "<?php echo trans('back.last_name') . trans('back.required_not_empty'); ?>"
                },
                email: {
                    required: "<?php echo trans('back.email') . trans('back.required_not_empty'); ?>",
                    remote: "<?php echo trans('back.email_taken'); ?>"
                },
                username: {
                    required: "<?php echo trans('back.username') . trans('back.required_not_empty'); ?>",
                    minlength: "<?php echo trans('back.username') . trans('back.required_length'); ?>",
                    remote: "<?php echo trans('back.username_taken'); ?>"
                },
                password: {
                    minlength: "<?php echo trans('back.password') . trans('back.required_length'); ?>"
                },
                password_confirmation: {
                    equalTo: "<?php echo trans('back.passwords_not_match'); ?>"
                }
            }
        });
    })
</script>