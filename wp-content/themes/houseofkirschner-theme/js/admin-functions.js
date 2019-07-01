/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;
/******/
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			exports: {},
/******/ 			id: moduleId,
/******/ 			loaded: false
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.loaded = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "./js/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';
	
	__webpack_require__(1);
	
	var _fileUpload = __webpack_require__(2);

/***/ }),
/* 1 */
/***/ (function(module, exports) {

	'use strict';
	
	var $ = jQuery;
	// Banners - Eliminar Item
	jQuery(document).ready(function ($) {
		$('#table__banners').on('click', '.reset', function (e) {
			var the_id = $(this).closest('tr').attr('id');
			$('#table__banners #' + the_id + ' .media-button').css('display', 'block');
			$('#table__banners #' + the_id + ' img').hide();
			$(this).hide();
		});
	});
	
	// Banners - Desplegar Imágenes
	jQuery(document).ready(function ($) {
		function inputCheck() {
			if ($(this).find('input').val() !== '') {
				$(this).find('button').css('display', 'none');
			} else {
				$(this).find('button').css('display', 'block');
			}
		}
		$('tr.banner_row').each(inputCheck);
	});
	// Featured Image - Escoger Imagen de Item
	jQuery(document).ready(function ($) {
		var meta_image_frame;
	
		$('#table__banners').on('click', '.media-button', function (e) {
	
			var the_id = $(this).closest('tr').attr('id');
			// console.log(the_id);
	
			e.preventDefault();
	
			if (meta_image_frame) {
				meta_image_frame.open();
				return;
			}
	
			// Sets up the media library frame
			var meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
				title: "Agregar Imagen",
				multiple: false,
				library: { type: 'image' }
			});
	
			var media_set_image = function media_set_image() {
				var selection = wp.media.frames.meta_image_frame.state().get('selection');
	
				if (!selection) {
					return;
				} // No selection
	
				// Iterate through selected elements
				selection.each(function (attachment) {
					var id = attachment.attributes.id;
					var thumbnail = attachment.attributes.sizes.thumbnail.url;
					$('#table__banners #' + the_id + ' .media-input').val(id);
					$('#table__banners #' + the_id + ' .media-button').css('display', 'none');
					$('#table__banners #' + the_id + ' .thumbnail_holder').html('<div class="reset">&#10005;</div><img width="100" src="' + thumbnail + '"><button class="button media-button" style="display:none;">Elegir Imagen</button>');
				});
			};
	
			wp.media.frames.meta_image_frame.on('close', media_set_image); // Closing event for media manger
			wp.media.frames.meta_image_frame.on('select', media_set_image); // Image selection event
			wp.media.frames.meta_image_frame.open(); // Showing media manager
		});
	});
	
	jQuery(document).ready(function ($) {
		var $featured_images = $(".featured_image_JS");
	
		if ($featured_images.length > 0) {
	
			var set_featured_image = function set_featured_image(e) {
	
				e.preventDefault();
	
				if (meta_image_frame) {
					meta_image_frame.open();
					return;
				}
	
				// Sets up the media library frame
				var meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
					// title: "Agregar Imagen",
					multiple: false,
					library: { type: 'image' }
				}),
				    $open = $(this),
				    media_set_image = function media_set_image() {
					var selection = wp.media.frames.meta_image_frame.state().get('selection');
	
					if (!selection) {
						return;
					} // No selection
	
					// Iterate through selected elements
					selection.each(function (attachment) {
						var id = attachment.attributes.id,
						    thumbnail = attachment.attributes.sizes.full.url,
						    $featured = $open.closest(".featured_image_JS");
	
						$featured.find(".featured_image-input_JS").val(id);
						$featured.find(".featured_image-image_JS").attr("src", thumbnail);
	
						$featured.find(".featured_image-howto_JS").show();
						$featured.find(".featured_image-remove_JS").show();
						$featured.find(".featured_image-image_JS").show();
						$featured.find(".featured_image-add_JS").hide();
					});
				};
	
				wp.media.frames.meta_image_frame.on('select', media_set_image); // Image selection event
				wp.media.frames.meta_image_frame.open(); // Showing media manager
			},
			    unset_featured_image = function unset_featured_image(e) {
				e.preventDefault();
				var $featured = $(this).closest(".featured_image_JS");
				$featured.find(".featured_image-input_JS").val("");
				$featured.find(".featured_image-image_JS").attr("src", "");
	
				$featured.find(".featured_image-howto_JS").hide();
				$featured.find(".featured_image-add_JS").show();
				$featured.find(".featured_image-image_JS").hide();
				$(this).hide();
			};
	
			$featured_images.on("click", ".featured_image-add_JS", set_featured_image);
			$featured_images.on("click", ".featured_image-image_JS", set_featured_image);
			$featured_images.on("click", ".featured_image-remove_JS", unset_featured_image);
		}
	});

/***/ }),
/* 2 */
/***/ (function(module, exports) {

	'use strict';
	
	Object.defineProperty(exports, "__esModule", {
		value: true
	});
	var $ = jQuery;
	//metaboxUploadInterface:: Obj config {
	//		WPLibraryOpts {String title, Bool multiple, Obj library}, //con defaults
	//		upload_button_selector,
	//		onSelectionForEach(attachment),
	//		afterSelectionForEach(selection),
	//		onRemoveHandler(selection)
	//	} -> I/O
	//
	// OJO: onRemoveHandler corre dos veces (init y después de la seleccion) así que hay que cuidar de no hacer demasiados demasiados listeners... usar $(selector).off('click') antes del $(selector).on('click' para devincular y no duplicar listeners.
	var metaboxUploadInterface = exports.metaboxUploadInterface = function metaboxUploadInterface(config) {
	
		var library_opts = config.WPLibraryOpts || {};
	
		//setup
		var upload_button = $(config.upload_button_selector);
	
		var meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
			title: library_opts.title || "Agregar Archivo",
			multiple: library_opts.multiple || false,
			library: library_opts.library || {}
		});
	
		var onSelection = function onSelection() {
			var selection = wp.media.frames.meta_image_frame.state().get('selection');
			if (!selection) {
				return;
			}
			selection.forEach(function (attachment) {
				config.onSelectionForEach(attachment);
			});
	
			if (typeof config.afterSelectionForEach === 'function') {
				config.afterSelectionForEach(selection);
			}
			if (typeof config.onRemoveHandler === 'function') {
				config.onRemoveHandler(selection);
			}
		};
	
		//register click handlers
		if (upload_button.length > 0 && meta_image_frame) {
			upload_button.on('click', function () {
				meta_image_frame.open();
			});
	
			if (typeof config.onRemoveHandler === 'function') {
				config.onRemoveHandler();
			}
		}
	
		//register WPLibrary onSelection event handler
		wp.media.frames.meta_image_frame.on('select', onSelection); // Image selection event
	};
	
	var metaboxUploadFiles = exports.metaboxUploadFiles = function metaboxUploadFiles() {
	
		$("body").find(".fileUpload_row_JS").each(function (upload) {
	
			var upload_id = this.id,
			    $upload = $(this),
			    add_button_selector = '.cltvo_upload_JS',
			    delete_button_selector = '.cltvo_remove_upload_JS',
			    input_id_selector = '.cltvo_file_id_input_JS',
			    input_filename_selector = '.cltvo_filename_input_JS',
			    success_selector = '.fileUpload__success_JS';
	
			console.log("upload " + upload_id + ' found');
			$upload.on("click", add_button_selector, function (e) {
				e.preventDefault();
	
				if (meta_image_frame) {
					meta_image_frame.open();
					return;
				}
	
				// Sets up the media library frame
				var meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
					multiple: false,
					library: {}
				}),
				    media_set_file = function media_set_file() {
					var selection = wp.media.frames.meta_image_frame.state().get('selection');
	
					if (!selection) {
						return;
					} // No selection
	
					// Iterate through selected elements
					selection.each(function (attachment) {
						var file_id = attachment.attributes.id,
						    filename = attachment.attributes.filename;
	
						$upload.find(input_id_selector).val(file_id);
						$upload.find(input_filename_selector).val(filename);
						$upload.find(success_selector).text(filename).show();
	
						$upload.find(add_button_selector).hide();
						$upload.find(delete_button_selector).show();
					});
				};
	
				wp.media.frames.meta_image_frame.on('select', media_set_file); // Image selection event
				wp.media.frames.meta_image_frame.open();
			});
	
			$upload.on("click", delete_button_selector, function () {
				$upload.find(input_id_selector).val('');
				$upload.find(input_filename_selector).val('');
				$upload.find(success_selector).hide();
	
				$(this).hide();
				$upload.find(add_button_selector).show();
			});
		});
	};
	
	var fileUploadConfig = exports.fileUploadConfig = {
		upload_button_selector: '.cltvo_upload_JS',
	
		onSelectionForEach: function onSelectionForEach(attachment) {
			var filename = attachment.attributes.filename;
			var file_id = attachment.id;
			var id_input = $('.cltvo_file_id_input_JS');
			var filename_input = $('.cltvo_filename_input_JS');
			var upload_button = $('.cltvo_upload_JS');
			var notification = $('.fileUpload__success_JS');
	
			var removeButton = $('.cltvo_remove_upload_JS');
	
			upload_button.hide();
			id_input.val(file_id);
			filename_input.val(filename);
			notification.text(filename).show();
			removeButton.show();
		},
	
		onRemoveHandler: function onRemoveHandler() {
			var remove_button = $('.cltvo_remove_upload_JS');
			remove_button.off('click');
			remove_button.on('click', function () {
				remove_button.hide();
				$('.cltvo_file_id_input_JS').val('');
				$('.cltvo_filename_input_JS').val('');
				$('.fileUpload__success_JS').hide();
				$('.cltvo_upload_JS').show();
			});
		}
	};
	
	var defaultFileUploadConfig = exports.defaultFileUploadConfig = function defaultFileUploadConfig() {
		jQuery(window).load(function () {
			// metaboxUploadInterface(fileUploadConfig)
			metaboxUploadFiles();
		});
	};

/***/ })
/******/ ]);
//# sourceMappingURL=admin-functions.js.map