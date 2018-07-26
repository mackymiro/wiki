<?php
/**
 * Created by PhpStorm.
 * User: miro.mm
 * Date: 12/20/2017
 * Time: 10:24 AM
 */

    global $wpdb;

    $date = new DateTime('first Monday of this month');
    $thisMonth = $date->format('m');
    while ($date->format('m') === $thisMonth) {
        $dateM = $date->format('Y-m-d');
        $date->modify('next Monday');

        //get the date every Monday on the month
        if ($dateM) {
            $results = $wpdb->get_results('SELECT * FROM mail_magazine');


            foreach ($results as $res) {
                $fireEmail = $res->email;

                $technical_informations = get_posts(array(
                    'numberposts' => -1,
                    'post_type' => 'techInfo',
                    'post_status' => 'publish'
                ));


                foreach ($technical_informations as $technical_information) {
                    $file = get_post_custom($technical_information->ID);
                    $file = get_post_meta($file);
                    $path = $file['_wp_attached_file'][0];

                    $exp = explode("/", $path);

                }


                require_once get_template_directory() . '/includes/PHPMailer-5.2.23/PHPMailerAutoload.php';
                require_once get_template_directory() . '/custom/functions/connector.php';

                $pop = POP3::popBeforeSmtp('miro.mm@ntsp.nec.co.jp', 110, 30, 'miro.mm@ntsp.nec.co.jp', 'UhYklRW13s', 1);

                $mail = new PHPMailer(true);
                $fireEmail = "";
                try {
                    $sendTo = $fireEmail;
                    //$sender = $_POST[ 'techinfo_name' ];
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
                    $mail->addReplyTo('miro.mm@ntsp.nec.co.jp', 'OSS Team');
                    //Set who the message is to be sent to
                    $mail->addAddress($sendTo, 'Subscriber');
                    //Set the subject line
                    $mail->Subject = 'OSS Your Mail Magazine';
                    //Use html in formatting the mail to be sent
                    $mail->isHTML(true);
                    //Replace the plain text body with one created manually
                    $mail->AltBody = 'Thank you for subscribing!';
                    // save details to db

                    $file_to_attach = '/wp-content/uploads/. $exp[2]';
                    $mail->AddAttachment($file_to_attach, 'NameOfFile.txt');

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
                                                <td align="left">
                                                    <p class="body-message">Good day!</p>
                                                </td>
                                            </tr>
            
                                            <tr style="height: 30px;">
                                                <td align="left">
                                                    <p class="body-message">Here is your magazine </p>
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

                        wp_die();
                    } catch (Exception $e) {
                        wp_die();
                    }

                } catch (phpmailerException $e) {
                    wp_die();
                } catch (Exception $e) {
                    wp_die();
                }

            }


        }


    }






