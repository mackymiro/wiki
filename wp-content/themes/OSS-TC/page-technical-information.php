<?php get_header(); ?>

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <!-- =========================
        START TECH INFO SECTION
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
            <div class="col-md-12 wow fadeInLeftBig table-responsive">
              <table class="dataTables table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th class="width-50"></th>
                    <th>File Name</th>
                    <th class="width-125">Download Link</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                   $technical_informations = get_posts(array(
                     'numberposts' => -1,
                     'post_type' => 'techInfo',
                     'post_status' => 'publish'
                   ));

									//print_r( $technical_informations );
                 ?>
                 <?php foreach ($technical_informations as $technical_information):

										 $file = get_post_custom( $technical_information->ID );

										 $file = $file[ 'technical_information_contents' ][0];
										 $file = get_post_meta( $file );
										 $path = $file[ '_wp_attached_file' ][0];

										 $exp = explode("/", $path);

                 ?>

                   <tr>
										 <td></td>
										 <td><?php echo $technical_information->post_title; ?></td>
                     <td><a href="<?php echo site_url() . '/wp-content/uploads/' . $path; ?>" target="_blank"><i class="fa fa-download" aria-hidden="true"></i> Download</a></td>
                   </tr>
                 <?php endforeach; ?>

                </tbody>
              </table>
            </div>



						<!-- Form for technical info -->
						<div class="row">
							<div class="section_title section-title-custom">
								<h2>Subscribe to our mail magazine</h2>
							</div>
						<form role="form" id="techinfo_form">
							<div class="row">
								<div class="col-md-12" style="padding: 20px 20px 20px 20px!important;">
									<div class="hide techinfo-success"></div>
									<div class="hide techinfo-error" style="color: red; text-align: center"></div>
                                    <div class="loading" style="display:none; text-align: center">
                                        <img  alt="" src="../wp-content/themes/OSS-TC/assets/images/loading-lodi.gif" />
                                    </div>
                                    <div class="hide text alert alert-success"><p>Thank you for subscribing in our mail magazine!</p></div>
									<div class="form-group col-md-6 padding-l-0">
										<label>Name</label>
										<input type="text" required class="form-control techinfoFields" name="techinfo_name" id="techinfo_name" placeholder="Type your Name" style="height: 45px;">
									</div>

									<div class="form-group col-md-6 padding-r-0">
										<label>Email</label>
										<input type="text" required class="form-control techinfoFields" name="techinfo_email" id="techinfo_email" placeholder="Email" style="height: 45px;">
									</div>

									<div class="form-group col-md-12 padding-l-0" style="text-align: left">
										<button type="button" class="pull-right btn btn-primary" id="techinfo_submit">Subscribe</button>
									</div>
									</div>
								</div>
							</div>
						</form>
						 <?php echo smlsubform(); ?>
						<br/>
						<br/>
						<br/>
						<br/>
						<!-- End form for technical info -->
          </div>
        </div>
      </div>
    </section>
    <!-- End Tech info-->

  <?php endwhile; endif; ?>

<?php get_footer(); ?>
