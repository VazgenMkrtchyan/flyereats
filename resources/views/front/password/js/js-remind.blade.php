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
                email: {
                    required: true,
                    email: true
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
                email: {
                    required: "{{ trans('front.email') . trans('front.required_not_empty') }}"
                },
                hiddenRecaptcha: {
                    required: "{{ trans('front.recaptcha_required') }}"
                }
            }
        });

    })
</script>