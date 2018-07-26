<?php
	error_reporting(0);
	add_theme_support('post-thumbnails');

    /**
	 * Remove auto <p> tag
	 */
	//remove_filter( 'the_content', 'wpautop' );
	
	//add_filter( 'the_content', 'nl2br' );
	//add_filter( 'the_excerpt', 'nl2br' );

	/**
	 * Custom load value for type wysiwyg
	 * acf/load_value/type={$field_type} - filter for a value load based on it's field type
	 */
	add_filter('acf/load_value/type=wysiwyg', 'my_acf_load_value', 10, 3);
	function my_acf_load_value( $value, $post_id, $field ) {
		/*if(!is_admin()) {
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
		}*/

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
	      'supports' => array('title','editor','thumbnail', 'page-attributes'),
				'hierarchical' => true
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


		register_post_type('license',
		array(
			'labels' => array(
				'name'=> __('License Page'),
				'singular_name' => __( 'License' )
			),
			'public'=> true,
			'supports'=>array('title', 'editor', 'thumbnail', 'page-attributes'),
                'hierarchical' => true

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

		//add fusioncharts js
       // wp_enqueue_script( 'fusion_chart', get_theme_file_uri( '/assets/js/fusioncharts.js' ) );


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
	 * Technical Information - Subscribe mailing list
	 */
	add_action( 'wp_ajax_nopriv_subscribetechinfo', 'my_subscribetechinfo' );
	add_action( 'wp_ajax_subscribetechinfo', 'my_subscribetechinfo' );
	require_once get_template_directory() . '/custom/functions/techinfo/subsribetechinfo.php';

    /**
    * Technical Information - Send Mail Magazine
    */
    /*add_action('wp_ajax_nopriv_sendmagazine', 'my_sendmagazine');
    add_action('wp_ajax_sendmagazine', 'my_sendmagazine');
    require_once get_template_directory() . '/custom/funtions/techinfo/sendmagazine.php';*/


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
	

	/*
	    Script Code By: Macky Miro

	*/
	add_action('add_meta_boxes', 'cd_meta_box_add');
	add_action('save_post', 'cd_meta_box_save');
	
	function cd_meta_box_add(){
		add_meta_box( 'my-meta-box-id', 'My Meta Box', 'cd_meta_box_cb' ,'post', 'normal', 'high' );
	}
	
	function cd_meta_box_cb($post){
		global $post;
		$values = get_post_custom( $post->ID );
		
		wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
		
		
		$dlink = isset( $values['my_meta_box_dlink'] ) ? $values['my_meta_box_dlink'] : '';
		

        $dlinkJP = isset( $values['my_meta_box_dlinkJP'] ) ? $values['my_meta_box_dlinkJP'] : '';

        $dlink1 = isset( $values['my_meta_box_dlink1'] ) ? $values['my_meta_box_dlink1'] : '';

        $dlink1JP = isset( $values['my_meta_box_dlink1JP'] ) ? $values['my_meta_box_dlink1JP'] : '';

        $dlinkManual = isset( $values['my_meta_box_dlinkManual'] ) ? $values['my_meta_box_dlinkManual'] : '';

        $dlinkBasicOperation = isset( $values['my_meta_box_dlinkBasicOperation'] ) ? $values['my_meta_box_dlinkBasicOperation'] : '';

        $dlinkBasicOperationJP = isset( $values['my_meta_box_dlinkBasicOperationJP'] ) ? $values['my_meta_box_dlinkBasicOperationJP'] : '';

        $dlinkVUpgrade = isset( $values['my_meta_box_dlinkVUpgrade'] ) ? $values['my_meta_box_dlinkVUpgrade'] : '';

        $dlinkVUpgradeJP = isset( $values['my_meta_box_dlinkVUpgradeJP'] ) ? $values['my_meta_box_dlinkVUpgradeJP'] : '';

        $dlinkPart = isset( $values['my_meta_box_dlinkPart'] ) ? $values['my_meta_box_dlinkPart'] : '';

        $dlinkPartJP = isset( $values['my_meta_box_dlinkPartJP'] ) ? $values['my_meta_box_dlinkPartJP'] : '';

        $dlinkPerfOp = isset( $values['my_meta_box_dlinkPerfOp'] ) ? $values['my_meta_box_dlinkPerfOp'] : '';

        $dlinkPerfOpJP = isset( $values['my_meta_box_dlinkPerfOpJP'] ) ? $values['my_meta_box_dlinkPerfOpJP'] : '';

        $dlinkScaling = isset( $values['my_meta_box_dlinkScaling'] ) ? $values['my_meta_box_dlinkScaling'] : '';

        $dlinkScalingJP = isset( $values['my_meta_box_dlinkScalingJP'] ) ? $values['my_meta_box_dlinkScalingJP'] : '';

        $dlinkFDetec = isset( $values['my_meta_box_dlinkFDetec'] ) ? $values['my_meta_box_dlinkFDetec'] : '';

        $dlinkFDetecJP = isset( $values['my_meta_box_dlinkFDetecJP'] ) ? $values['my_meta_box_dlinkFDetecJP'] : '';

        $dlinkFRecovery = isset( $values['my_meta_box_dlinkFRecovery'] ) ? $values['my_meta_box_dlinkFRecovery'] : '';

        $dlinkFRecoveryJP = isset( $values['my_meta_box_dlinkFRecoveryJP'] ) ? $values['my_meta_box_dlinkFRecoveryJP'] : '';

        $dlinkMSlaveReplica = isset( $values['my_meta_box_dlinkMSlaveReplica'] ) ? $values['my_meta_box_dlinkMSlaveReplica'] : '';

        $dlinkMSlaveReplicaJP = isset( $values['my_meta_box_dlinkMSlaveReplicaJP'] ) ? $values['my_meta_box_dlinkMSlaveReplicaJP'] : '';

		echo "<label for='my_meta_box_text'>Download Link: </label>";
		echo "<br>";
		echo "<input type='text' name='my_meta_box_dlink' id='my_meta_box_dlink' value='$dlink[0]' />";
		echo "<br>";
        echo "<label for='my_meta_box_text'>Download Link JP Version: </label>";
        echo "<br>";
        echo "<input type='text' name='my_meta_box_dlinkJP' id='my_meta_box_dlinkJP' value='$dlinkJP[0]' />";

        echo "<br>";
        echo "<br>";
        echo "<label for='my_meta_box_text'>Installation, Configuration and Initial Startup Procedure</label>";
        echo "<br>";
	
        
		echo "<label for='my_meta_box_text'>Download Link: </label>";
        echo "<br>";
        echo "<input type='text' name='my_meta_box_dlink1' id='my_meta_box_dlink1' value='$dlink1[0]' />";
        echo "<br>";
        echo "<label for='my_meta_box_text'>Download Link JP Version: </label>";
        echo "<br>";
		echo "<label for='my_meta_box_text'>Name of the file in JP:  </label>";
		echo "<br>";
		
		
        echo "<input type='text' name='my_meta_box_dlink1JP' id='my_meta_box_dlink1JP' value='$dlink1JP[0]' />";
        echo "<br>";
        echo "<label for='my_meta_box_text'>Download Link Manual: </label>";
        echo "<br>";
        echo "<input type='text' name='my_meta_box_dlinkManual' id='my_meta_box_dlinkManual' value='$dlinkManual[0]' />";
        echo "<br>";
        echo "<label for='my_meta_box_text'>Basic Operation Commands, Backup and Restore</label>";
        echo "<br>";
        echo "<label for='my_meta_box_text'>Download Link: </label>";
        echo "<br>";
        echo "<input type='text' name='my_meta_box_dlinkBasicOperation' id='my_meta_box_dlinkBasicOperation' value='$dlinkBasicOperation[0]' />";
        echo "<br>";
        echo "<label for='my_meta_box_text'>Download Link JP: </label>";
        echo "<br>";
        echo "<input type='text' name='my_meta_box_dlinkBasicOperationJP' id='my_meta_box_dlinkBasicOperationJP' value='$dlinkBasicOperationJP[0]' />";
		echo "<br>";
        echo "<label for='my_meta_box_text'>Version Upgrade and Downgrade</label>";
        echo "<br>";
        echo "<label for='my_meta_box_text'>Download Link: </label>";
        echo "<br>";
        echo "<input type='text' name='my_meta_box_dlinkVUpgrade' id='my_meta_box_dlinkVUpgrade' value='$dlinkVUpgrade[0]' />";
        echo "<br>";
        echo "<label for='my_meta_box_text'>Download Link JP: </label>";
        echo "<br>";
        echo "<input type='text' name='my_meta_box_dlinkVUpgradeJP' id='my_meta_box_dlinkVUpgradeJP' value='$dlinkVUpgradeJP[0]' />";
        echo "<br>";

        echo "<label for='my_meta_box_text'>Partitioning:  </label>";
        echo "<br>";
        echo "<label for='my_meta_box_text'>Download Link: </label>";
        echo "<br>";
        echo "<input type='text' name='my_meta_box_dlinkPart' id='my_meta_box_dlinkPart' value='$dlinkPart[0]' />";
        echo "<br>";
        echo "<label for='my_meta_box_text'>Download Link JP: </label>";
        echo "<br>";
        echo "<input type='text' name='my_meta_box_dlinkPartJP' id='my_meta_box_dlinkPartJP' value='$dlinkPartJP[0]' />";
        echo "<br>";

        echo "<label for='my_meta_box_text'>Performance Optimization:  </label>";
        echo "<br>";
        echo "<label for='my_meta_box_text'>Download Link: </label>";
        echo "<br>";
        echo "<input type='text' name='my_meta_box_dlinkPerfOp' id='my_meta_box_dlinkPerfOp' value='$dlinkPerfOp[0]' />";
        echo "<br>";
        echo "<label for='my_meta_box_text'>Download Link JP: </label>";
        echo "<br>";
        echo "<input type='text' name='my_meta_box_dlinkPerfOpJP' id='my_meta_box_dlinkPerfOpJP' value='$dlinkPerfOpJP[0]' />";
        echo "<br>";

        echo "<label for='my_meta_box_text'>Scaling the Cluster: </label>";
        echo "<br>";
        echo "<label for='my_meta_box_text'>Download Link: </label>";
        echo "<br>";
        echo "<input type='text' name='my_meta_box_dlinkScaling' id='my_meta_box_dlinkScaling' value='$dlinkScaling[0]' />";
        echo "<br>";
        echo "<label for='my_meta_box_text'>Download Link JP: </label>";
        echo "<br>";
        echo "<input type='text' name='my_meta_box_dlinkScalingJP' id='my_meta_box_dlinkScalingJP' value='$dlinkScalingJP[0]' />";
        echo "<br>";

        echo "<label for='my_meta_box_text'>Failure Detection: </label>";
        echo "<br>";
        echo "<label for='my_meta_box_text'>Download Link: </label>";
        echo "<br>";
        echo "<input type='text' name='my_meta_box_dlinkFDetec' id='my_meta_box_dlinkFDetec' value='$dlinkFDetec[0]' />";
        echo "<br>";
        echo "<label for='my_meta_box_text'>Download Link JP: </label>";
        echo "<br>";
        echo "<input type='text' name='my_meta_box_dlinkFDetecJP' id='my_meta_box_dlinkFDetecJP' value='$dlinkFDetecJP[0]' />";
        echo "<br>";

        echo "<label for='my_meta_box_text'>Failure Recovery: </label>";
        echo "<br>";
        echo "<label for='my_meta_box_text'>Download Link: </label>";
        echo "<br>";
        echo "<input type='text' name='my_meta_box_dlinkFRecovery' id='my_meta_box_dlinkFRecovery' value='$dlinkFRecovery[0]' />";
        echo "<br>";
        echo "<label for='my_meta_box_text'>Download Link JP: </label>";
        echo "<br>";
        echo "<input type='text' name='my_meta_box_dlinkFRecoveryJP' id='my_meta_box_dlinkFRecoveryJP' value='$dlinkFRecoveryJP[0]' />";
        echo "<br>";

        echo "<label for='my_meta_box_text'>Master-Slave Replication: </label>";
        echo "<br>";
        echo "<label for='my_meta_box_text'>Download Link: </label>";
        echo "<br>";
        echo "<input type='text' name='my_meta_box_dlinkMSlaveReplica' id='my_meta_box_dlinkMSlaveReplica' value='$dlinkMSlaveReplica[0]' />";
        echo "<br>";
        echo "<label for='my_meta_box_text'>Download Link JP: </label>";
        echo "<br>";
        echo "<input type='text' name='my_meta_box_dlinkMSlaveReplicaJP' id='my_meta_box_dlinkMSlaveReplicaJP' value='$dlinkMSlaveReplicaJP[0]' />";

	}
	
	function cd_meta_box_save($post_id){
		  // Bail if we're doing an auto save
			if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
			 
			// if our nonce isn't there, or we can't verify it, bail
			if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
			 
			// if our current user can't edit this post, bail
			if( !current_user_can( 'edit_post' ) ) return;
			 
			// now we can actually save the data
			$allowed = array( 
				'a' => array( // on allow a tags
					'href' => array() // and those anchors can only have href attribute
				)
			);
	
			 // Make sure your data is set before trying to save it
			 
			
			 
			if(isset($_POST['my_meta_box_dlink']))
				update_post_meta( $post_id, 'my_meta_box_dlink', wp_kses( $_POST['my_meta_box_dlink'], $allowed ) );

            if(isset($_POST['my_meta_box_dlinkJP']))
                update_post_meta( $post_id, 'my_meta_box_dlinkJP', wp_kses( $_POST['my_meta_box_dlinkJP'], $allowed ) );

            if(isset($_POST['my_meta_box_dlink1']))
                 update_post_meta( $post_id, 'my_meta_box_dlink1', wp_kses( $_POST['my_meta_box_dlink1'], $allowed ) );

            if(isset($_POST['my_meta_box_dlink1JP']))
                update_post_meta( $post_id, 'my_meta_box_dlink1JP', wp_kses( $_POST['my_meta_box_dlink1JP'], $allowed ) );

            if(isset($_POST['my_meta_box_dlinkManual']))
                update_post_meta( $post_id, 'my_meta_box_dlinkManual', wp_kses( $_POST['my_meta_box_dlinkManual'], $allowed ) );

            if(isset($_POST['my_meta_box_dlinkBasicOperation']))
                update_post_meta( $post_id, 'my_meta_box_dlinkBasicOperation', wp_kses( $_POST['my_meta_box_dlinkBasicOperation'], $allowed ) );

            if(isset($_POST['my_meta_box_dlinkBasicOperationJP']))
                update_post_meta( $post_id, 'my_meta_box_dlinkBasicOperationJP', wp_kses( $_POST['my_meta_box_dlinkBasicOperationJP'], $allowed) );

            if(isset($_POST['my_meta_box_dlinkVUpgrade']))
                update_post_meta( $post_id, 'my_meta_box_dlinkVUpgrade', wp_kses( $_POST['my_meta_box_dlinkVUpgrade'], $allowed) );

            if(isset($_POST['my_meta_box_dlinkVUpgradeJP']))
                update_post_meta( $post_id, 'my_meta_box_dlinkVUpgradeJP', wp_kses( $_POST['my_meta_box_dlinkVUpgradeJP'], $allowed) );


            if(isset($_POST['my_meta_box_dlinkPart']))
                update_post_meta( $post_id, 'my_meta_box_dlinkPart', wp_kses( $_POST['my_meta_box_dlinkPart'], $allowed) );

            if(isset($_POST['my_meta_box_dlinkPartJP']))
                update_post_meta( $post_id, 'my_meta_box_dlinkPartJP', wp_kses( $_POST['my_meta_box_dlinkPartJP'], $allowed) );

            if(isset($_POST['my_meta_box_dlinkPerfOp']))
                update_post_meta( $post_id, 'my_meta_box_dlinkPerfOp', wp_kses( $_POST['my_meta_box_dlinkPerfOp'], $allowed) );

            if(isset($_POST['my_meta_box_dlinkPerfOpJP']))
                update_post_meta( $post_id, 'my_meta_box_dlinkPerfOpJP', wp_kses( $_POST['my_meta_box_dlinkPerfOpJP'], $allowed) );

            if(isset($_POST['my_meta_box_dlinkScaling']))
                update_post_meta( $post_id, 'my_meta_box_dlinkScaling', wp_kses( $_POST['my_meta_box_dlinkScaling'], $allowed) );

            if(isset($_POST['my_meta_box_dlinkScalingJP']))
                update_post_meta( $post_id, 'my_meta_box_dlinkScalingJP', wp_kses( $_POST['my_meta_box_dlinkScalingJP'], $allowed) );

            if(isset($_POST['my_meta_box_dlinkFDetec']))
                update_post_meta( $post_id, 'my_meta_box_dlinkFDetec', wp_kses( $_POST['my_meta_box_dlinkFDetec'], $allowed) );

            if(isset($_POST['my_meta_box_dlinkFDetecJP']))
                update_post_meta( $post_id, 'my_meta_box_dlinkFDetecJP', wp_kses( $_POST['my_meta_box_dlinkFDetecJP'], $allowed) );

            if(isset($_POST['my_meta_box_dlinkFRecovery']))
                update_post_meta( $post_id, 'my_meta_box_dlinkFRecovery', wp_kses( $_POST['my_meta_box_dlinkFRecovery'], $allowed) );

            if(isset($_POST['my_meta_box_dlinkFRecoveryJP']))
                update_post_meta( $post_id, 'my_meta_box_dlinkFRecoveryJP', wp_kses( $_POST['my_meta_box_dlinkFRecoveryJP'], $allowed) );

            if(isset($_POST['my_meta_box_dlinkMSlaveReplica']))
                update_post_meta( $post_id, 'my_meta_box_dlinkMSlaveReplica', wp_kses( $_POST['my_meta_box_dlinkMSlaveReplica'], $allowed) );

            if(isset($_POST['my_meta_box_dlinkMSlaveReplicaJP']))
                update_post_meta( $post_id, 'my_meta_box_dlinkMSlaveReplicaJP', wp_kses( $_POST['my_meta_box_dlinkMSlaveReplicaJP'], $allowed));
    }
	
	
	/* registering tinyMCEplugin */
	
	function add_the_table_button( $buttons ) {
	   array_push( $buttons, 'separator', 'table' );
	   return $buttons;
	}
	
	add_filter( 'mce_buttons', 'add_the_table_button' );
	
	function add_the_table_plugin( $plugins ) {
		$plugins['table'] = content_url() . '/tinymceplugins/table/plugin.min.js';
		return $plugins;
	}
	
	add_filter( 'mce_external_plugins', 'add_the_table_plugin' );
	
	
	/**
	 * Remove empty paragraphs created by wpautop()
	 * @author Ryan Hamilton
	 * @link https://gist.github.com/Fantikerz/5557617
	 */
	function remove_empty_p( $content ) {
		$content = force_balance_tags( $content );
		$content = preg_replace( '#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content );
		$content = preg_replace( '~\s?<p>(\s|&nbsp;)+</p>\s?~', '', $content );
		return $content;
	}
	add_filter('the_content', 'remove_empty_p', 20, 1);

	//save post to table list_of_downloads
    function my_action(){
        global $wpdb; // this is how you get access to the database

        $name = $_POST['name'];

        $res = $wpdb->get_results('SELECT * FROM list_of_downloads WHERE name="'.$name.'"');
        foreach($res as $result){
            $id = $result->id;
            $downloadName = $result->name;
            $c = $result->number_of_downloads;


        }

        //check if filename is on the table then update
        //else insert the record to the table
        if($name == $downloadName){
            $countie = ++$count;

            if($c){
                //if number of downloads is in the table
                if($c == NULL){
                    $countie = ++$count;
                }else{
                    $countie = $c + 1;
                }


                $wpdb->update(
                    'list_of_downloads',
                    array(
                        'number_of_downloads'=>$countie
                    ),
                    array( 'id' => $id ),
                    array(
                        '%s',	// value1
                        '%d'	// value2
                    ),
                    array( '%d' )
                );
            }else{
                $wpdb->update(
                    'list_of_downloads',
                    array(
                        'number_of_downloads'=>$countie
                    ),
                    array( 'id' => $id ),
                    array(
                        '%s',	// value1
                        '%d'	// value2
                    ),
                    array( '%d' )
                );
            }

        }else{
            $countie = ++$count;
            $wpdb->insert('list_of_downloads', array(
                'number_of_downloads'=>$countie,
                'name' => $name
            ));
        }



        wp_die(); // this is required to terminate immediately and return a proper response
    }


    add_action( 'wp_ajax_my_action', 'my_action' );
    add_action( 'wp_ajax_nopriv_my_action', 'my_action' ); // <= this one

    add_action( 'init', 'my_script_enqueuer' );

    function my_script_enqueuer() {
        wp_enqueue_script( 'add-order-front',  get_template_directory_uri() . '/js/ajax.js' );
        wp_localize_script( 'add-order-front', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'add-order-front' );

    }

		

?>
