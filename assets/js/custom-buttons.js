(function() {
    tinymce.create('tinymce.plugins.citation', {
        init : function(ed, url) {
 
            ed.addButton('citation', {
                title : 'Citation',
                cmd : 'citation',
                image :  url + '/citation.png'
            });
 
            ed.addCommand('citation', function() {
                var selected_text = ed.selection.getContent();
                var return_text = '';
                return_text = '<cite>' + selected_text + '</cite>';
                ed.execCommand('mceInsertContent', 0, return_text);
            });
        },
    });
    // Register plugin
    tinymce.PluginManager.add( 'citation', tinymce.plugins.citation );
})();