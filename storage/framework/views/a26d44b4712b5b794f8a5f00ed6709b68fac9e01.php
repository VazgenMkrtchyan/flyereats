<script>
    $(document).ready(function () {

        <?php if(isPage(['admin.company-profiles.edit'])): ?>
        var upload_logo_button = $('#upload-logo-button');
        var logo_error = $('#logo-error');

        $('#logo').ace_file_input({

                    before_change: function () {
                        upload_logo_button.removeAttr('disabled');
                        logo_error.removeClass('inline');
                        return true;
                    },
                    before_remove: function () {
                        upload_logo_button.prop('disabled', true);
                        logo_error.removeClass('inline');
                        return true;
                    },

                    no_file: '<?php echo trans('back.fi_no_file'); ?>',
                    btn_choose: '<?php echo trans('back.fi_choose'); ?>',
                    btn_change: '<?php echo trans('back.fi_change'); ?>',
                    droppable: false,
                    onchange: null,
                    thumbnail: false, //| true | large
                    allowExt: ['jpg', 'jpeg', 'png', 'gif', 'tif', 'tiff', 'bmp']
                })
                .on('file.error.ace', function () {
                    upload_logo_button.prop('disabled', true);
                    logo_error.addClass('inline');
                });

        loadLocationInit();
        <?php endif; ?>

        //for autosize text area
        $("#description").autosize();

        //VALIDATION
        var formVal = $("#form-val");

        formVal.validate({
            rules: {
                user_id: {
                    required: true
                },
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
                user_id: {
                    required: "<?php echo trans('back.select_user'); ?>"
                },
                name: {
                    required: "<?php echo trans('back.company_name') . trans('back.required_not_empty'); ?>"
                },
                state_id: {
                    required: "<?php echo trans('fromDB.select_state'); ?>"
                },
                city: {
                    required: "<?php echo trans('back.city') . trans('back.required_not_empty'); ?>"
                },
                addr_1: {
                    required: "<?php echo trans('back.address') . trans('back.required_not_empty'); ?>"
                },
                zip: {
                    required: "<?php echo trans('fromDB.zip') . trans('back.required_not_empty'); ?>"
                }
            }
        });

        //GMAPS
        $("#loadLocation").click(function () {
            loadLocationInit();
        });

    })
</script>