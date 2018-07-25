<?php

/**
 * Author : Rico Gabunada
 * Usage  : Used in bug patches subscribe function
 * Result : Sends email to subscriber(s)
 *
 * This example shows how to use POP-before-SMTP for authentication.
 */

function my_subscribe () {
	require_once get_template_directory() . '/includes/PHPMailer-5.2.23/PHPMailerAutoload.php';
	require_once get_template_directory() . '/custom/functions/connector.php';

	//Authenticate via POP3.
	//After this you should be allowed to submit messages over SMTP for a while.
	//Only applies if your host supports POP-before-SMTP.
	$pop = POP3::popBeforeSmtp('balicante.rm@ntsp.nec.co.jp', 110, 30, 'balicante.rm@ntsp.nec.co.jp', 'UhYklRW13s', 1);
	//Create a new PHPMailer instance
	//Passing true to the constructor enables the use of exceptions for error handling
	$mail = new PHPMailer(true);
	try {
			$sendTo = $_POST[ 'email' ];
			$sender = $_POST[ 'name' ];
			$mail->isSMTP();
			//Enable SMTP debugging
			// 0 = off (for production use)
			// 1 = client messages
			// 2 = client and server messages
			$mail->SMTPDebug = 2;
			//Ask for HTML-friendly debug output
			$mail->Debugoutput = 'html';
			//Set the hostname of the mail server
			$mail->Host = "pop";
			//Set the SMTP port number - likely to be 25, 465 or 587
			$mail->Port = 25;
			//Whether to use SMTP authentication
			$mail->SMTPAuth = false;
			//Set who the message is to be sent from
			$mail->setFrom('gabunada.rb@ntsp.nec.co.jp', 'OSS Team');
			//Set an alternative reply-to address
			$mail->addReplyTo('gabunada.rb@ntsp.nec.co.jp', 'OSS Team');
			//Set who the message is to be sent to
			$mail->addAddress( $sendTo, 'Subscriber');
			//Set the subject line
			$mail->Subject = 'OSS Subscription';
			//Use html in formatting the mail to be sent
			$mail->isHTML( true );
			//Replace the plain text body with one created manually
			$mail->AltBody = 'Thank you for subscribing!';
			// save details to db
			$name       = $_POST['name'];
			$email      = $_POST['email'];
			$start_date = date( 'Y-m-d', strtotime( $_POST['start_date'] ) );
			$end_date   = date( 'Y-m-d', strtotime( $_POST['end_date'] ) );
			$oss        = $_POST['oss'];

			try {
				$insertToSubscribers = "INSERT INTO subscribers VALUES ('', '$name', '$email', '$start_date', '$end_date')";

				if ($conn->query( $insertToSubscribers ) ) {
					//send the message
					//Note that we don't need check the response from this because it will throw an exception if it has trouble
					//Set body
					$mail->Body = '
						<html>
						<head></head>
						<style>

						.table-body {
							width: 100%;
							font-family: arial;
							font-size: 14px;
							padding: 10px;
						}

						table * {
							word-spacing: 1px;
						}

						.body-message {
							text-indent: 15px;
							line-height: 1.4;
						}

						.requester_info_table {
							width: 50%;
							border-collapse: collapse;
						}

						.requester_info_table td, .requester_info_table th {
							display: table-cell;
							vertical-align: inherit;
						}

						.requester_info_table thead th {
							border-bottom-width: 2px !important;
						}

						.requester_info_table thead th,
						.requester_info_table tbody td {
							padding: 8px;
							border: 1px solid #ddd;
							line-height: 1.42857143;
							text-align: left;
							font-size: 13px;
						}
						</style>
						<body>
							<table class="table-body">
								<tbody>
									<tr style="height: 30px;">
										<td align="left">Hello '.$sender.',</td>
									</tr>

									<tr style="height: 30px;">
										<td align="left">
											<p class="body-message">Good day!</p>
										</td>
									</tr>

									<tr style="height: 30px;">
										<td align="left">
											<p class="body-message">Thank you so much for subscribing! We will update you about the latest bug/patches based on the information you\'ve provided: </p>
										</td>
									</tr>
									<tr style="height: 30px;">
										<td align="left">
											<p class="body-message"><b>Your USER ID is: '.$conn->insert_id.'</b></p>
											<p class="body-message" style="color: red">Note: Your user id will be used when you want to unsubscribe an oss.</p>
										</td>
									</tr>

									<tr style="height: 10px;">
										<td>
											<table class="requester_info_table">
												<thead>
													<th>Name</th>
													<th>Email</th>
													<th>Chosen OSS</th>
													<th>Start Date</th>
													<th>End Date</th>
												</thead>
												<tbody>
													<tr>
														<td>' . $sender . '</td>
														<td>' . $sendTo  . '</td>
														<td>' . implode( ',', $_POST[ 'oss' ] ) . '</td>
														<td>' . $_POST['start_date']. '</td>
														<td>' . $_POST['end_date']. '</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>

									<tr style="height: 30px;">
										<td align="left">Thanks & Best Regards,</td>
									</tr>

									<tr style="height: 30px;">
										<td align="left">OSS Team</td>
									</tr>
								<tbody>
							</table>
						</body>
						</html>';
					$mail->send();
					$user_id = $conn->insert_id;

					// Start transaction
					$conn->autocommit(FALSE);

					foreach ( $oss as $value ) {
						$insertToOss = "INSERT INTO subscribers_oss VALUES ('', $user_id, '$value')";
						$conn->query( $insertToOss );
					}

					$conn->commit();
				}
				$conn->close();
				
				wp_die();
			} catch ( Exception $e ) {
				$conn->rollback();

				wp_die();
			}
	} catch (phpmailerException $e) {
		// echo $e->errorMessage(); //Pretty error messages from PHPMailer
		wp_die();
	} catch (Exception $e) {
		// echo $e->getMessage(); //Boring error messages from anything else!
		wp_die();
	}
}
