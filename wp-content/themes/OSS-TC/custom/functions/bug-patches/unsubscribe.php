<?php
/**
 * Author : Rico Gabunada
 * Usage  : Used in bug patches unsubscribe function - confirm unsubsription of the selected OSS
 * Result : Returns true if the selected OSS was deleted from the database.
 */

function my_unsubscribe () {
	/**
	* DB Connection
	*
	*/
	require_once get_template_directory() . '/custom/functions/connector.php';

	$sql = "DELETE from `subscribers_oss` WHERE `oss_id` = ".$_GET['oss_id']." and `user_id` = ".$_GET['user_id'].";";

	if ( $conn->query( $sql ) ) {
		echo json_encode( true );
	} else {
		echo json_encode( array( "error"=>"$conn->error" ) );
	}

	$conn->close();
	wp_die();
}
