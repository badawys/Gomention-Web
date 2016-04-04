/*jslint browser: true*/
/*global $, jQuery, alert*/

(function () {
	'use strict';
	//Hide pagination
	$('ul.pagination:visible:first').hide();

	var $container = $('#container'), delId, delSelector;

	$container.imagesLoaded().progress(function () {

		$container.show();

		$container.masonry({
			columnWidth: '.item',
			itemSelector: '.item',
			percentPosition: true
		});

		$('.fancybox').fancybox({
			padding: 0,
			openEffect: 'elastic',
			closeEffect: 'elastic',
			closeBtn: false,
			closeClick: true
		});

		$('.mentions-list').infinitescroll({
			navSelector: ".pagination",
			nextSelector: ".pagination li.active + li > a",
			itemSelector: ".item",
			debug: false

		}, function (arrayOfNewElems) {

			// hide new items while they are loading
			var $newElems = $(arrayOfNewElems).css({
				opacity: 0
			});
			// ensure that images load before adding to masonry layout
			$newElems.imagesLoaded(function () {
				// show elems now they're ready
				$newElems.animate({
					opacity: 1
				});
				$container.masonry('appended', $newElems, true);
			});
		});
	});

	/*
	*	Show delete model
	*/
	$(document).on('click', '.delete-mention', function () {

		delId = $(this).parents('.item').attr('id');
		delSelector = $('#' + delId);

		$('#delModel').modal('show');
	});

	/*
	*	Delete mention
	*/
	$('#doDelete').click(function () {
		$.ajax({
			url: 'mention/' + delId + '/delete',
			type: 'GET',
			success: function (result) {
				$('#container')
					.masonry('remove', delSelector)
					.masonry();

				$('#delModel').modal('hide');

				delSelector = null;
				delId = null;
			}
		});
	});


	/*
	*	Like toggle
	*/

	$(document).on('click', '.likeToggle', function (e) {

		var $selected = $(this),
			mentionId = $selected.parents('.item').attr('id');

		$.ajax({
			url: 'mention/' + mentionId + '/like',
			type: 'GET',
			success: function (result) {
				$selected.toggleClass("liked");
			}
		});

		e.preventDefault();
	});

}());
