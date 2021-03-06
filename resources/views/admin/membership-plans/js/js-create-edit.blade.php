<script>
    $( document ).ready( function() {
        //autosize
        $( "#description" ).autosize();

        //VALIDATION
        $( '#form-val' ).validate({
            rules: {
                user_group_id: {
                  required: true
                },
                name: {
                    required: true
                },
                description: {
                    required: true
                },
                price: {
                    required: true,
                    number: true,
                    min: 0
                },
                duration: {
                    required: true,
                    number: true,
                    min: 0
                },
                max_listings: {
                    required: true,
                    number: true,
                    min: 0
                },
                max_photos: {
                    required: true,
                    number: true,
                    min: 0
                },
                order: {
                    number: true,
                    min: 0
                }
            },

            messages: {
                user_group_id: {
                    required: "{{ trans('back.select_user_group') }}"
                },
                name: {
                    required: "{{ trans('back.membership_plan_name') . trans('back.required_not_empty') }}"
                },
                description: {
                    required: "{{ trans('back.description') . trans('back.required_not_empty') }}"
                }
            }
        });


        @if (isset($membershipPlan))
            //disables user group on edit page
            $( "#user_group_id" ).toggleDisabled();
        @endif

    })
</script>