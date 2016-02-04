<?php
/**
 * Add function to widgets_init that will load our widget.
 */
add_action( 'widgets_init', 'widget_contacts_load' );

/**
 * Register our widget.
 */
function widget_contacts_load() {
	register_widget( 'themerex_contacts_widget' );
}

/**
 * Twitter Widget class.
 */
class themerex_contacts_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function themerex_contacts_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget_contacts', 'description' => __('Contacts block', 'themerex') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 250, 'id_base' => 'themerex-contacts-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'themerex-contacts-widget', __('ThemeREX - Contacts block', 'themerex'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', isset($instance['title']) ? $instance['title'] : '' );
		$contacts_address = isset($instance['contacts_address']) ? $instance['contacts_address'] : '';
		$contacts_phone = isset($instance['contacts_phone']) ? $instance['contacts_phone'] : '';
		$contacts_fax = 	isset($instance['contacts_fax']) ? $instance['contacts_fax'] : '';
		$contacts_email = 	isset($instance['contacts_email']) ? $instance['contacts_email'] : '';
		$contacts_website = isset($instance['contacts_website']) ? $instance['contacts_website'] : '';
		
		$social_title =  isset($instance['social_title']) ? $instance['social_title'] : '';
		$contacts_linkedin =  isset($instance['contacts_linkedin']) ? $instance['contacts_linkedin'] : '';
		$contacts_facebook =  isset($instance['contacts_facebook']) ? $instance['contacts_facebook'] : '';
		$contacts_gplus = 	  isset($instance['contacts_gplus']) ? $instance['contacts_gplus'] : '';
		$contacts_pinterest = isset($instance['contacts_pinterest']) ? $instance['contacts_pinterest'] : '';
		$contacts_dribble =   isset($instance['contacts_dribble']) ? $instance['contacts_dribble'] : '';

		/* Before widget (defined by themes). */			
		echo $before_widget;		

		if ($title) echo $before_title . $title . $after_title;
?>			
		<div class="widget_contacts_inner">
			<?php 
				echo !empty($contacts_address) ? '<div class="contacts_widget_contacts">'.$contacts_address.'</div>' : '';
				$contact_details = array($contacts_phone, $contacts_fax, $contacts_email, $contacts_website);
				$show_details = false;
				foreach ($contact_details as $detail) {
					if(!empty($detail)) {
						$show_details = true;
						break;
					}
				}
				if($show_details) {
					echo '<div class="contact_details_section">';
					echo '<h3 class="widget_section_title">'.__('Contact Details', 'themerex').'</h3>';
					echo !empty($contacts_phone) ? '<div class="contact_details_row"><i class="icon icon-phone"></i>'.$contacts_phone.'</div>' : '';
					echo !empty($contacts_fax) ? '<div class="contact_details_row"><i class="icon icon-print-1"></i>'.$contacts_fax.'</div>' : '';
					echo !empty($contacts_email) ? '<div class="contact_details_row"><i class="icon icon-mail-alt"></i><a target="_blank" href="mailto:'.$contacts_email.'">'.$contacts_email.'</a></div>' : '';
					echo !empty($contacts_website) ? '<div class="contact_details_row"><i class="icon icon-globe-1"></i><a target="_blank" href="'.$contacts_website.'">'.$contacts_website.'</a></div>' : '';
					echo '</div>';
				}
				$show_social = false;
				$contact_links = array($contacts_linkedin, $contacts_facebook, $contacts_gplus, $contacts_pinterest, $contacts_dribble);
				foreach ($contact_links as $social) {
					if(!empty($social)) {
						$show_social = true;
						break;
					}
				}
				if($show_social) {
					trx_print($social_title, '<h3 class="widget_section_title">%s</h3>');
					echo '<div class="widget_contact_social user_links"><ul>';
					echo !empty($contacts_linkedin) ? '<li class="contact_social"><a data-tooltip="Linkedin" href="'.$contacts_linkedin.'"><i class="icon icon-linkedin"></i></a></li>' : '';
					echo !empty($contacts_facebook) ? '<li class="contact_social"><a data-tooltip="Facebook" href="'.$contacts_facebook.'"><i class="icon icon-facebook"></i></a></li>' : '';
					echo !empty($contacts_gplus) ? '<li class="contact_social"><a data-tooltip="Google Plus" href="'.$contacts_gplus.'"><i class="icon icon-gplus"></i></a></li>' : '';
					echo !empty($contacts_pinterest) ? '<li class="contact_social"><a data-tooltip="Pinterest" href="'.$contacts_pinterest.'"><i class="icon icon-pinterest"></i></a></li>' : '';
					echo !empty($contacts_dribble) ? '<li class="contact_social"><a data-tooltip="Dribbble" href="'.$contacts_dribble.'"><i class="icon icon-dribbble"></i></a></li>' : '';
					echo '</ul><span class="tooltip"></span></div>';
				}
			?>
		</div>
<?php
		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['social_title'] = strip_tags( $new_instance['social_title'] );
		$instance['contacts_address'] = strip_tags( $new_instance['contacts_address'] );
		$instance['contacts_phone'] = strip_tags( $new_instance['contacts_phone'] );
		$instance['contacts_fax'] = strip_tags( $new_instance['contacts_fax'] );
		$instance['contacts_email'] = strip_tags( $new_instance['contacts_email'] );
		$instance['contacts_website'] = strip_tags( $new_instance['contacts_website'] );		
		
		$instance['contacts_linkedin'] = strip_tags( $new_instance['contacts_linkedin'] );
		$instance['contacts_facebook'] = strip_tags( $new_instance['contacts_facebook'] );
		$instance['contacts_gplus'] = strip_tags( $new_instance['contacts_gplus'] );
		$instance['contacts_pinterest'] = strip_tags( $new_instance['contacts_pinterest'] );
		$instance['contacts_dribble'] = strip_tags( $new_instance['contacts_dribble'] );

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	 
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => '', 'description' => __('Contacts block', 'themerex') );
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		$title = isset($instance['title']) ? $instance['title'] : '';
		$social_title = isset($instance['social_title']) ? $instance['social_title'] : '';
		$contacts_address 	= isset($instance['contacts_address']) ? $instance['contacts_address'] : '';
		$contacts_phone 	= isset($instance['contacts_phone']) ? $instance['contacts_phone'] : '';
		$contacts_fax 		= isset($instance['contacts_fax']) ? $instance['contacts_fax'] : '';
		$contacts_email 	= isset($instance['contacts_email']) ? $instance['contacts_email'] : '';
		$contacts_website 	= isset($instance['contacts_website']) ? $instance['contacts_website'] : '';
		
		$contacts_linkedin 	= isset($instance['contacts_linkedin']) ? $instance['contacts_linkedin'] : '';
		$contacts_facebook 	= isset($instance['contacts_facebook']) ? $instance['contacts_facebook'] : '';
		$contacts_gplus 	= isset($instance['contacts_gplus']) ? $instance['contacts_gplus'] : '';
		$contacts_pinterest = isset($instance['contacts_pinterest']) ? $instance['contacts_pinterest'] : '';
		$contacts_dribble 	= isset($instance['contacts_dribble']) ? $instance['contacts_dribble'] : '';
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'themerex'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $title; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'contacts_address' ); ?>"><?php _e('Address:', 'themerex'); ?></label>
			<input id="<?php echo $this->get_field_id( 'contacts_address' ); ?>" name="<?php echo $this->get_field_name( 'contacts_address' ); ?>" value="<?php echo $contacts_address; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'contacts_phone' ); ?>"><?php _e('Phone:', 'themerex'); ?></label>
			<input id="<?php echo $this->get_field_id( 'contacts_phone' ); ?>" name="<?php echo $this->get_field_name( 'contacts_phone' ); ?>" value="<?php echo $contacts_phone; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'contacts_fax' ); ?>"><?php _e('Fax:', 'themerex'); ?></label>
			<input id="<?php echo $this->get_field_id( 'contacts_fax' ); ?>" name="<?php echo $this->get_field_name( 'contacts_fax' ); ?>" value="<?php echo $contacts_fax; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'contacts_email' ); ?>"><?php _e('Email:', 'themerex'); ?></label>
			<input id="<?php echo $this->get_field_id( 'contacts_email' ); ?>" name="<?php echo $this->get_field_name( 'contacts_email' ); ?>" value="<?php echo $contacts_email; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'contacts_website' ); ?>"><?php _e('Website:', 'themerex'); ?></label>
			<input id="<?php echo $this->get_field_id( 'contacts_website' ); ?>" name="<?php echo $this->get_field_name( 'contacts_website' ); ?>" value="<?php echo $contacts_website; ?>" style="width:100%;" />
		</p>
		<h4 class="section_title"><?php echo __('Get Social', 'themerex'); ?></h4>
		<p>
			<label for="<?php echo $this->get_field_id( 'social_title' ); ?>"><?php _e('Socail Title:', 'themerex'); ?></label>
			<input id="<?php echo $this->get_field_id( 'social_title' ); ?>" name="<?php echo $this->get_field_name( 'social_title' ); ?>" value="<?php echo $social_title; ?>" style="width:100%;" />
		</p>
		<p><i><strong><?php echo __('http:// required', 'themerex'); ?></strong></i></p>
		<p>
			<label for="<?php echo $this->get_field_id( 'contacts_linkedin' ); ?>"><?php _e('LinkedIn Profile URL:', 'themerex'); ?></label>
			<input id="<?php echo $this->get_field_id( 'contacts_linkedin' ); ?>" name="<?php echo $this->get_field_name( 'contacts_linkedin' ); ?>" value="<?php echo $contacts_linkedin; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'contacts_facebook' ); ?>"><?php _e('Facebook Profile URL:', 'themerex'); ?></label>
			<input id="<?php echo $this->get_field_id( 'contacts_facebook' ); ?>" name="<?php echo $this->get_field_name( 'contacts_facebook' ); ?>" value="<?php echo $contacts_facebook; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'contacts_gplus' ); ?>"><?php _e('Google Plus Profile URL:', 'themerex'); ?></label>
			<input id="<?php echo $this->get_field_id( 'contacts_gplus' ); ?>" name="<?php echo $this->get_field_name( 'contacts_gplus' ); ?>" value="<?php echo $contacts_gplus; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'contacts_pinterest' ); ?>"><?php _e('Pinterest Profile URL:', 'themerex'); ?></label>
			<input id="<?php echo $this->get_field_id( 'contacts_pinterest' ); ?>" name="<?php echo $this->get_field_name( 'contacts_pinterest' ); ?>" value="<?php echo $contacts_pinterest; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'contacts_dribble' ); ?>"><?php _e('Dribble Profile URL:', 'themerex'); ?></label>
			<input id="<?php echo $this->get_field_id( 'contacts_dribble' ); ?>" name="<?php echo $this->get_field_name( 'contacts_dribble' ); ?>" value="<?php echo $contacts_dribble; ?>" style="width:100%;" />
		</p>
	<?php
	}
}

if (is_admin()) {
	require_once(get_template_directory().'/admin/theme-custom.php');
}
?>