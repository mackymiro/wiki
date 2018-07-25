<?php
$registeredImageSizes = array();
$registeredImageSizes[0] = 'thumbnail';
$registeredImageSizes[1] = 'medium';
$registeredImageSizes[2] = 'large';
$registeredImageSizes[3] = 'full';
 
global $_wp_additional_image_sizes;
if (isset($_wp_additional_image_sizes)) {
	foreach($_wp_additional_image_sizes as $key => $addImageSize) {
		$registeredImageSizes[count($registeredImageSizes)] = $key;
	}
}
?>
<div class="wrap rsec-settings">
	<?php if ( $this->updated_message ) : ?>
	<div id="message" class="updated fade"><p><?php echo $this->updated_message; ?></p></div>
	<?php endif; ?>
  <h2>Super Zoom Gallery Settings</h2>
  <form id="superzoomgallery-settings-form" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
    <?php wp_nonce_field('superzoomgallery_settings'); ?>
    <table class="widefat">
      <thead>
        <tr>
          <th scope="col" style="width: 40%;">Image Settings</th><th></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><label for="superzoomgallery_thumb">Thumbnail image to use</label></td>
          <td><select name="superzoomgallery_thumb" id="superzoomgallery_thumb">
            <option value=""> -- SELECT -- </option>
            <?php $current = get_option('superzoomgallery_thumb', 'thumbnail'); ?>
            <?php $settings_link = ''; ?>
            <?php foreach ( $registeredImageSizes as $size ) : ?>
              <?php $selected = ''; ?>
              <?php if ( $size == $current ) {
                $selected = ' selected="selected"';
              } ?>
              <option value="<?php echo $size; ?>"<?php echo $size==$current?' selected="selected"':''; ?>><?php echo $size; ?></option>
            <?php endforeach; ?>
          </select></td>
        </tr>
		<tr>
          <td><label for="superzoomgallery_medium">Medium sized image to use</label></td>
          <td><select name="superzoomgallery_medium" id="superzoomgallery_medium">
            <option value=""> -- SELECT -- </option>
            <?php $current = get_option('superzoomgallery_medium', 'medium'); ?>
            <?php $settings_link = ''; ?>
            <?php foreach ( $registeredImageSizes as $size ) : ?>
              <?php $selected = ''; ?>
              <?php if ( $size == $current ) {
                $selected = ' selected="selected"';
              } ?>
              <option value="<?php echo $size; ?>"<?php echo $size==$current?' selected="selected"':''; ?>><?php echo $size; ?></option>
            <?php endforeach; ?>
          </select></td>
        </tr>
        <tr>
          <td><label for="superzoomgallery_full">Image to use for zooming (full size)</label></td>
          <td><select name="superzoomgallery_full" id="superzoomgallery_full">
            <option value=""> -- SELECT -- </option>
            <?php $current = get_option('superzoomgallery_full', 'full'); ?>
            <?php $settings_link = ''; ?>
            <?php foreach ( $registeredImageSizes as $size ) : ?>
              <?php $selected = ''; ?>
              <?php if ( $size == $current ) {
                $selected = ' selected="selected"';
              } ?>
              <option value="<?php echo $size; ?>"<?php echo $size==$current?' selected="selected"':''; ?>><?php echo $size; ?></option>
            <?php endforeach; ?>
          </select></td>
        </tr>
		<tr>
          <td><label for="superzoomgallery_showcaptions">Show captions on the images (if they are specified).</label></td>
          <?php
           $superzoomgallery_showcaptions = get_option('superzoomgallery_showcaptions', '') == 'enabled' ? ' checked="checked"':'';
           ?>
          <td><input type="checkbox" value="enabled"<?php echo $superzoomgallery_showcaptions; ?> name="superzoomgallery_showcaptions" id="superzoomgallery_showcaptions" /></td>
        </tr>
			<tr>
	          <td><label for="superzoomgallery_captionfield">Field to use as a caption</label></td>
			<?php $current = get_option('superzoomgallery_captionfield', 'title'); ?>
	          <td><select name="superzoomgallery_captionfield" id="superzoomgallery_captionfield">
	            <option value="title"<?php echo 'title'==$current ? ' selected="selected"':''; ?>>Title</option>
				<option value="caption"<?php echo 'caption'==$current ? ' selected="selected"':''; ?>>Caption</option>
	          </select></td>
	        </tr>
      </tbody>
    </table>
    <div style="height:20px;"></div>
    <table class="widefat">
      <thead>
        <tr>
          <th scope="col" style="width: 40%;">Gallery Settings</th><th></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><label for="superzoomgallery_overwrite_gallery">Use as default gallery</label></td>
          <?php
           $superzoomgallery_overwrite_gallery = get_option('superzoomgallery_overwrite_gallery', '') == 'enabled' ? ' checked="checked"':'';
           ?>
          <td><input type="checkbox" value="enabled"<?php echo $superzoomgallery_overwrite_gallery; ?> name="superzoomgallery_overwrite_gallery" id="superzoomgallery_overwrite_gallery" /></td>
        </tr>
         <tr>
          <td><label for="superzoomgallery_overwrite_gallery">Use inner zoom</label></td>
          <?php
           $superzoomgallery_innerzoom = get_option('superzoomgallery_innerzoom', '') == 'enabled' ? ' checked="checked"':'';
           ?>
          <td><input type="checkbox" value="enabled"<?php echo $superzoomgallery_innerzoom; ?> name="superzoomgallery_innerzoom" id="superzoomgallery_innerzoom" /></td>
        </tr>
      </tbody>
    </table>
    <div class="save-settings-form" style="margin-top: 1em;">
      <input class="button button-highlighted" type="submit" value="Save" />
    </div>
  </form>
</div>

<?php

function current_season() {
       // Locate the icons
       $icons = array(
               "spring" => "images/spring.png",
               "summer" => "images/summer.png",
               "autumn" => "images/autumn.png",
               "winter" => "images/winter.png"
       );

       // What is today's date - number
       $day = date("z");

       //  Days of spring
       $spring_starts = date("z", strtotime("March 21"));
       $spring_ends   = date("z", strtotime("June 20"));

       //  Days of summer
       $summer_starts = date("z", strtotime("June 21"));
       $summer_ends   = date("z", strtotime("September 22"));

       //  Days of autumn
       $autumn_starts = date("z", strtotime("September 23"));
       $autumn_ends   = date("z", strtotime("December 20"));

       //  If $day is between the days of spring, summer, autumn, and winter
       if( $day >= $spring_starts && $day <= $spring_ends ) :
               $season = "spring";
       elseif( $day >= $summer_starts && $day <= $summer_ends ) :
               $season = "summer";
       elseif( $day >= $autumn_starts && $day <= $autumn_ends ) :
               $season = "autumn";
       else :
               $season = "winter";
       endif;

       return $season;
}

?>