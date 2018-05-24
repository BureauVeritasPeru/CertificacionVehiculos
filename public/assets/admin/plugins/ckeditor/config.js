/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For the complete reference:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for a single toolbar row.
	config.toolbarGroups = [
		{ name: 'clipboard',    groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',      groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'basicstyles',  groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',    groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'others' },
		{ name: 'tools' },
		{ name: 'document',     groups: [ 'mode', 'document', 'doctools' ] },
	];

	config.toolbar_Basic =
	[
		['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', 'Link', 'Unlink', '-', 'TextColor', 'BGColor', 'PasteFromWord', 'PasteText', '-', 'Sourcedialog', 'Templates']
	];
	// The default plugins included in the basic setup define some buttons that
	// we don't want too have in a basic editor. We remove them here.
	config.removeButtons = 'Cut,Copy,Paste,Undo,Redo,Anchor,Strike,Subscript,Superscript';

	// Let's have it basic on dialogs as well.
	config.removeDialogTabs = 'link:advanced';

	config.extraAllowedContent ={
    'div span p a em strong ': {
        attributes: ['itemscope','itemtype','itemprop'],
    },
    'time':{
        attributes: ['itemprop','datetime']   
    }
};
	/*
        config.colorButton_colors = '09195B,233e99,7abbd7,4d4d4f,000000,347abe,505ba9,afd3e5,'+
                       'a7a9ac,89816f,ba6127,a4bae0,cddee7,cacbcd,c2b59b,f7931e,'+
                       'b8d5f0,74adb2,dcddde,e6e2d5,e9d66b,dae3e7,acd4d9,f1f1f2,'+
                       'efebe3,2f0e6bc,838f5e,ffffff,bb7665';
        */
	config.autoParagraph = false;
	config.enterMode = CKEDITOR.ENTER_P;
	config.templates_replaceContent = false;
	config.extraPlugins = 'strinsert';
};
