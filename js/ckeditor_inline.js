$(function() {

    $('#refresh').click(function(){
        location.reload();
    });

    $('#reset').click(function(){

        jQuery.ajax({
            url: "/welcome/reset",
            type: "POST",
            data: {
                reset : true
            },
            dataType: "html"
        }).done(function() {
            location.reload();
        });
     });

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