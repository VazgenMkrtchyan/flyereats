<?php echo $__env->make('admin.js.dropdowns', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script>
    $( document ).ready( function() {

        //loads if it's listing edit page
        <?php if(isPage(['userlistings.edit'])): ?>

            <?php if(session('listing_added') OR session('photos_upload_fallback')): ?>
                    $( "[href='#listing-photos']" ).tab( "show" );
            <?php endif; ?>

            <?php if(session('payment_for') == 'listingPlan'): ?>
                $( "[href='#listing-plan']" ).tab( "show" );
            <?php elseif(session('payment_for')): ?>
                $( "[href='#listing-enhancement']" ).tab( "show" );
            <?php endif; ?>

            //loads location
            loadLocationInit();

        <?php endif; ?>
        // ./loads if it's listing edit page

        //for autosize text area
        $( "#description" ).autosize();

        //initializes make/model dropdown
        dropdownInit( "<?php echo route('api_models'); ?>", "#make_id", "#model_id", "<?php echo isset($listing->model_id) ? $listing->model_id : ''; ?>", "<?php echo trans('front.-select_make-'); ?>", "<?php echo trans('front.-model-'); ?>", "", "", "<?php echo trans('front.loading'); ?>" );

        var formVal = $( "#form-val" );


        //LOCATION INIT
        $( "#loadAddress" ).click(function() {
            //loads address and zip
            // $( "#state_id" ).val( "<?php echo Auth::user()->state_id; ?>" );
            // $( "#city" ).val( "<?php echo Auth::user()->city; ?>" );
            // $( "#addr_1" ).val( "<?php echo Auth::user()->addr_1; ?>" );
            // $( "#zip" ).val( "<?php echo Auth::user()->zip; ?>");
            // formVal.trigger( "address_loaded" );
        });

        //GMAPS
        $( "#loadLocation" ).click(function () {
            loadLocationInit();
        });
        // ./LOCATION INIT


        //VALIDATION
        formVal.validate({
            rules: {
                make_id: {
                    required: false
                },
                model_id: {
                    required: false
                },
                det_condition_id: {
                    required: false
                },
                det_bodystyle_id: {
                    required: false
                },
                det_extcolor_id: {
                    required: false
                },
                det_intcolor_id: {
                    required: false
                },
                det_transmission_id: {
                    required: false
                },
                det_drivetype_id: {
                    required: false
                },
                det_fueltype_id: {
                    required: false
                },
                mileage: {
                    required: false,
                    number: true,
                    min: 0
                },
                price: {
                    required: false,
                    number: true,
                    min: 0
                },
                state_id: {
                    required: false
                },
                city: {
                    required: false
                },
                addr_1: {
                    required: false
                },
                zip: {
                    required: false
                }
            },

            messages: {
                make_id: {
                    required: "<?php echo trans('front.select_make'); ?>"
                },
                model_id: {
                    required: "<?php echo trans('front.select_model'); ?>"
                },
                det_condition_id: {
                    required: "<?php echo trans('front.select_condition'); ?>"
                },
                det_bodystyle_id: {
                    required: "<?php echo trans('front.select_body_style'); ?>"
                },
                det_extcolor_id: {
                    required: "<?php echo trans('front.select_ext_color'); ?>"
                },
                det_intcolor_id: {
                    required: "<?php echo trans('front.select_int_color'); ?>"
                },
                det_transmission_id: {
                    required: "<?php echo trans('front.select_transmission'); ?>"
                },
                det_drivetype_id: {
                    required: "<?php echo trans('front.select_drive_type'); ?>"
                },
                det_fueltype_id: {
                    required: "<?php echo trans('front.select_fuel_type'); ?>"
                },
                mileage: {
                    required: "<?php echo trans('front.mileage') . trans('front.required_not_empty'); ?>"
                },
                price: {
                    required: "<?php echo trans('front.price') . trans('front.required_not_empty'); ?>"
                },
                state_id: {
                    required: "<?php echo trans('fromDB.select_state'); ?>"
                },
                city: {
                    required: "<?php echo trans('front.city') . trans('front.required_not_empty'); ?>"
                },
                addr_1: {
                    required: "<?php echo trans('front.address') . trans('front.required_not_empty'); ?>"
                },
                zip: {
                    required: "<?php echo trans('fromDB.zip') . trans('front.required_not_empty'); ?>"
                }
            }
        });


        formVal
                .on( "address_loaded", function() {
                    $( this ).valid(); //revalidates form fields
                    //loads gmaps
                    loadLocationInit();
                });
    })
</script>