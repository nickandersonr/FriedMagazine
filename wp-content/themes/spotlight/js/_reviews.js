/* global jQuery:false */

var THEMEREX_user_marks = false;
var allowUserReviews = false;

jQuery(document).ready(function () {
	"use strict";

	jQuery('.ratingEdit').mousemove(function (e) {
		"use strict";
		var ratWidth = jQuery(this).width();
		var ratX = e.pageX - jQuery(this).offset().left; //this.offsetLeft;
		if (ratX == 1) ratX = 0;
		if (ratX <= ratWidth) {
			var ratPercent = Math.round(ratX / ratWidth * 100);
			jQuery(this).find('.ratBubble').css('left', ratPercent + '%').html(marksToDisplay(ratPercent) + (reviews_max_level==100 ? '%' : ''));
		}
	});

	jQuery('.ratingEdit').click(function (e) {
		"use strict";
		var ratWidth = jQuery(this).width();
		var ratX = e.pageX - jQuery(this).offset().left; //this.offsetLeft + 1;
		if (ratX == 1) ratX = 0;
		if (ratX <= ratWidth) {
			var ratPercent = Math.round(ratX / ratWidth * 100);
			jQuery(this).data('mark', marksToDisplay(ratPercent))
				.find('input').val(marksToDisplay(ratPercent)).end()
				.find('.starHover').css('width', ratPercent + '%');
			if (!THEMEREX_ADMIN_MODE && !THEMEREX_user_marks) {
				THEMEREX_user_marks = true;
				jQuery(this).parent().siblings('.ratBody').find('.ratingEdit').each(function () {
					jQuery(this).data('mark', 0).find('.starHover').css('width', 0);
				});
			}
			setAverageMark(jQuery(this).parents('.ratingStars'));
		}
	});

	// Save user's marks
	if (typeof(allowUserReviews)!=undefined && allowUserReviews) {
		jQuery('#users-tabs .accept a').click(function(e) {
			var marks_cnt = 0;
			jQuery('#users-tabs .ratingEdit input').each(function (idx) {
				marks[idx] = Math.round(((marks.length>idx && marks[idx]!='' ? parseFloat(marks[idx])*users : 0) + parseFloat(jQuery(this).val()))/(users+1)*10)/10;
				jQuery(this).val(marks[idx]);
				marks_cnt++;
			});
			if (marks.length > marks_cnt)
				marks = marks.splice(marks_cnt, marks.length-marks_cnt)
			users++;
			jQuery('#users-tabs .accept').fadeOut();
			jQuery.post(THEMEREX_ajax_url, {
				action: 'reviews_users_accept',
				nonce: THEMEREX_ajax_nonce,
				post_id: post_id,
				marks: marks.join(','),
				users: users
			}).done(function(response) {
				var rez = JSON.parse(response);
				if (rez.error === '') {
					allowUserReviews = false;
					jQuery.cookie('reviews_vote', reviews_vote + (reviews_vote.substr(-1)!=',' ? ',' : '') + post_id + ',', {expires: 365, path: '/'});
					jQuery('#users-tabs .ratingItem').each(function (idx) {
						jQuery(this).data('mark', marks[idx])
							.find('input').val(marks[idx]).end()
							.find('.starHover').css('width', Math.round(marks[idx]/reviews_max_level*100) + '%');
					});
					setAverageMark(jQuery('#users-tabs'));
					jQuery('#users-tabs .ratingEdit').removeClass('ratingEdit');
					jQuery('#users-tabs .infoTotal .infoRat').html(THEMEREX_REVIEWS_VOTE);
				} else {
					jQuery('#users-tabs .infoTotal .infoRat').html(THEMEREX_REVIEWS_ERROR);
				}
			});
			e.preventDefault();
			return false;
		});
	}
});


// Show average mark
function setAverageMark(obj) {
	"use strict";
	var avg = 0;
	var cnt = 0;
	obj.find('.ratingEdit').each(function() {
		avg += parseFloat(jQuery(this).data('mark'));
		cnt++;
	});
	avg = cnt > 0 ? Math.round(avg/cnt*10)/10 : '0';
	if (reviews_max_level < 100 && String(avg).indexOf('.') < 0) {
		avg += '.0';
	}
	obj.find('.infoTotal')
		.find('.totalRating').html(avg).end()
		.find('.ratingItem').data('mark', avg)
		.find('.starHover').css('width', Math.round(avg/reviews_max_level*100) + '%');
}

// Convert percent to rating marks level
function marksToDisplay(mark) {
	"use strict";
	if (reviews_max_level < 100) {
		mark = Math.round(mark / 100 * reviews_max_level * 10) / 10;
		if (String(mark).indexOf('.') < 0) {
			mark += '.0';
		}
	}
	return mark;
}