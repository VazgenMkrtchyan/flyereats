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
                    required: "{{ trans('front.email') . trans('front.required_not_empty') }}"
                },
                password: {
                    required: "{{ trans('front.password') . trans('front.required_not_empty') }}",
                    minlength: "{{ trans('front.password') . trans('front.required_length') }}"
                },
                password_confirmation: {
                    equalTo: "{{ trans('front.passwords_not_match') }}"
                }
            }
        });

    })
</script>