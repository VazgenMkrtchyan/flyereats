<!-- dropzone upload script-->
<script src="<?php echo asset('templates/front/js/dropzone.min.js'); ?>"></script>

<script>
    $( document ).ready( function() {

        try {
            Dropzone.autoDiscover = false;
            var myDropzone = new Dropzone("#dropzone" , {
                //forceFallback: true,
                fallback: false, //leave false
                paramName: "file", // The name that will be used to transfer the file
                addRemoveLinks : false,
                dictDefaultMessage :
                        '<span class="bigger-150 bolder"><i class="ace-icon fa fa-caret-right red"></i> <?php echo trans('back.dz_drop_files'); ?></span> <?php echo trans('back.dz_to_upload'); ?> \
                        <span class="smaller-80 grey"><?php echo trans('back.dz_or_click'); ?></span> <br /> \
                        <i class="upload-icon ace-icon fa fa-cloud-upload blue fa-3x"></i>'
                ,
                dictResponseError: '<?php echo trans('back.dz_error_while_uploading'); ?>',

                //change the previewTemplate to use Bootstrap progress bars
                previewTemplate: "<div class=\"dz-preview dz-file-preview\">\n  <div class=\"dz-details\">\n    <div class=\"dz-filename\"><span data-dz-name></span></div>\n    <div class=\"dz-size\" data-dz-size></div>\n    <img data-dz-thumbnail />\n  </div>\n  <div class=\"progress progress-small progress-striped active\"><div class=\"progress-bar progress-bar-success\" data-dz-uploadprogress></div></div>\n  <div class=\"dz-success-mark\"><span></span></div>\n  <div class=\"dz-error-mark\"><span></span></div>\n  <div class=\"dz-error-message\"><span data-dz-errormessage></span></div>\n</div>"
            });

            $( document ).one( 'ajaxloadstart.page', function(e) {
                try {
                    myDropzone.destroy();
                } catch(e) {}
            });

            //initializing dropzone fallback
        } catch(e) {
            $( "#dropzone" ).hide();
            $( "#fallback" ).show();
        }


        if ( typeof myDropzone != "undefined" ) {

            myDropzone.on( 'queuecomplete', function () {
                $.ajax({
                    url: "<?php echo route('admin.listing-photos.photos', $listing->id); ?>",
                    type: "GET",
                    dataType: "html",

                    success: function ( html ) {
                        $( "#listingPhotos" ).html( html );
                        myDropzone.removeAllFiles(); //clears dropzone
                    }
                });
            });

        }

        var listingPhotos = $( "#listingPhotos" );

        listingPhotos.on( "click", "[data-delete-photo]", function() {
            var photoId = $( this ).data( "delete-photo" );

            $.ajax({
                url: "<?php echo route('admin.listing-photos.destroy'); ?>",
                data: {
                    _method: "DELETE",
                    photoId: photoId
                },
                type: "POST",

                success: function() {
                    var photoBlock = $( "[data-photo-block='" + photoId + "']" );
                    //removes unnecessary not shown notifications
                    if ( photoBlock.find( "[data-not-shown-notify]").length == 0 ) {
                        $ ( "[data-not-shown-notify]" ).first().remove();
                    }
                    //removes photo block
                    photoBlock.remove();

                    //removes unnecessary photo move arrows after removing block
                    var photoBlocks = $( "[data-photo-block]" );

                    photoBlocks.first().find( "[data-move-left]" ).remove();
                    photoBlocks.last().find( "[data-move-right]" ).remove();
                }
            })
        });


        listingPhotos.on( "click", "[data-move-photo]", function() {
            var photoId = $( this ).data( "move-photo" );
            var targetId = $( this ).data( "move-target" );

            $.ajax({
                url: "<?php echo route('admin.listing-photos.move'); ?>",
                data: {
                    photoId: photoId,
                    targetId: targetId
                },
                type: "POST",

                success: function() {
                    //replaces images
                    var photo = $( "[data-photo='" + photoId + "']" );
                    var target = $( "[data-photo='" + targetId + "']" );

                    var photoSrc = photo.attr( "src" );
                    var targetSrc = target.attr( "src" );

                    photo.attr( "src", targetSrc );
                    target.attr( "src", photoSrc );
                }
            })
        });

    })
</script>