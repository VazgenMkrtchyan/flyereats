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
                        url: "{{ route('validation.uniqueEmail') }}",
                        data: {
                            exceptId: "{{ $user->id }}"
                        },
                        type: 'POST'
                    }
                },
                username: {
                    required: true,
                    minlength: 4,
                    remote: {
                        url: "{{ route('validation.uniqueUsername') }}",
                        data: {
                            exceptId: "{{ $user->id }}"
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
                    required: "{{ trans('back.first_name') . trans('back.required_not_empty') }}"
                },
                last_name: {
                    required: "{{ trans('back.last_name') . trans('back.required_not_empty') }}"
                },
                email: {
                    required: "{{ trans('back.email') . trans('back.required_not_empty') }}",
                    remote: "{{ trans('back.email_taken') }}"
                },
                username: {
                    required: "{{ trans('back.username') . trans('back.required_not_empty') }}",
                    minlength: "{{ trans('back.username') . trans('back.required_length') }}",
                    remote: "{{ trans('back.username_taken') }}"
                },
                password: {
                    minlength: "{{ trans('back.password') . trans('back.required_length') }}"
                },
                password_confirmation: {
                    equalTo: "{{ trans('back.passwords_not_match') }}"
                }
            }
        });
    })
</script>