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
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <!-- =========================
        START Bug Patches SECTION
    ============================== -->
    <section class="about page knowledge" id="ABOUT">
      <div class="inner_about_area">
        <div class="container">
          <div class="row">
            <div class="col-md-12 wow fadeInLeftBig">
              <div class="section_title section-title-custom">
                <?php the_field('page_description', false, false); ?>
              </div>
            </div>
          </div>
          <br>

          <div class="row">
            <div class="col-md-12 wow fadeInLeftBig">
              <div class="accordion" id="myAccordion">
				
                <?php $i=1; ?>
                <?php if( have_rows('bug_patch_labels_contents') ): while( have_rows('bug_patch_labels_contents') ): the_row(); ?>
                <?php
                  $label = get_sub_field('bug_patch_label');
                  $content = get_sub_field('bug_patch_content');
                ?>
                <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                      <a role="button" class="<?php echo $content ? 'color-blue' : 'color-gray' ?>" data-toggle="<?php echo $content ? 'collapse' : '' ?>" data-target="#collapsible-<?php echo $i; ?>" data-parent="#myAccordion" aria-expanded="true" aria-controls="collapseOne">
                        <?php echo $i .'. ' . $label;  ?>
                      </a>
                    </h4>
                  </div>
                  <div id="collapsible-<?php echo $i; ?>" class="collapse">
                    <div class="panel-body">
                      <?php the_sub_field('bug_patch_content'); ?>
                    </div>
                  </div>
                </div>
                <?php $i++; ?>
                <?php endwhile; endif; ?>

              </div>
            </div>
          </div>

        </div>
      </div>
    </section>
    <!-- End Bug Patches -->

    <!-- =========================
         Start Subscription Form
    ============================== -->
		<section class="subscribe parallax subscribe-parallax" data-stellar-background-ratio="0.6" data-stellar-vertical-offset="20">
        <div class="section_overlay wow lightSpeedIn">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Start Subscribe Section Title -->
                        <div class="section_title">
                            <h2>SUBSCRIBE</h2>
                        </div>
                        <!-- End Subscribe Section Title -->
                    </div>
                </div>
            </div>

            <div class="container">
              <div class="row wow lightSpeedIn">
                <?php the_field('subscription_contents', false, false); ?>
              </div>
            </dv>
        </div>
    </section>
    <!-- END SUBSCRIPBE FORM -->

  <?php endwhile; endif; ?>

	<!-- =========================
		MODAL
	============================== -->
	 <div class="modal fade" id="unsubscribe-modal" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Unsubscribe</h4>
				</div>
				<div class="modal-body">
					<form role="form" id="unsubscribe_form">
						<div class="row">
							<div class="col-md-12">
								<div class="hide unsubscribe-success"></div>
								<div class="hide unsubscribe-error" data-toggle="tooltip" data-placement="bottom" title="User ID/Name should match with the Email you provided" style="color: red; text-align: center"></div>

								<div class="form-group col-md-6 padding-l-0">
									<label>User ID/Name</label>
                  <i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Input a keyword of your username or simply input your user id and then select from the dropdown below."></i>
									<input type="text" required class="form-control unsubscribeFields" name="userid" id="users" placeholder="Type your User ID or Name" style="height: 45px;">
								</div>

								<div class="form-group col-md-6 padding-r-0">
									<label>Email</label>
									<input type="text" required class="form-control unsubscribeFields" name="unsubscribe_email" id="unsubscribe_email" placeholder="Email" style="height: 45px;">
								</div>

								<div class="form-group col-md-12 padding-l-0" style="text-align: left">
									<button type="button" class="btn btn-default" id="clear">Clear</button>
									<button type="button" class="btn btn-primary" id="checkUsernameEmail">Next</button>
								</div>

								<div class="hidden" id="oss-table">
									<div class="col-md-12" style="text-align: center"><h3>List of OSS</h3></div>
									<div class="table-responsive" style="font-size: 12px;">
										<table class="unsubscribe_dataTables table table-striped table-bordered table-hover" cellspacing="0" width="100%">
											<thead>
												<tr>
													<th style="width: 28px!important;"></th>
													<th style="width: 696px!important;">OSS Name</th>
													<th style="width: 79px!important"></th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<div class="modal fade" id="confirmUS-modal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header modal-header-danger">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Confirm</h4>
				</div>
				<div class="modal-body">
					Are you sure you want to unsubscribe this OSS?
				</div>
				<div class="modal-footer margin-top-0">
					<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
					<button type="button" class="btn btn-primary confirm-unsubscribe-btn">Yes</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
<?php get_footer(); ?>
