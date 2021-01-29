<script>
    //removes error from the field
    function recaptchaCallback() {
        $( '#hiddenRecaptcha' ) . valid();
    }

    $( document ).ready( function() {

        //validation
        $('#form-val').validate({
            ignore: '.ignore',
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                subject: {
                    required: true
                },
                message: {
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
                name: {
                    required: "<?php echo trans('front.name') . trans('front.required_not_empty'); ?>"
                },
                email: {
                    required: "<?php echo trans('front.email') . trans('front.required_not_empty'); ?>"
                },
                subject: {
                    required: "<?php echo trans('front.subject') . trans('front.required_not_empty'); ?>"
                },
                message: {
                    required: "<?php echo trans('front.message') . trans('front.required_not_empty'); ?>"
                },
                hiddenRecaptcha: {
                    required: "<?php echo trans('front.recaptcha_required'); ?>"
                }
            }
        });

    })
</script>