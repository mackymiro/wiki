<?php
/**
 * Author : Rico Gabunada
 * Usage  : Used in bug patches unsubscribe function - getting all the subscribed OSS of the user
 * Result : Returns all the oss saved in db with that specific user selected
 */


function my_get_all_oss () {
	/**
	 * DB Connection
	 */
	require_once get_template_directory() . '/custom/functions/connector.php';

	$sql     = "SELECT * FROM `subscribers_oss` WHERE `user_id` = '".$_GET[ 'user_id' ]."';";
	$result  = $conn->query($sql);

	if ( $result ) {
		$result_array = array();
		$i = 0;

		while( $row = $result->fetch_assoc() ) {
			$result_array[$i]['oss_id']   = $row[ 'oss_id' ];
			$result_array[$i]['user_id']  = $row[ 'user_id' ];
			$result_array[$i]['oss_name'] = $row[ 'oss_name' ];
			$i++;
		}
		echo json_encode( $result_array );
	} else {
		echo json_encode( array( "error"=>"$conn->error" ) );
	}

	$conn->close();
	wp_die();
}
