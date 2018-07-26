	<!-- FOOTER -->
	<section class="copyright footer">
		<h2></h2>
		<div class="container">
				<div class="row">
						<div class="col-md-6">
                                <?php if($_SESSION['lang'] == "en"): ?>
								<div class="copy_right_text" style="margin-top:-20px;">
                                    <?php
                                    $date = date('Y-m-d');
                                    //query the mark_date which is today
                                    $getDate = $wpdb->get_results('SELECT * FROM page_views WHERE mark_date="'.$date.'"');

                                    ?>
                                    <p style="font-size:15px; color:#FFFFFF;">Views: <?php echo count($getDate)."-people have visited this website today."?></p>
                                    <!-- COPYRIGHT TEXT -->
									<p style="color:#FFFFFF;">Network OSS Technical Hub<br>Copyright &copy; <?php echo date('Y'); ?>. All Rights Reserved.</p>

									<?php //echo do_shortcode('[google-translator]'); ?>

                                </div>
                                <?php elseif($_SESSION['lang'] == "jp"): ?>
                                    <div class="copy_right_text" style="margin-top:-20px;">
                                        <?php
                                        $date = date('Y-m-d');
                                        //query the mark_date which is today
                                        $getDate = $wpdb->get_results('SELECT * FROM page_views WHERE mark_date="'.$date.'"');

                                        ?>
                                        <p style="font-size:15px; color:#FFFFFF;">今日、 <?php echo count($getDate)."人がこのページを閲覧しました。"?></p>
                                        <!-- COPYRIGHT TEXT -->
                                        <p style="color:#FFFFFF;">ネットワークＯＳＳテクニカルハブ<br>Copyright &copy; <?php echo date('Y'); ?>. All Rights Reserved.</p>

                                        <?php //echo do_shortcode('[google-translator]'); ?>

                                    </div>

                                <?php else: ?>
                                    <div class="copy_right_text" style="margin-top:-20px;">
                                        <?php
                                        $date = date('Y-m-d');
                                        //query the mark_date which is today
                                        $getDate = $wpdb->get_results('SELECT * FROM page_views WHERE mark_date="'.$date.'"');

                                        ?>
                                        <p style="font-size:15px; color:#FFFFFF;">Views: <?php echo count($getDate)."-people have visited this website today."?></p>
                                        <!-- COPYRIGHT TEXT -->
                                        <p style="color:#FFFFFF;">Network OSS Technical Hub<br>Copyright &copy; <?php echo date('Y'); ?>. All Rights Reserved.</p>

                                        <?php //echo do_shortcode('[google-translator]'); ?>

                                    </div>


                                <?php endif; ?>


						</div>

						<div class="col-md-6">
								<div class="scroll_top">
										<a href="#HOME"><i class="fa fa-angle-up"></i></a>
								</div>
						</div>
				</div>
		</div>
  </section>
	<!-- END FOOTER -->

	<?php // wp_footer(); ?>

</body>
</html>
