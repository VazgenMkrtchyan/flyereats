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
                        url: "{{ route('validation.uniqueUsername') }}",
                        data: {
                            exceptId: "{{ $administrator->id or '' }}"
                        },
                        type: "POST"
                    }
                },
                password: {
                    required: "{{ isset($administrator) ? 'false' : 'true' }}" == "true",
                    minlength: 4
                },
                password_confirmation: {
                    equalTo: "#password"
                },
                email: {
                    required: true,
                    email: true,
                    remote: {
                        url: "{{ route('validation.uniqueEmail') }}",
                        data: {
                            exceptId: "{{ $administrator->id or '' }}"
                        },
                        type: "POST"
                    }
                }
            },

            messages: {
                first_name: {
                    required: "{{ trans('back.first_name') . trans('back.required_not_empty') }}"
                },
                last_name: {
                    required: "{{ trans('back.last_name') . trans('back.required_not_empty') }}"
                },
                username: {
                    required: "{{ trans('back.username') . trans('back.required_not_empty') }}",
                    minlength: "{{ trans('back.username') . trans('back.required_length') }}",
                    remote: "{{ trans('back.username_taken') }}"
                },
                password: {
                    required: "{{ trans('back.password') . trans('back.required_not_empty') }}",
                    minlength: "{{ trans('back.password') . trans('back.required_length') }}"
                },
                password_confirmation: {
                    equalTo: "{{ trans('back.passwords_not_match') }}"
                },
                email: {
                    required: "{{ trans('back.email') . trans('back.required_not_empty') }}",
                    remote: "{{ trans('back.username') . trans('back.required_length') }}"
                }
            }
        });

    })
</script>