    <?php echo $__env->make('admin.js.dropdowns', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script>
    $( document ).ready( function() {

        //initializes make/model dropdown
        dropdownInit( "<?php echo route('api_models'); ?>", "#make", "#model", "", "<?php echo trans('front.all_models'); ?>", "<?php echo trans('front.all_models'); ?>", "activeL", "", "<?php echo trans('front.loading'); ?>" );

        //enhanced listings slider initialization
        lightSliderInit( "#enhanced-listings" );

        //recently added listings thumbs init
        lightSliderThumbsInit( "#recently-added" );

        //load more init
        loadMoreInit( "#recently-added" );

        //VALIDATION
        var formVal = $( "#quick-search" );

        formVal.validate({
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
                    remote: "<?php echo trans('fromDB.invalid_zip'); ?>"
                }
            }
        });

    })

            $(document).ready(function() {
          $('.homeSlider').slick({
            autoplay: true,
            dots: false,
            infinite: true,
            speed: 500,
            fade: true,
            cssEase: 'linear',
            lazyLoad: 'ondemand', controls: false,
          });
          $('.slick-prev').html('<i class="fa fa-chevron-left"></i>');
          $('.slick-next').html('<i class="fa fa-chevron-right"></i>')
        });
</script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>