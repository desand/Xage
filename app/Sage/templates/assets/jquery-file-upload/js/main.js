/*
 * jQuery File Upload Plugin JS Example 7.0
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/*jslint nomen: true, unparam: true, regexp: true */
/*global $, window, document */

$(function () {
    'use strict';

    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        xhrFields: {withCredentials: true},
        url: $('#fileuploadurl').val()
    });

    
    // Load existing files:
    // Demo settings:
    $.ajax({
        // Uncomment the following to send cross-domain cookies:
        url: $('#fileupload').fileupload('option', 'url'),
        dataType: 'json',            
        context: $('#fileupload')[0],
        maxFileSize: 5000000,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,///(xls|xlsx)$/i,
        process: [
            {
                action: 'load',
                fileTypes: /^image\/(gif|jpeg|png)$/,//fileTypes: /(xls|xlsx)$/,
                maxFileSize: 20000000 // 20MB
            },
            {
                action: 'resize',
                maxWidth: 1440,
                maxHeight: 900
            },
            {
                action: 'save'
            }
        ]
    }).done(function (result) {
        $(this).fileupload('option', 'done')
            .call(this, null, {result: result});
    });

    // Upload server status check for browsers with CORS support:
    if ($.support.cors) {
        $.ajax({
            url: $('#fileuploadurl').val(),
            type: 'HEAD'
        }).fail(function () {
            $('<span class="alert alert-error"/>')
                .text('Upload server currently unavailable - ' +
                        new Date())
                .appendTo('#fileupload');
        });
    }
    

});
