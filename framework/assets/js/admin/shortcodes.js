// Salamander Theme Tinymce plugin
jQuery(function($) {
    /* Register button */
    tinymce.create('tinymce.plugins.SSCButtons', {
        init: function( editor, url )  {

            // Add the Insert Gistpen button
            editor.addButton( 'ssc_button', {
                //text: 'Insert Shortcode',
                icon: 'icons dashicons-icon',
                tooltip: 'Insert Shortcode',
                cmd: 'plugin_command'
            });

            // Called when we click the Insert Gistpen button
            editor.addCommand( 'plugin_command', function() {
                // Calls the pop-up modal
                editor.windowManager.open({
                    // Modal settings
                    title: 'Insert Shortcode',
                    width: jQuery( window ).width() * 0.7,
                    // minus head and foot of dialog box
                    height: (jQuery( window ).height() - 36 - 50) * 0.7,
                    inline: 1,
                    id: 'plugin-slug-insert-dialog',
                    buttons: [{
                        text: 'Insert',
                        id: 'plugin-slug-button-insert',
                        class: 'insert',
                        onclick: function( e ) {
                            insertShortcode();
                        },
                    },
                    {
                        text: 'Cancel',
                        id: 'plugin-slug-button-cancel',
                        onclick: function ( e ) {
                            $( '#shrtcodes-form-wrapper' ).append( $('#shortcodes-form') );
                            tinyMCE.activeEditor.windowManager.close();
                        }
                        // onclick: 'close'
                    }],
                });
                //Move form to dialog
                $( '#plugin-slug-insert-dialog-body' ).append( $('#shortcodes-form') );

            });
        }
    });
    /* Start the buttons */
    tinymce.PluginManager.add('ssc_button', tinymce.plugins.SSCButtons);

    getShortCodeTemplate($('#shortcode-type').val());
    /* add ajax calback on shortcodes type change */
    $('#shortcode-type').on('change', function() {
        getShortCodeTemplate($(this).val());
    });
    /* parse shortcodes form */
    $('#insert').click(function() {
        var data = $("#shortcodes-form").find("select, textarea, input, checkbox").serializeArray();
        var shortcode = getShortcode(data);
        tb_remove();
        tinyMCE.activeEditor.selection.setContent(shortcode.toString());

        return false;
    });

    function insertShortcode() {
        var data = $("#shortcodes-form").find("select, textarea, input, checkbox").serializeArray();
        tinyMCE.activeEditor.selection.setContent(getShortcode(data));
        //move for back to wrapper
        $('#shrtcodes-form-wrapper').append($('#shortcodes-form'));
        tinyMCE.activeEditor.windowManager.close();
    }

    function getShortcode(data) {
        var cnt = '';
        var shortcodeType = '';
        var string = '[';
        var assoc = {};
        $.each(data, function(k, v) {
            if (typeof(assoc[v.name]) == 'undefined' && assoc[v.name] == null) {
                assoc[v.name] = [];
                assoc[v.name].push(v.value);
            }
            else {
                assoc[v.name].push(v.value);
            }
        });
        shortcodeType = assoc['shortcode_type'][0];
        string += shortcodeType;
        if ('cnt' in assoc) {
            cnt = assoc['cnt'];
        }
        delete assoc['cnt'];
        delete assoc['shortcode_type'];
        $.each(assoc, function(k, v) {
            v = v.join(', ');
            string += ' ' + k + '="' + v + '"';
        });
        string += ']';
        if (cnt) {
            string += cnt + '[/' + shortcodeType + ']';
        }

        return string;
    }

    function getShortCodeTemplate(type) {
        console.log(type.replace('_', '-'))
        $.post(
            //global var viewsDir
            viewsDir + 'admin/shortcodes/' + type.replace('_', '-') + '.php',
            {},
            function(data) {
                $('#shortcode-data').replaceWith($(data).find('#shortcode-data'));
            },
            'html'
        );
    }
});
