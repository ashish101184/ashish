<?php
/*
Plugin Name: Home Banner
Plugin URI: 
Description: Home Banner
Version: 1.1
Author: Rishabh
Author URI: 
License: 
*/
?>
<?php 
/*
* Create home grid Table
*/
global $homebanner_version;
$homebanner_version = "1.1";
/*function homebanner_table_plugin() {
global $wpdb;
global $homebanner_version;
// table for ads
$table_name = $wpdb->prefix . "bannergrid";
 
if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
 
$sql = "CREATE TABLE " . $table_name . "  (
`id` INT NOT NULL AUTO_INCREMENT ,
`grid_title` VARCHAR(20) NULL ,
`main_heading` VARCHAR(20) NULL ,
`sub_heading` VARCHAR(25) NULL ,
`description` VARCHAR(50) NULL ,
`link_window` TINYINT(2) NULL ,
`link_href` VARCHAR(155) NULL ,
`link_text` VARCHAR(20) NULL ,
`box_type` VARCHAR(30) NULL ,
`file_type` TINYINT(2) NULL COMMENT '1=image, 2 = video',
`file_name` VARCHAR(255) NULL ,
`data_row` INT(11) NULL ,
`data_col` INT(11) NULL ,
PRIMARY KEY (`id`) )
CHARACTER SET utf8 COLLATE utf8_general_ci;";
 
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
dbDelta($sql);
 
add_option("homebanner_db_version", $homebanner_version);
 
}
}*/

function homebanner_admin() {     
    include('homebanner_admin.php');  
} 
function homebanner_list_admin() {     
    include('homebanner_list_admin.php');  
} 
function homebanner_admin_actions() {        
    $admin_page = add_menu_page("homebanner", "Home Banner", 1, "homebanner", "homebanner_list_admin");  
    add_submenu_page("homebanner", "List Banner","List Banner", 1, "homebanner", "homebanner_list_admin");  
    add_submenu_page("homebanner", "Add Banner","Add New Banner", 1, "homebanner-add", "homebanner_admin");  
    //add_submenu_page("homebanner", "Position","Banner Position", 1, "homebanner-position", "homebanner_position_admin");  
}  
  
add_action('admin_menu', 'homebanner_admin_actions');
/*function homebanner_position_admin() { 
  global $wpdb;
  $table_name = $wpdb->prefix . "homebanner";
  $row = $wpdb->get_results( "SELECT * FROM ".$table_name);  
  include('homebanner_position_admin.php');  
}*/ 

function remove_bannerBgImg() {
  global $wpdb;
  $table_name = $wpdb->prefix . "homebanner";
  $fetchQ = "SELECT background_image FROM ". $wpdb->prefix ."homebanner WHERE id = ".$_REQUEST['bannerId'];
  $resultData = $wpdb->get_results($fetchQ);
  $image_name  = $resultData[0]->background_image;
  
  if(file_exists(WP_CONTENT_DIR.'/uploads/homebanner/bg_original_images/'.$image_name)) {
      chmod(WP_CONTENT_DIR.'/uploads/homebanner/bg_original_images/'.$image_name, 0777);
      unlink(WP_CONTENT_DIR.'/uploads/homebanner/bg_original_images/'.$image_name);

      if (file_exists(WP_CONTENT_DIR.'/uploads/homebanner/bg_thumb_images/'.$image_name)) {
          chmod(WP_CONTENT_DIR.'/uploads/homebanner/bg_thumb_images/'.$image_name, 0777);
          unlink(WP_CONTENT_DIR.'/uploads/homebanner/bg_thumb_images/'.$image_name);

          $wpdb->query("UPDATE ".$table_name." SET background_image = '', WHERE id = '".$_REQUEST['bannerId']."'" );                 
          echo 'true';
          die;
          }else{
            echo 'false';
            die;
          }
      } else {
          echo 'false';
          die;
      }
 } 
// creating Ajax call for WordPress
add_action('wp_ajax_nopriv_remove_bannerBgImg', 'remove_bannerBgImg');
add_action('wp_ajax_remove_bannerBgImg', 'remove_bannerBgImg');

function remove_bannerFrontImg() {
  global $wpdb;
  $table_name = $wpdb->prefix . "homebanner";
  $fetchQ = "SELECT front_image FROM ". $wpdb->prefix ."homebanner WHERE id = ".$_REQUEST['bannerId'];
  $resultData = $wpdb->get_results($fetchQ);
  $image_name  = $resultData[0]->front_image;
  
  if(file_exists(WP_CONTENT_DIR.'/uploads/homebanner/front_original_images/'.$image_name)) {
      chmod(WP_CONTENT_DIR.'/uploads/homebanner/front_original_images/'.$image_name, 0777);
      unlink(WP_CONTENT_DIR.'/uploads/homebanner/front_original_images/'.$image_name);

      if (file_exists(WP_CONTENT_DIR.'/uploads/homebanner/front_thumb_images/'.$image_name)) {
          chmod(WP_CONTENT_DIR.'/uploads/homebanner/front_thumb_images/'.$image_name, 0777);
          unlink(WP_CONTENT_DIR.'/uploads/homebanner/front_thumb_images/'.$image_name);

          $wpdb->query("UPDATE ".$table_name." SET front_image = ''  WHERE id = '".$_REQUEST['bannerId']."'" );
          echo 'true';
          die;
          }else{
            echo 'false';
            die;
          }
      }else {
          echo 'false';
          die;
      }
 } 
// creating Ajax call for WordPress
add_action('wp_ajax_nopriv_remove_bannerFrontImg', 'remove_bannerFrontImg');
add_action('wp_ajax_remove_bannerFrontImg', 'remove_bannerFrontImg');
?>