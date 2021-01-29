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
                        url: "{{ route('validation.uniqueUsername') }}",
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
                        url: "{{ route('validation.uniqueEmail') }}",
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
                    required: "{{ trans('front.select_user_group') }}"
                },
                first_name: {
                    required: "{{ trans('front.first_name') . trans('front.required_not_empty') }}"
                },
                last_name: {
                    required: "{{ trans('front.last_name') . trans('front.required_not_empty') }}"
                },
                username: {
                    required: "{{ trans('front.username') . trans('front.required_not_empty') }}",
                    minlength: "{{ trans('front.username') . trans('front.required_length') }}",
                    remote: "{{ trans('front.username_taken') }}"
                },
                password: {
                    required: "{{ trans('front.password') . trans('front.required_not_empty') }}",
                    minlength: "{{ trans('front.password') . trans('front.required_length') }}"
                },
                password_confirmation: {
                    equalTo: "{{ trans('front.passwords_not_match') }}"
                },
                email: {
                    required: "{{ trans('front.email') . trans('front.required_not_empty') }}",
                    remote: "{{ trans('front.email_taken') }}"
                },
                state_id: {
                    required: "{{ trans('fromDB.select_state') }}"
                },
                city: {
                    required: "{{ trans('front.city') . trans('front.required_not_empty') }}"
                },
                addr_1: {
                    required: "{{ trans('front.address') . trans('front.required_not_empty') }}"
                },
                zip: {
                    required: "{{ trans('fromDB.zip') . trans('front.required_not_empty') }}"
                },
                hiddenRecaptcha: {
                    required: "{{ trans('front.recaptcha_required') }}"
                }
            }
        });

    })
</script>