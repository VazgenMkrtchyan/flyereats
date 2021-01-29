    @include('admin.js.dropdowns')
<script>
    $( document ).ready( function() {

        //initializes make/model dropdown
        dropdownInit( "{{ route('api_models') }}", "#make", "#model", "", "{{ trans('front.all_models') }}", "{{ trans('front.all_models') }}", "activeL", "", "{{ trans('front.loading') }}" );

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
                        url: "{{ route('validation.validZIP') }}",
                        type: "POST"
                    }
                }
            },

            messages: {
                zip: {
                    remote: "{{ trans('fromDB.invalid_zip') }}"
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