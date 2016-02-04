<script type="text/javascript">
jQuery(document).ready(function() {
	<?php
	// Reject old browsers
	global $THEMEREX_jreject;
	if ($THEMEREX_jreject) {
	?>
		jQuery.reject({
			reject : {
				all: false, // Nothing blocked
				msie5: true, msie6: true, msie7: true, msie8: true // Covers MSIE 5-8
				/*
				 * Possibilities are endless...
				 *
				 * // MSIE Flags (Global, 5-8)
				 * msie, msie5, msie6, msie7, msie8,
				 * // Firefox Flags (Global, 1-3)
				 * firefox, firefox1, firefox2, firefox3,
				 * // Konqueror Flags (Global, 1-3)
				 * konqueror, konqueror1, konqueror2, konqueror3,
				 * // Chrome Flags (Global, 1-4)
				 * chrome, chrome1, chrome2, chrome3, chrome4,
				 * // Safari Flags (Global, 1-4)
				 * safari, safari2, safari3, safari4,
				 * // Opera Flags (Global, 7-10)
				 * opera, opera7, opera8, opera9, opera10,
				 * // Rendering Engines (Gecko, Webkit, Trident, KHTML, Presto)
				 * gecko, webkit, trident, khtml, presto,
				 * // Operating Systems (Win, Mac, Linux, Solaris, iPhone)
				 * win, mac, linux, solaris, iphone,
				 * unknown // Unknown covers everything else
				 */
			},
			imagePath: "<?php echo get_template_directory_uri(); ?>/js/jreject/images/",
			header: "<?php _e('Your browser is out of date', 'themerex'); ?>", // Header Text
			paragraph1: "<?php _e('You are currently using an unsupported browser', 'themerex'); ?>", // Paragraph 1
			paragraph2: "<?php _e('Please install one of the many optional browsers below to proceed', 'themerex'); ?>",
			closeMessage: "<?php _e('Close this window at your own demise!', 'themerex'); ?>" // Message below close window link
		});
	<?php 
	} 
	?>
});


// Popup windows engine
var THEMEREX_popupEngine = 'magnific';

// E-mail mask
THEMEREX_EMAIL_MASK = '^([a-zA-Z0-9_\\-]+\\.)*[a-zA-Z0-9_\\-]+@[a-z0-9_\\-]+(\\.[a-z0-9_\\-]+)*\\.[a-z]{2,6}$';

// Javascript String constants for translation
THEMEREX_MESSAGE_EMAIL_ADDED= "<?php _e('Your address %s has been successfully added to the subscription list', 'themerex'); ?>";
THEMEREX_MESSAGE_BOOKMARK_ADD   = "<?php echo addslashes(__('Add the bookmark', 'themerex')); ?>";
THEMEREX_MESSAGE_BOOKMARK_ADDED = "<?php echo addslashes(__('Current page has been successfully added to the bookmarks. You can see it in the right panel on the tab \'Bookmarks\'', 'themerex')); ?>";
THEMEREX_MESSAGE_BOOKMARK_EXISTS= "<?php echo addslashes(__('Current page already exists in the bookmarks list', 'themerex')); ?>";
THEMEREX_REVIEWS_VOTE		= "<?php _e('Thanks for your vote! New average rating is:', 'themerex'); ?>";
THEMEREX_REVIEWS_ERROR		= "<?php _e('Error saving your vote! Please, try again later.', 'themerex'); ?>";
THEMEREX_MAGNIFIC_LOADING   = "<?php _e('Loading image #%curr% ...', 'themerex'); ?>";
THEMEREX_MAGNIFIC_ERROR     = "<?php echo addslashes(__('<a href="%url%">The image #%curr%</a> could not be loaded.', 'themerex')); ?>";
THEMEREX_SAVE_ERROR = "<?php echo __('Error saving post data', 'themerex') ?>";
THEMEREX_MESSAGE_ERROR_LIKE = "<?php _e('Error saving your like! Please, try again later.', 'themerex'); ?>";
THEMEREX_SC_SKILLS			= "<?php _e('Skills', 'themerex'); ?>";
THEMEREX_GLOBAL_ERROR_TEXT	= "<?php _e('Global error text', 'themerex'); ?>";
THEMEREX_NAME_EMPTY			= "<?php _e('The name can\'t be empty', 'themerex'); ?>";
THEMEREX_NAME_LONG 			= "<?php _e('Too long name', 'themerex'); ?>";
THEMEREX_EMAIL_EMPTY 		= "<?php _e('Too short (or empty) email address', 'themerex'); ?>";
THEMEREX_EMAIL_LONG			= "<?php _e('Too long email address', 'themerex'); ?>";
THEMEREX_EMAIL_NOT_VALID 	= "<?php _e('Invalid email address', 'themerex'); ?>";
THEMEREX_SUBJECT_EMPTY		= "<?php _e('The subject can\'t be empty', 'themerex'); ?>";
THEMEREX_SUBJECT_LONG 		= "<?php _e('Too long subject', 'themerex'); ?>";
THEMEREX_MESSAGE_EMPTY 		= "<?php _e('The message text can\'t be empty', 'themerex'); ?>";
THEMEREX_MESSAGE_LONG 		= "<?php _e('Too long message text', 'themerex'); ?>";
THEMEREX_SEND_COMPLETE 		= "<?php _e("Send message complete!", 'themerex'); ?>";
THEMEREX_SEND_ERROR 		= "<?php _e("Transmit failed!", 'themerex'); ?>";
THEMEREX_LOGIN_EMPTY		= "<?php _e("The Login field can't be empty", 'themerex'); ?>";
THEMEREX_LOGIN_LONG			= "<?php _e('Too long login field', 'themerex'); ?>";
THEMEREX_PASSWORD_EMPTY		= "<?php _e("The password can't be empty and shorter then 5 characters", 'themerex'); ?>";
THEMEREX_PASSWORD_LONG		= "<?php _e('Too long password', 'themerex'); ?>";
THEMEREX_PASSWORD_NOT_EQUAL	= "<?php _e('The passwords in both fields are not equal', 'themerex'); ?>";
THEMEREX_REGISTRATION_SUCCESS= "<?php _e('Registration success! Please log in!', 'themerex'); ?>";
THEMEREX_REGISTRATION_FAILED= "<?php _e('Registration failed!', 'themerex'); ?>";
THEMEREX_REGISTRATION_AUTHOR= "<?php _e('Your account is waiting for the site admin moderation!', 'themerex'); ?>";
THEMEREX_GEOCODE_ERROR 		= "<?php _e("Geocode was not successful for the following reason:", 'wspace'); ?>";
THEMEREX_GOOGLE_MAP_NOT_AVAIL="<?php _e("Google map API not available!", 'themerex'); ?>";
THEMEREX_NAVIGATE_TO		= "<?php _e("Navigate to...", 'themerex'); ?>";
THEMEREX_SAVE_SUCCESS 		= "<?php _e("Post content saved!", 'themerex') ?>";

// AJAX parameters
<?php global $THEMEREX_ajax_url, $THEMEREX_ajax_nonce; ?>
var THEMEREX_ajax_url = "<?php echo $THEMEREX_ajax_url; ?>";
var THEMEREX_ajax_nonce = "<?php echo $THEMEREX_ajax_nonce; ?>";

// Site base url
var THEMEREX_site_url = "<?php echo get_site_url(); ?>";

// Theme base url
var THEMEREX_theme_url = "<?php echo get_template_directory_uri(); ?>";
</script>
