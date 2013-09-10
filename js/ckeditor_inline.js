$(function() {
    // inline CKEDITOR editing
     CKEDITOR.disableAutoInline = true;

     $("div[contenteditable='true']" ).each(function( index ) {

        var content_id = $(this).attr('id');

        CKEDITOR.inline( content_id, {
            extraPlugins: 'sourcedialog',
            on: {
                blur: function( event ) {

                    var data = event.editor.getData();
                    var request = jQuery.ajax({
                        url: "/welcome/update",
                        type: "POST",
                        data: {
                            content : data,
                            content_id : content_id
                        },
                        dataType: "html"
                    });
                }
            }
        });
    });
});