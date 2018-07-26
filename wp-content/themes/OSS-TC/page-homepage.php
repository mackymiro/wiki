<?php get_header(); ?>
<?php
/* ----------------------
   
    Script written by: Macky Miro
	
  ------------------------------------*/
  

global $wpdb;

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
				 START HEADER SECTION
		============================== -->
    <section class="header parallax home-parallax page" id="HOME">
        <div class="section_overlay">
            <div class="container-fluid home-container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="logo text-center">
                            <!-- LOGO -->
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="col-md-12">
                            <div class="panel panel-default" style="background-color: rgba(255, 255, 255, 0.62)!important;">
                                <div class="panel-heading bg-blue">
                                    <?php if($_SESSION['lang'] == "en"): ?>
                                        <h3 class="panel-title">What's New</h3>
                                    <?php elseif($_SESSION['lang'] == "jp"): ?>
                                        <h3 class="panel-title">新着情報</h3>

                                    <?php else: ?>
                                        <h3 class="panel-title">What's New</h3>
                                    <?php endif; ?>
                                </div>
                                <div class="panel-body" style="overflow: auto; height: 250px;">
                                    <div class="col-md-6 col-md-offset-4">
                                        <ul style="margin-left: 20px; font-size: 15px;">

                                            <?php
                                                $args = array(
                                                    'posts_per_page'=>100,
                                                    'category_name'  => 'newsfeed',
                                                );
                                                $arr = get_posts( $args );

                                                foreach ( $arr as $key => $value ) {
                                                    echo "<li><b>" . $arr[ $key ]->post_title. "</b> - <a class=\"hover-blue\" href=\"" . site_url() . get_field( "news_link", $arr[ $key ]->ID ) ."\">" . $arr[ $key ]->post_content . "</a></li>";
                                                }
                                            ?>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="home_text">
                                <div class="download-btn">
                                <!--[> BUTTON <]-->
                                <a class="tuor btn wow fadeInRight arrow-down-custom" href="#ABOUT"><i class="arrow-down-custom fa fa-angle-down"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
		<!-- END HEADER SECTION -->


		<!-- =========================
				 START ABOUT US SECTION
		============================== -->
    <section class="about page about-override" id="ABOUT">
        <div class="inner_about_area">
          <div class="container">
              <div class="row">
                  <div class="col-md-6 wow fadeInLeftBig">
                            <!-- MISSION & VISION LEFT TITLE -->
                      <div class="video_title">
                          <?php if($_SESSION['lang'] == "en") :?>
                            <?php the_field('mission', false, false); ?>
                          <?php elseif($_SESSION['lang'] == "jp"): ?>
                            <h2>ミッション</h2>
                            <p>
                                OSSテクニカル・ハッブは、開発からシステムの結合まで支援をご提供致します。また、OSSテクニカル・ハッブに蓄積された知識を活用し、プロジェクトに効率的なツールを提供する事により、品質、コストにご貢献致します。

                            </p>

                          <?php else: ?>
                              <?php the_field('mission', false, false); ?>

                          <?php endif; ?>
                      </div>

                      <div class="video_title padding-top-20">
                          <?php if($_SESSION['lang'] == "en"): ?>
                            <?php the_field('vision', false, false); ?>
                          <?php elseif($_SESSION['lang'] == "jp"):?>
                            <h2>ビジョン</h2>
                            <p>
                                OSSテクニカル・ハッブは、OSSソリューションを促進し、新しい市場動向を提案する頼りになるOSS専門家の組織であることを目指しています。
                            </p>

                          <?php else: ?>
                              <?php the_field('vision', false, false); ?>

                          <?php endif; ?>
                      </div>
                  </div>
                  <div class="col-md-6 wow fadeInRightBig padding-top-70">
                       <!-- PPT -->
                       <div id="carousel-mission-vission" class="carousel slide" data-ride="carousel" data-interval="false">

                           <!-- Wrapper for slides -->
													 <?php $i=0; ?>
                           <div class="carousel-inner no-border-img">
                                        <?php if( have_rows('presentation') ): ?>
                                                 <?php while( have_rows('presentation') ): the_row(); ?>
                                                 <div class="item <?php echo $i==0 ? 'active' : ''; ?>">
                                                     <?php $arr = array(); $arr = get_sub_field('image'); ?>
                                                     <div class="col-md-12 text-center" onclick="viewImage('<?php echo $arr['url'];?>')">
                                                             <!-- IMAGE -->
                                                             <img src="<?php echo $arr['url'];?>" alt="" width="320"  height="320">
                                                     </div>
                                                 </div>
                                                 <?php $i++; ?>
                                            <?php endwhile; ?>
                                        <?php endif; ?>
                           </div>

                           <!-- Left and right controls -->
                          <a class="left carousel-control" href="#carousel-mission-vission" data-slide="prev">
                            <span class="fa fa-arrow-left carousel-control-buttons" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                          </a>
                          <a class="right carousel-control" href="#carousel-mission-vission" data-slide="next">
                            <span class="fa fa-arrow-right carousel-control-buttons" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                          </a>
                       </div>
                  </div>
              </div>
          </div>
        </div>

        <div class="video_area">
            <?php if($_SESSION['lang'] == "en"): ?>
            <div class="container">
                <div class="section_title section-title-custom">
                    <h2>MENU</h2>
                </div>
                <?php the_field('menu', false, false); ?>
            </div>
            <?php elseif($_SESSION['lang'] == "jp"): ?>
                <div class="container">
                    <div class="section_title section-title-custom">
                        <h2>メニュー</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-12 wow fadeInLeftBig">
                            <div class="col-md-4 text-center"><!-- BUTTON --><br />
                                <a class="width-250 btn btn-primary btn-video" title="Ask questions here." href="http://www.ntsp.nec.co.jp/oss-tc/portal/question-answer/?lang=jp" data-toggle="tooltip" data-placement="top">お問い合わせ</a></div>
                            <div class="col-md-4 text-center"><!-- BUTTON --><br />
                                <a class="width-250 btn btn-primary btn-video" title="Watch progress." href="http://www.ntsp.nec.co.jp/oss-tc/redmine/" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="top">進捗確認</a></div>
                            <div class="col-md-4 text-center"><!-- BUTTON --><br />
                                <a class="width-250 btn btn-primary btn-video" title="Frequently Asked Questions" href="http://www.ntsp.nec.co.jp/oss-tc/portal/faq/?lang=jp" data-toggle="tooltip" data-placement="top">よくある質問</a></div>
                        </div>
                    </div>
                    <div class="row margin-top-10">
                        <div class="col-md-12 wow fadeInLeftBig">
                            <div class="col-md-4 text-center"><!-- BUTTON --><br />
                                <a class="width-250 btn btn-primary btn-video" title="Services offered" href="http://www.ntsp.nec.co.jp/oss-tc/portal/service/?lang=jp" data-toggle="tooltip" data-placement="left">サポートメニュー</a></div>
                            <div class="col-md-4 text-center"><!-- BUTTON --><br />
                                <a class="width-250 btn btn-primary btn-video" title="OSS Wiki" href="http://www.ntsp.nec.co.jp/oss-tc/portal/knowledge/?lang=jp" data-toggle="tooltip" data-placement="left">知識</a></div>
                            <div class="col-md-4 text-center"><!-- BUTTON --><br />
                                <a class="width-250 btn btn-primary btn-video" title="Know more about Tools used" href="http://www.ntsp.nec.co.jp/oss-tc/portal/tool/?lang=jp" data-toggle="tooltip" data-placement="left">ツール</a></div>
                        </div>
                    </div>
                    <div class="row margin-top-10">
                        <div class="col-md-12 wow fadeInLeftBig">
                            <div class="col-md-4 text-center"><!-- BUTTON --><br />
                                <a class="width-250 btn btn-primary btn-video" title="Updates? Patches? Look inside" href="http://www.ntsp.nec.co.jp/oss-tc/portal/bug-patches/?lang=jp" data-toggle="tooltip" data-placement="bottom">バグパッチ</a></div>
                            <div class="col-md-4 text-center"><!-- BUTTON --><br />
                                <a class="width-250 btn btn-primary btn-video" title="OSS Process" href="http://www.ntsp.nec.co.jp/oss-tc/portal/our-process/?lang=jp" data-toggle="tooltip" data-placement="bottom">私たちのプロセス</a></div>
                        </div>
                    </div>

                </div>


            <?php else: ?>
                <div class="container">
                    <div class="section_title section-title-custom">
                        <h2>MENU</h2>
                    </div>
                    <?php the_field('menu', false, false); ?>
                </div>

            <?php endif; ?>
        </div>
    </section>
    <!-- End About Us -->

	<?php endwhile; endif; ?>

	<!-- Modal -->
	<div class="modal fade" id="mission-vision-image-viewer" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header" style="border-bottom:0;">
					<button type="button" class="close" style="margin-top:-12px !important" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<img id="img-src" width="100%">
			</div>
		</div>
	</div>
	<!-- End Modal -->




<?php get_footer(); ?>
