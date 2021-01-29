<!-- JQUERY FOR DEPENDENT DROPDOWNS (WITH 2 LEVELS ONLY(parent & child)) -->
<script>
    $( document ).ready( function() {
        //GENERATES DROPDOWN
        var generateDropdown = function( apiUrl, parentSelector, childSelector, childSelectedValue, selectFromParentText, selectFromChildFirstOptionText, countOf, loadingIndicatorSelector, loadingDataText ) {
            var dropdown = $( childSelector );
            if ( $( parentSelector ).val() != "" ) {
                $.ajax({
                    url: apiUrl,
                    data: {
                        parentId: $( parentSelector ).val(),
                        countOf: countOf
                    },
                    type: "GET",
                    dataType: "json",

                    beforeSend: function() {
                        if ( loadingIndicatorSelector != "" ) {
                            $(loadingIndicatorSelector).show();
                        } //shows loading indicator

                        if ( loadingDataText != "" ) {
                            dropdown.html( "<option value=''>" +
                            loadingDataText + "</option>" );
                        } //adds loading text in dropdown
                    },

                    success: function( json ) {
                        //formats first select option
                        var options = "<option value=''>" + selectFromChildFirstOptionText + "</option>";

                        $.each( json, function ( key, value ) {
                            options += "<option value='" + key + "'>" +
                            value + "</option>";
                        });

                        dropdown.html( options ); //adds select options
                    },

                    complete: function() {
                        //selects correct child value
                        if ( childSelectedValue != "" ) {
                            dropdown.val( childSelectedValue );
                        }
                        //hides loading indicator
                        if ( loadingIndicatorSelector != "" ) {
                            $( loadingIndicatorSelector ).hide();
                        }
                    }
                });
            }
            else
            {
                //asks to select from parent first
                dropdown.html( "<option value=''>" + selectFromParentText + "</option>" );
            }
        };

        //dropdown initialize function
        window.dropdownInit = function( apiUrl, parentSelector, childSelector, childSelectedValue, selectFromParentText, selectFromChildFirstOptionText, countOf, loadingIndicatorSelector, loadingDataText ) {

            //loads values on page load if parent has selected value
            if ( $( parentSelector ).val() != "" ) {
                generateDropdown( apiUrl, parentSelector, childSelector, childSelectedValue, selectFromParentText, selectFromChildFirstOptionText, countOf, loadingIndicatorSelector, loadingDataText );
            }

            //reloads values
            $( parentSelector ).on( "change", function() {
                generateDropdown( apiUrl, parentSelector, childSelector, "", selectFromParentText, selectFromChildFirstOptionText, countOf, loadingIndicatorSelector, loadingDataText );
            })
        }
    })
</script>