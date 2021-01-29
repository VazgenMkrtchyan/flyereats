<!-- basic scripts -->

<!--[if !IE]> -->
<script type="text/javascript">
    window.jQuery || document.write("<script src='{{ asset('templates/admin/js/jquery.min.js') }}'>"+"<"+"/script>");
</script>

<!-- <![endif]-->

<!--[if IE]>
<script type="text/javascript">
    window.jQuery || document.write("<script src='{{ asset('templates/admin/js/jquery1x.min.js') }}'>"+"<"+"/script>");
</script>
<![endif]-->
<script type="text/javascript">
    if('ontouchstart' in document.documentElement) document.write("<script src='{{ asset('templates/admin/js/jquery.mobile.custom.min.js') }}'>"+"<"+"/script>");
</script>

<!-- bootstrap.js -->
<script src="{{ asset('templates/admin/js/bootstrap.min.js') }}"></script>

<!-- jqueryValidate -->
<script src="{{ asset('templates/admin/js/jqueryValidate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('templates/admin/js/jqueryValidate/additional-methods.min.js') }}"></script>


<!-- OTHER PAGES' SCRIPTS -->

@if (isPage(['admin.administrators.edit']))
    <script src="{{ asset('templates/admin/js/fuelux/fuelux.tree.min.js') }}"></script><!-- administrators edit page -->
@endif

@if (isPage(['admin.listings.create', 'admin.listings.edit', 'admin.users.create', 'admin.users.edit']))
    <script src="{{ asset('templates/admin/js/date-time/bootstrap-datepicker.min.js') }}"></script><!-- date picker -->
@endif


@if (isPage(['admin.listings.create', 'admin.listings.edit', 'admin.company-profiles.create', 'admin.company-profiles.edit']))
    <script type="text/javascript" src="//maps.google.com/maps/api/js?key={{ appCon()->google_maps_api_key }}"></script>
    <script src="{{ asset('templates/front/js/gmaps.min.js') }}"></script><!-- google maps -->
@endif

<script src="{{ asset('templates/admin/js/jquery.autosize.min.js') }}"></script><!-- autosize -->

<!-- ./OTHER PAGES' SCRIPTS -->

<!-- ace scripts -->
<script src="{{ asset('templates/admin/js/ace-elements.min.js') }}"></script>
<script src="{{ asset('templates/admin/js/ace.min.js') }}"></script>

<!-- MAIN JS -->
<script src="{{ asset('templates/front/js/main.js') }}"></script>

<script>
    //CSRF TOKEN (for Laravel)
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //default jqueryValidate Settings
    $.validator.setDefaults({
        errorElement: 'div',
        errorClass: 'help-block col-xs-12 col-sm-reset inline',
        focusInvalid: true,

        errorPlacement: function(error, element) {
            error.insertAfter(element.parent());
        },

        highlight: function (element) {
            $(element).parent().parent().addClass('has-error');
        },

        unhighlight: function (element) {
            $(element).parent().parent().removeClass('has-error');
        },

        success: function (label) {
            $(label).parent().removeClass('has-error');
            $(label).remove();
        }
    });

    $.extend($.validator.messages, {
        required: "{{ trans('validation.field_is_required') }}",
        email: "{{ trans('validation.enter_valid_email') }}",
        number: "{{ trans('validation.enter_valid_number') }}",
        min: jQuery.validator.format("{{ trans('validation.min_number_value') }}")
    });

    //adding helper jquery function
    (function($) {
        $.fn.toggleDisabled = function(){
            return this.each(function(){
                this.disabled = !this.disabled;
            });
        };
    })(jQuery);

    $( document ).ready(function() {
        //NAVIGATION
        //we can add hidden fields to the page with identifier name
        var liIdentifierHidden = $( "input[name='nav_li_identifier']" );
        if ( liIdentifierHidden.length ) {
            var liIdentifier = liIdentifierHidden.val();
        } else {
            //if hidden field is not added, li identifier becomes route name
            liIdentifier = "{{ Route::currentRouteName() }}";
        }
        $( "[data-li-identifier='" + liIdentifier + "']" )
                .addClass( "active" )
                .parents( "[data-li-top]" )
                .addClass( "active open" );

        //we can provide hidden data-li-top identifier for every page if needed
        var liTopHidden = $( "input[name='nav_li_top']" );
        if ( liTopHidden.length ) {
            $( "[data-li-top='" + liTopHidden.val() + "']" )
                    .addClass( "active open" );
        }
        // ./NAVIGATION


        //PER PAGE
        $( "[name='per_page']" ).change(function() {
            var perPage = $( this ).val();
            var url;
            if ( $( this ).attr('data-redirect') ) {
                url = $( this ).data('redirect');
            } else {
                url = "{{ ''//route(Route::currentRouteName(), Input::except('page')) }}";
            }

            $.get("{{ route('misc.pref_to_session', ['prefName' => Route::currentRouteName()]) }}" + "&prefValue=" + perPage, function() {
                window.location.replace( url );
            });
        });
        // ./PER PAGE

        //POPOVERS
        //popovers init
        $('[data-toggle=popover]').popover({
            html: true,
            trigger: 'manual'
        });
        //shows popover
        $('[data-popover]').click(function (e) {
            e.preventDefault();
            //closes open popovers before toggling popover
            $('[data-toggle="popover"]').each(function () {
                $(this).popover('hide');
            });
            var target = $(this).data('popover');
            $(target).popover('toggle');
        });
        //hides popover
        $('body').on('click', function (e) {
            //saves from instantly closing popover after opening it by clicking on help button
            if (e.target.className !== 'help-button') {
                $('[data-toggle="popover"]').each(function () {
                    //the 'is' for buttons that trigger popups
                    //the 'has' for icons within a button that triggers a popup
                    if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                        $(this).popover('hide');
                    }
                });
            }
        });
    });

</script>