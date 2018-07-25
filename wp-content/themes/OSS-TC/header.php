<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.11/css/all.css" integrity="sha384-p2jx59pefphTFIpeqCcISO9MdVfIm4pNnsL08A6v5vaQc4owkQqxMV8kg4Yvhaw/" crossorigin="anonymous">
    <title><?php wp_title(); ?> | <?php bloginfo( 'name' ); ?></title>
		<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<!-- =========================
			PRELOADER
	============================== -->
	<!--<div class="spn_hol">
		<div class="spinner">
			<div class="bounce1"></div>
			<div class="bounce2"></div>
			<div class="bounce3"></div>
		</div>
	</div>-->
	<!-- END PRELOADER -->
    <?php
        session_start();
        if(isset($_GET['lang'])){
            $_SESSION['lang'] = $_GET['lang'];
        }


    ?>


	<section class="header parallax home-parallax page" id="HOME">
		<div class="section_overlay">
			<!-- =========================
					NAV MENU
			============================== -->
				<nav id="original" class="navbar navbar-default navbar-fixed-top" role="navigation">
					<div class="container-fluid">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>

                            <?php if($_SESSION['lang'] == "jp"): ?>
                            <a class="navbar-brand" href="<?php echo site_url(); ?>/?lang=jp">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="Logo">
                            </a>
                            <?php else: ?>
                                <a class="navbar-brand" href="<?php echo site_url(); ?>">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="Logo">
                                </a>


                            <?php endif; ?>

						</div>
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav navbar-left">
								<!-- NAV -->
                                <?php if($_SESSION['lang'] == "en"): ?>
                                    <?php wp_nav_menu( array(
                                                    'menu' => 'Main Menu',
                                                    'menu_class' => 'nav navbar-nav navbar-right',
                                                    'container' => 'ul'));
                                    ?>
                                <?php elseif($_SESSION['lang'] == "jp"): ?>
                                <ul id="menu-menu-1" class="nav navbar-nav navbar-right"><li id="menu-item-85" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-82 current_page_item menu-item-85"><a href="http://www.ntsp.nec.co.jp/oss-tc/portal/question-answer/?lang=jp">お問い合わせ</a></li>
                                    <li id="menu-item-104" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-104"><a target="_blank" href="http://www.ntsp.nec.co.jp/oss-tc/redmine/">進捗</a></li>
                                    <li id="menu-item-91" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-91"><a href="http://www.ntsp.nec.co.jp/oss-tc/portal/faq/?lang=jp">よくある質問</a></li>
                                    <li id="menu-item-94" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-94"><a href="http://www.ntsp.nec.co.jp/oss-tc/portal/knowledge/?lang=jp">知識</a></li>
                                    <li id="menu-item-97" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-97"><a href="http://www.ntsp.nec.co.jp/oss-tc/portal/tool/?lang=jp">ツール</a></li>
                                    <li id="menu-item-100" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-100"><a href="http://www.ntsp.nec.co.jp/oss-tc/portal/bug-patches/?lang=jp">バグパッチ</a></li>
                                    <li id="menu-item-103" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-103"><a href="http://www.ntsp.nec.co.jp/oss-tc/portal/our-process/?lang=jp">私たちのプロセス</a></li>
                                    <li id="menu-item-450" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-450"><a href="http://www.ntsp.nec.co.jp/oss-tc/portal/service/?lang=jp">サポートメニュー</a></li>

                                </ul>


                                <?php else: ?>
                                    <?php wp_nav_menu( array(
                                        'menu' => 'Main Menu',
                                        'menu_class' => 'nav navbar-nav navbar-right',
                                        'container' => 'ul'));
                                    ?>


                                <?php endif; ?>
							</ul>
                            <?php if($_SESSION['lang'] == "en"): ?>
                                <div class="nav navbar-nav" style="padding:10px;">
                                    <a href="http://www.ntsp.nec.co.jp/oss-tc/portal/download-link/" class="btn btn-success">Download Link</a>
                                </div>
                            <?php elseif($_SESSION['lang'] == "jp"): ?>
                                <div class="nav navbar-nav" style="padding:10px;">
                                    <a href="http://www.ntsp.nec.co.jp/oss-tc/portal/download-link/?lang=jp" class="btn btn-success">ダウンロードリンク</a>
                                </div>

                            <?php else: ?>
                                <div class="nav navbar-nav" style="padding:10px;">
                                    <a href="http://www.ntsp.nec.co.jp/oss-tc/portal/download-link/" class="btn btn-success">Download Link</a>
                                </div>

                            <?php endif; ?>

                            <?php  $slug = basename(get_permalink()); ?>

                            <?php if($slug == "portal"): ?>
                            <div class="nav navbar-nav" style="padding:10px;">
                                <p>Translate in:  <a href="<?php echo site_url(); ?>?lang=en">English<img alt="" src="http://192.168.6.110/oss-tc/portal/wp-content/themes/OSS-TC/assets/images/usflag.jpg" width="20px;" height="20px;" style="padding-left:1px;" /></a> | <a href="<?php echo site_url(); ?>?lang=jp">Japanese<img alt="" src="http://192.168.6.110/oss-tc/portal/wp-content/themes/OSS-TC/assets/images/japan_1289.jpg" width="30px;" height="30px;" /></a></p>

                            </div>
                            <?php elseif($slug == "question-answer"): ?>
                                <div class="nav navbar-nav" style="padding:10px;">
                                    <p>Translate in:  <a href="<?php echo site_url(); ?>question-answer/?lang=en">English<img alt="" src="http://192.168.6.110/oss-tc/portal/wp-content/themes/OSS-TC/assets/images/usflag.jpg" width="20px;" height="20px;" style="padding-left:1px;" /></a> | <a href="<?php echo site_url(); ?>question-answer/?lang=jp">Japanese<img alt="" src="http://192.168.6.110/oss-tc/portal/wp-content/themes/OSS-TC/assets/images/japan_1289.jpg" width="30px;" height="30px;"  /></a></p>

                                </div>
                            <?php endif;?>


							<ul class="nav navbar-nav navbar-right">
								<li><img class="navbar-brand" src="<?php echo get_template_directory_uri(); ?>/assets/images/NEC-logo.png" alt="Logo"></li>
							</ul>
						</div>
						<!-- /.navbar-collapse -->
					</div>
					<!-- /.container- -->
				</nav>
				<!-- END NAV MENU -->
			</div>
		</section>




