<script>
    $( document ).ready( function() {

        //VALIDATION
        var formVal = $( "#form-val" );

        formVal.validate({
            rules: {
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                password: {
                    minlength: 6
                },
                password_confirmation: {
                    equalTo: "#password"
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
                }
            },

            messages: {
                first_name: {
                    required: "{{ trans('front.first_name') . trans('front.required_not_empty') }}"
                },
                last_name: {
                    required: "{{ trans('front.last_name') . trans('front.required_not_empty') }}"
                },
                password: {
                    minlength: "{{ trans('front.password') . trans('front.required_length') }}"
                },
                password_confirmation: {
                    equalTo: "{{ trans('front.passwords_not_match') }}"
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
                }
            }
        });

        //EMAIL CHANGE MODAL VALIDATION
        var emailChangeForm = $( '#form-change-email' );
        var modalChangeEmail = $( "#modal-change-email");

        emailChangeForm.validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                    remote: {
                        url: "{{ route('validation.uniqueEmail') }}",
                        type: "POST"
                    }
                }
            },

            messages: {
                email: {
                    required: "{{ trans('front.email') . trans('front.required_not_empty') }}",
                    remote: "{{ trans('front.email_taken') }}"
                }
            }
        });

        emailChangeForm.on( 'submit', function( e ) {
            e.preventDefault();
            //checks if the form is valid
            if ( $( this ).valid() ) {
                $.ajax({
                    type: "POST",
                    url: $( this ).attr('action'),
                    data: $( this ).serialize(),
                    dataType: 'json',

                    success: function (response) {
                        //listens to response
                        if (response.status == 'CHANGED') {
                            $("#alert-email-changed").show();
                            $("#form-val").find("[name='email']").val(response.newEmail);
                        }
                        else {
                            $("#alert-email-change-confirm").show();
                        }
                        //scrolls to page top to show notification
                        $(' html, body ').animate({ scrollTop: 0 }, 'slow');
                    },

                    error: function ( error ) {
                        alert('oops! something went wrong! try again!');
                        console.log( error )
                    },

                    complete: function() {
                        modalChangeEmail.modal( 'hide' );
                    }
                });

            }

        });

        modalChangeEmail.on( "show.bs.modal", function() {
            //hides unnecessary alerts if exists
            $( "#alert-email-changed, #alert-email-change-confirm" ).hide();
        });

    })

</script>