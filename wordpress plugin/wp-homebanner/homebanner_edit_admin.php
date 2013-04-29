<script src="<?php echo plugins_url()?>/wp-homegrid/js/jquery.js"></script>
<script src="<?php echo plugins_url()?>/wp-homegrid/js/validation.js"></script>
<link href="<?php echo plugins_url()?>/wp-homegrid/css/add_form_style.css" type="text/css" rel="stylesheet">
<?php   
    if($_POST['homebanner_hidden_edit'] == 'Y') { 
        $error_bg = false;
        $error_front = false;
        $error_bgType = '';
        $error_frontType = '';
        
        $bgFileExtension = end(explode(".", $_FILES["background_image"]["name"]));
        $frontFileExtension = end(explode(".", $_FILES["front_image"]["name"]));        
        $allowedExts = array("gif", "jpeg", "jpg", "png");
        include(ABSPATH . "wp-content/lib/class.upload.php");
        //for bg image
        if(isset($_FILES["background_image"]["name"]) && !empty($_FILES["background_image"]["name"])) { 
        if((($_FILES["background_image"]["type"] == "image/gif")
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
            $error_bgType = 'Invalid Background Image';
            $error_bg = true;
          }      
        } 
          
         //for front image
        if(isset($_FILES["front_image"]["name"]) && !empty($_FILES["front_image"]["name"])) {
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
                $handle_new = new Upload($_FILES["front_image"]);
                
                $handle_new->Process($front_originalImgPath);
                rename($front_originalImgPath.'/'.$handle_new->file_dst_name,$front_originalImgPath.'/'.$front_uploadFileName);
                
                $handle_new->image_resize            = true;
                $handle_new->image_ratio_y           = true;
                $handle_new->image_x                 = 100;
                $handle_new->file_dst_name = "test";
                $handle_new->Process($front_thumbImgPath);
                rename($front_thumbImgPath.'/'.$handle_new->file_dst_name,$front_thumbImgPath.'/'.$front_uploadFileName);
            }
          }
        else
          {
            $error_frontType = 'Invalid Front Image';
            $error_front = true;
          }
        } 
          
          //no error
          if(!$error_bg && !$error_front)
          {
            $bg_fileNameUpdate = '';
            $front_fileNameUpdate = '';
            if($bg_uploadFileName){ 
              $bg_fileNameUpdate = ", background_image = '".$bg_uploadFileName."'"; 
             }
             if($front_uploadFileName){ 
              $front_fileNameUpdate = ", front_image = '".$front_uploadFileName."'"; 
             }
            global $wpdb;
            $table_name = $wpdb->prefix . "homebanner";              
            $wpdb->query( "UPDATE ".$table_name." SET banner_title = '".$_POST['banner_title']."',banner_text = '".$_POST['banner_text']."' ,banner_link = '".$_POST['banner_link']."',banner_order = '".$_POST['banner_order']."' $bg_fileNameUpdate $front_fileNameUpdate WHERE id = '".$_POST['banner_id']."'" );
            //echo "Successfull";die;
            $success_msg = true;
          ?>          
          <?php   
          } 
         ?>  
         
        <?php  
    }
         global $wpdb; 
         $banner_Id = $_REQUEST['banner_id'];
         $fetchQ = "SELECT * FROM ". $wpdb->prefix ."homebanner WHERE id = ".$banner_Id;
         $resultData = $wpdb->get_results($fetchQ);
    
?> 
        
<div id="top" class="wrap formmain_div" >          
<h2>Edit Banner</h2>          
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
      <?php } elseif($error_front) { ?>
      <div class="msg-error">
        <?php echo $error_frontType; ?>       
      </div>
      <?php } ?>      
        <div class="contents">
          <form name="homebanner_edit_form" id="homebanner_edit_form" method="post" enctype="multipart/form-data" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">         
          <div class="form_left">
                <input type="hidden" name="homebanner_hidden_edit" value="Y">
                <input type="hidden" name="banner_id" value="<?php echo $banner_Id; ?>">
              <div class="control-box">
                <div class="field_div"> Banner Title <span class="astrik_sign">*</span>:</div>
                <div class="field_div" field_div2> <input type="text" name="banner_title" value="<?php echo $resultData[0]->banner_title; ?>" ></div>
              </div>
              <div class="control-box">
                <div class="field_div"> Banner Text :</div>
                <div class="field_div field_div2">
                 <textarea rows="3" class="textarea_fulllength" name="banner_text"  ><?php echo $resultData[0]->banner_text; ?></textarea> 
                  <!--<input type="text" name="banner_text" value="<?php //echo $resultData[0]->banner_text; ?>" >-->
                </div>
              </div>
              <div class="control-box">
                <div class="field_div"> Banner Link:</div>
                 <div class="field_div field_div2">
                <input type="text"  name="banner_link" value="<?php echo $resultData[0]->banner_link; ?>" > </div>
              </div>
              <div class="control-box">
                <div class="field_div">Banner Order:</div>
                 <div class="field_div">
                <input type="text"  name="banner_order" value="<?php echo $resultData[0]->banner_order; ?>" > </div>
              </div>   
            <?php
            if (!empty($resultData[0]->background_image)) {
            ?>
             <input type="hidden" name="bg_hiddenFilename" value='1' id ="bg_hiddenFilename">    
            <?php   
            } else {
            ?>
            <input type="hidden" name="bg_hiddenFilename" value='0' id ="bg_hiddenFilename">   
            <?php  
            }
            ?>      
              <div class="control-box" id='bg_fileAlreadyExists'>
                <div class="field_div"> Background Image<span class="astrik_sign">*</span>:</div>
                 <div class="field_div">
                 <img src="<?php echo WP_CONTENT_URL.'/uploads/homebanner/bg_thumb_images/'.$resultData[0]->background_image; ?>" alt="" />
                 <div class="removeImg_link" >
                    <a id="bg_removeBannerImage" title="Remove Image" href="javascript:void(0)">Remove Image</a>                                 </div>
                 </div>
              </div>
              <div class="control-box" id='bg_fileUploadEdit'>
                <div class="field_div"> Background Image:<span class="astrik_sign">*</span></div>
                 <div class="field_div">
                 <input type="file" name="background_image" value="" > </div>
              </div>
              
              <?php
              if (!empty($resultData[0]->front_image)) {
              ?>
              <input type="hidden" name="front_hiddenFilename" value='1' id ="front_hiddenFilename">    
              <?php   
              } else {
              ?>
              <input type="hidden" name="front_hiddenFilename" value='0' id ="front_hiddenFilename">   
              <?php  
              }
              ?>      
              <div class="control-box" id='front_fileAlreadyExists'>
                <div class="field_div"> Front Image<span class="astrik_sign">*</span>:</div>
                 <div class="field_div">
                 <img src="<?php echo WP_CONTENT_URL.'/uploads/homebanner/front_thumb_images/'.$resultData[0]->front_image; ?>" alt="" />
                 <div class="removeImg_link" >
                    <a id="front_removeBannerImage" title="Remove Image" href="javascript:void(0)">Remove Image</a>                              </div>
                 </div>
              </div>
              <div class="control-box" id='front_fileUploadEdit'>
                <div class="field_div"> Front Image<span class="astrik_sign">*</span>:</div>
                 <div class="field_div">
                 <input type="file" name="front_image" value="" > </div>
              </div>
            
          </div>
         <div class="field_div"> </div>
         <div class="field_div"> 
           <input name="submit" type="submit"  class="button-primary" value="Save" />
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
    var bg_fileExists = $('#bg_hiddenFilename').val();
		if(bg_fileExists == 1){ 
			$('#bg_fileUploadEdit').hide();
			$('#bg_fileAlreadyExists').show();
		} else {      
			$('#bg_fileUploadEdit').show();
			$('#bg_fileAlreadyExists').hide();
		}
    
      $('#bg_removeBannerImage').live('click', function(){
			var response = confirm("Are you sure you want to delete it?");
			if(response){
				//$('#ajaxLoader').css('display','inline');
				var bannerId = <?php echo $banner_Id; ?>;
				$.ajax({
					type: "GET",
					url: "<?php bloginfo('url'); ?>/wp-admin/admin-ajax.php?action=remove_bannerBgImg&bannerId="+bannerId,
					dataType: "html",
					success: function(response){
						if(response == 'true'){							
							//$('#ajaxLoader').css('display','none');
							$('#bg_fileAlreadyExists').hide();
							$('#bg_fileUploadEdit').show();
						} else {
							//$('#ajaxLoader').css('display','none');
              $('#bg_removeBannerImage').parent().find('.error').remove();
							$('#bg_removeBannerImage').parent().append('<div class="error">Error in removing file.</div>');
						}
					}
				});
			}
   });  
   
   var front_fileExists = $('#front_hiddenFilename').val();
		if(front_fileExists == 1){ 
			$('#front_fileUploadEdit').hide();
			$('#front_fileAlreadyExists').show();
		} else {      
			$('#front_fileUploadEdit').show();
			$('#front_fileAlreadyExists').hide();
		}
    
   $('#front_removeBannerImage').live('click', function(){
			var response = confirm("Are you sure you want to delete it?");
			if(response){
				//$('#ajaxLoader').css('display','inline');
				var bannerId = <?php echo $banner_Id; ?>;
				$.ajax({
					type: "GET",
					url: "<?php bloginfo('url'); ?>/wp-admin/admin-ajax.php?action=remove_bannerFrontImg&bannerId="+bannerId,
					dataType: "html",
					success: function(response){
						if(response == 'true'){							
							//$('#ajaxLoader').css('display','none');
							$('#front_fileAlreadyExists').hide();
							$('#front_fileUploadEdit').show();
						} else {
							//$('#ajaxLoader').css('display','none');
              $('#front_removeBannerImage').parent().find('.error').remove();
							$('#front_removeBannerImage').parent().append('<div class="error">Error in removing file.</div>');
						}
					}
				});
			}
   });  
   
   });  
</script>
<script type="text/javascript">
	$(document).ready(function() {           
                 
		//For validating Banner Add Form 
		$("#homebanner_edit_form").validate({
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