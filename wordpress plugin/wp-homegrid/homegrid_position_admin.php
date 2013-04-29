<?php
    //wp_enqueue_script( 'simplejquery',plugins_url('wp-homegrid/js/jquery.js'));  
    ?>
<div id="top" class="wrap" style="float:left;">
<script src="<?php echo plugins_url()?>/wp-homegrid/js/jquery.js"></script>
  <script>jQuery.noConflict()</script>
  <script src="<?php echo plugins_url()?>/wp-homegrid/js/jquery.gridster.js"></script>  
<link href="<?php echo plugins_url()?>/wp-homegrid/css/simple_style.css" type="text/css" rel="stylesheet">  
<link href="<?php echo plugins_url()?>/wp-homegrid/css/jquery.gridster.css" type="text/css" rel="stylesheet">
<link href="<?php echo plugins_url()?>/wp-homegrid/css/qunit.css" type="text/css" rel="stylesheet">
<?php //

//    wp_enqueue_script( 'gridster',plugins_url('wp-homegrid/js/jquery.gridster.js'));  
//    wp_enqueue_style( 'simplestyle',plugins_url('wp-homegrid/css/simple_style.css'));
//    wp_enqueue_style( 'gridstercss',plugins_url('wp-homegrid/css/jquery.gridster.css'));
//    wp_enqueue_style( 'qunit',plugins_url('wp-homegrid/css/qunit.css'));
    ?>
    <script type="text/javascript">
      jQuery(function(){ //DOM Ready
          jQuery(".gridster ul").gridster({
              widget_margins: [10, 10],
              widget_base_dimensions: [220, 220],
              max_size_x : 3
          });
      });
    </script>
    
<h2>Grid Settings : Set Position</h2>
<div style="padding:12px;">
<div class="gridster">
    <ul>
      <?php
      foreach($row as $rows){
        $size = explode(",",$rows->box_type);
        echo "<li id= '".$rows->id."' data-row = '".$rows->data_row."' data-col= '".$rows->data_col."' data-sizex= '".$size[0]."' data-sizey= '".$size[1]."' ><div style='padding:70px;'>".$rows->grid_title."<br><br>".$size[0]." X ".$size[1]."</div></li>";
      }
      ?>
        
    </ul>
</div>
<div>
  <input type="submit" class="button-primary" value="Save" onclick="getAllliAttribute()">
  <span id="process" style="display: none;"><img src="<?php echo plugins_url().'/wp-homegrid/ajax-loader.gif';?>" >    
  </span>
  <span id="message" style="display:none;color:green;font-size: 12px;font-weight: bold;">
    Block has been successfully saved.
  </span>
  <span id="error" style="display:none;color:green;font-size: 12px;font-weight: bold;">
    Block is not saved please try again.
  </span>
</div>
</div>
</div>
  
<script>
jQuery(function(){ //DOM Ready
 
    jQuery(".gridster ul").gridster({
        widget_margins: [10, 10],
        widget_base_dimensions: [140, 140],
        max_size_x : 2
    });
 
});
function getAllliAttribute(){
  jQuery("#process").show();  
  var content= [];
  jQuery('.gridster ul li').each(function(i)
{ 
  content.push({
           data_row: jQuery(this).attr('data-row'),
           data_col: jQuery(this).attr('data-col'),
           data_sizex: jQuery(this).attr('data-sizex'),
           data_sizey: jQuery(this).attr('data-sizey'),
           data_id: jQuery(this).attr('id')
        });
});
url = "<?php bloginfo('url'); ?>/wp-admin/admin-ajax.php";
jQuery.ajax({
            type: 'POST',
            url: url,
            data: {content:JSON.stringify(content),action:'homegrid_ajax'},
            dataType: 'json',            
            success: function (data) {
              if(data){
                jQuery("#message").show();
                setTimeout(function() {
                    jQuery("#message").fadeOut('fast');
                }, 5000);
                jQuery("#process").hide().delay(5000).fadeOut();
              }else{
                jQuery("#error").show();
                setTimeout(function() {
                    jQuery("#error").fadeOut('fast');
                }, 5000);
                jQuery("#process").hide().delay(5000).fadeOut();
              }
            },
            error:function (){
              jQuery("#process").hide().delay(5000).fadeOut();
            }
        });
}

</script>
