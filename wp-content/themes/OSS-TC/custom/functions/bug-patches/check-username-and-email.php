<?php
/**
 * Author : Rico Gabunada
 * Usage  : Used in bug patches unsubscribe function - checking if userid and email exist in database
 * Result : Returns 1 if the userid and email exist in db, else 0
 */

function my_check_username_and_email () {
	/**
	 * DB Connection
	 */
	require_once get_template_directory() . '/custom/functions/connector.php';

	$sql     = "SELECT * FROM `subscribers` WHERE `user_id` = '".$_POST[ 'userid' ]."' and `email` = '".$_POST[ 'unsubscribe_email' ]."';";
	$result  = $conn->query($sql);

	if ( $result ) {
		if ( $row = $result->fetch_assoc() ) {
			echo json_encode( $row );
		} else {
			echo 0;
		}
	} else {
		echo json_encode( array( "error"=>"$conn->error" ) );
	}

	$conn->close();
	wp_die();
}
