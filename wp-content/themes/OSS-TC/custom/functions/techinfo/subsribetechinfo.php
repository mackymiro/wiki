<?php

/**
 * Author : NEC
 * Usage  : Used in technical information subscribe function
 * Result : Sends email to subscriber(s)
 *
 * This example shows how to use POP-before-SMTP for authentication.
 */

function my_subscribetechinfo () {
	require_once get_template_directory() . '/includes/PHPMailer-5.2.23/PHPMailerAutoload.php';
	require_once get_template_directory() . '/custom/functions/connector.php';

	//Authenticate via POP3.
	//After this you should be allowed to submit messages over SMTP for a while.
	//Only applies if your host supports POP-before-SMTP.
	//$pop = POP3::popBeforeSmtp('balicante.rm@ntsp.nec.co.jp', 110, 30, 'balicante.rm@ntsp.nec.co.jp', 'UhYklRW13s', 1);
	$pop = POP3::popBeforeSmtp('miro.mm@ntsp.nec.co.jp', 110, 30, 'miro.mm@ntsp.nec.co.jp', 'UhYklRW13s', 1);
	//Create a new PHPMailer instance
	//Passing true to the constructor enables the use of exceptions for error handling
	$mail = new PHPMailer(true);
	try {
			$sendTo = $_POST[ 'techinfo_email' ];
			$sender = $_POST[ 'techinfo_name' ];
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
			$mail->setFrom('info@ntsp.nec.co.jp', 'OSS Team');
			//Set an alternative reply-to address
			$mail->addReplyTo('info@ntsp.nec.co.jp', 'OSS Team');
			//Set who the message is to be sent to
			$mail->addAddress( $sendTo, 'Subscriber');
			//Set the subject line
			$mail->Subject = 'OSS Mail Magazine Subscription';
			//Use html in formatting the mail to be sent
			$mail->isHTML( true );
			//Replace the plain text body with one created manually
			$mail->AltBody = 'Thank you for subscribing!';
			// save details to db
			$name  = $_POST['techinfo_name'];
			$email = $_POST['techinfo_email'];


			try {
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
										<p class="body-message">Thank you so much for subscribing to our mail magazine! We\'ll make sure to keep you updated.</p>
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

                global $wpdb;
                $date = date('Y-m-d');
                //query if the mail_magazine email is already in the table
                $result = $wpdb->get_results('SELECT * FROM mail_magazine WHERE email="'.$email.'" ');
                if(empty($result)){
                    $wpdb->insert('mail_magazine', array(
                        'email' => $email,
                        'send_option_value'=>$date
                    ));
                }


				wp_die();
			} catch ( Exception $e ) {
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
