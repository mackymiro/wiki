<?php get_header(); ?>
<?php

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
        START TOOL Child SECTION
    ============================== -->
    <section class="about page knowledge" id="ABOUT">
       <div class="inner_about_area">
         <div class="container">
             <div class="row">
                 <div class="col-md-12 wow fadeInLeftBig">
                   <div class="section_title section-title-custom">
                       <h2><?php echo the_title(); ?></h2>
                   </div>
                 </div>
             </div>
             <div class="row">

						 <?php if( have_rows('tool_tabs_contents') ): ?>
						 <div class="row">
						 
										
								 <!-- Nav tabs -->
								 <div class="col-xs-4 col-md-3">
									 <ul class="nav nav-tabs tabs-left" id="myTabs">
								
										 <?php $i=0; ?>

										 <?php while( have_rows('tool_tabs_contents') ) : the_row(); ?>
											 <li id="sample-<?php the_sub_field('tool_tab_id'); ?>" class="<?php echo $i==0 ? 'active' : '' ?>"><a href="#<?php the_sub_field('tool_tab_id'); ?>" data-toggle="tab"><?php the_sub_field('tool_tab_label'); $i++; ?></a></li>
										     
											 <script type="text/javascript">
												$(document).ready(function(){
													$("#sample").click(function(){
														$("#sample-<?php the_sub_field('tool_tab_id'); ?>").addClass("active");
														$("#sample-<?php the_sub_field('tool_tab_id'); ?>").removeClass("active");
														$("#basicscan").removeClass("active");
														$("#htmlreport").addClass("active");
														$("#sample-htmlreport").addClass("active");
														$("#sample-7").addClass("active");
														$("#2").removeClass("active");
														$("#7").addClass("active");
														
														$("#sample-5").removeClass("active");
														$("#5").removeClass("active");

														//Gatling page
														$("#sample-CreatingASimulation").addClass("active");
														$("#CreatingASimulation").addClass("active");


														$("#sample-InstallationandSetup").removeClass("active");
														$("#InstallationandSetup").removeClass("active");



													});

													//Gatling page
                                                    $("#directory_structure").click(function(){
                                                        $("#sample-directorystructure").addClass("active");
                                                        $("#directorystructure").addClass("active");

                                                        $("#sample-InstallationandSetup").removeClass("active");
                                                        $("#InstallationandSetup").removeClass("active");

                                                    });
													
													$("#reference").click(function(){
														$("#sample-7").addClass("active");
														$("#7").addClass("active");
														$("#sample-5").removeClass("active");
														$("#5").removeClass("active");
													});
												});
											
											</script>	
										 
										 <?php endwhile; ?>
									 </ul>
								 </div>
								 <!-- End Nav tabs  -->

								 <!-- Tab Pane  -->
								 <div class="col-xs-7 col-md-9">
									 <div class="tab-content">
										 <?php $i=0; ?>
										 <?php while( have_rows('tool_tabs_contents') ) : the_row(); ?>
										        
												<div class="tab-pane <?php echo $i==0 ? 'active' : '' ?>" id="<?php the_sub_field('tool_tab_id'); ?>">
													<div class="panel panel-default">
														<div class="panel-heading bg-orange">
															<h3 class="panel-title"><?php the_sub_field('tab_header', false, false); $i++;  ?></h3>
														</div>
														<div class="panel-body">
															<?php the_sub_field('tool_tab_content', false, false); $i++; ?>
															
														</div>
													
													</div>
											 	 	
													
														
												</div>
											
										 <?php endwhile; ?>
									 </div>
								 </div>
								 <!-- End Tab Pane -->
							 </div>
						 <?php endif; ?>

             <!-- Back Button -->
             <div class="row">
               <div class="col-md-12 col-xs-12 padding-bt-20">
                 <a href="<?php echo site_url() . get_field('back_button'); ?>" class="pull-right"><span class="fa fa-arrow-circle-left" aria-hidden="true"></span> Back To List</a>
               </div>
             </div>
             <!-- End Back Button -->

          </div>
      </div>
    </section>
    <!-- End TOOL Child -->

	<div class="modal fade" id="download-modal" tabindex="-1" role="dialog">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <h4 class="modal-title">FORM</h4>
         </div>
         <div class="modal-body">
					<?php the_field('tool_download_form'); ?>
         </div>
       </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
   	</div><!-- /.modal -->

	<?php endwhile; endif; ?>

<script type="text/javascript">
    jQuery(document).on('click','.dL',function(){
        var name = ($(this).attr('name'));
        var urldata = ($(this).attr('href'));
        jQuery.ajax({
            type : 'POST',
            url  : MyAjax.ajaxurl,
            data: {
                action: 'my_action',
                'name': name,
                'urldata': urldata
            },
            dataType:"json",
            success:function(data){
                console.log(data);
            },
            error: function(data){
                console.log(data);
            }
        });
    });
</script>

<?php get_footer(); ?>
