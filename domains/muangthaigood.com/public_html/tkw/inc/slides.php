
<div style="display:block;position:relative;max-width:701px; height:360px; padding-left:0px; padding-right:150px; padding-bottom:10px; padding-top:10px; margin:0px auto 0px; background:#f2eded; border:1px solid #d1d3d2;">
  <div id="amazingslider-1" style="display:block;position:relative;margin:0 auto; max-width:500px;">
    <ul class="amazingslider-slides" style="display:none;">
    <?php
    $sql = "SELECT * FROM " . $slides->getTbl() . " WHERE status = 'ใช้งาน' ORDER BY sort ASC";


    $query = $db->Query($sql);


	 while ($row = $db->FetchArray($query)) { 
	  $image = $slides_file->getDataDescLastID("file_name", "slides_id = '" . $row['id'] . "'");
	  
	 ?>
	  <li><img src="<?php echo ADDRESS_SLIDES . $image?>" alt="<?php echo $row['slides_name']?>" /> </li>
		 
		 
             
     <?php } ?>
       
    
    </ul>
    <ul class="amazingslider-thumbnails" style="display:none;">
      <?php
    $sql = "SELECT * FROM " . $slides->getTbl() . " WHERE status = 'ใช้งาน' ORDER BY sort ASC";


    $query = $db->Query($sql);


	 while ($row = $db->FetchArray($query)) { 
	  $image = $slides_file->getDataDescLastID("file_name", "slides_id = '" . $row['id'] . "'");
	  
	 ?>
	  <li><img src="<?php echo ADDRESS_SLIDES . $image?>"  /> </li>
		 
		 
             
     <?php } ?>
    </ul>
  </div>
</div>
