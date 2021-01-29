<script>
    $( document ).ready( function() {

        //enquiry modal initialization
        var modalContact = $( "#modal-contact" );
        modalContact
                .one( "show.bs.modal", function() {
                    //loads validation script and validation rules for modals
                    $.getScript( "{{ asset('templates/assets/formValidation/formValidation.min.js') }}", function() {
                        //validation (Enquiry)
                        $( '#form-val' ).formValidation({
                            framework: 'bootstrap',
                            icon: {
                                valid: 'glyphicon glyphicon-ok',
                                invalid: 'glyphicon glyphicon-remove',
                                validating: 'glyphicon glyphicon-refresh'
                            },
                            fields: {
                                name: {
                                    validators: {
                                        notEmpty: {
                                            message: 'Name is required and cannot be empty'
                                        }
                                    }
                                },
                                email: {
                                    validators: {
                                        notEmpty: {
                                            message: 'Email is required and cannot be empty'
                                        }
                                    }
                                },
                                subject: {
                                    validators: {
                                        notEmpty: {
                                            message: 'Subject is required and cannot be empty'
                                        }
                                    }
                                },
                                message: {
                                    validators: {
                                        notEmpty: {
                                            message: 'Message is required and cannot be empty'
                                        }
                                    }
                                }
                            }
                        });

                    });
                })
            //on successfully submitting form
                .on( 'success.form.fv', function( e ) {
                    e.preventDefault();
                    var form = $( e.target );

                    $.ajax({
                        type: "POST",
                        url: form.attr( 'action' ),
                        data: form.serialize(),
                        dataType: 'json',

                        success: function() {
                            modalContact.modal( 'hide' );
                            $( "#enquiry-sent" ).show();
                            setTimeout( function() {
                                $( "#enquiry-sent" ).hide(500);
                            }, 5000);
                        },

                        error: function( error ) {
                            modalContact.modal( 'hide' );
                            alert( 'oops! something went wrong! try again!' );
                            console.log( error )
                        },

                        complete: function() {
                            $( "#captchaImage" ).trigger( 'click' );
                        }
                    });
                })
            //resets form when closes modal
                .on( "hide.bs.modal", function() {
                    $( '#form-val' ).formValidation( 'resetForm', true );
                });


    })
</script>