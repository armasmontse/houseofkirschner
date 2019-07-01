const $ = jQuery
// Banners - Eliminar Item
jQuery(document).ready(function($) {
	$('#table__banners').on('click','.reset',function(e){
		var the_id = $(this).closest('tr').attr('id');
		$('#table__banners #'+the_id+' .media-button').css('display','block');
		$('#table__banners #'+the_id+' img').hide();
		$(this).hide();
	});
});

// Banners - Desplegar Imágenes
jQuery(document).ready(function($){
	function inputCheck() {
		if ( $(this).find('input').val() !== '' ) {
			$(this).find('button').css('display','none');
		} else {
			$(this).find('button').css('display','block');
		}
	}
	$('tr.banner_row').each(inputCheck);
});
// Featured Image - Escoger Imagen de Item
jQuery(document).ready(function($){
	var meta_image_frame;

	$('#table__banners').on('click','.media-button',function(e){

		var the_id = $(this).closest('tr').attr('id');
		// console.log(the_id);

		e.preventDefault();

		if ( meta_image_frame ) {
			meta_image_frame.open();
			return;
		}

		// Sets up the media library frame
		var meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
			title: "Agregar Imagen",
			multiple: false,
			library: {type: 'image'}
		});

		var media_set_image = function() {
			var selection = wp.media.frames.meta_image_frame.state().get('selection');

			if (!selection) { return;} // No selection

			// Iterate through selected elements
			selection.each(function(attachment) {
				var id = attachment.attributes.id;
				var thumbnail = attachment.attributes.sizes.thumbnail.url;
				$('#table__banners #'+the_id+' .media-input').val(id);
				$('#table__banners #'+the_id+' .media-button').css('display','none');
				$('#table__banners #'+the_id+' .thumbnail_holder').html('<div class="reset">&#10005;</div><img width="100" src="'+thumbnail+'"><button class="button media-button" style="display:none;">Elegir Imagen</button>');
			});
		};

		wp.media.frames.meta_image_frame.on('close', media_set_image); // Closing event for media manger
		wp.media.frames.meta_image_frame.on('select', media_set_image); // Image selection event
		wp.media.frames.meta_image_frame.open(); // Showing media manager

	});
});

jQuery(document).ready(function($) {
	var $featured_images = $(".featured_image_JS");

	if ($featured_images.length > 0) {

		var set_featured_image = function(e){

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
				media_set_image = function() {
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
					$featured.find(".featured_image-image_JS").attr("src",thumbnail);

					$featured.find(".featured_image-howto_JS").show();
					$featured.find(".featured_image-remove_JS").show();
					$featured.find(".featured_image-image_JS").show();
					$featured.find(".featured_image-add_JS").hide();
				});
			};

			wp.media.frames.meta_image_frame.on('select', media_set_image); // Image selection event
			wp.media.frames.meta_image_frame.open(); // Showing media manager
		},

		unset_featured_image = function(e){
			e.preventDefault();
			var $featured = $(this).closest(".featured_image_JS");
			$featured.find(".featured_image-input_JS").val("");
			$featured.find(".featured_image-image_JS").attr("src","");

			$featured.find(".featured_image-howto_JS").hide();
			$featured.find(".featured_image-add_JS").show();
			$featured.find(".featured_image-image_JS").hide();
			$(this).hide();
		} ;

		$featured_images.on("click", ".featured_image-add_JS",set_featured_image);
		$featured_images.on("click", ".featured_image-image_JS",set_featured_image);
		$featured_images.on("click", ".featured_image-remove_JS",unset_featured_image);
	}

});
