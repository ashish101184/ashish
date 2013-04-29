<link rel="stylesheet" href="<?php echo plugins_url()?>/wp-homegrid/front/css/slider.css" type="text/css" media="screen" />

	
<div> 
<div class="content"><div class="home">
<?php 
$i = 0;
foreach($results as $result){  
  $apply_class = "";  
  if($i == 0){
    $apply_class = "active";
    $i = 1;
  }
?>
<div style="cursor: pointer;" class="slide <?php echo $apply_class;?>" onclick="window.open('<?php echo $result->banner_link; ?>','_blank')">
  <div class="back" style="background-image: url(<?php echo WP_CONTENT_URL.'/uploads/homebanner/bg_original_images/'.$result->background_image;?>)" >
  
  
          <div class="image">
              <a href="<?php echo $result->banner_link;?>" ><img alt="Landscape" src="<?php echo WP_CONTENT_URL.'/uploads/homebanner/front_original_images/'.$result->front_image;?>">
                </a>
            </div>
        
          <div class="arrow-holder">
            <a href="#" class="arrow arrow-left"><img alt="Arrow-left" src="<?php echo plugins_url()?>/wp-homegrid/front/images/bg_direction_nav.png">
              </a>
            
            <h1 class="title"><?php echo $result->banner_text;?></h1>
            
        
              
                  <a href="#" class="arrow arrow-right"><img alt="Arrow-right" src="<?php echo plugins_url()?>/wp-homegrid/front/images/bg_direction_nav_2.png">
                  </a>
      </div>
      <div class="arrow-holder2 ">
         
      </div>
    
  </div>
  <img src="<?php echo plugins_url()?>/wp-homegrid/front/images/0.png" class="covershadow" alt="">
   <img alt="Arrow-left" src="<?php echo WP_CONTENT_URL.'/uploads/homebanner/bg_original_images/'.$result->background_image;?>" class="imagebig"  >
    </div>
<?php 
}
?>  
</div>

</div>
  <!-- Ending slider--> 
  <!--  Smooth scrolling back to top -->
</div>
<div class="clearfloat"></div>

