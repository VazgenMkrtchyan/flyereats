<?php echo $__env->make('admin.js.dropdowns', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script>
    $( document ).ready( function() {

        <?php if(appCon()->membershipPlansBased()): ?>
        //for expiration date picking
        $( "#expires_on" ).datepicker({
            autoclose: true,
            todayHighlight: true
        });

        //initializes make/model dropdown
        dropdownInit( "<?php echo route('api_membership_plans'); ?>", "#user_group_id", "#membership_plan_id", "<?php echo isset($user->membership_plan_id) ? $user->membership_plan_id : ''; ?>", "<?php echo trans('back.-select_user_group-'); ?>", "<?php echo trans('back.-none-'); ?>", "", "", "<?php echo trans('back.loading'); ?>" );

        var loadMembershipPlanButton = $( "#loadMembershipPlan" );
        var expirationSettings = $( "#expiration-settings" );
        //disables load membership plan button
        $( '#user_group_id' ).on( 'change', function() {
            loadMembershipPlanButton.attr( 'disabled', 'disabled' );
            $( "#membershipPlanLoaded" ).hide();
            expirationSettings.hide();
        });


        //enables load membership settings button (on edit page)
        if ( "<?php echo isset($user->membership_plan_id) ? $user->membership_plan_id : ''; ?>" ) {
            loadMembershipPlanButton.removeAttr( 'disabled' );
            expirationSettings.show();
        }


        //on selecting membership plan
        $( '#membership_plan_id' ).on( 'change', function() {
            if ( $( this ).val() == '') {
                loadMembershipPlanButton.attr( 'disabled', 'disabled' );
                expirationSettings.hide();
            }
            else {
                loadMembershipPlanButton
                        .removeAttr( 'disabled' )
                        .val( $( this ).val() );
                expirationSettings.show();
            }

            $( "#membershipPlanLoaded" ).hide();
        });


        //loads membership plan expiration date
        loadMembershipPlanButton.on( 'click', function() {
            loadMembershipPlan( $( this ).val() );
            $( this ).attr( 'disabled', 'disabled' );
        });

        //loads membership plan data
        function loadMembershipPlan( membershipPlanId ) {
            $.ajax({
                url: "<?php echo route('api_membershipplan_data'); ?>",
                data: {
                    membershipPlanId: membershipPlanId
                },
                type: "GET",
                dataType: "json",

                success: function (json) {
                    $("#expires_on").val(json.formatted_expiration);

                    $("#membershipPlanApiLoading").hide();
                    $("#membershipPlanLoaded").show();
                },

                beforeSend: function () {
                    $("#membershipPlanApiLoading").show();
                    $("#membershipPlanLoaded").hide();
                }
            });
        }
        <?php endif; ?>


        //VALIDATION
        var formVal = $( "#form-val" );

        formVal.validate({
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
                        data: {
                            exceptId: "<?php echo isset($user->id) ? $user->id : ''; ?>"
                        },
                        type: "POST"
                    }
                },
                password: {
                    required: "<?php echo isset($user) ? 'false' : 'true'; ?>" == "true",
                    minlength: 4
                },
                password_confirmation: {
                    equalTo: "#password"
                },
                email: {
                    required: true,
                    email: true,
                    remote: {
                        url: "<?php echo route('validation.uniqueEmail'); ?>",
                        data: {
                            exceptId: "<?php echo isset($user->id) ? $user->id : ''; ?>"
                        },
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
                }
            },

            messages: {
                user_group_id: {
                    required: "<?php echo trans('back.select_user_group'); ?>"
                },
                first_name: {
                    required: "<?php echo trans('back.first_name') . trans('back.required_not_empty'); ?>"
                },
                last_name: {
                    required: "<?php echo trans('back.last_name') . trans('back.required_not_empty'); ?>"
                },
                username: {
                    required: "<?php echo trans('back.username') . trans('back.required_not_empty'); ?>",
                    minlength: "<?php echo trans('back.username') . trans('back.required_length'); ?>",
                    remote: "<?php echo trans('back.username_taken'); ?>"
                },
                password: {
                    required: "<?php echo trans('back.password') . trans('back.required_not_empty'); ?>",
                    minlength: "<?php echo trans('back.password') . trans('back.required_length'); ?>"
                },
                password_confirmation: {
                    equalTo: "<?php echo trans('back.passwords_not_match'); ?>"
                },
                email: {
                    required: "<?php echo trans('back.email') . trans('back.required_not_empty'); ?>",
                    remote: "<?php echo trans('back.email_taken'); ?>"
                },
                state_id: {
                    required: "<?php echo trans('fromDB.select_state'); ?>"
                },
                city: {
                    required: "<?php echo trans('back.city') . trans('back.required_not_empty'); ?>"
                },
                addr_1: {
                    required: "<?php echo trans('back.address') . trans('back.required_not_empty'); ?>"
                },
                zip: {
                    required: "<?php echo trans('fromDB.zip') . trans('back.required_not_empty'); ?>"
                }
            }
        });

    })
</script>