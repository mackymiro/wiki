<?php
	function my_get_page_visits () {
		$counts       = ( "/var/www/oss_hp_tmp/dev/wp-content/themes/OSS-TC/custom/functions/counter/counter.txt" );
		$countsPerDay = ( "/var/www/oss_hp_tmp/dev/wp-content/themes/OSS-TC/custom/functions/counter/counterPerDay.txt" );

		$hits       = file($counts);
		$hitsPerDay = file($countsPerDay);

		$hits[0] ++;
		$hitsPerDay[0] ++;

		$fp       = fopen($counts, "w");
		$fpPerDay = fopen($countsPerDay, "w");

		fputs($fp , "$hits[0]");
		fputs($fpPerDay , "$hitsPerDay[0]");

		fclose($fp);
		fclose($fpPerDay);

		echo json_encode( $hits[0] );

		wp_die();
	}
