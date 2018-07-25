<?php
/**
 * Author : Rico Gabunada
 * Usage  : Used in bug patches unsubscribe function - searching of users
 * Result : Returns an array of objects form of results based on the search filter ( $_GET[ 'query' ] )
 */

function my_get_all_subscribers () {
	/**
	 * DB Connection
	 */
	require_once get_template_directory() . '/custom/functions/connector.php';

	$sql     = "SELECT * FROM `subscribers` WHERE `name` LIKE '%".addslashes( $_GET[ 'query' ] )."%' OR `user_id` = '".$_GET[ 'query' ]."';";
	$result  = $conn->query($sql);

	if ( $result ) {
		$result_array = array();
		$i = 0;

		while( $row = $result->fetch_assoc() ) {
			$result_array[$i]['user_id']       = $row[ 'user_id' ];
			$result_array[$i]['name']          = $row[ 'name' ];
			$result_array[$i]['nameAndUserid'] = $row[ 'user_id' ].' - '.$row[ 'name' ];
			$i++;
		}
		echo json_encode( $result_array );
	} else {
		echo json_encode( array( "error"=>"$conn->error" ) );
	}

	$conn->close();
	wp_die();
}
