<!-- dropzone upload script-->
<script src="<?php echo asset('templates/front/js/dropzone.min.js'); ?>"></script>

<script>
    $( document ).ready( function() {

        //PHOTOS INIT
        var listingPhotos = $( "#listingPhotos" );
        var maxPhotosNo = listingPhotos.data( "max-photos" );
        //show/hide implementation
        var photosLimitAlert = $(  "#photos-limit-alert" );
        var addFilesButton = $( "#add-files" );

        var fallback = $( "#fallback" );

        //disables add files button
        var disableAddFilesButton = function() {
            addFilesButton.attr("disabled", "disabled");
        };
        //counts uploaded photos
        var uploadedPhotosNo = function() {
            return $( "[data-delete-photo]" ).length;
        };
        //counts how many photos is left for upload
        var photosLeft = function() {
            if ( maxPhotosNo > uploadedPhotosNo() && maxPhotosNo != 'UNLIMITED') {
                return maxPhotosNo - uploadedPhotosNo();
            }
            if (maxPhotosNo == 'UNLIMITED') {
                return 1000;
            }
            return 0;
        };
        //updates uploaded photos number
        var updateUploadedPhotosNo = function() {
            $( "#photosUploaded" ).html( uploadedPhotosNo() );
        };

        if ( ! photosLeft() ) {
            photosLimitAlert.show();
            disableAddFilesButton();
        }

        //dropzone
        try {
            var myDropzone = new Dropzone(document.body, {
                url: "<?php echo route('photomanager.upload', $listing->id); ?>",
                //forceFallback: true,
                fallback: false, //leave false
                paramName: "file",
                thumbnailWidth: 160,
                thumbnailHeight: 160,
                parallelUploads: 2,
                previewTemplate: $( '#photo-preview-template' ).html(),
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                previewsContainer: "#previews", // Define the container to display the previews
                clickable: "#add-files" // Define the element that should be used as click trigger to select files.
            });

            $( document ).one( 'ajaxloadstart.page', function(e) {
                try {
                    myDropzone.destroy();
                } catch(e) {}
            });

            //initializing fallback form
        } catch(e) {
            addFilesButton.hide();
            fallback.show();
            if ( ! photosLeft() ) {
                fallback.find( "button" ).attr("disabled", "disabled");
            }
        }


        //if dropzone plugin is supported
        if ( typeof myDropzone != 'undefined' ) {
            //MAX FILES
            var maxFiles = function () {
                var photosLeftNo = photosLeft();
                if ( photosLeftNo == 1 ) {
                    return 2; //avoids errors of letting to select only single photo
                    //not ideal solution but does the trick
                }
                else return photosLeftNo;
            };
            //initializing maxFiles limit (whether on click or on drop)
            addFilesButton.on("click", function () {
                myDropzone.options.maxFiles = maxFiles();
            });
            myDropzone.on("drop", function () {
                myDropzone.options.maxFiles = maxFiles();
            });


            //page actions after uploading photos
            myDropzone.on('queuecomplete', function () {
                $.ajax({
                    url: "<?php echo route('photomanager.photos', $listing->id); ?>",
                    type: "GET",
                    dataType: "html",

                    success: function (html) {
                        $("#listingPhotos").html(html);
                        updateUploadedPhotosNo();

                        //nice uploaded photos fading away
                        $( "#previews" ).addClass( 'all-completed' );
                        //time out in order to let uploaded photos fade away nicely
                        setTimeout(function () {
                            myDropzone.removeAllFiles(); //clears dropzone
                            $("#previews").removeClass('all-completed');
                        }, 500);

                        //alerts and disables add files button
                        if ( ! photosLeft() ) {
                            photosLimitAlert.show();
                            disableAddFilesButton();
                        }
                    }
                });
            });

        }


        //page actions when deleting photo
        listingPhotos.on( "click", "[data-delete-photo]", function() {
            var photoId = $( this ).data( "delete-photo" );

            $.ajax({
                url: "<?php echo route('photomanager.destroy'); ?>",
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

                    //removes unnecessary photo move arrows
                    var photoBlocks = $( "[data-photo-block]" );
                    photoBlocks.first().find( "[data-move-left]" ).remove();
                    photoBlocks.last().find( "[data-move-right]" ).remove();

                    //removes alert about exceeded photos no + enables add files button
                    if ( photosLeft() ) {
                        photosLimitAlert.hide();
                        if ( typeof myDropzone != "undefined" ) {
                            addFilesButton.removeAttr( "disabled" );
                        } else {
                            fallback.find( "button" ).removeAttr( "disabled" ); //fallback upload form
                        }
                    }
                    updateUploadedPhotosNo();
                }
            })
        });


        //page actions when changing photos order
        listingPhotos.on( "click", "[data-move-photo]", function() {
            var photoId = $( this ).data( "move-photo" );
            var targetId = $( this ).data( "move-target" );

            $.ajax({
                url: "<?php echo route('photomanager.move'); ?>",
                data: {
                    photoId: photoId,
                    targetId: targetId
                },
                type: "POST",

                success: function() {
                    var photo = $( "[data-photo='" + photoId + "']" );
                    var target = $( "[data-photo='" + targetId + "']" );

                    var photoSrc = photo.attr( "src" );
                    var targetSrc = target.attr( "src" );

                    photo.attr( "src", targetSrc );
                    target.attr( "src", photoSrc );
                }
            })
        });
        // ./PHOTOS INIT
    })
</script>