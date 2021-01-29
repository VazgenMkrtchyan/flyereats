<script>
    //removes error from the field
    function recaptchaCallback() {
        $( '#hiddenRecaptcha' ) . valid();
    }

    $( document ).ready( function() {

        //VALIDATION
        var formVal = $( "#form-val" );

        formVal.validate({
            ignore: '.ignore',
            rules: {
                user_group_id: {
                    required: true
                },
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
                        type: "POST"
                    }
                },
                password: {
                    required: true,
                    minlength: 6
                },
                password_confirmation: {
                    equalTo: "#password"
                },
                email: {
                    required: true,
                    email: true,
                    remote: {
                        url: "<?php echo route('validation.uniqueEmail'); ?>",
                        type: "POST"
                    }
                },
                state_id: {
                    required: true
                },
                city: {
                    required: true
                },
                addr_1: {
                    required: true
                },
                zip: {
                    required: true
                },
                hiddenRecaptcha: {
                    required: function () {
                        if (grecaptcha.getResponse() == '') {
                            return true;
                        } else {
                            return false;
                        }
                    }
                }
            },

            messages: {
                user_group_id: {
                    required: "<?php echo trans('front.select_user_group'); ?>"
                },
                first_name: {
                    required: "<?php echo trans('front.first_name') . trans('front.required_not_empty'); ?>"
                },
                last_name: {
                    required: "<?php echo trans('front.last_name') . trans('front.required_not_empty'); ?>"
                },
                username: {
                    required: "<?php echo trans('front.username') . trans('front.required_not_empty'); ?>",
                    minlength: "<?php echo trans('front.username') . trans('front.required_length'); ?>",
                    remote: "<?php echo trans('front.username_taken'); ?>"
                },
                password: {
                    required: "<?php echo trans('front.password') . trans('front.required_not_empty'); ?>",
                    minlength: "<?php echo trans('front.password') . trans('front.required_length'); ?>"
                },
                password_confirmation: {
                    equalTo: "<?php echo trans('front.passwords_not_match'); ?>"
                },
                email: {
                    required: "<?php echo trans('front.email') . trans('front.required_not_empty'); ?>",
                    remote: "<?php echo trans('front.email_taken'); ?>"
                },
                state_id: {
                    required: "<?php echo trans('fromDB.select_state'); ?>"
                },
                city: {
                    required: "<?php echo trans('front.city') . trans('front.required_not_empty'); ?>"
                },
                addr_1: {
                    required: "<?php echo trans('front.address') . trans('front.required_not_empty'); ?>"
                },
                zip: {
                    required: "<?php echo trans('fromDB.zip') . trans('front.required_not_empty'); ?>"
                },
                hiddenRecaptcha: {
                    required: "<?php echo trans('front.recaptcha_required'); ?>"
                }
            }
        });

    })
</script>