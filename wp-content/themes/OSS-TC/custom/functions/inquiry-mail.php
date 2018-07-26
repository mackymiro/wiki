<?php

  /**
   * Send Inquiry Email
   */
  function my_inquiry_email() {
    require_once get_template_directory() . '/includes/PHPMailer-5.2.23/PHPMailerAutoload.php';

    //$pop = POP3::popBeforeSmtp('balicante.rm@ntsp.nec.co.jp', 110, 30, 'balicante.rm@ntsp.nec.co.jp', 'UhYklRW13s', 1);

	$pop = POP3::popBeforeSmtp('miro.mm@ntsp.nec.co.jp', 110, 30, 'miro.mm@ntsp.nec.co.jp', 'UhYklRW13s', 1);
    $mail = new PHPMailer(true);

    try {
        // Email variables
        $emails = explode(",", $_POST['emails']);
        //$to = 'gabunada.rb@ntsp.nec.co.jp';
        //$to = 'nsp-oss-tech-center-ml@ntsp.nec.co.jp';
        $to = 'miro.mm@ntsp.nec.co.jp';
		$from = $emails[0];
        $from_name = $_POST['requester'];
        $messageForm = $_POST['message'];

        $mail->isSMTP();

        $mail->CharSet = "UTF-8";

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

        //Set an alternative reply-to address
        $mail->addReplyTo($to, 'Information');

        //Set who the message is to be sent to
        $mail->addAddress($to, 'OSS Team');

        //Set the subject line
        $mail->Subject = 'Inquiry of ' . $from_name;

        //Use html in formatting the mail to be sent
        $mail->isHTML( true );

        // Loop emails
        for ($i=0; $i < count($emails); $i++) {
          // Add CC
          $mail->addCC($emails[$i]);
        }

        // Move attach files to attachments directory
        foreach ($_FILES['file_attach']['error'] as $key=>$val) {
          if ( $val == 0 ) {
            $tmp_name = $_FILES['file_attach']['tmp_name'][$key];
            $name = basename($_FILES['file_attach']['name'][$key]);
            $path = get_template_directory() . '/assets/attachments';
            move_uploaded_file($tmp_name, "$path/$name");

            $mail->addAttachment( $path .'/'. $name);         // Add attachments
          }
        }

        // Set body
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

        //Send the message
        //Note that we don't need check the response from this because it will throw an exception if it has trouble
        $mail->send();
        echo "Message sent!";
    } catch (phpmailerException $e) {
        echo $e->errorMessage(); //Pretty error messages from PHPMailer
    } catch (Exception $e) {
        echo $e->getMessage(); //Boring error messages from anything else!
    }

    wp_die();
  }
?>
