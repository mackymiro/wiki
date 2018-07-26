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


	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<!-- =========================
        START DOWNLOAD LINK SECTION
		============================== -->
		 <section class="about page knowledge" id="ABOUT">
         <div class="inner_about_area">
           <div class="container">
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
							
								
								
								<p style="padding:10px;">
								<?php if(get_the_ID() == "1033"): ?>
									<b style="padding:10px;">Mysql Cluster Overview</b>
								<?php endif; ?>
								
								<?php  $id = get_the_ID();?>
								<?php if($id == "1033"):?>
									<a class="dL" id="dl-<?php echo $dlink;?>" onclick="showDownloadFormModal('<?php echo $dlink;?>')" name="MySQL Cluster Overview.pptx"> <i class="fa fa-download"></i>Download</a>
								<?php endif;?>

                                <?php if($id == "1048"): ?>
                                    <a class="dL" id="dl-<?php echo $dlink;?>" onclick="showDownloadFormModal('<?php echo $dlink;?>')" name="Selenium 2"> <i class="fa fa-download"></i>Download</a>
                                <?php endif; ?>

                                <?php if($id == "1037"): ?>
                                    <a class="dL" id="dl-<?php echo $dlink;?>" onclick="showDownloadFormModal('<?php echo $dlink;?>')" name="Zabbix"> <i class="fa fa-download"></i>Download</a>
                                <?php endif; ?>

                                <?php if($id == "1035"): ?>
                                    <a class="dL" id="dl-<?php echo $dlink;?>" onclick="showDownloadFormModal('<?php echo $dlink;?>')" name="Redmine"> <i class="fa fa-download"></i>Download</a>
                                <?php endif; ?>
						 
								<?php if(get_the_ID() == "1033"): ?>
                                      
										 <?php $dlink1 =  get_post_meta(get_the_ID(), 'my_meta_box_dlink1', true); ?>
										<?php $dlinkJP =  get_post_meta(get_the_ID(), 'my_meta_box_dlinkJP', true); ?>
                                        <a class="dL" onclick="showDownloadFormModal('<?php echo $dlinkJP;?>')" name="MySQLクラスターの概要 (日本語版).pptx')"> <i class="fa fa-download"></i>Download (JP)</a></p>
	
										<p style="padding:10px;"><b style="padding:10px;">Installation, Configuration and Initial Startup Procedure</b>
									
										  
										<a class="dL" onclick="showDownloadFormModal('<?php echo $dlink1;?>')" name="Installation, Configuration and Initial Startup Procedure.pptx"> <i class="fa fa-download"></i>Download (EN)</a>
                                         <?php $dlink1JP =  get_post_meta(get_the_ID(), 'my_meta_box_dlink1JP', true); ?>

										<a class="dL" onclick="showDownloadFormModal('<?php echo $dlink1JP;?>')" name="Installation, Configuration and Initial Startup Procedure._jppptx"> <i class="fa fa-download"></i>Download (JP)</a>
                                        <?php $dlinkManual =  get_post_meta(get_the_ID(), 'my_meta_box_dlinkManual', true); ?>

                                        <a class="dL" onclick="showDownloadFormModal('<?php echo $dlinkManual;?>')" name="MySQL Cluster Installtaion Manual.pptx"> <i class="fa fa-download"></i>Download Manual (En)</a></p>
                                        <?php $dlinkBasicOperation =  get_post_meta(get_the_ID(), 'my_meta_box_dlinkBasicOperation', true); ?>

                                        <p style="padding:10px;"><b style="padding:10px;">Basic Operation Commands, Backup and Restore</b>
                                        <a class="dL" onclick="showDownloadFormModal('<?php echo $dlinkBasicOperation;?>')" name="MySQl Cluster Restore.pptx"> <i class="fa fa-download"></i>Download (EN)</a>

                                        <?php $dlinkBasicOperationJP =  get_post_meta(get_the_ID(), 'my_meta_box_dlinkBasicOperationJP', true); ?>
                                        <a class="dL" onclick="showDownloadFormModal('<?php echo $dlinkBasicOperationJP;?>')" name="MySQl Cluster Restore._jpptx"> <i class="fa fa-download"></i>Download (JP)</a></p>

                                        <p style="padding:10px;"><b style="padding:10px;">Version Upgrade and Downgrade</b>
                                        <?php $dlinkVUpgrade =  get_post_meta(get_the_ID(), 'my_meta_box_dlinkVUpgrade', true); ?>
                                        <?php $dlinkVUpgradeJP =  get_post_meta(get_the_ID(), 'my_meta_box_dlinkVUpgradeJP', true); ?>
                                        <a class="dL" onclick="showDownloadFormModal('<?php echo $dlinkVUpgrade;?>')" name="MySQL Cluster report upgrade and downgrade.pptx"> <i class="fa fa-download"></i>Download (EN)</a>
                                        <a class="dL" onclick="showDownloadFormModal('<?php echo $dlinkVUpgradeJP;?>')" name="MySQl Cluster report upgrade and downgrade._jpptx"> <i class="fa fa-download"></i>Download (JP)</a></p>

                                        <p style="padding:10px;"><b style="padding:10px;">Partitioning</b>
                                        <?php $dlinkPart =  get_post_meta(get_the_ID(), 'my_meta_box_dlinkPart', true); ?>
                                        <?php $dlinkPartJP =  get_post_meta(get_the_ID(), 'my_meta_box_dlinkPartJP', true); ?>
                                        <a class="dL" onclick="showDownloadFormModal('<?php echo $dlinkPart;?>')" name="MySQL Cluster report partioning.pptx"> <i class="fa fa-download"></i>Download (EN)</a>
                                        <a class="dL" onclick="showDownloadFormModal('<?php echo $dlinkPartJP;?>')" name="MySQL Cluster report partitioning._jpptx"> <i class="fa fa-download"></i>Download (JP)</a></p>

                                         <p style="padding:10px;"><b style="padding:10px;">Performance Optimization</b>
                                        <?php $dlinkPerfOp =  get_post_meta(get_the_ID(), 'my_meta_box_dlinkPerfOp', true); ?>
                                        <?php $dlinkPerfOpJP =  get_post_meta(get_the_ID(), 'my_meta_box_dlinkPerfOpJP', true); ?>
                                        <a class="dL" onclick="showDownloadFormModal('<?php echo $dlinkPerfOp;?>')" name="MySQL Cluster performance optimization.pptx " > <i class="fa fa-download"></i>Download (EN)</a>
                                        <a class="dL" onclick="showDownloadFormModal('<?php echo $dlinkPerfOpJP;?>')" name="MySQL Cluster performance optimization._jpptx"> <i class="fa fa-download"></i>Download (JP)</a></p>

                                        <p style="padding:10px;"><b style="padding:10px;">Scaling the Cluster</b>
                                        <?php $dlinkScaling =  get_post_meta(get_the_ID(), 'my_meta_box_dlinkScaling', true); ?>
                                        <?php $dlinkScalingJP =  get_post_meta(get_the_ID(), 'my_meta_box_dlinkScalingJP', true); ?>
                                        <a class="dL" onclick="showDownloadFormModal('<?php echo $dlinkScaling;?>')" name="MySQL Cluster scaling cluster.pptx"> <i class="fa fa-download"></i>Download (EN)</a>
                                        <a class="dL" onclick="showDownloadFormModal('<?php echo $dlinkScalingJP;?>')" name="MySQL Cluster scaling cluster._jppptx"> <i class="fa fa-download"></i>Download (JP)</a></p>

                                        <p style="padding:10px;"><b style="padding:10px;">Failure Detection</b>
                                        <?php $dlinkFDetec =  get_post_meta(get_the_ID(), 'my_meta_box_dlinkFDetec', true); ?>
                                        <?php $dlinkFDetecJP =  get_post_meta(get_the_ID(), 'my_meta_box_dlinkFDetecJP', true); ?>
                                        <a class="dL" onclick="showDownloadFormModal('<?php echo $dlinkFDetec;?>')" name="MySQL Cluster failure detection.pptx"> <i class="fa fa-download"></i>Download (EN)</a>
                                        <a class="dL" onclick="showDownloadFormModal('<?php echo $dlinkFDetecJP;?>')" name="MySQL Cluster failure detection._jpptx"> <i class="fa fa-download"></i>Download (JP)</a></p>

                                        <p style="padding:10px;"><b style="padding:10px;">Failure Recovery</b>
                                        <?php $dlinkFRecovery =  get_post_meta(get_the_ID(), 'my_meta_box_dlinkFRecovery', true); ?>
                                        <?php $dlinkFRecoveryJP =  get_post_meta(get_the_ID(), 'my_meta_box_dlinkFRecoveryJP', true); ?>
                                        <a class="dL" onclick="showDownloadFormModal('<?php echo $dlinkFRecovery;?>')" name="MySQl Cluster failure recovery.pptx"> <i class="fa fa-download"></i>Download (EN)</a>
                                        <a class="dL" onclick="showDownloadFormModal('<?php echo $dlinkFRecoveryJP;?>')" name="MySQL Cluster failure recovery._jpptx"> <i class="fa fa-download"></i>Download (JP)</a></p>

										<p style="padding:10px;"><b style="padding:10px;">Master-Slave Replication</b>
                                        <?php $dlinkMSlaveReplica =  get_post_meta(get_the_ID(), 'my_meta_box_dlinkMSlaveReplica', true); ?>
                                        <?php $dlinkMSlaveReplicaJP =  get_post_meta(get_the_ID(), 'my_meta_box_dlinkMSlaveReplicaJP', true); ?>
                                        <a class="dL" onclick="showDownloadFormModal('<?php echo $dlinkMSlaveReplica;?>')" name="MySql Cluster NDB replication.pptx"> <i class="fa fa-download"></i>Download (EN)</a>
                                        <a class="dL" onclick="showDownloadFormModal('<?php echo $dlinkMSlaveReplicaJP;?>')" name="MySQL ClusterNDB replication._jpptx"> <i class="fa fa-download"></i>Download (JP)</a></p>
                                    <?php endif;?>
						 
					  </div>
					</div>
					
					<?php endwhile; wp_reset_query(); ?>
					

				
				</div>
				<br>
				<br>
				<div class="modal fade" id="download-modal" tabindex="-1" role="dialog">
				 <div class="modal-dialog" role="document">
				   <div class="modal-content">
					 <div class="modal-header">
					   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					   <h4 class="modal-title">FORM</h4>
					 </div>
					 <div class="modal-body">
						<form id="download_file_form">
							<div class="row">
							<div class="col-md-12">
							<div class="form-group col-md-12 padding-lr-0"><label>Division</label><br />
							<select id="division" class="form-control" name="division"><option value="">–</option><option value="1SD">1SD</option><option value="2SD">2SD</option><option value="3SD">3SD</option><option value="CPD">CPD</option></select></div>
							<div class="form-group margin-top-10 col-md-12 padding-lr-0"><label>Project</label><br />
							<input id="project" class="form-control" name="project" type="text" placeholder="Project" /></div>
							<div class="form-group margin-top-10 col-md-12 padding-lr-0"><label>Name</label><br />
							<input id="name" class="form-control" name="name" type="text" placeholder="Name" /></div>
							<div class="form-group margin-top-10 col-md-12 padding-lr-0"><label>Email</label><br />
							<input id="email" class="form-control" name="email" type="text" placeholder="Email" /></div>
							<div class="form-group margin-top-20 col-md-6 padding-l-0"><button class="btn btn-default submit-btn remove-height confirm-download-btn" type="button">DOWNLOAD FILE</button></div>
							<div class="form-group margin-top-20 col-md-6 padding-r-0"><button class="btn btn-default submit-btn remove-height clear-download-btn" type="button" data-dismiss="modal">CLOSE</button></div>
							</div>
							</div>
						</form>

					 </div>
				   </div><!-- /.modal-content -->
				 </div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
				
			</div>
              
           </div>
         </div>
     </section>
			   
		
		
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
<?php get_footer();?>