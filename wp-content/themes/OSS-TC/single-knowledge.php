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
        START KNOWLEDGE Child SECTION
    ============================== -->
    <section class="about page knowledge" id="ABOUT">
       <div class="inner_about_area">
         <div class="container-fluid" style="width: 85%;">
             <div class="row">
                 <div class="col-md-12 wow fadeInLeftBig">
                   <div class="section_title section-title-custom">
                       <h2><?php echo the_title(); ?></h2>
                   </div>
                 </div>
             </div>

						 <?php if( have_rows('knowledge_tabs_contents') ) { ?>
	             <div class="row">
								 <!-- Nav tabs -->
								 <div class="col-xs-4 col-md-3">
									 <ul class="nav nav-tabs tabs-left" id="myTabs">
										 <?php $i=0; ?>
										 <?php while( have_rows('knowledge_tabs_contents') ) : the_row(); ?>
											<li id="sample-<?php the_sub_field('knowledge_tab_id')?>" class="<?php echo $i==0 ? 'active' : '' ?>"><a href="#<?php the_sub_field('knowledge_tab_id'); ?>" data-toggle="tab"><?php the_sub_field('knowledge_tab_label'); $i++; ?></a></li>
											<script type="text/javascript">
												$(document).ready(function(){
													$("#sample").click(function(){
														$("#sample-compilingdesigns").removeClass("active");
														$("#compilingdesigns").removeClass("active");
														$("#sample-designs").addClass("active");
														$("#designs").addClass("active");
														
														
														
													});
													
													$("#sample-2").click(function(){
														$("#sample-compilingdesigns").removeClass("active");
														$("#compilingdesigns").removeClass("active");
														$("#sample-designs").addClass("active");
														$("#designs").addClass("active");
														
													});
													
													$("#sample-refer").click(function(){
														$("#sample-fillings").removeClass("active");
														$("#sample-parameters").addClass("active");
														
														$("#fillings").removeClass("active");
														$("#parameters").addClass("active");
														
													});
													
													
													//JasperReports page
													
													$("#jasperToCompD").click(function(){
														$("#sample-fillings").removeClass("active");
														$("#sample-compilingdesigns").addClass("active");
														
														$("#fillings").removeClass("active");
														$("#compilingdesigns").addClass("active");
														
													});
													
													$("#jasperToCompD-2").click(function(){
														$("#sample-fillings").removeClass("active");
														$("#sample-compilingdesigns").addClass("active");
														
														$("#fillings").removeClass("active");
														$("#compilingdesigns").addClass("active");
														
													});
													
													$("#data-sources").click(function(){
														$("#sample-fillings").removeClass("active");
														$("#sample-datasources").addClass("active");
														
														$("#fillings").removeClass("active");
														$("#datasources").addClass("active");
														
													});
													
													$("#sample-viewprint").click(function(){
														$("#sample-viewandprint").removeClass("active");
														$("#viewandprint").removeClass("active");
														$("#sample-fillings").addClass("active");
														$("#fillings").addClass("active");
														
													});
													
													
													$("#sample-export").click(function(){
														$("#sample-exporting").removeClass("active");
														$("#exporting").removeClass("active");
														
														$("#sample-fillings").addClass("active");
														$("#fillings").addClass("active");
													
														
														
													});
													
													
													$("#subReports").click(function(){
														$("#sample-subreports").removeClass("active");
														$("#subreports").removeClass("active");
														
														$("#sample-datasources").addClass("active");
														$("#datasources").addClass("active");
													});
													
													//JSONIC page
													$("#jsonic").click(function(){
														$("#sample-jsonapiutility").removeClass("active");
														$("#jsonapiutility").removeClass("active");
														
														$("#sample-encoding").addClass("active");
														$("#encoding").addClass("active");
													});
													
													$("#jsonicInst").click(function(){
														$("#sample-jsonapiinstantiation").removeClass("active");
														$("#jsonapiinstantiation").removeClass("active");
														
														$("#sample-encoding").addClass("active");
														$("#encoding").addClass("active");
														
													});
													
													$("#jsonicDecode").click(function(){
														$("#sample-jsonapiinstantiation").removeClass("active");
														$("#jsonapiinstantiation").removeClass("active");
														
														$("#sample-decoding").addClass("active");
														$("#decoding").addClass("active");
														
													});
													
													//Comparison of VM and Docker using LPIC Use Cases page
													
													$("#1011").click(function(){
														$("#sample-technicalcomparison").removeClass("active");
														$("#technicalcomparison").removeClass("active");
														
														$("#sample-lpicitems101").addClass("active");
														$("#lpicitems101").addClass("active");
												
													});
													
													$("#1012").click(function(){
														$("#sample-technicalcomparison").removeClass("active");
														$("#technicalcomparison").removeClass("active");
														
														$("#sample-lpicitems1012").addClass("active");
														$("#lpicitems1012").addClass("active");
													});
													
													$("#1013").click(function(){
														$("#sample-technicalcomparison").removeClass("active");
														$("#technicalcomparison").removeClass("active");
														
														$("#sample-lpicitems1013").addClass("active");
														$("#lpicitems1013").addClass("active");
													});
													
													$("#1014").click(function(){
														$("#sample-technicalcomparison").removeClass("active");
														$("#technicalcomparison").removeClass("active");
														
														$("#sample-lpicitems1014").addClass("active");
														$("#lpicitems1014").addClass("active");
													});
													
													$("#1015").click(function(){
														$("#sample-technicalcomparison").removeClass("active");
														$("#technicalcomparison").removeClass("active");
														
														$("#sample-lpicitems1015").addClass("active");
														$("#lpicitems1015").addClass("active");
													});
													
													$("#1021").click(function(){
														$("#sample-technicalcomparison").removeClass("active");
														$("#technicalcomparison").removeClass("active");
														
														$("#sample-lpicitems1021").addClass("active");
														$("#lpicitems1021").addClass("active");
													});
													
													$("#1023").click(function(){
														$("#sample-technicalcomparison").removeClass("active");
														$("#technicalcomparison").removeClass("active");
														
														$("#sample-lpicitems1023").addClass("active");
														$("#lpicitems1023").addClass("active");
													});
													
													$("#1036").click(function(){
														$("#sample-technicalcomparison").removeClass("active");
														$("#technicalcomparison").removeClass("active");
														
														$("#sample-lpicitems1036").addClass("active");
														$("#lpicitems1036").addClass("active");
													});
													
													$("#1037").click(function(){
														$("#sample-technicalcomparison").removeClass("active");
														$("#technicalcomparison").removeClass("active");
														
														$("#sample-lpicitems1037").addClass("active");
														$("#lpicitems1037").addClass("active");
														
													});
													
													$("#1038").click(function(){
														$("#sample-technicalcomparison").removeClass("active");
														$("#technicalcomparison").removeClass("active");
														
														$("#sample-lpicitems1038").addClass("active");
														$("#lpicitems1038").addClass("active");
													});
													
													$("#dockerStorages1").click(function(){
														$("#sample-technicalcomparison").removeClass("active");
														$("#technicalcomparison").removeClass("active");
														
														$("#sample-dockerstorages").addClass("active");
														$("#dockerstorages").addClass("active");
													});
													
													$("#1041").click(function(){
														$("#sample-technicalcomparison").removeClass("active");
														$("#technicalcomparison").removeClass("active");
														
														$("#sample-lpicitems1041").addClass("active");
														$("#lpicitems1041").addClass("active");
													});
													
													$("#1042").click(function(){
														$("#sample-technicalcomparison").removeClass("active");
														$("#technicalcomparison").removeClass("active");
														
														$("#sample-lpicitems1042").addClass("active");
														$("#lpicitems1042").addClass("active");
													});
													
													$("#1043").click(function(){
														$("#sample-technicalcomparison").removeClass("active");
														$("#technicalcomparison").removeClass("active");
														
														$("#sample-lpicitems1043").addClass("active");
														$("#lpicitems1043").addClass("active");
													});
													
													$("#dockerStorages2").click(function(){
														$("#sample-technicalcomparison").removeClass("active");
														$("#technicalcomparison").removeClass("active");
														
														$("#sample-dockerstorages").addClass("active");
														$("#dockerstorages").addClass("active");
													});
													
													$("#1044").click(function(){
														$("#sample-technicalcomparison").removeClass("active");
														$("#technicalcomparison").removeClass("active");
														
														$("#sample-lpicitems1044").addClass("active");
														$("#lpicitems1044").addClass("active");
													});
													
													
													$("#1045").click(function(){
														$("#sample-technicalcomparison").removeClass("active");
														$("#technicalcomparison").removeClass("active");
														
														$("#sample-lpicitems1045").addClass("active");
														$("#lpicitems1045").addClass("active");
													});
													
													$("#1047").click(function(){
														$("#sample-technicalcomparison").removeClass("active");
														$("#technicalcomparison").removeClass("active");
														
														$("#sample-lpicitems1047").addClass("active");
														$("#lpicitems1047").addClass("active");
													});
													
													$("#1072").click(function(){
														$("#sample-technicalcomparison").removeClass("active");
														$("#technicalcomparison").removeClass("active");
														
														$("#sample-lpicitems1072").addClass("active");
														$("#lpicitems1072").addClass("active");
													});
													
													$("#1073").click(function(){
														$("#sample-technicalcomparison").removeClass("active");
														$("#technicalcomparison").removeClass("active");
														
														$("#sample-lpicitems1073").addClass("active");
														$("#lpicitems1073").addClass("active");
													});
													
													$("#1092").click(function(){
														$("#sample-technicalcomparison").removeClass("active");
														$("#technicalcomparison").removeClass("active");
														
														$("#sample-lpicitems1092").addClass("active");
														$("#lpicitems1092").addClass("active");
													});
													
													$("#proceedDockerStorage").click(function(){
														$("#sample-lpicitems1041").removeClass("active");
														$("#lpicitems1041").removeClass("active");
														
														$("#sample-dockerstorages").addClass("active");
														$("#dockerstorages").addClass("active");
													});
													
													
													
													$("#viewDockerStorage").click(function(){
														$("#sample-lpicitems1043").removeClass("active");
														$("#lpicitems1043").removeClass("active");
														
														$("#sample-dockerstorages").addClass("active");
														$("#dockerstorages").addClass("active");
													});
													
													//OpenShift 3 page
													$("#nodeports").click(function(){
														$("#sample-podsservicesroutes").removeClass("active");
														$("#podsservicesroutes").removeClass("active");
														
														$("#sample-routesnodeports").addClass("active");
														$("#routesnodeports").addClass("active");
													
													});
													
													$("#nd").click(function(){
														$("#sample-introduction").removeClass("active");
														$("#introduction").removeClass("active");
														$("#sample-Networkdiagram").addClass("active");
														$("#Networkdiagram").addClass("active");
													});
													
													$("#manualclick").click(function(){
														$("#sample-introduction").removeClass("active");
														$("#introduction").removeClass("active");
														$("#sample-Manual").addClass("active");
														$("#Manual").addClass("active");
													});
													
													
													$("#nd1").click(function(){
														$("#sample-Manual").removeClass("active");
														$("#Manual").removeClass("active");
														$("#sample-Networkdiagram").addClass("active");
														$("#Networkdiagram").addClass("active");
													});
													
													$("#openshift3-setup-diagram").click(function(){
														$("#sample-openshift3installation").removeClass("active");
														$("#openshift3installation").removeClass("active");
														
														$("#sample-openshift3setupdiagram").addClass("active");
														$("#openshift3setupdiagram").addClass("active");
														
													});
													
													$("#openshift3-networkdiagram").click(function(){
														$("#sample-openshift3exipnproutes").removeClass("active");
														$("#openshift3exipnproutes").removeClass("active");
														
														$("#sample-openshift3networkdiagram").addClass("active");
														$("#openshift3networkdiagram").addClass("active");
													
													});
													
													$("#openshift3-bet-nodes").click(function(){
														$("#sample-openshift3exipnproutes").removeClass("active");
														$("#openshift3exipnproutes").removeClass("active");
														
														$("#sample-openshift3betnodes").addClass("active");
														$("#openshift3betnodes").addClass("active");
														
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
										 <?php while( have_rows('knowledge_tabs_contents') ) : the_row(); ?>
												<div class="tab-pane <?php echo $i==0 ? 'active' : '' ?>" id="<?php the_sub_field('knowledge_tab_id'); ?>">
													<div class="panel panel-default">
														<div class="panel-heading bg-orange">
															<h3 class="panel-title"><?php the_sub_field('tab_header', false, false); $i++; ?></h3>
														</div>
														<div class="panel-body">
															<?php the_sub_field('knowledge_tab_content', false, false); $i++; ?>
														</div>
													</div>
											 	 	
													
												</div>
										 <?php endwhile; ?>
										
									 </div>
								 </div>
								 <!-- End Tab Pane -->
							 </div>
						 <?php } else { ?>
								<section class="about page knowledge" id="ABOUT">
										<div class="inner_about_area">
											<div class="container">
													<div class="row">
															<div class="col-md-12 wow fadeInLeftBig">
																<div class="section_title section-title-custom">
																	<h2>SITE UNDER MAINTENANCE</h2>
																</div>
															</div>
													</div>
													<div class="row" >
														<div class="col-md-12 wow fadeInLeftBig text-center" style="margin-bottom: 25%;">
															<img src="<?php echo get_template_directory_uri(); ?>/assets/images/site_maintenance.png" alt="Under Maintenance">
														</div>
													</div>
											</div>
										</div>
								</section>
						 <?php } ?>

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
    <!-- End KNOWLEDGE Child -->

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
