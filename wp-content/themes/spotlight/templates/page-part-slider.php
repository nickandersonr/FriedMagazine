<?php
if (get_custom_option('slider_show')=='yes') { 
	$slider = get_custom_option('slider_engine');
?>
	<div class="sliderHomeBullets statickSlider slider_engine_<?php echo $slider; ?>">
		<?php
			if ($slider == 'revo' && revslider_exists()) {
				$slider_alias = get_custom_option('slider_alias');
				if (!empty($slider_alias)) putRevSlider($slider_alias);
			} if ($slider == 'royal' && royalslider_exists()) {
				//$slider_alias = get_custom_option('slider_alias');
				//if (!empty($slider_alias)) echo get_new_royalslider($slider_alias);
				?>
				<div class="rsContent slide-1">
					<div class="main">
						<div class="textBlock rsABlock" data-fade-effect="none" data-move-effect="top" data-opposite="true" data-move-offset="900" data-delay="300" data-speed="1500" data-easing="easeOutBack" data-rsw="707" data-rsh="471">
							<div class="title">Multifunctional Website</div>
							<p>Optimized for <br> Work with Touchscreen.</p>
						</div>
						<img  class="rsABlock women" data-fade-effect="none" data-move-effect="bottom" data-opposite="true" data-move-offset="950" data-delay="450" data-speed="2500" data-easing="" src="<?php echo get_template_directory_uri(); ?>/images/slider/slide1_2.png" data-rsw="707" data-rsh="471">
					</div>
				</div>

				<div class="rsContent  slide-2">
					<div class="main">
						<div class="textBlock rsABlock" data-fade-effect="none" data-move-effect="left" data-opposite="true" data-move-offset="900" data-delay="300" data-speed="1200" data-easing="" data-rsw="707" data-rsh="471">
							<div class="title">100% Responsive</div>
							<p>& Retina Friedly</p>
						</div>
						<img class="rsABlock retinaExample" data-fade-effect="none" data-move-effect="top" data-opposite="true" data-move-offset="950" data-delay="700" data-speed="2000" data-easing="" src="<?php echo get_template_directory_uri(); ?>/images/slider/slide2_3.png" data-rsw="707" data-rsh="471">
			
						<img class="rsABlock iPadPhone" data-fade-effect="none" data-move-effect="bottom" data-opposite="true" data-move-offset="950" data-delay="300" data-speed="1000" data-easing="" src="<?php echo get_template_directory_uri(); ?>/images/slider/slide2_2.png" data-rsw="707" data-rsh="471">
					</div>
				</div>

				<div class="rsContent  slide-3">
					<div class="main">
						<div class="textBlock rsABlock" data-fade-effect="none" data-move-effect="top" data-opposite="true" data-move-offset="950" data-delay="450" data-speed="1000" data-easing="" data-rsw="707" data-rsh="471">
							<div class="title">Free Installation Services</div>
							<p>by ThemeREX</p>
						</div>
						<div class="order rsABlock" data-fade-effect="none" data-move-effect="bottom" data-opposite="true" data-move-offset="950" data-delay="950" data-speed="900" data-easing="" src="images_post/slider/slide1_3.png" data-rsw="707" data-rsh="471">
							<a href="#" class="submitOrder">Order Now</a>
						</div>
						<img class="rsABlock installPic" data-fade-effect="none" data-move-effect="left" data-opposite="true" data-move-offset="950" data-delay="350" data-speed="1300" data-easing="" src="<?php echo get_template_directory_uri(); ?>/images/slider/slide3_2.png" data-rsw="707" data-rsh="471">
			
					</div>
				</div>
				<?php
			} else if ($slider == 'flex' || $slider == 'swiper') {
				$slider_cat = get_custom_option("slider_category");
				$slider_orderby = get_custom_option("slider_orderby");
				$slider_order = get_custom_option("slider_order");
				$slider_count = $slider_ids = get_custom_option("slider_posts");
				if (themerex_strpos($slider_ids, ',')!==false)
					$slider_count = 0;
				else {
					$slider_ids = '';
					if (empty($slider_count)) $slider_count = 3;
				}
				$slider_info_box = get_custom_option("slider_info_box");
				$slider_info_fixed = get_custom_option("slider_info_fixed");
				if ($slider_count>0 || !empty($slider_ids)) {
					echo do_shortcode('[slider engine="'.$slider.'" controls="0"' 
						. ($slider_cat ? ' cat="'.$slider_cat.'"' : '') 
						. ($slider_ids ? ' ids="'.$slider_ids.'"' : '') 
						. ($slider_count ? ' count="'.$slider_count.'"' : '') 
						. ($slider_orderby ? ' orderby="'.$slider_orderby.'"' : '') 
						. ($slider_order ? ' order="'.$slider_order.'"' : '') 
						. ' titles="'.($slider_info_box=='yes' ? ($slider_info_fixed=='yes' ? 2 : 1) : 0)  .'"'
						. ']');
				}
			}
		?>
	</div>
<?php } ?>
