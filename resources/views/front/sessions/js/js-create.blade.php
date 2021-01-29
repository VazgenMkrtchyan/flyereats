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
                username: {
                    required: true
                },
                password: {
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
                username: {
                    required: "{{ trans('front.enter_username') }}"
                },
                password: {
                    required: "{{ trans('front.enter_password') }}"
                },
                hiddenRecaptcha: {
                    required: "{{ trans('front.recaptcha_required') }}"
                }
            }
        });

    })
</script>