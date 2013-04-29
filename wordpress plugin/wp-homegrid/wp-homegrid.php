<?php
/*
Plugin Name: Home Grid
Plugin URI: 
Description: Home Grid
Version: 1.1
Author: Rishabh
Author URI: 
License: GPL
*/
?>
<?php 
/*
* Create home grid Table
*/
global $homegrid_version;
$homegrid_version = "1.1";
/*function homegrid_table_plugin() {
global $wpdb;
global $homegrid_version;
// table for ads
$table_name = $wpdb->prefix . "homegrid";
 
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
 
add_option("homegrid_db_version", $homegrid_version);
 
}
}*/

function homegrid_admin() {     
    include('homegrid_admin.php');  
} 
function homegrid_list_admin() {     
    include('homegrid_list_admin.php');  
} 
function homegrid_admin_actions() {        
    $admin_page = add_menu_page("HomeGrid", "Home Grid", 1, "homegrid", "homegrid_list_admin");  
    add_submenu_page("homegrid", "List Grid","List Grid", 1, "homegrid", "homegrid_list_admin");  
    add_submenu_page("homegrid", "Add Grid","Add new Grid Element", 1, "homegrid-add", "homegrid_admin");  
    add_submenu_page("homegrid", "Position","Grid Position", 1, "homegrid-position", "homegrid_position_admin");  
}  
  
add_action('admin_menu', 'homegrid_admin_actions');
function homegrid_position_admin() {   
  global $wpdb;
  $table_name = $wpdb->prefix . "homegrid";
  $row = $wpdb->get_results( "SELECT * FROM ".$table_name);  
  include('homegrid_position_admin.php');  
} 

function homegrid_ajax() {
  global $wpdb;
  $table_name = $wpdb->prefix . "homegrid";
  try{
      $results = json_decode(stripslashes($_POST['content']));      
      foreach($results as $result){
        $sizeString = $result->data_sizex.','.$result->data_sizey;        
        $wpdb->query( "UPDATE ".$table_name." SET data_row = '".$result->data_row."',data_col = '".$result->data_col."', box_type = '".$sizeString."' WHERE id = '".$result->data_id."'" ); 
      }
      echo 1;
  }catch(Exeception $e){
    echo 0;
  }
      exit;
}
// creating Ajax call for WordPress
add_action( 'wp_ajax_nopriv_homegrid_ajax', 'homegrid_ajax' );
add_action( 'wp_ajax_homegrid_ajax', 'homegrid_ajax' );
add_shortcode( 'homegrid', 'homegrid_parse_shortcode');
//add_filter( 'the_content', 'homegrid_parse_shortcode' );
function homegrid_parse_shortcode($content){
  global $wpdb;
  $table_name = $wpdb->prefix . "homegrid";
  $rows = $wpdb->get_results( "SELECT * FROM ".$table_name." ORDER BY `data_row` ASC,`data_col` ASC ");    
  
  include "homegrid_content.php";  
}
add_shortcode( 'homegrid_banner', 'homegrid_banner_parse_shortcode');
function homegrid_banner_parse_shortcode($content){
  global $wpdb;
  $table_name = $wpdb->prefix . "homebanner";
  $results = $wpdb->get_results( "SELECT * FROM ".$table_name." ORDER BY `banner_order` ASC ");      
  include "homegrid_banner.php";  
}

function remove_gridImg() {
  global $wpdb;
  $table_name = $wpdb->prefix . "homegrid";
  $fetchQ = "SELECT file_name FROM ". $wpdb->prefix ."homegrid WHERE id = ".$_REQUEST['gridId'];
  $resultData = $wpdb->get_results($fetchQ);
  $image_name  = $resultData[0]->file_name;
  
  if(file_exists(WP_CONTENT_DIR.'/uploads/homegrid/images/'.$image_name)) {
      chmod(WP_CONTENT_DIR.'/uploads/homegrid/images/'.$image_name, 0777);
      unlink(WP_CONTENT_DIR.'/uploads/homegrid/images/'.$image_name);

      if (file_exists(WP_CONTENT_DIR.'/uploads/homegrid/thumbimages/'.$image_name)) {
          chmod(WP_CONTENT_DIR.'/uploads/homegrid/thumbimages/'.$image_name, 0777);
          unlink(WP_CONTENT_DIR.'/uploads/homegrid/thumbimages/'.$image_name);

          $wpdb->query("UPDATE ".$table_name." SET file_name = '' WHERE id = '".$_REQUEST['gridId']."'" );                 
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
add_action( 'wp_ajax_nopriv_remove_gridImg', 'remove_gridImg' );
add_action( 'wp_ajax_remove_gridImg', 'remove_gridImg' );

function wp_admin_homegrid_css() {
	wp_enqueue_style('homegrid',WP_PLUGIN_URL . '/' . plugin_basename(dirname(__FILE__)) . '/css/simple_style.css', $deps = array(), '', $media = 'all' );
  wp_enqueue_style('homegrid_jquery_gridster',WP_PLUGIN_URL . '/' . plugin_basename(dirname(__FILE__)) . '/css/jquery.gridster.css', $deps = array(), '', $media = 'all' );
  wp_enqueue_style('homegrid_qunit',WP_PLUGIN_URL . '/' . plugin_basename(dirname(__FILE__)) . '/css/qunit.css', $deps = array(),'', $media = 'all' );
}
add_action('admin_print_styles', 'wp_admin_homegrid_css');
?>