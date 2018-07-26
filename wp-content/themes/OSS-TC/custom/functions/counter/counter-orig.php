<?php
	function my_get_page_visits () {
		$counts = ("/var/www/oss_hp_tmp/dev/wp-content/themes/OSS-TC/custom/functions/counter/counter.txt");
		$hits = file($counts);
		$hits[0] ++;
		$fp = fopen($counts, "w");
		fputs($fp , "$hits[0]");
		fclose($fp);
		echo json_encode( $hits[0] );

		wp_die();
	}
