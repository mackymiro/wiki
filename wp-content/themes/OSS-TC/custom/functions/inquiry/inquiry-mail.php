<?php
/**
 * Send Inquiry Email
 */
function my_inquiry_email() {
	//set the default timezone
	date_default_timezone_set('Asia/Tokyo');

				
	require_once get_template_directory() . '/includes/PHPMailer-5.2.23/PHPMailerAutoload.php';

	//Authenticate via POP3.
	//After this you should be allowed to submit messages over SMTP for a while.
	//Only applies if your host supports POP-before-SMTP.
	$pop = POP3::popBeforeSmtp('gabunada.rb@ntsp.nec.co.jp', 110, 30, 'gabunada.rb@ntsp.nec.co.jp', 'U4dkz5CcnO', 1);
	//Create a new PHPMailer instance
	//Passing true to the constructor enables the use of exceptions for error handling
	$mail = new PHPMailer(true);
	try {
			//$sendTo = 'nsp-oss-tech-center-ml@ntsp.nec.co.jp';
            $sendTo = 'aguirre.ah@ntsp.nec.co.jp';
			$emails      = explode(",", $_POST['emails']);
			$from        = $emails[0];
			$from_name   = $_POST['requester'];
			$messageForm = $_POST['message'];
			$subject     = $_POST['title'];

			$mail->CharSet = 'UTF-8';
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
			$mail->setFrom($from, $from_name);
			// Loop emails
			for ($i=0; $i < count($emails); $i++) {
				$mail->addCC($emails[$i]);    // Add cc
			}
			// Move attach files to attachments directory
			foreach ($_FILES['file_attach']['error'] as $key=>$val) {
				if ( $val == 0 ) {
					$tmp_name = $_FILES['file_attach']['tmp_name'][$key];
					$name = basename($_FILES['file_attach']['name'][$key]);
          $path = get_template_directory() . '/assets/attachments';
					move_uploaded_file($tmp_name, "$path/$name");

					$mail->addAttachment( $path .'/'. $name); // Add attachments
				}
			}
			//Set an alternative reply-to address
			$mail->addReplyTo($sendTo, 'Information');
			//Set who the message is to be sent to
			$mail->addAddress($sendTo, 'OSS TEAM');
			//Set the subject line
			$mail->Subject = $subject;
			//Use html in formatting the mail to be sent
			$mail->isHTML( true );
			//Replace the plain text body with one created manually
			$mail->AltBody = 'Thank you for your inquiry we will get back to you soon!';

			$mail->Body    = '
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
							<td align="left">Hello OSS Team,</td>
						</tr>

						<tr style="height: 30px;">
							<td align="left">Good day!</td>
						</tr>

						<tr style="height: 30px;">
							<td align="left">
								<p class="body-message">'
								. nl2br( htmlspecialchars( $messageForm ) ) .
								'</p>
							</td>
						</tr>

						<tr style="height: 10px;">
							<td>
								<table class="requester_info_table">
									<thead>
										<th>Division</th>
										<th>Project Name</th>
										<th>OSS</th>
										<th>OSS Version</th>
										<th>Due Date</th>
										<th>Requester</th>
									</thead>
									<tbody>
										<tr>
											<td>' . $_POST['division']. '</td>
											<td>' . $_POST['project_name']. '</td>
											<td>' . $_POST['target_oss']. '</td>
											<td>' . $_POST['oss_version']. '</td>
											<td>' . $_POST['due_date']. '</td>
											<td>' . $_POST['requester']. '</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>

						<tr style="height: 30px;">
							<td align="left">Thanks & Best Regards,</td>
						</tr>

						<tr style="height: 30px;">
							<td align="left">' .$from_name. '</td>
						</tr>
					<tbody>
				</table>
			</body>
			</html>';

			if(!$mail->send())
			{
					echo 'Message could not be sent.';
					echo 'Mailer Error: ' . $mail->ErrorInfo;
					wp_die();
			}
			else
			{
                echo 'Message has been sent';

                // Function to get the client ip address
                function get_client_ip_env() {
                    $ipaddress = '';
                    if (getenv('HTTP_CLIENT_IP'))
                        $ipaddress = getenv('HTTP_CLIENT_IP');
                    else if(getenv('HTTP_X_FORWARDED_FOR'))
                        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
                    else if(getenv('HTTP_X_FORWARDED'))
                        $ipaddress = getenv('HTTP_X_FORWARDED');
                    else if(getenv('HTTP_FORWARDED_FOR'))
                        $ipaddress = getenv('HTTP_FORWARDED_FOR');
                    else if(getenv('HTTP_FORWARDED'))
                        $ipaddress = getenv('HTTP_FORWARDED');
                    else if(getenv('REMOTE_ADDR'))
                        $ipaddress = getenv('REMOTE_ADDR');
                    else
                        $ipaddress = 'UNKNOWN';

                    return $ipaddress;
                }

                // Function to get the client ip address
                function get_client_ip_server() {
                    $ipaddress = '';
                    if ($_SERVER['HTTP_CLIENT_IP'])
                        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
                    else if($_SERVER['HTTP_X_FORWARDED_FOR'])
                        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
                    else if($_SERVER['HTTP_X_FORWARDED'])
                        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
                    else if($_SERVER['HTTP_FORWARDED_FOR'])
                        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
                    else if($_SERVER['HTTP_FORWARDED'])
                        $ipaddress = $_SERVER['HTTP_FORWARDED'];
                    else if($_SERVER['REMOTE_ADDR'])
                        $ipaddress = $_SERVER['REMOTE_ADDR'];
                    else
                        $ipaddress = 'UNKNOWN';

                    return $ipaddress;
                }


                // Get the client ip address
                $ipaddress = $_SERVER['REMOTE_ADDR'];

                $useragent = $_SERVER['HTTP_USER_AGENT'];

                $remotehost = @getHostByAddr($ipaddress);

                $clientIPEnv = get_client_ip_env();


                //save information to table list_of_inquiries
                global $wpdb; // this is how you get access to the database

               
                $time = time();

				
				//explode if there is unknown IP address
                $exp = explode(",", $clientIPEnv);

                if($exp[0] == "unknown"){
					$expRes = $exp[1];
                }else{
                    $expRes = $clientIPEnv;
                }

				//insert to table list_of_inquiries
                $wpdb->insert('list_of_inquiries', array(
                    'division'=>$_POST['division'],
                    'project_name'=>$_POST['project_name'],
                    'oss'=>$_POST['target_oss'],
                    'oss_version'=>$_POST['oss_version'],
                    'due_date'=>$_POST['due_date'],
                    'requester'=>$_POST['requester'],
                    'ip_address'=>$expRes,
                    'date'=>$time
                ));

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
