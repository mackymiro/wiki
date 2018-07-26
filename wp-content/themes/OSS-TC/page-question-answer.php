<?php get_header(); ?>
<?php
/* ----------------------
   
    Script written by: Macky Miro
	
  ------------------------------------*/

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
$clientIPServer = get_client_ip_server();

$logline = $ipaddress . '|' . get_client_ip_env() . '|' . get_client_ip_server() . '|' .$remotehost.  '|' .$useragent.  "\n";

$date = date('Y-m-d');

// Create log line
$logline = $ipaddress . '|' . get_client_ip_env() . '|' . get_client_ip_server() . '|' .$remotehost.  '|' .$useragent.  "\n";

$date = date('Y-m-d');

//query from the page_views table
$results = $wpdb->get_results('SELECT * FROM page_views WHERE get_client_ip_env="'.$clientIPEnv.'"  AND mark_date = "'.$date.'"  ');

//if date is not today inserts into page_views table
if(empty($results)){
    global $wpdb;

    $wpdb->insert('page_views', array(
        'ip_address' => $ipaddress,
        'get_client_ip_env' => $clientIPEnv,
        'get_client_ip_server' => $clientIPServer,
        'mark_date'=>$date
    ));
}else{
    //query the table page_views
    $queries = $wpdb->get_results('SELECT * FROM page_views');

    //query the mark_date which is today
    $getDate = $wpdb->get_results('SELECT * FROM page_views WHERE mark_date="'.$date.'"');



    //displays the data from page_views table
    foreach($queries as $q){
        $q->ip_address;

    }

    //
    foreach($results as $result){
        $result->mark_date;
        $result->ip_address;
    }

    //if date is not equal today. Insert to table
    if($result->mark_date != $date){
        global $wpdb;

        $wpdb->insert('page_views', array(
            'ip_address' => $ipaddress,
            'get_client_ip_env' => $clientIPEnv,
            'get_client_ip_server' => $clientIPServer,
            'mark_date'=>$date
        ));
    }

}


?>
<?php
    session_start();
    if(isset($_GET['lang'])){
        $_SESSION['lang'] = $_GET['lang'];

    }

?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<!-- =========================
					START CONTACT FORM AREA
		============================== -->
    <section class="contact page question-answer-section">
         <div class="section_overlay">
             <div class="container">
                 <div class="col-md-12 wow bounceIn padding-lr-0">
                   <div class="section_title section-title-custom padding-top-40">
                                            <?php if($_SESSION['lang'] == "en"): ?>
											    <?php the_field('page_description', false, false); ?>
                                            <?php elseif($_SESSION['lang'] == "jp"): ?>
                                                <h2>お問い合わせ</h2>
                                                <p>このページでは、OSSに質問する及び、調査依頼などが可能でございます。 </p>
                                            <?php else: ?>
                                                <?php the_field('page_description', false, false); ?>
                                            <?php endif; ?>
                   </div>
									 <!-- Start Contact Section Title-->
									 <div class="section_title remove-background-after padding-bottom-0 padding-top-0">
										 <div class="panel panel-info panel-body-info">
											 <div class="panel-body panel-body-notice">
												<?php the_field('inquiry_notice', false, false); ?>
											 </div>
										</div>
                  </div>
                 </div>
             </div>

             <div class="contact_form wow bounceIn">
                 <div class="container">

									<div class="form-group margin-top-10 col-md-12 padding-lr-0">
										<?php if($_SESSION['lang'] == "en"): ?>
                                            <?php the_field('inquiry_info', false, false); ?>
                                        <?php elseif($_SESSION['lang'] =="jp"): ?>
                                            <p><label>情報</label></p>
                                            <blockquote class="form-notice">
                                                <p> お客様のリクエストを受けてから24時間以内にリクエストの確認を行います。 お客様の要求は、人材の可用性とOSSチームの能力に基づいて考慮されます。 評価または計画を行う前に、1〜5日間の初期調査を行います。 調査期間は、お客様の要求の複雑さによって決まります。 リクエストが非常に複雑で5日以上の調査が必要な場合は、リクエストを受けてから1日目または2日目にお知らせします。</p>
                                            </blockquote>
                                        <?php else: ?>
                                            <?php the_field('inquiry_info', false, false); ?>
                                        <?php endif; ?>
									</div>

									<!-- START ERROR AND SUCCESS MESSAGE -->
									<div class="form_error text-center">
										<div class="error-message hide error"></div>
									</div>
									<div class="Sucess"></div>
									<!-- END ERROR AND SUCCESS MESSAGE -->

                                    <?php if($_SESSION['lang'] == "en"): ?>
                                        <!-- CONTACT FORM -->
                                        <?php the_field('inquiry_email_form', false, false); ?>
                                        <!-- END FORM -->
                                    <?php elseif($_SESSION['lang'] =="jp"): ?>
                                        <form role="form" id="question_answer_form">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group col-md-6 padding-l-0">
                                                        <label>分割</label><br />
                                                        <select id="division" class="form-control" name="division"><option value="">&#8211;</option><option value="1SD">1SD</option><option value="2SD">2SD</option><option value="3SD">3SD</option><option value="CPD">CPD</option></select>
                                                    </div>
                                                    <div class="form-group col-md-6 padding-r-0">
                                                        <label>プロジェクト名</label><br />
                                                        <input id="project_name" class="form-control" name="project_name" type="text" placeholder="Project Name" />
                                                    </div>
                                                    <div class="form-group margin-top-10 col-md-6 padding-l-0">
                                                        <label>リクエスタ</label><br />
                                                        <input id="requester" class="form-control" name="requester" type="text" placeholder="Requester" />
                                                    </div>
                                                    <div class="form-group margin-top-10 col-md-6 padding-r-0">
                                                        <label>Eメール</label><br />
                                                        <i class="fa fa-question-circle" title="&lt;b&gt;*Can add multiple emails&lt;br&gt;*Press TAB, &quot;,&quot; or ENTER to add another email&lt;/b&gt;" data-toggle="tooltip" data-html="true" data-placement="top"></i><br />
                                                        <input id="emails" class="form-control" name="emails" type="text" placeholder="Email" data-role="tagsinput" />
                                                    </div>
                                                    <div class="form-group margin-top-10 col-md-6 padding-l-0">
                                                        <label>OSS対象</label><br />
                                                        <input id="target_oss" class="form-control" name="target_oss" type="text" placeholder="Target OSS" />
                                                    </div>
                                                    <div class="form-group margin-top-10 col-md-6 padding-r-0">
                                                        <label>OSSバージョン</label><br />
                                                        <input id="oss_version" class="form-control" name="oss_version" type="text" placeholder="OSS Version" />
                                                    </div>
                                                    <!--<div class="form-group margin-top-10 col-md-6 padding-l-0">
                                                        <label>締め切り</label><br />
                                                        <input id="due_date" class="form-control" name="due_date" type="text" placeholder="mm/dd/yyyy" />
                                                    </div>-->
                                                    <div class="form-group margin-top-10 col-md-6 padding-r-0">
                                                        <label>CP有り</label><br />
                                                        <select id="cp_availability" class="form-control"><option value="na">N/A</option><option value="no">NO</option><option value="yes">YES</option></select>
                                                    </div>
                                                    <div class="form-group margin-top-10 col-md-12 padding-lr-0">
                                                        <label>添付ファイル</label><br />
                                                        <input id="file_attach" multiple="multiple" name="file_attach[]" type="file" />
														<a href="#" onclick="return false;" id="reset_attached">Clear Attachments</a>
                                                    </div>
                                                    <div class="form-group margin-top-10 col-md-12 padding-lr-0">
                                                        <label>タイトル</label><br />
                                                        <input id="title" class="form-control" name="title" type="text" placeholder="Title" />
                                                    </div>
                                                    <div class="form-group margin-top-10 col-md-12 padding-lr-0">
                                                        <label>メッセージ</label><br />
                                                        <textarea id="message" class="form-control" cols="10" name="message" rows="25" placeholder="Message..."></textarea>
                                                    </div>
                                                    <div class="form-group margin-top-10 col-md-6 padding-l-0">
                                                        <button class="btn btn-default submit-btn form_submit_question_answer" disabled="disabled" type="button">メッセージを送信</button>
                                                    </div>
                                                    <div class="form-group margin-top-10 col-md-6 padding-r-0">
                                                        <a href="#" onclick="return false;" class="btn btn-default submit-btn form_clear_question_answer" id="reset">クリア</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    <?php else: ?>

                                        <?php the_field('inquiry_email_form', false, false); ?>
                                    <?php endif;?>


                 </div>
             </div>
           </div>
		</section>
		<!-- END CONTACT -->

	<?php endwhile; endif; ?>

	<div class="modal fade" id="confirmation-modal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Confirmation</h4>
				</div>
				<div class="modal-body">
					Are you sure you want to send this email?
				</div>
				<div class="modal-footer margin-top-0">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary confirm-question-answer-btn">Send</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<!-- CUSTOM SCRIPT ONLY FOR THIS PAGE -->
	<script type="text/javascript">
	
		$( document ).ready( function () {
			/**
			 * Initialize date picker
			 *
			 */
			
			$( '#due_date' ).datepicker( {
				ormat: "mm/dd/yyyy",
				startDate: new Date(),
				autoclose: true,
				startDate: '+7d',
				
			} )

			/**
			 * Customize tags input
			 *
			 */
			 $( '.bootstrap-tagsinput' ).addClass( 'form-control form-control-v2' );
			 
			 /* reset fields except file attachment*/
			 $("#reset").click(function(){
				  $("#division").val("");
				  $("#project_name").val("");
				  $("#requester").val("");
				  $("#target_oss").val("");
				  $("#oss_version").val("");
				  $("#due_date").val("");
				 
				  $("#title").val("");
				  $("#message").val("");
				  $("#emails").tagsinput('removeAll');
				  $('#cp_availability').val('no');
			 });
			 
			 /* reset attachement file only */
			 $("#reset_attached").click(function(){
				 $("#file_attach").val("");
			 });
			 
		} );
	</script>
	<!-- END CUSTOM SCRIPT -->

<?php get_footer(); ?>
