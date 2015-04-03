/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For the complete reference:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'about' }
	];

	// Remove some buttons, provided by the standard plugins, which we don't
	// need to have in the Standard(s) toolbar.
	config.removeButtons = 'Underline,Subscript,Superscript';

	// Se the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';
    var base_url = 'http://localhost/dkdt/';
    //var base_url = 'http://dolong.zz.mu/';
	// Make dialogs simpler.
	config.removeDialogTabs = 'image:advanced;link:advanced';
    config.filebrowserBrowseUrl= base_url.concat('public/ckfinder/ckfinder.html');
    config.filebrowserImageBrowseUrl= base_url.concat('public/ckfinder/ckfinder.html?type=Images');
    config.filebrowserFlashBrowseUrl= base_url.concat('public/ckfinder/ckfinder.html?type=Flash');
    config.filebrowserUploadUrl= base_url.concat('public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files');
    config.filebrowserImageUploadUrl= base_url.concat('public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images');                        
    config.filebrowserFlashUploadUrl= base_url.concat('public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash');  
};
