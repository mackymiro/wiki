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
        START OUR PROCESS SECTION
    ============================== -->
      <section class="about page knowledge" id="ABOUT">
        <div class="inner_about_area our-process-area">
          <div class="container-fluid padding-lr-150">
            <div class="row">
              <div class="col-md-12 wow fadeInLeftBig">
                <div class="section_title section-title-custom">
                  <?php the_field('page_description', false, false); ?>
                </div>
              </div>
            </div>
            <br>
            <div class="row margin-top-10">
              <div class="col-md-12 wow fadeInLeftBig">
                <div class="accordion" id="myAccordion">
                  <?php if( have_rows('our_process_processes') ): ?>
                    <?php $i = 1; ?>
                    <?php while( have_rows('our_process_processes') ): the_row(); ?>
                      <?php
                          $ii = 1;
                          $process_id = get_sub_field('process_id');
                          $process_label = get_sub_field('process_label');
                          $process_class = get_sub_field('process_class');
                          $process_divison = get_sub_field('process_division');
                          $grid = 0;
                          $sub_process_elem = '';
                      ?>
                      <div class="col-md-12 col-xs-12">
                        <!-- Parent Process -->
                        <div class="panel panel-default margin-bottom-8">
                          <div class="panel-heading <?php echo $process_class; ?>" role="tab" id="headingOne">
                            <h4 class="panel-title">
                              <a role="button" class="panel-title color-white collapse-anchor-button" data-toggle="collapse" data-target="#collapsible-<?php echo $i; ?>" data-parent="#myAccordion" aria-expanded="true" aria-controls="collapseOne">
                                <?php echo $process_label; ?>
                              </a>
                            </h4>
                          </div>
                          <div id="collapsible-<?php echo $i; ?>" class="collapse collapse in">
                            <div class="panel-body">
                              <!-- Sub Process -->
                              <div class="accordion" id="<?php echo $process_id; ?>">
                                <?php if( have_rows('sub_process') ): ?>
                                  <?php while( have_rows('sub_process') ): the_row(); ?>
                                    <?php
                                      $sub_process_label = get_sub_field('sub_process_label');
                                      $sub_process_content = get_sub_field('sub_process_content');
                                      $sub_process_file_url = get_sub_field('sub_process_file');
				      $sub_process_file_url = $sub_process_file_url['url'];
                                      $download_link = '';

                                      if ( $grid == 0 ) {
                                        $sub_process_elem .= "<div class='row'>";
                                      }

                                      if ( $sub_process_file_url ) {
                                        $download_link = "<a class='pull-right' target='_blank' href='$sub_process_file_url'><i class='fa fa-download' aria-hidden='true'></i> Download</a>";
                                      }

                                      $sub_process_elem .= "<div class='col-md-$process_divison'>
                                                  <div class='panel panel-default margin-bottom-8'>
                                                    <div class='panel-heading $process_class' role='tab' id='headingOne'>
                                                      <h4 class='panel-title'>
                                                        <a role='button' class='color-white collapse-anchor-button' data-toggle='collapse' data-target='#$process_id-$ii' data-parent='#$process_id' aria-expanded='true' aria-controls='collapseOne'>
                                                          $sub_process_label
                                                        </a>
                                                      </h4>
                                                    </div>
                                                    <div id='$process_id-$ii' class='collapse'>
                                                      <div class='panel-body'>
                                                        $sub_process_content
                                                        $download_link
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>";

                                      $grid += $process_divison;

                                      if ( $grid == 12 ) {
                                        $sub_process_elem .= "</div>";
                                        $grid = 0;
                                      }

                                      $ii++;
                                    ?>
                                  <?php endwhile; ?>

                                  <!-- Display Sub Process -->
                                  <?php echo $sub_process_elem; ?>
                                  <!-- End Display Sub Process -->

                                <?php endif; ?>
                                </div>
                                <!-- End Sub Process -->

                              <?php $i++; ?>
                              </div>
                            </div>
                          </div>
                          <!-- End Parent Process -->
                      </div>
                  <?php endwhile; endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    <!-- End Our Process -->

  <?php endwhile; endif; ?>

<?php get_footer(); ?>
