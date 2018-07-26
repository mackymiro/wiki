<?php
/**
 * Created by PhpStorm.
 * User: miro.mm
 * Date: 2/19/2018
 * Time: 1:41 PM
 */
?>

<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <!-- =========================
               START LICENSE PAGE SECTION
           ============================== -->
    <section class="about page knowledge" id="ABOUT">
        <div class="container-fluid" style="width: 85%;">
            <div class="row">
                <div class="col-md-12 wow fadeInLeftBig">
                    <div class="section_title section-title-custom">
                        <h2><?php echo the_title(); ?></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 wow fadeInLeftBig">
                    <div class="col-md-12 col-xs-12">
                        <?php the_field('license_content', false, false); ?>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <div class="row">
                <div class="col-md-12 col-xs-12 padding-bt-20">
                    <a href="<?php echo site_url() . get_field('back_button'); ?>" class="pull-right"><span class="fa fa-arrow-circle-left" aria-hidden="true"></span> Back To List</a>
                </div>
            </div>
            <!-- End Back Button -->

        </div>
    </section>

<?php endwhile; endif; ?>
<?php get_footer(); ?>
