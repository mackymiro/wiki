<?php

	/**
	 * Remove auto <p> tag
	 */
	remove_filter( 'the_content', 'wpautop' );

	/**
	 * Custom load value for type wysiwyg
	 * acf/load_value/type={$field_type} - filter for a value load based on it's field type
	 */
	add_filter('acf/load_value/type=wysiwyg', 'my_acf_load_value', 10, 3);
	function my_acf_load_value( $value, $post_id, $field ) {
		if(!is_admin()) {
			preg_match_all('/src=("[^"]*")/i', $value, $matches);
			$imgs = array_pop($matches);

			// Unset array $matches
			unset($matches);

			foreach ($imgs as $img) {
				$img = trim($img, '"');
				$full_path = get_template_directory_uri() . "/assets/images/" . $img;

				$value = str_replace($img, $full_path, $value);
			}

			// Unset array $imgs
			unset($imgs);

			preg_match_all('/href=("[^"]*")/i', $value, $matches);
			$links = array_pop($matches);

			// Unset array $matches
			unset($matches);

			foreach ($links as $link) {
				$link = trim($link, '"');
				$is_url = filter_var($link, FILTER_VALIDATE_URL) == true;

				if(!$is_url) {
					$full_path = get_template_directory_uri() . "/assets/images/" . $link;

					$value = str_replace($link, $full_path, $value);
				}
			}

			// Unset array $links
			unset($links);
		}

		$value = apply_filters('the_content',$value);

    return $value;
	}


	/**
	 * Add custom attributes in wp_nav_menu
	 */
	add_filter( 'nav_menu_link_attributes', 'custom_progress_menu_atts', 10, 3 );
	function custom_progress_menu_atts( $atts, $item, $args ) {
		// The ID of the target menu item
		$menu_target = 104;

		// inspect $item
		if ($item->ID == $menu_target) {
			$atts['target'] = '_blank';
		}
		return $atts;
	}


	// Unlock wp_nav_menu
	register_nav_menus( array(
		'primary' => 'Main Menu',
	) );


	/**
	 * Create custom post for faq, knowledge & tool
	 */
	add_action( 'init', 'create_faq_knowledge_tool_post' );
	function create_faq_knowledge_tool_post() {
	  register_post_type( 'faq',
	    array(
	      'labels' => array(
	        'name' => __( 'FAQ' ),
	        'singular_name' => __( 'FAQ' )
	      ),
	      'public' => true,
	      'supports' => array('title','editor','thumbnail')
	    )
	  );

		register_post_type( 'knowledge',
	    array(
	      'labels' => array(
	        'name' => __( 'Knowledge' ),
	        'singular_name' => __( 'Knowledge' )
	      ),
	      'public' => true,
	      'supports' => array('title','editor','thumbnail', 'page-attributes'),
				'hierarchical' => true
	    )
	  );

		register_post_type( 'tool',
	    array(
	      'labels' => array(
	        'name' => __( 'Tool' ),
	        'singular_name' => __( 'Tool' )
	      ),
	      'public' => true,
	      'supports' => array('title','editor','thumbnail')
	    )
	  );

		register_post_type( 'techInfo',
	    array(
	      'labels' => array(
	        'name' => __( 'Technical Information' ),
	        'singular_name' => __( 'Technical' )
	      ),
	      'public' => true,
	      'supports' => array('title','editor','thumbnail')
	    )
	  );
	}


	/**
	 * Remove twentyseventeen theme css
	 */
	add_action('get_header', 'remove_admin_login_header');
	function remove_admin_login_header() {
		remove_action('wp_head', '_admin_bar_bump_cb');
	}


	/**
	 * Enqueue scripts
	 */
	add_action( 'wp_enqueue_scripts', 'theme_scripts' );
	function theme_scripts() {
		// Deregister default jquery
		wp_deregister_script( 'jquery' );

		// Add local jquery
		wp_enqueue_script( 'jquery_script', get_theme_file_uri( '/assets/js/jquery.min.js' ) );

		// Add Select2 js
		wp_enqueue_script( 'select2_script', get_theme_file_uri( '/assets/js/select2.min.js' ) );

		// Add Bootstrap Typeadhead js
		wp_enqueue_script( 'bootstrap_typeahead_script', get_theme_file_uri( '/assets/js/bootstrap-typeahead.js' ) );

		// Add WOW js
		wp_enqueue_script( 'wow_script', get_theme_file_uri( '/assets/js/wow.min.js' ) );

		// Add Hightchart js
		wp_enqueue_script( 'hightcharts_script', get_theme_file_uri( '/assets/js/highcharts.js' ) );

		// Add Exporting js
		wp_enqueue_script( 'exporting_script', get_theme_file_uri( '/assets/js/exporting.js' ) );

		// Add Export CSV js
		wp_enqueue_script( 'export_csv_script', get_theme_file_uri( '/assets/js/export-csv.js' ) );

		// Add Datepicker js
		wp_enqueue_script( 'datepicker_script', get_theme_file_uri( '/assets/js/datepicker.js' ) );

		// Add Tether js
		wp_enqueue_script( 'tether_script', get_theme_file_uri( '/assets/js/tether.min.js' ) );

		// Add Bootstrap js
		wp_enqueue_script( 'bootstrap_script', get_theme_file_uri( '/assets/js/bootstrap.min.js' ) );

		// Add Datatable js
		wp_enqueue_script( 'jquery_datatable_script', get_theme_file_uri( '/assets/js/jquery.dataTables.min.js' ) );
		wp_enqueue_script( 'bootstrap_datatable_script', get_theme_file_uri( '/assets/js/dataTables.bootstrap.min.js' ) );

		// Add Owl Carousel js
		wp_enqueue_script( 'owl_carousel_script', get_theme_file_uri( '/assets/js/owl.carousel.js' ) );

		// Add Jquery FitVids js
		wp_enqueue_script( 'jquery_fitvids_script', get_theme_file_uri( '/assets/js/jquery.fitvids.js' ) );

		// Add Smoothscroll js
		wp_enqueue_script( 'smoothscroll_script', get_theme_file_uri( '/assets/js/smoothscroll.js' ) );

		// Add Jquery Parallax js
		wp_enqueue_script( 'jquery_parallax_script', get_theme_file_uri( '/assets/js/jquery.parallax-1.1.3.js' ) );

		// Add Jquery PrettyPhoto js
		wp_enqueue_script( 'jquery_prettyphoto_script', get_theme_file_uri( '/assets/js/jquery.prettyPhoto.js' ) );

		// Add Jquery Ajaxchimp mini js
		wp_enqueue_script( 'jquery_ajaxchimp_mini_script', get_theme_file_uri( '/assets/js/jquery.ajaxchimp.min.js' ) );

		// Add Jquery Ajaxchimp langs js
		wp_enqueue_script( 'jquery_ajaxchimp_langs_script', get_theme_file_uri( '/assets/js/jquery.ajaxchimp.langs.js' ) );

		// Add Waypoint js
		wp_enqueue_script( 'waypoints_script', get_theme_file_uri( '/assets/js/waypoints.min.js' ) );

		// Add Jquery Counterup js
		wp_enqueue_script( 'jquery_counterup_script', get_theme_file_uri( '/assets/js/jquery.counterup.min.js' ) );

		// Add Bootstrap Tagsinput js if page is inquiry
		if(is_page(82)) {
			wp_enqueue_script( 'bootstrap_tagsinput_script', get_theme_file_uri( '/assets/js/bootstrap-tagsinput.js' ) );
		}

		// Add Page Visits script
		// wp_enqueue_script( 'page_counter', get_theme_file_uri( '/assets/js/counter/counter.php' ) );

		// Add main script
		wp_enqueue_script( 'custom_script', get_theme_file_uri( '/assets/js/script.js' ), array( 'jquery_script' ) );
	}


	/**
	 * Enqueue styles
	 */
	add_action( 'wp_enqueue_scripts', 'theme_styles' );
	function theme_styles() {
		// Add Font css
		wp_enqueue_style( 'font_style', get_theme_file_uri( '/assets/css/fonts.css' ) );

		// Add Bootstrap css
		wp_enqueue_style( 'bootstrap_style', get_theme_file_uri( '/assets/css/bootstrap.min.css' ) );

		// Add Select2 css
		wp_enqueue_style( 'select2_style', get_theme_file_uri( '/assets/css/select2.min.css' ) );

		// Add Owl Carousel css
		wp_enqueue_style( 'owl_carousel_style', get_theme_file_uri( '/assets/css/owl.carousel.css' ) );
		wp_enqueue_style( 'owl_theme_style', get_theme_file_uri( '/assets/css/owl.theme.css' ) );

		// Add Pixeden Icon Font css
		wp_enqueue_style( 'pe_icon_7_style', get_theme_file_uri( '/assets/css/Pe-icon-7-stroke.css' ) );

		// Add Font Awesome css
		wp_enqueue_style( 'font_awesome_style', get_theme_file_uri( '/assets/css/font-awesome.min.css' ) );

		// Add Pretty Photo css
		wp_enqueue_style( 'pretty_photo_style', get_theme_file_uri( '/assets/css/prettyPhoto.css' ) );

		// Add Animate css
		wp_enqueue_style( 'animate_style', get_theme_file_uri( '/assets/css/animate.css' ) );

		// Add Responsive css
		wp_enqueue_style( 'responsive_style', get_theme_file_uri( '/assets/css/responsive.css' ) );

		// Add Datepicker css
		wp_enqueue_style( 'datepicker_style', get_theme_file_uri( '/assets/css/datepicker.css' ) );

		// Add Sorting Arrows ( fontAwesome ) for datatables css
		wp_enqueue_style( 'dataTablesSortCss', get_theme_file_uri( '/assets/css/dataTables.fontAwesome.css' ) );

		// Add Bootstrap Tagsinput css if page is inquiry
		if(is_page(82)) {
			wp_enqueue_style( 'bootstrap_tagsinput_style', get_theme_file_uri( '/assets/css/bootstrap-tagsinput.css' ) );
		}

		// Add main style
		wp_enqueue_style( 'custom_style', get_theme_file_uri( '/style.css' ) );
	}


	/**
	 * Add global variables
	 */
	add_action( 'wp_head', 'global_lazy_ajax', 0, 0 );
	function global_lazy_ajax() {
		?>

		<script type="text/javascript">
			/* <![CDATA[ */
			var ajaxUrl = '<?php echo admin_url( 'admin-ajax.php' ); ?>';
			var siteUrl = '<?php echo get_template_directory_uri(); ?>';
			/* ]]> */
    	</script>

    	<?php
	}


	/**
	 * Send Inquiry Email
	 */
	add_action( 'wp_ajax_nopriv_inquiry_email', 'my_inquiry_email' );
	add_action( 'wp_ajax_inquiry_email', 'my_inquiry_email' );
	require_once get_template_directory() . '/custom/functions/inquiry/inquiry-mail.php';


	/**
	 * Download Form API
	 */
	add_action( 'wp_ajax_nopriv_download_file', 'my_download_form' );
	add_action( 'wp_ajax_download_file', 'my_download_form' );
	require_once get_template_directory() . '/custom/functions/download-form.php';

	/**
	 * Get Page Visits
	 */
	add_action( 'wp_ajax_nopriv_get_page_visits', 'my_get_page_visits' );
	add_action( 'wp_ajax_get_page_visits', 'my_get_page_visits' );
	require_once get_template_directory() . '/custom/functions/counter/counter.php';

	/**
	 * Bug Patches - Unsubscribe
	 */
	add_action( 'wp_ajax_nopriv_unsubscribe', 'my_unsubscribe' );
	add_action( 'wp_ajax_unsubscribe', 'my_unsubscribe' );
	require_once get_template_directory() . '/custom/functions/bug-patches/unsubscribe.php';

	/**
	 * Bug Patches - Subscribe
	 */
	add_action( 'wp_ajax_nopriv_subscribe', 'my_subscribe' );
	add_action( 'wp_ajax_subscribe', 'my_subscribe' );
	require_once get_template_directory() . '/custom/functions/bug-patches/subscribe.php';

	/**
	 * Bug Patches - Check validity of inputted username and email
	 */
	add_action( 'wp_ajax_nopriv_check_username_and_email', 'my_check_username_and_email' );
	add_action( 'wp_ajax_check_username_and_email', 'my_check_username_and_email' );
	require_once get_template_directory() . '/custom/functions/bug-patches/check-username-and-email.php';

	/**
	 * Bug Patches - Get All OSS
	 */
	add_action( 'wp_ajax_nopriv_get_all_oss', 'my_get_all_oss' );
	add_action( 'wp_ajax_get_all_oss', 'my_get_all_oss' );
	require_once get_template_directory() . '/custom/functions/bug-patches/get-all-oss.php';

	/**
	 * Bug Patches - Get All Subscribers
	 */
	add_action( 'wp_ajax_nopriv_get_all_subscribers', 'my_get_all_subscribers' );
	add_action( 'wp_ajax_get_all_subscribers', 'my_get_all_subscribers' );
	require_once get_template_directory() . '/custom/functions/bug-patches/get-all-subscribers.php';

?>
