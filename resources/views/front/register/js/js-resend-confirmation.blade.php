<script>
    $( document ).ready( function() {

        //validation
        $('#form-val').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                }
            },

            messages: {
                email: {
                    required: "{{ trans('front.email') . trans('front.required_not_empty') }}"
                }
            }
        });

    })
</script>