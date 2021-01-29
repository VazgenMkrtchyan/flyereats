<script>
    $( document ).ready( function() {

        //for autosize text area
        $( "#description" ).autosize({ append: "\n" });

        //VALIDATION
        var formVal = $( "#form-val" );

        formVal.validate({
            rules: {
                name: {
                    required: true
                },
                email: {
                  email: true
                },
                state_id: {
                    required: true
                },
                city: {
                    required: true
                },
                addr_1: {
                    required: true
                },
                zip: {
                    required: true
                }
            },

            messages: {
                name: {
                    required: "<?php echo trans('front.company_name') . trans('front.required_not_empty'); ?>"
                },
                state_id: {
                    required: "<?php echo trans('fromDB.select_state'); ?>"
                },
                city: {
                    required: "<?php echo trans('front.city') . trans('front.required_not_empty'); ?>"
                },
                addr_1: {
                    required: "<?php echo trans('front.address') . trans('front.required_not_empty'); ?>"
                },
                zip: {
                    required: "<?php echo trans('fromDB.zip') . trans('front.required_not_empty'); ?>"
                }
            }
        });

        //VALIDATION 2 (logo upload)
        $( '#company-logo' ).validate({
            rules: {
                logo: {
                    required: true,
                    accept: "image/jpeg,image/png"
                }
            },

            messages: {
                logo: {
                    required: "<?php echo trans('front.select_file_to_upload'); ?>",
                    accept: "<?php echo trans('front.not_valid_image'); ?>"
                }
            }
        });


        //GMAPS
        $( "#loadLocation" ).click(function () {
            loadLocationInit();
        });

        //loads map on listing edit page
        <?php if(isPage(['compprofile.edit'])): ?>
            loadLocationInit();
        <?php endif; ?>
        // ./GMAPS
    })
</script>