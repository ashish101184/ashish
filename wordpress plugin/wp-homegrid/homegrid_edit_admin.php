<script src="<?php echo plugins_url()?>/wp-homegrid/js/jquery.js"></script>
<script src="<?php echo plugins_url()?>/wp-homegrid/js/validation.js"></script>
<script src="<?php echo plugins_url()?>/wp-homegrid/js/general_grid.js"></script>
<link href="<?php echo plugins_url()?>/wp-homegrid/css/add_form_style.css" type="text/css" rel="stylesheet">
<?php   
    if($_POST['homegrid_hidden_edit'] == 'Y') { 
        $error = false;
        //Form data sent
        $fileExtension = end(explode(".", $_FILES["file_name"]["name"]));        
        if(isset($_FILES["file_name"]["name"]) && !empty($_FILES["file_name"]["name"])) {  
        $allowedExts = array("gif", "jpeg", "jpg", "png");                  
        if ((($_FILES["file_name"]["type"] == "image/gif")
        || ($_FILES["file_name"]["type"] == "image/jpeg")
        || ($_FILES["file_name"]["type"] == "image/jpg")
        || ($_FILES["file_name"]["type"] == "image/png"))
        //&& ($_FILES["file_name"]["size"] < 20000)
        && in_array($fileExtension, $allowedExts))
          {
          if ($_FILES["file_name"]["error"] > 0)
            {
              $errorType = $_FILES["file_name"]["error"];
              $error = true;
            }
          else
            {
              $uploadFileName = uniqid(rand(), false).".".$fileExtension;
              $originalImgPath = WP_CONTENT_DIR."/uploads/homegrid/images/";
              $thumbImgPath = WP_CONTENT_DIR."/uploads/homegrid/thumbimages/";             
//              if(!(move_uploaded_file($_FILES["file_name"]["tmp_name"],
//              $originalImgPath) && copy($originalImgPath, $thumbImgPath)))
//              {
//                $errorType = 'File upload fail';
//                $error = true;
//              }else
//              {  
//                resizeimg($thumbImgPath, 400, 300);
//              }
                include(ABSPATH . "wp-content/lib/class.upload.php");
                $handle = new Upload($_FILES["file_name"]);
                
                $handle->Process($originalImgPath);
                rename($originalImgPath.'/'.$handle->file_dst_name,$originalImgPath.'/'.$uploadFileName);
                
                $handle->image_resize            = true;
                $handle->image_ratio_y           = true;
                $handle->image_x                 = 100;
                $handle->file_dst_name = "test";
                $handle->Process($thumbImgPath);
                rename($thumbImgPath.'/'.$handle->file_dst_name,$thumbImgPath.'/'.$uploadFileName);                
            }
          }
        else
          {
            $errorType = 'Invalid Image file';
            $error = true;
          }
        }
        
          // no error
          if(!$error)
          {   
             $fileNameUpdate = '';
             if($uploadFileName){ 
              $fileNameUpdate = ", file_name = '".$uploadFileName."'"; 
             }
            
            global $wpdb;
            $table_name = $wpdb->prefix . "homegrid";            
            $wpdb->query( "UPDATE ".$table_name." SET grid_title = '".$_POST['grid_title']."',main_heading = '".$_POST['main_heading']."', sub_heading = '".$_POST['sub_heading']."', description = '".$_POST['description']."', link_window = '".$_POST['link_window']."', link_href = '".$_POST['link_href']."', link_text = '".$_POST['link_text']."', box_type = '".$_POST['box_type']."' $fileNameUpdate WHERE id = '".$_POST['grid_id']."'" );
            //echo "Successfull";die;            
            //wp_redirect(admin_url().'/admin.php?page=homegrid-position');           
            $success_msg = true;
          ?>          
          <?php   
          } 
         ?>  
         
        <?php  
    }
         global $wpdb;
         $grid_Id = $_REQUEST['grid_id'];
         $fetchQ = "SELECT * FROM ". $wpdb->prefix ."homegrid WHERE id = ".$grid_Id;
         $resultData = $wpdb->get_results($fetchQ);
?> 
        
<div id="top" class="wrap formmain_div" >          
<h2>Edit Grid</h2>           
<div class="container">  
<div class="content" id="content_inner">
  <div class="content_details">
    <?php if($success_msg) { ?>
      <div class="msg_display">
      Successfully saved    
     </div>
     <?php } ?>
      <?php if($error) { ?>
      <div class="msg-error">
        <?php echo $errorType; ?>        
      </div>
      <?php } ?>
        <div class="contents">
          <form name="homegrid_edit_form" id="homegrid_edit_form" method="post" enctype="multipart/form-data" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">          
          <div class="form_left">
                <input type="hidden" name="homegrid_hidden_edit" value="Y">                
                <input type="hidden" name="grid_id" value="<?php echo $grid_Id; ?>">
              <div class="control-box">
                <div class="field_div"> Grid Title <span class="astrik_sign">*</span>:</div>
                <div class="field_div field_div2"> <input type="text" name="grid_title" value="<?php echo $resultData[0]->grid_title; ?>" ></div>
              </div>
              <div class="control-box">
                <div class="field_div"> Box Type <span class="astrik_sign">*</span>:</div>
                <div for="select"></div>
                 <div class="field_div">
                 <select name="box_type" id="box_type_id" onchange="javascript:boximagesize(this.value);">
                  <option value="" >Select box type</option>  
                  <option value="1,1" <?php echo $resultData[0]->box_type == '1,1'?'selected="selected"':''; ?>>1x1</option>
                  <option value="1,2" <?php echo $resultData[0]->box_type == '1,2'?'selected="selected"':''; ?>>1x2</option>
                  <option value="2,1" <?php echo $resultData[0]->box_type == '2,1'?'selected="selected"':''; ?>>2x1</option>
                  <option value="2,2" <?php echo $resultData[0]->box_type == '2,2'?'selected="selected"':''; ?>>2x2</option>
                  <option value="3,1" <?php echo $resultData[0]->box_type == '3,1'?'selected="selected"':''; ?>>3x1</option>
                  </select>
                 </div>
              </div>
              <div class="control-box">
                <div class="field_div"> Main Heading :</div>
                 <div class="field_div field_div2">
                  <input type="text" name="main_heading" value="<?php echo $resultData[0]->main_heading; ?>" ></div>
              </div>
              <div class="control-box">
                <div class="field_div"> Sub Heading:</div>
                 <div class="field_div field_div2">
                 <input type="text" name="sub_heading" value="<?php echo $resultData[0]->sub_heading; ?>" ></div>
              </div>
              <div class="control-box">
                <div class="field_div"> Description:</div>
                 <div class="field_div field_div2">
                   <textarea rows="3" class="textarea_fulllength" name="description"  ><?php echo $resultData[0]->description; ?></textarea>  
                 
              </div>
               <div class="control-box">
                <div class="field_div"> Link:</div>
                 <div class="field_div field_div2">
                 <input  type="text" name="link_href" value="<?php echo $resultData[0]->link_href; ?>" > </div>
              </div> 
              <div class="control-box">
                <div class="field_div"> Link Text:</div>
                 <div class="field_div field_div2">
                 <input type="text" name="link_text" value="<?php echo $resultData[0]->link_text; ?>" > </div>
              </div>   
              <div class="control-box">
                <div class="field_div"> Link Window :</div>
                 <div class="field_div field_div2"> 
                 <input type="radio" name="link_window" class="data_feed" <?php echo $resultData[0]->link_window == 1?'checked="checked"':''; ?> value="1"><p>New</p>
                <input type="radio" name="link_window" class="data_feed" <?php echo $resultData[0]->link_window == 2?'checked="checked"':''; ?> value="2"><p>Self</p>
                </div>
              </div>
             
            <?php
            if (!empty($resultData[0]->file_name)) {
            ?>
             <input type="hidden" name="hiddenFilename" value='1' id ="hiddenFilename">    
            <?php   
            } else {
            ?>
            <input type="hidden" name="hiddenFilename" value='0' id ="hiddenFilename">   
            <?php  
            }
            ?>      
              <div class="control-box" id='fileAlreadyExists'>
                <div class="field_div"> Image File<span class="astrik_sign">*</span>:</div>
                 <div class="field_div images">
                 <img src="<?php echo WP_CONTENT_URL.'/uploads/homegrid/thumbimages/'.$resultData[0]->file_name; ?>" alt="" />
                 <div class="removeImg_link" >
                    <a id="removeBannerImage" title="Remove Image" href="javascript:void(0)">Remove Image</a>                                      </div>
                 </div>
              </div>
              <div class="control-box" id='fileUploadEdit'>
                <div class="field_div"> Image File<span class="astrik_sign">*</span>:</div>
                 <div class="field_div field_div2">
                 <input type="file" name="file_name" value="" >
                 <div id="imgsize_divid" class="imgsizeclass" style="display:none;">Ideal Image Size: <span id="imgsize_spanid"> </span> in px</div>
                 </div>
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
    var fileExists = $('#hiddenFilename').val();
		if(fileExists == 1){ 
			$('#fileUploadEdit').hide();
			$('#fileAlreadyExists').show();
		} else {      
			$('#fileUploadEdit').show();
			$('#fileAlreadyExists').hide();
		}
      $('#removeBannerImage').live('click', function(){
			var response = confirm("Are you sure you want to delete it?");
			if(response){
				$('#ajaxLoader').css('display','inline');
				var gridId = <?php echo $grid_Id; ?>;
				$.ajax({
					type: "GET",
					url: "<?php bloginfo('url'); ?>/wp-admin/admin-ajax.php?action=remove_gridImg&gridId="+gridId,
					dataType: "html",
					success: function(response){
						if(response == 'true'){							
							//$('#ajaxLoader').css('display','none');
							$('#fileAlreadyExists').hide();
							$('#fileUploadEdit').show();
						} else {
							//$('#ajaxLoader').css('display','none');
              $('#removeBannerImage').parent().find('.error').remove();
							$('#removeBannerImage').parent().append('<div class="error">Error in removing file.</div>');
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
		$("#homegrid_edit_form").validate({
      ignore: ':hidden',
			rules: {			
				'grid_title': {
					required: true
				},        
        'box_type': {
          required: true
        },
        'file_name': {
          required: true
        }
                                	
			},
			messages: {
				'grid_title': {
					required: "Grid Title is required"					
				},
        'box_type': {
          required: "Box Type is required"
        },
        'file_name': {
          required: "Image File is required"
        }
        
				               	
			}
		});
    
 });  
var boxsize = $("#box_type_id").val();
boximagesize(boxsize);
</script>     