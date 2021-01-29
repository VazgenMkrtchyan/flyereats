<?php echo $__env->make('admin.js.dropdowns', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script>
    $( document ).ready( function() {
        //initializes make/model dropdown
        dropdownInit( "<?php echo route('api_models'); ?>", "#make", "#model", "<?php echo Input::get('model'); ?>", "<?php echo trans('front.all_models'); ?>", "<?php echo trans('front.all_models'); ?>", "activeL", "", "<?php echo trans('front.loading'); ?>" );

        // HIDE/SHOW search options
        $( "#load-more-options" ).click(function() {
            $( "#more-search-options" ).show(300);
            $(this).hide();
            $( "#hide-more-options" ).show();
            $.get("<?php echo route('misc.pref_to_session', ['prefName' => 'search_options', 'prefValue' => 'expanded']); ?>");
        });

        $( "#hide-more-options" ).click(function() {
            $( "#more-search-options" ).hide(300);
            $(this).hide();
            $( "#load-more-options" ).show();
            $.get("<?php echo route('misc.pref_to_session', ['prefName' => 'search_options', 'prefValue' => 'contracted']); ?>");
        });

        <?php if(sessionOrDefault('search_options') == 'expanded'): ?>
        $( "#more-search-options" ).show();
        $( "#hide-more-options" ).show();
        $( "#load-more-options" ).hide();
        <?php endif; ?>
        // ./HIDE/SHOW search options

        //list or grid view
        $( "#list-view" ).click( function(e) {
            e.preventDefault();
            $( ".listing-data" ).toggleClass( "grid" );
            $( "#grid-view" ).toggleClass( "active" );
            $( this ).toggleClass( "active" );
            $.get("<?php echo route('misc.pref_to_session', ['prefName' => 'view', 'prefValue' => 'list']); ?>");
        });
        $( "#grid-view" ).click( function(e) {
            e.preventDefault();
            $( ".listing-data" ).toggleClass( "grid" );
            $( "#list-view" ).toggleClass( "active" );
            $( this ).toggleClass( "active" );
            $.get("<?php echo route('misc.pref_to_session', ['prefName' => 'view', 'prefValue' => 'grid']); ?>");
        });

        //per page
        $( "[data-per-page]" ).click( function(e) {
            e.preventDefault();
            var page = $( this ).data('per-page');

            $.get("<?php echo route('misc.pref_to_session', ['prefName' => 'per_page']); ?>" + "&prefValue=" + page, function() {
                window.location.replace( "<?php echo route('browselistings.index', Input::except(['page'])); ?>" );
            });
        });

        //sort by
        $( "[data-sort-by]" ).click( function(e) {
            e.preventDefault();
            var sortBy = $( this ).data('sort-by');

            $.get("<?php echo route('misc.pref_to_session', ['prefName' => 'sort_by']); ?>" + "&prefValue=" + sortBy, function() {
                window.location.replace( "<?php echo route('browselistings.index', Input::except(['page'])); ?>" );
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
                        url: "<?php echo route('validation.validZIP'); ?>",
                        type: "POST"
                    }
                }
            },

            messages: {
                zip: {
                    remote: "<?php echo trans('front.enter_valid_zip'); ?>"
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