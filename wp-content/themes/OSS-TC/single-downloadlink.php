<?php get_header(); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<!-- =========================
        START DOWNLOAD LINK SECTION
		============================== -->
		
			<?php if(have_rows('tabs_downloadlink_contents')):?>
										
				   <?php $i=0; ?>
				   
				   <?php while(have_rows('tabs_downloadlink_contents')): the_row(); ?>

				   <br>

						<p><?php the_sub_field('file_name_en', false, false); $i++; ?></p>
						<p><?php the_sub_field('download_link_in_en_version', false, false); $i++; ?></p>
					<?php endwhile; ?>
				
				<?php endif; ?>

	<?php endwhile; endif; ?>
<?php get_footer();?>