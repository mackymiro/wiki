<?php
	/**
	*Template Name: download
	*
	*/

?>

<?php get_header(); ?>


    <style>
  
		@import url(https://fonts.googleapis.com/css?family=Lato:400,700);

* { 
  -webkit-box-sizing:border-box;
  -moz-box-sizing:border-box;
  -o-box-sizing:border-box;
  box-sizing:border-box;
}

html, body {
  background:#FFFFFF;
}

.acc-container {
  width:90%;
  margin:30px auto 0 auto;
  -webkit-border-radius:8px;
  -moz-border-radius:8px;
  -o-border-radius:8px;
  border-radius:8px;
  overflow:hidden;
}

.acc-btn { 
  width:100%;
  margin:0 auto;
  padding:20px 25px;
  cursor:pointer;
  background:#34495E;
  border-bottom:1px solid #2C3E50;
}

.acc-content {
  height:0px;
  width:100%;
  margin:0 auto;
  overflow:hidden;
  background:#FFFFFF;
}

.acc-content-inner {
  padding:30px;
}

.open {
  height: auto;
}

h1 {
  font:700 20px/26px 'Lato', sans-serif;
  color:#ffffff;
}

p { 
  font:400 16px/24px 'Lato', sans-serif;
  color:#798795;
}

.selected {
  color:#FFFFFF;
}
	

		
		
    </style>
	<script type="text/javascript">
		$(document).ready(function(){
  var animTime = 300,
      clickPolice = false;
  
  $(document).on('touchstart click', '.acc-btn', function(){
    if(!clickPolice){
       clickPolice = true;
      
      var currIndex = $(this).index('.acc-btn'),
          targetHeight = $('.acc-content-inner').eq(currIndex).outerHeight();
   
      $('.acc-btn h1').removeClass('selected');
      $(this).find('h1').addClass('selected');
      
      $('.acc-content').stop().animate({ height: 0 }, animTime);
      $('.acc-content').eq(currIndex).stop().animate({ height: targetHeight }, animTime);

      setTimeout(function(){ clickPolice = false; }, animTime);
    }
    
  });
  
});
	
	
	</script>
	

	 <!-- =========================
        START OUR DOWNLOAD SECTION
    ============================== -->
      <section class="about page knowledge" id="ABOUT">
        <div class="inner_about_area our-process-area">
          <div class="container-fluid padding-lr-150">
            <div class="row">
              <div class="col-md-12 wow fadeInLeftBig">
                <div class="section_title section-title-custom">
					<h2><?php the_title(); ?></h2>
							
                </div>
              </div>
            </div>
            <br>

                <div class="container">
				

              
				<div class="acc-container">
					 <?php

                            query_posts( array(
                                'category_name'  => 'tab-link',
                                'order' => 'ASC'
                            ) );

                        ?>
					<?php while(have_posts()) : the_post(); ?>
						
					<div class="acc-btn"><h1 class="selected"><?php the_title(); ?></h1></div>
					<div class="acc-content">
					  <div class="acc-content-inner">
						 <p ><?php the_content(); ?></p>
						 <?php $dlink =  get_post_meta(get_the_ID(), 'my_meta_box_dlink', true); ?>
						 <?php $dlinkName =  get_post_meta(get_the_ID(), 'my_meta_box_dlinkname', true); ?>
						  <p >
							<?php echo $dlinkName; ?>
							   <a href="<?php echo $dlink;?>" target="_blank"> <i class="fa fa-download"></i>Download</a>
						  </p>
						 
						  <?php if(get_the_ID() == "1033"): ?>
                                      
										 <?php $dlink1 =  get_post_meta(get_the_ID(), 'my_meta_box_dlink1', true); ?>
										
                                         <p style="padding:10px;"><a href="<?php echo $dlinkJP;?>" target="_blank"> <i class="fa fa-download"></i>Download (JP)</a></p>
										<?php $dlink1 =  get_post_meta(get_the_ID(), 'my_meta_box_dlink1', true); ?>

                                          <b style="padding:10px;">Installation, Configuration and Initial Startup Procedure</b>
                                          <p style="padding:10px;"><a href="<?php echo $dlink1;?>" target="_blank"> <i class="fa fa-download"></i>Download (EN)</a></p>
                                         <?php $dlink1JP =  get_post_meta(get_the_ID(), 'my_meta_box_dlink1JP', true); ?>

                                        <p style="padding:10px;"><a href="<?php echo $dlink1JP;?>" target="_blank"> <i class="fa fa-download"></i>Download (JP)</a></p>
                                        <?php $dlinkManual =  get_post_meta(get_the_ID(), 'my_meta_box_dlinkManual', true); ?>

                                        <p style="padding:10px;"><a href="<?php echo $dlink1JP;?>" target="_blank"> <i class="fa fa-download"></i>Download Manual (En)</a></p>
                                        <?php $dlinkBasicOperation =  get_post_meta(get_the_ID(), 'my_meta_box_dlinkBasicOperation', true); ?>

                                        <b style="padding:10px;">Basic Operation Commands, Backup and Restore</b>
                                        <p style="padding:10px;"><a href="<?php echo $dlinkBasicOperation;?>" target="_blank"> <i class="fa fa-download"></i>Download (EN)</a></p>

                                        <?php $dlinkBasicOperationJP =  get_post_meta(get_the_ID(), 'my_meta_box_dlinkBasicOperationJP', true); ?>
                                        <p style="padding:10px;"><a href="<?php echo $dlinkBasicOperationJP;?>" target="_blank"> <i class="fa fa-download"></i>Download (JP)</a></p>

                                        <b style="padding:10px;">Version Upgrade and Downgrade</b>
                                        <?php $dlinkVUpgrade =  get_post_meta(get_the_ID(), 'my_meta_box_dlinkVUpgrade', true); ?>
                                        <?php $dlinkVUpgradeJP =  get_post_meta(get_the_ID(), 'my_meta_box_dlinkVUpgradeJP', true); ?>
                                        <p style="padding:10px;"><a href="<?php echo $dlinkVUpgrade;?>" target="_blank"> <i class="fa fa-download"></i>Download (EN)</a></p>
                                        <p style="padding:10px;"><a href="<?php echo $dlinkVUpgradeJP;?>" target="_blank"> <i class="fa fa-download"></i>Download (JP)</a></p>

                                        <b style="padding:10px;">Partitioning</b>
                                        <?php $dlinkPart =  get_post_meta(get_the_ID(), 'my_meta_box_dlinkPart', true); ?>
                                        <?php $dlinkPartJP =  get_post_meta(get_the_ID(), 'my_meta_box_dlinkPartJP', true); ?>
                                        <p style="padding:10px;"><a href="<?php echo $dlinkPart;?>" target="_blank"> <i class="fa fa-download"></i>Download (EN)</a></p>
                                        <p style="padding:10px;"><a href="<?php echo $dlinkPartJP;?>" target="_blank"> <i class="fa fa-download"></i>Download (JP)</a></p>

                                        <b style="padding:10px;">Performance Optimization</b>
                                        <?php $dlinkPerfOp =  get_post_meta(get_the_ID(), 'my_meta_box_dlinkPerfOp', true); ?>
                                        <?php $dlinkPerfOpJP =  get_post_meta(get_the_ID(), 'my_meta_box_dlinkPerfOpJP', true); ?>
                                        <p style="padding:10px;"><a href="<?php echo $dlinkPerfOp;?>" target="_blank"> <i class="fa fa-download"></i>Download (EN)</a></p>
                                        <p style="padding:10px;"><a href="<?php echo $dlinkPerfOpJP;?>" target="_blank"> <i class="fa fa-download"></i>Download (JP)</a></p>

                                        <b style="padding:10px;">Scaling the Cluster</b>
                                        <?php $dlinkScaling =  get_post_meta(get_the_ID(), 'my_meta_box_dlinkScaling', true); ?>
                                        <?php $dlinkScalingJP =  get_post_meta(get_the_ID(), 'my_meta_box_dlinkScalingJP', true); ?>
                                        <p style="padding:10px;"><a href="<?php echo $dlinkScaling;?>" target="_blank"> <i class="fa fa-download"></i>Download (EN)</a></p>
                                        <p style="padding:10px;"><a href="<?php echo $dlinkScalingJP;?>" target="_blank"> <i class="fa fa-download"></i>Download (JP)</a></p>

                                        <b style="padding:10px;">Failure Detection</b>
                                        <?php $dlinkFDetec =  get_post_meta(get_the_ID(), 'my_meta_box_dlinkFDetec', true); ?>
                                        <?php $dlinkFDetecJP =  get_post_meta(get_the_ID(), 'my_meta_box_dlinkFDetecJP', true); ?>
                                        <p style="padding:10px;"><a href="<?php echo $dlinkFDetec;?>" target="_blank"> <i class="fa fa-download"></i>Download (EN)</a></p>
                                        <p style="padding:10px;"><a href="<?php echo $dlinkFDetecJP;?>" target="_blank"> <i class="fa fa-download"></i>Download (JP)</a></p>

                                        <b style="padding:10px;">Failure Recovery</b>
                                        <?php $dlinkFRecovery =  get_post_meta(get_the_ID(), 'my_meta_box_dlinkFRecovery', true); ?>
                                        <?php $dlinkFRecoveryJP =  get_post_meta(get_the_ID(), 'my_meta_box_dlinkFRecoveryJP', true); ?>
                                        <p style="padding:10px;"><a href="<?php echo $dlinkFRecovery;?>" target="_blank"> <i class="fa fa-download"></i>Download (EN)</a></p>
                                        <p style="padding:10px;"><a href="<?php echo $dlinkFRecoveryJP;?>" target="_blank"> <i class="fa fa-download"></i>Download (JP)</a></p>

                                        <b style="padding:10px;">Master-Slave Replication</b>
                                        <?php $dlinkMSlaveReplica =  get_post_meta(get_the_ID(), 'my_meta_box_dlinkMSlaveReplica', true); ?>
                                        <?php $dlinkMSlaveReplicaJP =  get_post_meta(get_the_ID(), 'my_meta_box_dlinkMSlaveReplicaJP', true); ?>
                                        <p style="padding:10px;"><a href="<?php echo $dlinkMSlaveReplica;?>" target="_blank"> <i class="fa fa-download"></i>Download (EN)</a></p>
                                        <p style="padding:10px;"><a href="<?php echo $dlinkMSlaveReplicaJP;?>" target="_blank"> <i class="fa fa-download"></i>Download (JP)</a></p>
                                    <?php endif;?>
						 
					  </div>
					</div>

					<?php endwhile; wp_reset_query(); ?>
					

				
				</div>
				
				
          </div>
		  
        </div>
      </section>
    <!-- End Our Process -->

<?php get_footer(); ?>