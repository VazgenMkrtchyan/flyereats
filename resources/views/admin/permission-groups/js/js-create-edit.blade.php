<script>
    $( document ).ready( function() {

        //VALIDATION
        $( '#form-val' ).validate({
            rules: {
                name: {
                    required: true,
                    remote: {
                        url: "{{ route('validation.uniqueDetailName') }}",
                        data: {
                            table: "permission_groups",
                            exceptId: "{{ Route::input('permission_groups') }}"
                        },
                        type: 'POST'
                    }
                },
                identifier: {
                  required: true
                },
                order: {
                    number: true,
                    min: 0
                }
            },

            messages: {
                name: {
                    required: "{{ trans('back.name') . trans('back.required_not_empty') }}",
                    remote: "{{ trans('back.name_taken') }}"
                }
            }
        });

    })
</script>