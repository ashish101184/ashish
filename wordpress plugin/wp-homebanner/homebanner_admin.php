<script src="<?php echo plugins_url()?>/wp-homegrid/js/jquery.js"></script>
<script src="<?php echo plugins_url()?>/wp-homegrid/js/validation.js"></script>
<link href="<?php echo plugins_url()?>/wp-homegrid/css/add_form_style.css" type="text/css" rel="stylesheet">
<?php   
    if($_POST['homebanner_hidden'] == 'Y') { 
        $error_bg = false;
        $error_front = false;
        $error_bgType = '';
        $error_frontType = '';
        $bgFileExtension = end(explode(".", $_FILES["background_image"]["name"]));
        $frontFileExtension = end(explode(".", $_FILES["front_image"]["name"]));        
        $allowedExts = array("gif", "jpeg", "jpg", "png");                  
        include(ABSPATH . "wp-content/lib/class.upload.php");
        //for bg image
        if ((($_FILES["background_image"]["type"] == "image/gif")
        || ($_FILES["background_image"]["type"] == "image/jpeg")
        || ($_FILES["background_image"]["type"] == "image/jpg")
        || ($_FILES["background_image"]["type"] == "image/png"))
        //&& ($_FILES["background_image"]["size"] < 20000)
        && in_array($bgFileExtension, $allowedExts))
          {
           if($_FILES["background_image"]["error"] > 0)
            {
              $error_bgType = $_FILES["background_image"]["error"];
              $error_bg = true;
            }
          else
            {
              $bg_uploadFileName = uniqid(rand(), false).".".$bgFileExtension;              
              $bg_originalImgPath = WP_CONTENT_DIR."/uploads/homebanner/bg_original_images/";
              $bg_thumbImgPath = WP_CONTENT_DIR."/uploads/homebanner/bg_thumb_images/";              
//              if(!(move_uploaded_file($_FILES["background_image"]["tmp_name"],
//              $bg_originalImgPath) && copy($bg_originalImgPath, $bg_thumbImgPath)))
//              {               
//                $error_bgType = 'File upload fail';
//                $error_bg = true;
//              }else
//              {  
//                resizeimg($bg_thumbImgPath, 550, 300);
//              }                
                $handle = new Upload($_FILES["background_image"]);
                
                $handle->Process($bg_originalImgPath);
                rename($bg_originalImgPath.'/'.$handle->file_dst_name,$bg_originalImgPath.'/'.$bg_uploadFileName);
                
                $handle->image_resize            = true;
                $handle->image_ratio_y           = true;
                $handle->image_x                 = 100;
                $handle->file_dst_name = "test";
                $handle->Process($bg_thumbImgPath);
                rename($bg_thumbImgPath.'/'.$handle->file_dst_name,$bg_thumbImgPath.'/'.$bg_uploadFileName);
            }
          }
        else
          {
            $error_bgType = 'Invalid file';
            $error_bg = true;
          }      
           
         //for front image
        if ((($_FILES["front_image"]["type"] == "image/gif")
        || ($_FILES["front_image"]["type"] == "image/jpeg")
        || ($_FILES["front_image"]["type"] == "image/jpg")
        || ($_FILES["front_image"]["type"] == "image/png"))
        //&& ($_FILES["background_image"]["size"] < 20000)
        && in_array($frontFileExtension, $allowedExts))
          {
           if($_FILES["front_image"]["error"] > 0)
            {
              $error_frontType = $_FILES["front_image"]["error"];
              $error_front = true;
            }
          else
            {
              $front_uploadFileName = uniqid(rand(), false).".".$frontFileExtension;
              $front_originalImgPath = WP_CONTENT_DIR."/uploads/homebanner/front_original_images/";
              $front_thumbImgPath = WP_CONTENT_DIR."/uploads/homebanner/front_thumb_images/";                      
//              if(!(move_uploaded_file($_FILES["front_image"]["tmp_name"],
//              $front_originalImgPath) && copy($front_originalImgPath, $front_thumbImgPath)))
//              {
//                $error_frontType = 'File upload fail';
//                $error_front = true;
//              }else
//              {  
//                resizeimg($front_thumbImgPath, 400, 300);
//              }                                       
                $handle = new Upload($_FILES["front_image"]);
                
                $handle->Process($front_originalImgPath);
                rename($front_originalImgPath.'/'.$handle->file_dst_name,$front_originalImgPath.'/'.$front_uploadFileName);
             
                $handle->image_resize            = true;
                $handle->image_ratio_y           = true;
                $handle->image_x                 = 100;
                $handle->file_dst_name = "test";
                $handle->Process($front_thumbImgPath);
                rename($front_thumbImgPath.'/'.$handle->file_dst_name,$front_thumbImgPath.'/'.$front_uploadFileName);
              
              
            }
          }
        else
          {
            $error_frontType = 'Invalid file';
            $error_front = true;
          }     
          
          //no error
          if(!$error_bg && !$error_front)
          {
            global $wpdb;            
            $wpdb->query( "INSERT INTO ". $wpdb->prefix ."homebanner (banner_title, banner_text, banner_link, banner_order, background_image, front_image) VALUES('".$_POST['banner_title']."', '".$_POST['banner_text']."', '".$_POST['banner_link']."', '".$_POST['banner_order']."', '".$bg_uploadFileName."', '".$front_uploadFileName."')" ) or wp_die( 'Could not save data!' );
            //echo "Successfull";die;
            $_POST['banner_title'] = '';
            $_POST['banner_text'] = '';
            $success_msg = true;
          ?>          
          <?php   
          } 
         ?>  
         
        <?php  
    } 
?> 
<div id="top" class="wrap formmain_div" >          
<h2>Add Banner</h2>          
<div class="container">  
<div class="content" id="content_inner">
  <div class="content_details">
    <?php if($success_msg) { ?>
      <div class="msg_display">
      Successfully saved      
     </div>
     <?php } ?>
      <?php if($error_bg) { ?>
      <div class="msg-error">
        <?php echo $error_bgType; ?>       
      </div>
      <?php }elseif($error_front) { ?>
      <div class="msg-error">
        <?php echo $error_frontType; ?>     
      </div>
      <?php } ?>
        <div class="contents">
          <form name="homebanner_form" id="homebanner_add_form" method="post" enctype="multipart/form-data" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">          
          <div class="form_left">
                <input type="hidden" name="homebanner_hidden" value="Y">
              <div class="control-box">
                <div class="field_div"> Banner Title<span class="astrik_sign">*</span> :</div>
                <div class="field_div field_div2"> <input type="text" name="banner_title" value="<?php echo $_REQUEST['banner_title']; ?>" ></div>
              </div>
              <div class="control-box">
                <div class="field_div"> Banner Text :</div>
                <div class="field_div field_div2">
                <textarea rows="3" class="textarea_fulllength" name="banner_text" ><?php echo $_REQUEST['banner_text']; ?></textarea>  
                  <!--<input type="text" name="banner_text" value="<?php //echo $_REQUEST['banner_text']; ?>" >-->
                </div>
              </div>
              <div class="control-box">
                <div class="field_div"> Banner Link:</div>
                 <div class="field_div field_div2">
                <input type="text"  name="banner_link" value="http://<?php echo $_REQUEST['banner_link']; ?>" > </div>
              </div>
              <div class="control-box">
                <div class="field_div">Banner Order:</div>
                 <div class="field_div">
                <input type="text"  name="banner_order" value="<?php echo $_REQUEST['banner_order']; ?>" > </div>
              </div>                
              <div class="control-box">
                <div class="field_div"> Background Image<span class="astrik_sign">*</span>:</div>
                 <div class="field_div">
                 <input type="file" name="background_image" value="" > </div>
              </div>
              <div class="control-box">
                <div class="field_div"> Front Image<span class="astrik_sign">*</span>:</div>
                 <div class="field_div">
                 <input type="file" name="front_image" value="" > </div>
              </div>  
          </div>
         <div class="field_div"> </div>
         <div class="field_div"> 
          <input name="submit" type="submit"  class="button-primary" value="Add Banner" />
          </div>
         </form>
          </div>
          </div>
        </div>
</div>
</div>
<!-- end of content_details -->
<script type="text/javascript">
	$(document).ready(function() {           
                 
		//For validating Banner Add Form 
		$("#homebanner_add_form").validate({
      ignore: ':hidden',
			rules: {			
				'banner_title': {
					required: true
				},        
        'background_image': {
          required: true
        },
        'front_image': {
          required: true
        }
                                	
			},
			messages: {
				'banner_title': {
					required: "Banner Title is required"					
				},
        'background_image': {
          required: "Background Image is required"
        },
        'front_image': {
          required: "Front Image is required"
        }
        
				               	
			}
		});
    
 });   
</script>    