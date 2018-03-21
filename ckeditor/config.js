/* 
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved. 
For licensing, see LICENSE.html or http://ckeditor.com/license 
*/ 

CKEDITOR.editorConfig = function( config ) 
{ 
        // Define changes to default configuration here. For example: 
    config.language = 'vn'; 

    config.skin='kama';
     
        // config.uiColor = '#AADC6E'; 
         
        config.toolbar_Full = [ 
            ['Source','-','Save','NewPage','Preview','-','Templates'], 
            ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'], 
            ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'], 
            '/', 
            ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'], 
            ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'], 
            ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'], 
            ['BidiLtr', 'BidiRtl' ], 
            ['Link','Unlink','Anchor'], 
            ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe'], 
            '/', 
            ['Styles','Format','Font','FontSize'], 
            ['TextColor','BGColor'], 
            ['Maximize', 'ShowBlocks','-','About'] 
            ]; 
         
        config.entities = false; 
        //config.entities_latin = false; 
         config.enterMode = CKEDITOR.ENTER_BR;//Loại bỏ thẻ <p>

        config.filebrowserBrowseUrl = 'http://127.0.0.1:1000/webphatgiao/admin/ckfinder/ckfinder.html'; 

        config.filebrowserImageBrowseUrl = 'http://127.0.0.1:1000/webphatgiao/admin/ckfinder/ckfinder.html?type=Images'; 

        config.filebrowserFlashBrowseUrl = 'http://127.0.0.1:1000/webphatgiao/admin/ckfinder/ckfinder.html?type=Flash'; 

        config.filebrowserUploadUrl = 'http://127.0.0.1:1000/webphatgiao/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'; 

        config.filebrowserImageUploadUrl = 'http://127.0.0.1:1000/webphatgiao/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'; 

        config.filebrowserFlashUploadUrl = 'http://127.0.0.1:1000/webphatgiao/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'; 

};  