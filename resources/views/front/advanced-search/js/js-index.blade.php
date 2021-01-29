@include('admin.js.dropdowns')
<script>
    $( document ).ready( function() {
        //initializes make/model dropdown
        dropdownInit( "{{ route('api_models') }}", "#make", "#model", "{{ Input::get('model') }}", "{{ trans('front.all_models') }}", "{{ trans('front.all_models') }}", "activeL", "", "{{ trans('front.loading') }}" );


        //VALIDATION
        var formVal = $( "#form-val" );

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
                    remote: "{{ trans('front.enter_valid_zip') }}"
                }
            }
        });

    })
</script>