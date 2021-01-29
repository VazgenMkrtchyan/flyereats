<script>
    //removes error from the field
    function recaptchaCallback() {
        $( '#hiddenRecaptcha' ) . valid();
    }

    $( document ).ready( function() {

        //google map style
        var styles = [{"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":-25},{"saturation":-100}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]}];

        //google maps integration
        var map = new GMaps({
            div: '#map_canvas',
            scrollwheel: false,
            lat: "{{ $listing->lat }}",
            lng: "{{ $listing->lng }}"
        } );
        //adds marker to map
        map.addMarker({
            lat: "{{ $listing->lat }}",
            lng: "{{ $listing->lng }}"
        });

        //adds style
        map.addStyle({
            styledMapName:"Styled Map",
            styles: styles,
            mapTypeId: "map_style"
        });
        //sets style
        map.setStyle("map_style");

        //initializes image gallery
        $('#view-image-gal').lightSlider({
            //LAZY LOADING
            onBeforeStart: function ($el) {
                var src_img = $el.find('li img').first().attr('data-src');
                $el.find('li img').first().attr('src', src_img);
            },
            onSliderLoad: function ($el) {
                // loads first 4 thumbnails (lazy loading)
                for (var i = 0; i < 4; i++)
                {
                    var thumbs = $('.lSPager').find('li img');
                    if ($el.find('li').eq(i).length )
                    {
                        var src_thumb = $el.find('li').eq(i).data('thumb-src');
                        thumbs.eq(i).attr('src', src_thumb);
                        $el.find('li').eq(i).attr('data-thumb', src_thumb);
                    }
                }
            },
            onBeforeSlide: function ($el, scene) {
                var $img = $el.find('img').eq( $el.getCurrentSlideCount()-1 );
                var $img_src = $img.attr('data-src');
                $img.attr('src', $img_src);

                //loads 3 next thumbnails (lazy loading)
                for (var i = 0; i < 3; i++)
                {
                    var thumbs = $('.lSPager').find('li img');
                    var index = $el.getCurrentSlideCount() + i;
                    if ($el.find('li').eq(index).length )
                    {
                        var src_thumb = $el.find('li').eq(index).data('thumb-src');
                        thumbs.eq(index).attr('src', src_thumb);
                        $el.find('li').eq(index).attr('data-thumb', src_thumb);
                    }
                }
            },

            gallery: true,
            item: 1,
            loop: false,
            slideMargin: 0,
            thumbItem: 4,
            keyPress: true,
            nextHtml: '<i class="fa fa-angle-right"></i>',
            prevHtml: '<i class="fa fa-angle-left"></i>'
        });

        //applies search filters (sort by and per page)
        $( "#search_filters" ).find( "select" ).change( function() {
            $( "#search_filters" ).submit();
        });


        //opens printable page
        $( "[data-printable-page]" ).click( function(e) {
            e.preventDefault();
            window.open("{{ route('listing_print', $listing->id) }}", "Printable Page", "height=500 , width=700");
        });


        //VALIDATION
        var formEnquiry = $( "#form-enquiry" );

        formEnquiry.validate({
            ignore: '.ignore',
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                message: {
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
                name: {
                    required: "{{ trans('front.name') . trans('front.required_not_empty') }}"
                },
                email: {
                    required: "{{ trans('front.email') . trans('front.required_not_empty') }}"
                },
                message: {
                    required: "{{ trans('front.message') . trans('front.required_not_empty') }}"
                },
                hiddenRecaptcha: {
                    required: "{{ trans('front.recaptcha_required') }}"
                }
            }
        });


        formEnquiry.on( "submit", function(e) {
            e.preventDefault();
            //if the enquiry form is valid
            if ( $( this ).valid() ) {

                $.ajax({
                    type: "POST",
                    url: $( this ).attr( 'action' ),
                    data: $( this ).serialize(),
                    dataType: 'json',

                    beforeSend: function () {
                        formEnquiry.find( ".fa-spinner" ).show()
                    },

                    success: function() {
                        $( "#enquiry-sent" ).show();
                        formEnquiry.hide();
                    },

                    error: function( error ) {
                        alert( 'oops! something went wrong! try again!' );
                        console.log( error )
                    },

                    complete: function() {
                        formEnquiry.find( ".fa-spinner" ).hide();
                    }
                });
            }
        });

    })
</script>

