@include('admin.js.dropdowns')
<script>
    $( document ).ready( function() {
        //initializes make/model dropdown
        dropdownInit( "{{ route('api_models') }}", "#make", "#model", "{{ Input::get('model') }}", "{{ trans('front.all_models') }}", "{{ trans('front.all_models') }}", "activeL", "", "{{ trans('front.loading') }}" );

        // HIDE/SHOW search options
        $( "#load-more-options" ).click(function() {
            $( "#more-search-options" ).show(300);
            $(this).hide();
            $( "#hide-more-options" ).show();
            $.get("{{ route('misc.pref_to_session', ['prefName' => 'search_options', 'prefValue' => 'expanded']) }}");
        });

        $( "#hide-more-options" ).click(function() {
            $( "#more-search-options" ).hide(300);
            $(this).hide();
            $( "#load-more-options" ).show();
            $.get("{{ route('misc.pref_to_session', ['prefName' => 'search_options', 'prefValue' => 'contracted']) }}");
        });

        @if (sessionOrDefault('search_options') == 'expanded')
        $( "#more-search-options" ).show();
        $( "#hide-more-options" ).show();
        $( "#load-more-options" ).hide();
        @endif
        // ./HIDE/SHOW search options

        //list or grid view
        $( "#list-view" ).click( function(e) {
            e.preventDefault();
            $( ".listing-data" ).toggleClass( "grid" );
            $( "#grid-view" ).toggleClass( "active" );
            $( this ).toggleClass( "active" );
            $.get("{{ route('misc.pref_to_session', ['prefName' => 'view', 'prefValue' => 'list']) }}");
        });
        $( "#grid-view" ).click( function(e) {
            e.preventDefault();
            $( ".listing-data" ).toggleClass( "grid" );
            $( "#list-view" ).toggleClass( "active" );
            $( this ).toggleClass( "active" );
            $.get("{{ route('misc.pref_to_session', ['prefName' => 'view', 'prefValue' => 'grid']) }}");
        });

        //per page
        $( "[data-per-page]" ).click( function(e) {
            e.preventDefault();
            var page = $( this ).data('per-page');

            $.get("{{ route('misc.pref_to_session', ['prefName' => 'per_page']) }}" + "&prefValue=" + page, function() {
                window.location.replace( "{{ route('browselistings.index', Input::except(['page'])) }}" );
            });
        });

        //sort by
        $( "[data-sort-by]" ).click( function(e) {
            e.preventDefault();
            var sortBy = $( this ).data('sort-by');

            $.get("{{ route('misc.pref_to_session', ['prefName' => 'sort_by']) }}" + "&prefValue=" + sortBy, function() {
                window.location.replace( "{{ route('browselistings.index', Input::except(['page'])) }}" );
            });
        });

        //VALIDATION
        var formVal = $( "#form-val" );

        formVal.validate({
            //correct error placement
            errorPlacement: function(error, element) {
                if (element.attr("name") == "zip" )
                    error.appendTo('.zip-error');
            },

            rules: {
                zip: {
                    minlength: 4,
                    remote: {
                        url: "{{ route('validation.validZIP') }}",
                        type: "POST"
                    }
                }
            },

            messages: {
                zip: {
                    remote: "{{ trans('front.enter_valid_zip') }}"
                }
            }
        });

        //RESETS ZIP VALUES
        $( ".reset-zip-distance" ).on( "click", function() {
            $( "#zip" ).val( "" );
            $( "#distance" ).val( "" );

            formVal.submit();
        });

        //LOADS THUMBS FOR LISTINGS GALLERY
        lightSliderThumbsInit( '.listing-results' );

    })
</script>