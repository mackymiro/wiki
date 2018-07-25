<?php
/**
 * Created by PhpStorm.
 * User: miro.mm
 * Date: 2/14/2018
 * Time: 9:45 AM
 */


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

<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <!-- =========================
       START LICENSE PAGE SECTION
       ============================== -->
    <section class="about page knowledge" id="ABOUT">
        <div class="inner_about_area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 wow fadeInLeftBig">
                        <div class="section_title section-title-custom">
                            <?php the_field('page_description', false, false)?>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12 wow fadeInLeftBig table-responsive">
                        <table class="dataTables table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th class="width-50"></th>
                                <th>License Type</th>
                                <th>License Details</th>
                                <th>Last Updated</th>
                                <th>OK for OSS?</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $licenses = get_posts(array(
                                    'numberposts'=>-1,
                                    'post_type'=>'license',
                                    'post_status'=>'publish'
                                ));
                            ?>
                            <?php foreach($licenses as $license): ?>
                                <?php $lType = get_post_custom($license->ID); ?>

                                <?php $lLicense = $lType['license_page_tag'][0]; ?>
                                <?php $lLicenseUpdated = $lType['licensed_last_updated'][0]; ?>

                                <tr>
                                    <td></td>
                                    <td><a href="<?php echo get_permalink($license->ID); ?>"><?php echo $license->post_title; ?></a></td>
                                    <td><?php echo $license->post_content; ?></td>
                                    <td><?php echo $lLicenseUpdated; ?></td>
                                    <td><?php echo $lLicense; ?></td>
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                        </table>

                    </div>
                </div>

            </div>

    </section>

<?php endwhile; endif; ?>
<?php get_footer(); ?>