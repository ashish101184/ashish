<div id="container">
<?php
$i=0;
$class = '';
//$sub_detail_class = '';
foreach($rows as $row){?>
<?php 
$odd = "";
$lightclass = '';
if($i%2!=0 && $i!=0){
  $odd = "dark";
  $lightclass = "light";
}
$box_type = $row->box_type;
if($box_type == "1,1"){
  $class = "oneone";
  //$sub_detail_class = 'one_one';
}elseif($box_type == "2,1"){
  $class = "twoone";
  //$sub_detail_class = 'one_one';
}elseif($box_type == "1,2"){
  $class = "onetwo";
  //$sub_detail_class = 'one_one';
}elseif($box_type == "2,2"){
  $class = "twotwo";
  //$sub_detail_class = 'one_one';
}elseif($box_type == "3,1"){
  $class = "threeeone";
  //$sub_detail_class = 'one_one';
}
?>
  <div class="box <?php echo $class." ".$odd;?>">  
    <div class="social">
     <ul>
     <li>
      <a target="_blank" href="http://www.facebook.com/sharer.php?s=100&p[url]=<?php echo $row->link_href; ?>&p[images][0]=<?php echo WP_CONTENT_URL.'/uploads/homegrid/images/'.$row->file_name; ?>&p[title]=<?php echo $row->main_heading; ?>"><img src="<?php echo plugins_url();?>/wp-homegrid/front/images/box_fb.png" alt="facebook share button" title="facebook share button" /></a>
     </li>
     <li>              
       <a target="_blank" href="http://twitter.com/share?text=<?php echo $row->main_heading; ?>&amp;url=<?php echo $row->link_href; ?>" title="Click to share this post on Twitter" ><img src="<?php echo plugins_url();?>/wp-homegrid/front/images/box_twi.png" alt="twitter share button" title="twitter share button" /></a>
     </li>
     <li>
       <a target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php echo $row->link_href; ?>&media=<?php echo WP_CONTENT_URL.'/uploads/homegrid/images/'.$row->file_name; ?>&description=<?php echo $row->main_heading; ?>" class="pin-it-button" count-layout="horizontal" ><img src="<?php echo plugins_url();?>/wp-homegrid/front/images/box_pint.png" alt="pinterest share button" title="pinterest share button" /></a>
     </li>
     <li>
       <!--<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php //echo $row->link_href; ?>&title=<?php //echo $row->main_heading; ?>&summary=&source=<?php //echo $row->main_heading; ?>" target="_new"><img src="<?php //echo plugins_url();?>/wp-homegrid/front/images/box_share.png" alt="linkedin share button" title="linkedin share button" />st_image="<?php //echo WP_CONTENT_URL.'/uploads/homegrid/images/'.$row->file_name; ?>"</a>-->
       
       <span class='st_sharethis_large' displayText='ShareThis' st_url="<?php echo $row->link_href; ?>" st_title="<?php echo $row->main_heading; ?>" st_image="<?php echo WP_CONTENT_URL.'/uploads/homegrid/images/'.$row->file_name; ?>" ></span>
       
     </li>
     </ul>
     </div>
    <div class="doom" style="background:url(<?php echo WP_CONTENT_URL.'/uploads/homegrid/images/'.$row->file_name; ?>)no-repeat scroll 0 0 transparent;"> 
     <!--img src="<?php //echo WP_CONTENT_URL.'/uploads/homegrid/images/'.$row->file_name; ?>" alt="" /> -->
    </div>  
    <div class="box_details  one_one <?php echo $lightclass; ?>">
      <div class="details title"><?php echo $row->main_heading; ?></div>
        <div class="details description"><?php echo $row->sub_heading; ?></div>	
        <div class="details description2"><?php echo $row->description; ?></div>
        <?php if($row->link_text){ ?>
        <div class="details buttons"><a href="<?php echo $row->link_href; ?>" title="<?php echo $row->link_text; ?>" <?php if($row->link_window == 1) {?> target="_blank" <?php } ?>><?php echo $row->link_text; ?></a></div>
        <?php } ?>
    </div>
  </div>
<?php 
$i++;
} ?>



</div>
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "6d4090ad-656e-4862-acfb-1b9734d4ea73", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>

