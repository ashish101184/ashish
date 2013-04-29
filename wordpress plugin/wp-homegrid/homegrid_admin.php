<script src="<?php echo plugins_url()?>/wp-homegrid/js/jquery.js"></script>
<script src="<?php echo plugins_url()?>/wp-homegrid/js/validation.js"></script>
<script src="<?php echo plugins_url()?>/wp-homegrid/js/general_grid.js"></script>
<link href="<?php echo plugins_url()?>/wp-homegrid/css/add_form_style.css" type="text/css" rel="stylesheet">
<?php   
    if($_POST['homegrid_hidden'] == 'Y') { 
        $error = false;
        
        //Form data sent
        $fileExtension = end(explode(".", $_FILES["file_name"]["name"]));        
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
            $errorType = 'Invalid file';
            $error = true;
          }      
       
        
          //no error
          if(!$error)
          {            
            global $wpdb;
            $wpdb->query(  "INSERT INTO ". $wpdb->prefix ."homegrid(grid_title, main_heading, sub_heading, description, link_window, link_href, link_text, box_type, file_name, data_row, data_col) VALUES('".$_POST['grid_title']."', '".$_POST['main_heading']."', '".$_POST['sub_heading']."', '".$_POST['description']."', '".$_POST['link_window']."', '".$_POST['link_href']."', '".$_POST['link_text']."', '".$_POST['box_type']."', '".$uploadFileName."', 1, 1)" ) or wp_die( 'Could not save data!' );
            //echo "Successfull";die;            
            //wp_redirect(admin_url().'/admin.php?page=homegrid-position');
          ?>
          <script type="text/javascript">            
                window.location= '<?php echo admin_url().'/admin.php?page=homegrid-position'; ?>';          
            </script>
          <?php   
          } 
         ?>  
         
        <?php  
    } 
?> 
<div id="top" class="wrap formmain_div" >          
<h2>Add Grid</h2>
<div class="container">  
<div class="content" id="content_inner">
  <div class="content_details">
    <?php if($error) { ?>
      <div class="msg-error">
        <?php echo $errorType; ?>      
      </div>
      <?php } ?>
        <div class="contents">
          <form name="homegrid_form" id="homegrid_add_form" method="post" enctype="multipart/form-data" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">          
          <div class="form_left">
                <input type="hidden" name="homegrid_hidden" value="Y">                
              <div class="control-box">
                <div class="field_div"> Grid Title<span class="astrik_sign">*</span> :</div>
                <div class="field_div field_div2"> <input type="text" name="grid_title" value="<?php echo $_REQUEST['grid_title']; ?>" ></div>
              </div>
              <div class="control-box">
                <div class="field_div"> Box Type<span class="astrik_sign">*</span> :</div>
                <div for="select"></div>
                 <div class="field_div">
                 <select name="box_type" id="box_type_id" onchange="javascript:boximagesize(this.value);">
                  <option value="" selected="selected">Select box type</option> 
                  <option value="1,1">1x1</option>
                  <option value="1,2">1x2</option>
                  <option value="2,1">2x1</option>
                  <option value="2,2">2x2</option>
                  <option value="3,1">3x1</option>
                  </select>
                 </div>
              </div>
              <div class="control-box">
                <div class="field_div"> Main Heading :</div>
                 <div class="field_div field_div2">
                  <input type="text" name="main_heading" value="<?php echo $_REQUEST['main_heading']; ?>" ></div>
              </div>
              <div class="control-box">
                <div class="field_div"> Sub Heading:</div>
                 <div class="field_div">
                 <input type="text" name="sub_heading" value="<?php echo $_REQUEST['sub_heading']; ?>" ></div>
              </div>
              <div class="control-box">
                <div class="field_div"> Description:</div>
                 <div class="field_div field_div2">
                   <textarea rows="3" class="textarea_fulllength" name="description" ><?php echo $_REQUEST['description']; ?></textarea>  
                 <!--<input type="text" name="description" value="<?php //echo $_REQUEST['description']; ?>" >-->
                 </div>
              </div>
               <div class="control-box">
                <div class="field_div"> Link:</div>
                 <div class="field_div field_div2">
                <input type="text"  name="link_href" value="http://<?php echo $_REQUEST['link_href']; ?>" > </div>
              </div> 
              <div class="control-box">
                <div class="field_div"> Link Text:</div>
                 <div class="field_div">
                 <input type="text" name="link_text" value="<?php echo $_REQUEST['link_text']; ?>" > </div>
              </div>   
              <div class="control-box">
                <div class="field_div"> Link Window :</div>
                 <div class="field_div field_div2"> 
                 <input type="radio" name="link_window" class="data_feed" value="1" checked="checked"><p>New</p>
                <input type="radio" name="link_window" class="data_feed" value="2"><p>Self</p>
                </div>
              </div>
              <div class="control-box">
                <div class="field_div"> Image File<span class="astrik_sign">*</span>:</div>
                 <div class="field_div field_div2">
                 <input type="file" name="file_name" value="" >
                 <div id="imgsize_divid" class="imgsizeclass" style="display:none;">Ideal Image Size: <span id="imgsize_spanid"> </span> in px</div>
                 </div>
              </div>            
          </div>
         <div class="field_div"> </div>
         <div class="field_div"> 
              <input name="submit" type="submit"  class="button-primary" value="Add Grid" />
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
		$("#homegrid_add_form").validate({
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
