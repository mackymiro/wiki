<?php
/*
Plugin Name: Super Zoom Gallery
Plugin URI: http://blog.leitmotif.nl/super-zoom-gallery/
Description: Gallery plugin with thumbnail and zoom capabilities, great for showing details of photos. Easy to use. Great for webshops!
Version: 0.5.13
Author: Niels Doorn
Author URI: http://blog.leitmotif.nl
License: GPL2
*/

/*  Copyright 2014  Niels Doorn  (email : szg@leitmotif.nl)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

global $superZoomGallery;
$superZoomGallery = new SuperZoomGallery();
register_activation_hook( __FILE__, array(&$superZoomGallery,'activate' ));
register_deactivation_hook( __FILE__, array(&$superZoomGallery,'deactivate' ));
add_filter('plugin_action_links', array(&$superZoomGallery, 'add_settings_link'), 10, 2 );


class SuperZoomGallery {
  
  public $updated_message = '';
  
  function __construct() {
    add_shortcode('superzoomgallery', array(&$this, 'generate_gallery'));
    if (get_option('superzoomgallery_overwrite_gallery') == 'enabled') {
      add_shortcode('gallery', array(&$this, 'generate_gallery'));
    }
    
    wp_enqueue_script('jquery');
    wp_register_script('superzoomgalleryscript', WP_PLUGIN_URL . '/super-zoom-gallery/szg-script.js', array('jquery'), null, true);
    wp_enqueue_script('superzoomgalleryscript');
    
    wp_register_style('superzoomgallerystylesheet', WP_PLUGIN_URL . '/super-zoom-gallery/szg-style.css');
    wp_enqueue_style('superzoomgallerystylesheet'); 
  
    add_action('admin_menu', array(&$this,'add_admin_menu'), 0);
  }
  
  function activate() {
    delete_option("superzoomgallery_usecss3"); // deprecated
    add_option("superzoomgallery_thumb", 'thumbnail', 'What image to use for the gallery thumbnails', 'yes');
    add_option("superzoomgallery_medium", 'medium', 'What image to use for the gallery medium size image', 'yes');
    add_option("superzoomgallery_full", 'full', 'What image to use for the gallery zoomed in image', 'yes');
    add_option("superzoomgallery_overwrite_gallery", 'disabled', 'Overwrite the default gallery shortcode or not', 'yes');
    add_option("superzoomgallery_showcaptions", 'disabled', 'Show captions on the mediumsize image and the thumbnails or not', 'yes');
    add_option("superzoomgallery_captionfield", 'title', 'What field to use as a caption', 'yes');
    add_option("superzoomgallery_innerzoom", 'disabled', 'Overlay the zoom window on the main window', 'yes');
  }
  
  function deactivate() {
    delete_option("superzoomgallery_thumb");
    delete_option("superzoomgallery_medium");
    delete_option("superzoomgallery_full");
    delete_option("superzoomgallery_overwrite_gallery");
    delete_option("superzoomgallery_showcaptions");
    delete_option("superzoomgallery_captionfield");
    delete_option("superzoomgallery_usecss3"); // deprecated
    delete_option("superzoomgallery_innerzoom");
  }
  
  public function add_admin_menu() {
    add_options_page('Super zoom gallery Options', 'Super zoom gallery', 'manage_options', 'superzoomgallery', array(&$this, 'settings_page'));
  }
    
  public function add_settings_link($links, $file) {
    static $this_plugin;
    if (!$this_plugin) $this_plugin = plugin_basename(__FILE__);
    if ($file == $this_plugin) {
      $settings_link = '<a href="options-general.php?page=superzoomgallery">'.__("Settings", "Super Zoom Gallery").'</a>';
      array_unshift($links, $settings_link);
      $faq_link = '<a href="http://wordpress.org/extend/plugins/super-zoom-gallery/">'.__("Wordpress page", "Super Zoom Gallery").'</a>';
      array_unshift($links, $faq_link);
    }
    return $links;
   }

  
  public function settings_page() {
    $this->save_settings_page();
    include('superzoomgallery-admin-settings.php');
  }
  
   public function save_settings_page() {
      if (isset($_POST['superzoomgallery_thumb'] )) {
        update_option('superzoomgallery_thumb', $_POST['superzoomgallery_thumb']);
        update_option('superzoomgallery_medium', $_POST['superzoomgallery_medium']);
        update_option('superzoomgallery_full', $_POST['superzoomgallery_full']);
        $overwriteDefaultGallery = isset($_POST['superzoomgallery_overwrite_gallery']) ? 'enabled' : 'disabled';
        update_option('superzoomgallery_overwrite_gallery', $overwriteDefaultGallery);
        $showCaptions= isset($_POST['superzoomgallery_showcaptions']) ? 'enabled' : 'disabled';
        update_option('superzoomgallery_showcaptions', $showCaptions);
  
        update_option('superzoomgallery_captionfield', $_POST['superzoomgallery_captionfield']);
  
        $superzoomgallery_innerzoom= isset($_POST['superzoomgallery_innerzoom']) ? 'enabled' : 'disabled';
        update_option('superzoomgallery_innerzoom', $superzoomgallery_innerzoom);
        $this->updated_message = 'Settings saved!';
      }
   }

   
  public function generate_gallery($attr, $the_content = null) {
    global $post;

    $thumbs = '';
    $content = '';
    $use_captions = get_option('superzoomgallery_showcaptions', 'disabled');
    $use_innerzoom = get_option('superzoomgallery_innerzoom', 'disabled');

    // from WP
    if ( ! empty( $attr['ids'] ) ) {
      // 'ids' is explicitly ordered, unless you specify otherwise.
      if ( empty( $attr['orderby'] ) )
        $attr['orderby'] = 'post__in';
      $attr['include'] = $attr['ids'];
    }

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
      $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
      if ( !$attr['orderby'] )
        unset( $attr['orderby'] );
    }

    extract(shortcode_atts(array(
      'order'      => 'DESC', // was ASC
      'orderby'    => 'menu_order ID',
      'id'         => $post->ID,
      'include'    => '',
      'exclude'    => ''
    ), $attr));

    $id = intval($id);
    if ( 'RAND' == $order )
      $orderby = 'none';

    if ( !empty($include) ) {
      $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

      $files = array();
      foreach ( $_attachments as $key => $val ) {
        $files[$val->ID] = $_attachments[$key];
      }
    } elseif ( !empty($exclude) ) {
      $files = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
      $files = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }

    if ( empty($files) ) {
      return '';
    }

    //$files = get_children('post_parent='.$post->ID.'&post_type=attachment&post_mime_type=image&orderby=menu_order');
    //$keys = array_reverse(array_keys($files));
    $keys = array_keys($files);
    $first_big = wp_get_attachment_image_src($keys[0], get_option('superzoomgallery_full', 'full'), false);         $first_medium = wp_get_attachment_image_src($keys[0],  get_option('superzoomgallery_medium', 'medium'), false);
    $first_caption = '';
    $fieldToUse = get_option('superzoomgallery_captionfield', 'title');
    if ('caption' === $fieldToUse) {
      $first_caption = $files[$keys[0]]->post_excerpt;
    } else {
      $first_caption = $files[$keys[0]]->post_title;
    }

    foreach ($keys as $num) {
      $file = $files[$num];
      if ('caption' === $fieldToUse) {
        $caption = $file->post_excerpt;
      } else {
        $caption = $file->post_title;
      }

      $big = wp_get_attachment_image_src($num, get_option('superzoomgallery_full', 'full'), false);  
      $medium = wp_get_attachment_image_src($num,  get_option('superzoomgallery_medium', 'medium'), false);
      $thumb = wp_get_attachment_image_src($num,  get_option('superzoomgallery_thumb', 'thumbnail'), false);
      $thumbs .= '<img src="'.$thumb[0].'" data-medium="'.$medium[0].'" data-large="'.$big[0].'" data-caption="'.$caption.'" />';
    }
    
    $content .= '<div class="szg-superzoomgallery">';
    $content .= ' <div class="szg-main" data-showcaption="'.$use_captions.'" data-caption="'.$first_caption.'">';
    $content .= '     <img class="szg-zoom-photo" />';
    $content .= '     <img class="szg-main-photo" />';
    $content .= '     <div class="szg-caption"></div>';
    $content .= '     <div class="szg-medium-loader">';
    $content .= '       <span></span>';
    $content .= '       <span></span>';
    $content .= '       <span></span>';
    $content .= '       <span></span>';
    $content .= '       <span></span>';
    $content .= '       <span></span>';
    $content .= '       <span></span>';
    $content .= '       <span></span>​';
    $content .= '     </div>';
    $content .= ' </div>';
    $content .= ' <div class="szg-zoom-box" data-innerzoom="'.$use_innerzoom.'">';
    $content .= '     <img class="szg-zoom-photo" src="'.$first_big[0].'" />';
    $content .= ' </div>';
    $content .= ' <div class="szg-thumbs">';
    $content .= $thumbs;
    $content .= ' </div>';
    $content .= '</div>';
    return $content;
  }
}
?>
