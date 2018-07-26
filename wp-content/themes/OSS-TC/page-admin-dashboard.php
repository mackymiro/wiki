<?php get_header(); ?>
<style>
/*----- Tabs -----*/
.tabs {
    width:100%;
    display:inline-block;
}

    /*----- Tab Links -----*/
    /* Clearfix */
    .tab-links:after {
        display:block;
        clear:both;
        content:'';
    }

    .tab-links li {
        margin:0px 5px;
        float:left;
        list-style:none;
    }

        .tab-links a {
            padding:9px 15px;
            display:inline-block;
            border-radius:3px 3px 0px 0px;
            background:lightgrey;
            font-size:16px;
            font-weight:600;
            color:#4c4c4c;
            transition:all linear 0.15s;
        }

        .tab-links a:hover {
            background:#a7cce5;
            text-decoration:none;
        }

    li.active a, li.active a:hover {
        background:#fff;
        color:#4c4c4c;
    }

    /*----- Content of Tabs -----*/
    .tab-content {
        padding:15px;
        border-radius: 5px;
        box-shadow: 6px 11px 32px rgba(0, 0, 0, 0.15);
        background:#fff;
    }

        .tab {
            display:none;
        }

        .tab.active {
            display:block;
        }



.container {
    margin-top:30px;
}

h1, h2, h3, h4, h5, h6 {
    font-family: 'Source Sans Pro';
    font-weight:700;
}

.fancyTab {
    text-align: center;
    padding:15px 0;
    background-color: #eee;
    box-shadow: 0 0 0 1px #ddd;
    top:15px;
    transition: top .2s;
}

.fancyTab.active {
    top:0;
    transition:top .2s;
}

.whiteBlock {
    display:none;
}

.fancyTab.active .whiteBlock {
    display:block;
    height:2px;
    bottom:-2px;
    background-color:#fff;
    width:99%;
    position:absolute;
    z-index:1;
}

.fancyTab a {
    font-family: 'Source Sans Pro';
    font-size:1.65em;
    font-weight:300;
    transition:.2s;
    color:#333;
}

/*.fancyTab .hidden-xs {
  white-space:nowrap;
}*/

.fancyTabs {
    border-bottom:2px solid #ddd;
    margin: 15px 0 0;
}

li.fancyTab a {
    padding-top: 15px;
    top:-15px;
    padding-bottom:0;
}

li.fancyTab.active a {
    padding-top: inherit;
}

.fancyTab .fa {
    font-size: 40px;
    width:100%;
    padding: 15px 0 5px;
    color:#666;
}

.fancyTab.active .fa {
    color: #cfb87c;
}

.fancyTab a:focus {
    outline:none;
}

.fancyTabContent {
    border-color: transparent;
    box-shadow: 0 -2px 0 -1px #fff, 0 0 0 1px #ddd;
    padding: 30px 15px 15px;
    position:relative;
    background-color:#fff;
}

.nav-tabs > li.fancyTab.active > a,
.nav-tabs > li.fancyTab.active > a:focus,
.nav-tabs > li.fancyTab.active > a:hover {
    border-width:0;
}

.nav-tabs > li.fancyTab:hover {
    background-color:#f9f9f9;
    box-shadow: 0 0 0 1px #ddd;
}

.nav-tabs > li.fancyTab.active:hover {
    background-color:#fff;
    box-shadow: 1px 1px 0 1px #fff, 0 0px 0 1px #ddd, -1px 1px 0 0px #ddd inset;
}

.nav-tabs > li.fancyTab:hover a {
    border-color:transparent;
}

.nav.nav-tabs .fancyTab a[data-toggle="tab"] {
    background-color:transparent;
    border-bottom:0;
}

.nav-tabs > li.fancyTab:hover a {
    border-right: 1px solid transparent;
}

.nav-tabs > li.fancyTab > a {
    margin-right:0;
    border-top:0;
    padding-bottom: 30px;
    margin-bottom: -30px;
}

.nav-tabs > li.fancyTab {
    margin-right:0;
    margin-bottom:0;
}

.nav-tabs > li.fancyTab:last-child a {
    border-right: 1px solid transparent;
}

.nav-tabs > li.fancyTab.active:last-child {
    border-right: 0px solid #ddd;
    box-shadow: 0px 2px 0 0px #fff, 0px 0px 0 1px #ddd;
}

.fancyTab:last-child {
    box-shadow: 0 0 0 1px #ddd;
}

.tabs .nav-tabs li.fancyTab.active a {
    box-shadow:none;
    top:0;
}


.fancyTab.active {
    background: #fff;
    box-shadow: 1px 1px 0 1px #fff, 0 0px 0 1px #ddd, -1px 1px 0 0px #ddd inset;
    padding-bottom:30px;
}

.arrow-down {
    display:none;
    width: 0;
    height: 0;
    border-left: 20px solid transparent;
    border-right: 20px solid transparent;
    border-top: 22px solid #ddd;
    position: absolute;
    top: -1px;
    left: calc(50% - 20px);
}

.arrow-down-inner {
    width: 0;
    height: 0;
    border-left: 18px solid transparent;
    border-right: 18px solid transparent;
    border-top: 12px solid #fff;
    position: absolute;
    top: -22px;
    left: -18px;
}

.fancyTab.active .arrow-down {
    display: block;
}

@media (max-width: 1200px) {

    .fancyTab .fa {
        font-size: 36px;
    }

    .fancyTab .hidden-xs {
        font-size:22px;
    }

}


@media (max-width: 992px) {

    .fancyTab .fa {
        font-size: 33px;
    }

    .fancyTab .hidden-xs {
        font-size:18px;
        font-weight:normal;
    }

}


@media (max-width: 768px) {

    .fancyTab > a {
        font-size:18px;
    }

    .nav > li.fancyTab > a {
        padding:15px 0;
        margin-bottom:inherit;
    }

    .fancyTab .fa {
        font-size:30px;
    }

    .nav-tabs > li.fancyTab > a {
        border-right:1px solid transparent;
        padding-bottom:0;
    }

    .fancyTab.active .fa {
        color: #333;
    }

}


</style>

<script type="text/javascript">
	jQuery(document).ready(function() {
    jQuery('.tabs .tab-links a').on('click', function(e)  {
        var currentAttrValue = jQuery(this).attr('href');

        // Show/Hide Tabs
        jQuery('.tabs ' + currentAttrValue).show().siblings().hide();

        // Change/remove current tab to active
        jQuery(this).parent('li').addClass('active').siblings().removeClass('active');

        e.preventDefault();
    });



});
</script>
<script type="text/javascript" src="http://static.fusioncharts.com/code/latest/fusioncharts.js"></script>
<script type="text/javascript" src="http://static.fusioncharts.com/code/latest/themes/fusioncharts.theme.fint.js?cacheBust=56"></script>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<!-- =========================
					START FAQ SECTION
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


<div class="tabs">
    <ul class="tab-links">
        <li class="active"><a href="#tab1">List of subscibers for bug patch</a></li>
        <li><a href="#tab2">List of downloads</a></li>
        <li><a href="#tab4">List of inquiries</a></li>
        <li><a href="#tab3">Page views</a></li>
    </ul>
    <?php global $wpdb; ?>
    <div class="tab-content">
        <div id="tab1" class="tab active">
           <p>
               <?php
                $subscribers = $wpdb->get_results('SELECT 
                                                        s.user_id, s.oss_name, o.name, o.email, o.start_date, o.end_date
                                                     FROM subscribers_oss s 
                                                     INNER JOIN subscribers o ON o.user_id = s.user_id
                                                    ');
               ?>
               <table class="table dataTables table-striped">
                <thead>
                    <th></th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>OSS Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                </thead>
                <tbody>
                    <?php foreach ($subscribers as $subscriber): ?>
                    <tr>
                        <td></td>
                        <td><?php echo $subscriber->name;?></td>
                        <td><?php echo $subscriber->email;?></td>
                        <td><?php echo $subscriber->oss_name; ?></td>
                        <td><?php echo $subscriber->start_date; ?></td>
                        <td><?php echo $subscriber->end_date; ?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
               </table>

           </p>
        </div>

        <div id="tab2" class="tab">
            <p>
                <?php
                $lDownloads = $wpdb->get_results('SELECT *
                                                    FROM
                                                    list_of_downloads
                                                      
                                                    ');
                ?>
            <table class="table dataTables table-striped">
                <thead>

                    <th>Name</th>
                    <th>Number of downloads</th>
                </thead>
                <tbody>
                <?php foreach ($lDownloads as $lDownload): ?>
                    <tr>

                        <td><?php echo $lDownload->name;?></td>
                        <td><?php echo $lDownload->number_of_downloads; ?></td>

                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
            </p>

        </div>
        <div id="tab4" class="tab">
            <?php
                $listOfInquiries =$wpdb->get_results('SELECT 
                                                    division, project_name, oss, oss_version, due_date,
                                                    requester, ip_address, date
                                                    FROM
                                                    list_of_inquiries
                                           ');
            ?>
            <table class="table dataTables table-striped">
                <thead>
                    <th>Division</th>
                    <th>Project Name</th>
                    <th>OSS</th>
                    <th>OSS Version</th>
                    <th>Due Date</th>
                    <th>Requester</th>
                    <th>IP Address</th>
                    <th>Date and Time</th>
                </thead>
                <tbody>
                 <?php foreach($listOfInquiries as $inquiry): ?>
                    <tr>
                        <td><?php echo $inquiry->division; ?></td>
                        <td><?php echo $inquiry->project_name; ?></td>
                        <td><?php echo $inquiry->oss; ?></td>
                        <td><?php echo $inquiry->oss_version; ?></td>
                        <td><?php echo $inquiry->due_date; ?></td>
                        <td><?php echo $inquiry->requester; ?></td>
                        <td><?php echo $inquiry->ip_address; ?></td>
                        <td><?php echo date("F j, Y, g:i a", $inquiry->date); ?></td>
                    </tr>
                 <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div id="tab3" class="tab">
            <p>
                <?php

                    require_once get_template_directory() . '/custom/functions/fusioncharts.php';
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

                $remotehost = gethostbyaddr($ipaddress);


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

                        $wpdb->insert('page_views', array(
                            'ip_address' => $ipaddress,
                            'get_client_ip_env' => $clientIPEnv,
                            'get_client_ip_server' => $clientIPServer,
                            'mark_date'=>$date
                        ));
                    }else{
                        //query the table page_views
                        $queries = $wpdb->get_results('SELECT * FROM page_views');

                        //query distinct data
                        $distincts = $wpdb->get_results('SELECT  DISTINCT mark_date FROM page_views');


                        //query the mark_date which is today
                        $getDate = $wpdb->get_results('SELECT * FROM page_views WHERE mark_date="'.$date.'"');

                        //count duplicate data in page_views table
                        $duplicateData = $wpdb->get_results('SELECT mark_date, COUNT(*) m FROM page_views GROUP BY mark_date HAVING m >0');


                        echo "Views: ".count($getDate)."-people have visited this website today.";
                        echo "<br>";
                        echo "<br>";
                        echo "<p style='font-size:18px;'>Your IP address is:".".$clientIPEnv."."</p>";
                        echo "<br>";


                        if($duplicateData) {
                            $arrData = array(
                                "chart" => array(
                                    "caption" => "IP Address",
                                    "subCaption"=> "(Graph is Per Day)",
                                    "paletteColors" => "#0075c2",
                                    "bgColor" => "#ffffff",
                                    "borderAlpha"=> "20",
                                    "canvasBorderAlpha"=> "0",
                                    "usePlotGradientColor"=> "0",
                                    "plotBorderAlpha"=> "10",
                                    "showXAxisLine"=> "1",
                                    "xAxisLineColor" => "#999999",
                                    "showValues" => "0",
                                    "divlineColor" => "#999999",
                                    "divLineIsDashed" => "1",
                                    "showAlternateHGridColor" => "0",
                                    "xAxisName"=> "Date",
                                    "yAxisName"=> "Number of Visits (Per Day)",

                                ),

                            );


                            $arrData["data"] = array();

                            foreach ($duplicateData as $d) {
                                // Push the data into the array
                                array_push($arrData["data"], array(
                                        "label"=>$d->mark_date,
                                        "value"=>$d->m
                                    )
                                );

                            }

                            //displays the data from page_views table
                            foreach ($queries as $q) {
                                $exp = explode(",", $q->get_client_ip_env);

                                /*if($exp[0] == "unknown"){
                                    echo '<span style="font-size:15px; color:green">'.$exp[1].'</span>';
                                    echo '<br>';
                                }else{
                                    echo '<span style="font-size:15px; color:green">'.$q->get_client_ip_env.'</span>';
                                    echo '<br>';

                                }*/

                                // Push the data into the array
                                /* array_push($arrData["data"], array(
                                         "label" => $q->mark_date,
                                         "value  " => $q->get_client_ip_env
                                     )
                                 );*/

                            }


                            /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */
                            $jsonEncodedData = json_encode($arrData);


                            /*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/
                           $columnChart = new FusionCharts("line", "IPChart", 1100, 400, "chart-1", "json", $jsonEncodedData);

                            // Render the chart
                            $columnChart->render();

                        }

                        //
                        foreach($results as $result){
                            $result->mark_date;
                            $result->ip_address;
                        }

                        //if date is not equal today. Insert to table
                        if($result->mark_date != $date){

                            $wpdb->insert('page_views', array(
                                'ip_address' => $ipaddress,
                                'get_client_ip_env' => $clientIPEnv,
                                'get_client_ip_server' => $clientIPServer,
                                'mark_date'=>$date
                            ));
                        }

                    }


                ?>

                <div id="chart-1"><!-- Fusion Charts will render here--></div>
            </p>

        </div>



    </div>
</div>


			</div>
		</div>
	</section>
	<!-- End FAQ -->

<?php endwhile; endif; ?>
<br>
<br>


<?php get_footer(); ?>
