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
        START FAQ Child SECTION
    ============================== -->
    <section class="about page knowledge" id="ABOUT">
       <div class="inner_about_area">
         <div class="container">
             <div class="row">
                 <div class="col-md-12 wow fadeInLeftBig">
                   <div class="section_title section-title-custom">
                       <h2>Question</h2>
                   </div>
                 </div>
             </div>
             <div class="row">
               <div class="col-md-12 wow fadeInLeftBig">
                 <div class="col-md-12 col-xs-12">
                   <!-- FAQ Child Title -->
                   <div class="page-header margin-top-10">
                     <h1 class="margin-top-10">
                       <?php
                        $title = preg_replace( '/\?/', '', get_the_title() );
                       ?>
                       <small><?php echo $title; ?><i class="fa fa-question" aria-hidden="true"></i></small>
                     </h1>
                   </div>
                   <!-- End Faq Child Title -->

                   <!-- Problems -->
                   <?php if( have_rows('faq_problems') ): ?>
                     <?php while( have_rows('faq_problems') ): the_row(); ?>
                       <div class="col-md-12 col-xs-12">
                         <div class="col-md-12 col-xs-12">
                           <h4>Problems:</h4>
                           <?php if( have_rows('faq_problem') ): ?>
                             <blockquote>
                               <ul class="faq-list">
                                 <?php while ( have_rows('faq_problem') ): the_row(); ?>
                                   <li><?php echo get_sub_field('faq_problem_text', false, false); ?></li>
                                 <?php endwhile; ?>
                               </ul>
                             </blockquote>
                           <?php endif; ?>
                         </div>
                         <?php if( get_sub_field('faq_problem_image') ): ?>
                           <div class="thumbnail col-md-12 col-xs-12" style="border: 0;">
			     <?php $faqprobimg = array(); $faqprobimg = get_sub_field('faq_problem_image'); ?>
                             <img src="<?php echo $faqprobimg['url']; ?>" alt="">
                           </div>
                         <?php endif; ?>
                         <?php the_sub_field('faq_problem_note', false, false); ?>
                       </div>
                    <?php endwhile; ?>
                   <?php endif; ?>
                   <!-- End Problems -->

                   <!-- Findings -->
                   <?php if( have_rows('faq_findings') ): ?>
                     <?php while( have_rows('faq_findings') ): the_row(); ?>
                       <div class="col-md-12 col-xs-12 margin-top-10">
                         <div class="col-md-12 col-xs-12">
                           <h4>Findings:</h4>
                           <?php if( have_rows('faq_finding') ): ?>
                             <blockquote>
                               <ul class="faq-list">
                                 <?php while ( have_rows('faq_finding') ): the_row(); ?>
                                   <li><?php echo get_sub_field('faq_finding_text', false, false); ?></li>
                                 <?php endwhile; ?>
                               </ul>
                             </blockquote>
                           <?php endif; ?>
                         </div>
                         <?php if( get_sub_field('faq_finding_image') ): ?>
                           <div class="thumbnail col-md-12 col-xs-12" style="border: 0;">
			     <?php $faqfindimg = array(); $faqfindimg = get_sub_field('faq_finding_image'); ?>
                             <img src="<?php echo $faqfindimg['url']; ?>" alt="">
                           </div>
                         <?php endif; ?>
                         <?php the_sub_field('faq_finding_note', false, false); ?>
                       </div>
                     <?php endwhile; ?>
                   <?php endif; ?>
                   <!-- End Findings -->

                   <!-- Solution -->
                   <?php if( have_rows('faq_solutions') ): ?>
                     <?php while( have_rows('faq_solutions') ): the_row(); ?>
                       <div class="col-md-12 col-xs-12 margin-top-10">
                         <div class="col-md-12 col-xs-12">
                           <h4>Solution:</h4>
                           <?php if( have_rows('faq_solution') ): ?>
                             <blockquote>
                               <ul class="faq-list">
                                 <?php while ( have_rows('faq_solution') ): the_row(); ?>
                                   <li><?php echo get_sub_field('faq_solution_text', false, false); ?></li>
                                 <?php endwhile; ?>
                               </ul>
                             </blockquote>
                           <?php endif; ?>
                         </div>
                         <?php if( get_sub_field('faq_solution_image') ): ?>
                           <div class="thumbnail col-md-12 col-xs-12" style="border: 0;">
			     <?php $faqsolimg = array(); $faqsolimg = get_sub_field('faq_solution_image'); ?>
                             <img src="<?php echo $faqsolimg['url']; ?>" alt="">
                           </div>
                         <?php endif; ?>
                         <?php the_sub_field('faq_solution_note', false, false); ?>
                       </div>
                    <?php endwhile; ?>
                   <?php endif; ?>
                   <!-- End Solution -->

                 </div>
               </div>
             </div>

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
    <!-- End FAQ Child -->

	<?php endwhile; endif; ?>

<?php get_footer(); ?>
