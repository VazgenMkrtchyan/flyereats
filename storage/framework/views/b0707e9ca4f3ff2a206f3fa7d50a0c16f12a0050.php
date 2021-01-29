<!-- for dynamic JavaScript Variables Inclusion -->
<?php echo $__env->make('helpers.JSVariables', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo asset('templates/front/js/bootstrap.min.js'); ?>"></script>
<!-- jqueryValidate -->
<script src="<?php echo asset('templates/front/js/jqueryValidate/jquery.validate.min.js'); ?>"></script>
<script src="<?php echo asset('templates/front/js/jqueryValidate/additional-methods.min.js'); ?>"></script>
<!-- Light Slider -->
<script src="<?php echo asset('templates/front/js/lightslider.js'); ?>"></script>
<!-- Autosize -->
<script src="<?php echo asset('templates/front/js/jquery.autosize.min.js'); ?>"></script>
<!-- MAIN JS -->
<script src="<?php echo asset('templates/front/js/main.js'); ?>"></script>

<!-- google maps -->
<?php if(isPage(['browselistings.view', 'userlistings.create', 'userlistings.edit', 'compprofile.create', 'compprofile.edit'])): ?>
    <script type="text/javascript" src="//maps.google.com/maps/api/js?key=<?php echo appCon()->google_maps_api_key; ?>"></script>
    <script src="<?php echo asset('templates/front/js/gmaps.min.js'); ?>"></script>
<?php endif; ?>

<script>
    //CSRF TOKEN (for Laravel)
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //current route name (used for navigation bar)
    var currentRouteName = "<?php echo Route::currentRouteName(); ?>";

    //default jqueryValidate Settings
    $.validator.setDefaults({
        errorElement: 'p',
        errorClass: 'help-block',
        focusInvalid: true,

        highlight: function (element) {
            $(element).parent().addClass('has-error');
        },

        unhighlight: function (element) {
            $(element).parent().removeClass('has-error');
        },

        success: function (label) {
            $(label).parent().removeClass('has-error');
            $(label).remove();
        }
    });

    $.extend($.validator.messages, {
        required: "<?php echo trans('validation.field_is_required'); ?>",
        email: "<?php echo trans('validation.enter_valid_email'); ?>",
        number: "<?php echo trans('validation.enter_valid_number'); ?>",
        min: jQuery.validator.format("<?php echo trans('validation.min_number_value'); ?>")
    });

    <?php if(demo_mode_on()): ?>
    //only for demo purposes
    //for demo - color change
    $(document).ready(function(){
        $( '#color_scheme' ).change(function () {
            $( '#change_color_scheme' ).submit();
        });

        var nav_menu = $('.nav-menu');
        var nav_menu_toggle = $('.nav-menu-toggle');
        var logo_mobile = $('.logo-mobile');
        function fix_css() {
            if ($(this).width() < 860) {
                nav_menu.css('top', '95px');
                nav_menu_toggle.css('top', '45px');
                logo_mobile.css('margin-top', '45px');
            }
        }

        fix_css();
        $(window).resize(function () {
            fix_css()
        });

    });
    <?php endif; ?>


    $( document ).ready(function() {
        //init homepage functionality
        homepageInit();

        //loves/unloves listings
        $("[data-love-listing]").click(function (e) {
            e.preventDefault();
            target = $(this);

            $.ajax({
                type: "POST",
                url: $( this ).data( 'love-listing' ),
                dataType: 'json',

                complete: function(json) {
                    if (json.responseJSON == 'loved')
                    {
                        target.find('i')
                                .attr('class', 'fa fa-heart')
                                .attr('title', '<?php echo trans('front.undo'); ?>');
                    }
                    else
                    {
                        target.find('i')
                                .attr('class', 'fa fa-heart-o')
                                .attr('title', '<?php echo trans('front.love'); ?>');
                    }
                }
            });
        });
    });
</script>