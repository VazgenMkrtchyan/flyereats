<!-- inline scripts related to this page -->
<script type="text/javascript">
    $( document ).ready( function() {

        //returns permissions tree
        var adminPermissions = function(options, callback){
            var $data = null;
            if(!("text" in options) && !("type" in options)){
                $data = JS.adminPermissions;//the root tree
                callback({ data: $data });
                return;
            }
            else if("type" in options && options.type == "folder") {
                if("additionalParameters" in options && "children" in options.additionalParameters)
                    $data = options.additionalParameters.children || {};
                else $data = {};//no data
            }

            if($data != null)
                callback({ data: $data });
        };

        //implements tree
        $('#adminPermissions')
                .ace_tree({
                    dataSource: adminPermissions,
                    multiSelect: true,
                    cacheItems: true,
                    'open-icon' : 'ace-icon tree-minus',
                    'close-icon' : 'ace-icon tree-plus',
                    'selectable' : true,
                    'selected-icon' : 'ace-icon fa fa-check',
                    'unselected-icon' : 'ace-icon fa fa-times',
                    loadingHTML : '<div class="tree-loading"><i class="ace-icon fa fa-refresh fa-spin blue"></i></div>'
                })
            //bypasses Fuel UX tree.js limitations (loads all elements inside)
                .find( '.tree-branch-name' ).trigger( 'click' ).trigger( 'click' ); //opens & closes


        //collects selected items
        $( '#applyPermissions' ).on( 'click', function() {
            var ids = '';
            var items = $('#adminPermissions').tree('selectedItems');
            for( var i in items ) {
                var item = items[i];
                ids +=  item.additionalParameters['id'] + "|";
            }
            //updates permissions
            $( location ).attr( 'href', "{{ route('admin.administrators.applypermissions', $administrator->id) }}" + "?permissions=" + ids);
        });
    })
</script>