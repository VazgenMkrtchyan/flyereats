<!--drop downs-->
@include('admin.js.dropdowns')

<script>
    $( document ).ready( function() {

        var formVal = $( "#form-val" );

        //for autosize text area
        $( "#description" ).autosize({ append: "\n" });

        $( "#high_or_feat_till" ).datepicker({
            autoclose: true,
            todayHighlight: true
        });

        //initializes make/model dropdown
        dropdownInit( "{{ route('api_models') }}", "#make_id", "#model_id", "{{ $listing->model_id or '' }}", "{{ trans('back.-select_make-') }}", "{{ trans('back.-select_model-') }}", "", "", "{{ trans('back.loading') }}" );


        // LISTING PLANS BASED
        @if (appCon()->listingPlansBased())
        //for expiration date picking
        $( "#expires_on" ).datepicker({
            autoclose: true,
            todayHighlight: true
        });

        //initializes user/listing plans dropdown
        dropdownInit( "{{ route('api_listing_plans') }}", "#user_id", "#listing_plan_id", "{{ $listing->listing_plan_id or '' }}", "{{ trans('back.-select_user-') }}", "{{ trans('back.-none-') }}", "", "", "{{ trans('back.loading') }}" );


        var loadListingPlanButton = $( "#loadListingPlan" );
        var expirationSettings = $( "#expiration-settings" );
        //loads listing plan data
        loadListingPlanButton.on( "click", function() {
            loadListingPlan( $( '#listing_plan_id' ).val() );
        });

        //enables load listing plan settings button (on edit page)
        if ( "{{ $listing->listing_plan_id or '' }}" ) {
            loadListingPlanButton.removeAttr( 'disabled' );
            expirationSettings.show();
        }


        //disable/enable load listing plan button
        $( "#listing_plan_id" ).on( "change", function() {
            var listingPlanId = $( this ).val();
            if ( $( this ).val() == '' ) {
                loadListingPlanButton.attr( 'disabled', 'disabled' );
                expirationSettings.hide();
            }
            else {
                loadListingPlanButton.removeAttr( 'disabled' );
                expirationSettings.show();
            }

            loadListingPlanButton.val( listingPlanId );
            $( "#listingPlanLoaded" ).hide();
        });
        @endif
        // ./LISTING PLANS BASED


        //ADDRESS LOADING
        var userId = $( "#user_id" );
        if ( userId.val() == "" ) {
            $( "#loadAddress" ).attr( 'disabled', 'disabled' );
        }

        userId.on( "change", function() {
            if ( $( this ).val() == "" ) {
                $( "#loadAddress" ).attr( 'disabled', 'disabled' );
            } else {
                $( "#loadAddress" ).removeAttr( 'disabled' );
            }
        });


        //loads user address data
        $( "#loadAddress" ).on( "click", function() {
            $.ajax({
                url: "{{ route('api_user_address') }}",
                data: {
                    userId: $( "#user_id" ).val()
                },
                type: "GET",
                dataType: "json",

                beforeSend: function() {
                    $( "#loadAddress" ).attr( 'disabled', 'disabled' );
                    $( "#addressLoaded" ).hide();
                    $( "#addressApiLoading" ).show();
                },

                success: function( json ) {
                    $( "#state_id" ).val( json['state_id'] );
                    $( "#city" ).val( json['city'] );
                    $( "#addr_1" ).val( json['addr_1'] );
                    $( "#zip" ).val( json['zip'] );

                    $( "#addressApiLoading" ).hide();
                    $( "#addressLoaded" ).show();

                    formVal.trigger( "address_loaded" );
                }

            });
        });


        //LISTING ENHANCEMENT
        var listingEnhancement = $( '#listing_enhancement' );
        var enhancedTill = $( '#enhanced_till' );

        if ( listingEnhancement.val() ) {
            enhancedTill.show();
        }

        listingEnhancement.on( 'change', function() {
            if ( $( this ).val() ) {
                enhancedTill.show();
            } else {
                enhancedTill.hide();
            }
        });


        //VALIDATION

        formVal.validate({
            rules: {
                user_id: {
                    required: true
                },
                make_id: {
                    required: true
                },
                listing_plan_id: {
                    required: true
                },
                model_id: {
                    required: true
                },
                det_condition_id: {
                    required: true
                },
                det_bodystyle_id: {
                    required: true
                },
                det_extcolor_id: {
                    required: true
                },
                det_intcolor_id: {
                    required: true
                },
                det_transmission_id: {
                    required: true
                },
                det_drivetype_id: {
                    required: true
                },
                det_fueltype_id: {
                    required: true
                },
                mileage: {
                    required: true,
                    number: true,
                    min: 0
                },
                price: {
                    required: true,
                    number: true,
                    min: 0
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
                user_id: {
                    required: "{{ trans('back.select_user') }}"
                },
                make_id: {
                    required: "{{ trans('back.select_make') }}"
                },
                model_id: {
                    required: "{{ trans('back.select_model') }}"
                },
                det_condition_id: {
                    required: "{{ trans('back.select_condition') }}"
                },
                det_bodystyle_id: {
                    required: "{{ trans('back.select_body_style') }}"
                },
                det_extcolor_id: {
                    required: "{{ trans('back.select_ext_color') }}"
                },
                det_intcolor_id: {
                    required: "{{ trans('back.select_int_color') }}"
                },
                det_transmission_id: {
                    required: "{{ trans('back.select_transmission') }}"
                },
                det_drivetype_id: {
                    required: "{{ trans('back.select_drive_type') }}"
                },
                det_fueltype_id: {
                    required: "{{ trans('back.select_fuel_type') }}"
                },
                mileage: {
                    required: "{{ trans('back.mileage') . trans('back.required_not_empty') }}"
                },
                price: {
                    required: "{{ trans('back.price') . trans('back.required_not_empty') }}"
                },
                state_id: {
                    required: "{{ trans('fromDB.select_state') }}"
                },
                city: {
                    required: "{{ trans('back.city') . trans('back.required_not_empty') }}"
                },
                addr_1: {
                    required: "{{ trans('back.address') . trans('back.required_not_empty') }}"
                },
                zip: {
                    required: "{{ trans('fromDB.zip') . trans('back.required_not_empty') }}"
                }
            }
        });

        formVal
                .on( "address_loaded", function() {
                    $( this ).valid(); //revalidates form fields
                    //show button
                    $( "#loadAddress" ).removeAttr( 'disabled' );

                    //loads gmaps
                    loadLocationInit();
                });

        //GMAPS
        $( "#loadLocation" ).click(function () {
            loadLocationInit();
        });

        //loads map on listing edit page
        @if (isPage(['admin.listings.edit']))

            @if (session('listing_added') OR session('photos_upload_fallback'))
                $( "[href='#listing-photos']" ).tab( "show" );
            @endif

            loadLocationInit();

        @endif
        // ./LOCATION INIT

        //triggers select event
        if ("{{ Input::get('userId') }}" !== "") {
            $( "#user_id" )
                    .val( "{{ Input::get('userId') }}" )
                    .trigger( "change" );
        }
    })
</script>


@if (appCon()->listingPlansBased())
    <script>
        //loads listing plan data
        function loadListingPlan( listingPlanId ) {
            $.ajax({
                url: "{{ route('api_listing_plan_data') }}",
                data: {
                    listingPlanId: listingPlanId
                },
                type: "GET",
                dataType: "json",

                success: function( json ){
                    $( "#expires_on" ).val( json.formatted_expiration );

                    $( "#listingPlanApiLoading" ).hide();
                    $( "#listingPlanLoaded" ).show();
                },

                beforeSend: function() {
                    $( "#listingPlanApiLoading" ).show();
                    $( "#listingPlanLoaded" ).hide();
                }
            });
        }
    </script>
@endif