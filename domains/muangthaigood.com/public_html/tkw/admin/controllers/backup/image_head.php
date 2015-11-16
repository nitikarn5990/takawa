<?php
	// If they are saving the Information	
	
	if ($_POST['submit_bt'] == 'บันทึกข้อมูล' || $_POST['submit_bt'] == 'บันทึกข้อมูล และแก้ไขต่อ'){
		if($_POST['submit_bt'] == 'บันทึกข้อมูล'){
			$redirect = true;
		}else{
			$redirect = false;
		}
				if(isset($_FILES['file_array'])){
			
					$Allfile = "";
					$Allfile_ref = "";
					for($i= 0; $i < count($_FILES['file_array']['tmp_name']); $i++){
						
					// Have add image
						if($_FILES["file_array"]["name"][$i] != ""){
			
							$targetPath = DIR_ROOT_HEAD . "/";
				
							$newImage = DATE_TIME_FILE . "_" . $_FILES['file_array']['name'][$i];
				
							$cdir = getcwd(); // Save the current directory
				
							chdir($targetPath);
				
							copy($_FILES['file_array']['tmp_name'][$i], $targetPath . $newImage);
				
							chdir($cdir); // Restore the old working directory   
							
							$image_head->SetValue('file_name', $newImage);
							
							if($_POST['file_name_ref'][$i] == ''){
								
								 $file_name_ref = $newImage;	
							}else{
								 $file_name_ref = $functions->seoTitle($_POST['file_name_ref'][$i]);	
							} 
						 	$arrImage = array(
								'image_name' => $_POST['image_name'],
								'file_name' =>  $newImage,
								'file_name_ref' => $file_name_ref,
								'status' => $_POST['status'],
								
								'updated_at' => DATE_TIME
					
							);
						 
						}else{
								$arrImage = array(
									'image_name' => $_POST['image_name'],
								
									'status' => $_POST['status'],
									 
									'updated_at' => DATE_TIME
						
								);
						}
					
					}
				}
				
			
					$arrImgID = array('id' => $_GET['id']);
			
					if($image_head->updateSQL($arrImage, $arrImgID)){
						Alert('เพิ่ม แก้ไข ข้อมูลสำเร็จ','success');
					}else{
						SetAlert('ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
					}
				
				
				////////
				
				if ($redirect){
					header('location:' . ADDRESS_ADMIN_CONTROL . 'image_head');
					die();
				}else{
					header('location:' . ADDRESS_ADMIN_CONTROL . 'image_head&action=edit&id=' . $image_head->getLastID("id"));
					die();
				}
		}
		
		
		
	//Delete Image
	if($_GET['image_head_file_id'] != '' && $_GET['action'] == 'edit'){

			$arrImage = array(
			
					'file_name' => '',
								
					'file_name_ref' => '',
									 
					'updated_at' => DATE_TIME
						
			);	
			
			$arrImgID = array('id' => $_GET['image_file_id']);
			
					if($image_head->updateSQL($arrImage, $arrImgID)){
						SetAlert('เพิ่ม แก้ไข ข้อมูลสำเร็จ','success');
					}else{
						SetAlert('ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
					}
			
	}
	
	// If Deleting the Page
	if ($_GET['id'] != '' && $_GET['action'] == 'del'){
		// Get all the form data
		$arrDel = array('id' => $_GET['id']);
		$image_head->SetValues($arrDel);
		
		// Remove the info from the DB
		if ($image_head->Delete()){
			// Set alert and redirect
			SetAlert('Delete Data Success','success');
			header('location:' . ADDRESS_ADMIN_CONTROL . 'image_head');
			die();
		}else{
			SetAlert('ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
		}
	}
	
	if ($_GET['id'] != '' && $_GET['action'] == 'edit'){
		// For Update
		$image_head->SetPrimary((int)$_GET['id']);
		// Try to get the information
		if (!$image_head->GetInfo()){
			SetAlert('ไม่สามารถค้นหาข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
			$image_head->ResetValues();
		}
	}
	
?>

<?php if($_GET['action'] == "add" || $_GET['action'] == "edit"){ ?>
<div class="row-fluid">
    <div class="span12">
        <?php
			// Report errors to the user
			SetAlert(GetAlert('error'));
			SetAlert(GetAlert('success'),'success');
		?> 
        <div class="da-panel collapsible">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    <i class="icol-<?php echo ($image_head->GetPrimary() != '') ? 'application-edit' : 'add'?>"></i> <?php echo ($image_head->GetPrimary() != '') ? 'แก้ไข' : 'เพิ่ม'?> รูปภาพ
                </span>
            </div>
            <div class="da-panel-content da-form-container">
                <form id="validate" enctype="multipart/form-data" action="<?php echo ADDRESS_ADMIN_CONTROL?>image_head<?php echo ($image_head->GetPrimary() != '') ? '&id=' . $image_head->GetPrimary() : ''; ?>" method="post" class="da-form">
                	<?php if($image_head->GetPrimary() != ''):?>
                    	<input type="hidden" name="id" value="<?php echo $image_head->GetPrimary()?>" />
                  		<input type="hidden" name="created_at" value="<?php echo $image_head->GetValue('created_at')?>" />
               		<?php endif;?>
                    <div class="da-form-inline">
                        <div class="da-form-row">
                            <label class="da-form-label">ชื่อภาพ <span class="required">*</span></label>
                            <div class="da-form-item large">
                                <input type="text" name="image_name" id="image_name" value="<?php echo ($image_head->GetPrimary() != '') ? $image_head->GetValue('image_name') : ''; ?>" class="span12 required" />
                            </div>
                        </div>
                
                    
                        <div class="da-form-row">

                            <label class="da-form-label">ไฟล์ที่อัพโหลด</label>

                            <div class="da-form-item large">

                            	       <ul style=" list-style-type: none;" class="da-form-list">
                                       <?php 
									   
									   $sql = "SELECT *  FROM " . $image_head->getTbl() . " WHERE id = '" . $image_head->GetPrimary() . "' AND file_name not in('')";
									 //  echo $sql;
									   //exit();
									   $query = $db->Query($sql);
										if($db->NumRows($query) > 0){ ?>
											<ul>
										<?php	while($row = $db->FetchArray($query)){ ?>
                                                <li>
                                                    <img src="<?php echo ADDRESS_HEAD . $row['file_name']?>" style="height:130px; width:200px;">
                                                    <span class="label success3"><a style="color:#FFF !important;" href="<?php echo ADDRESS_HEAD. $row['file_name']?>" target="_blank"><?php echo $row['file_name_ref']?> </a>                                                   
                                               		<?php $k++;?>
                                                </li>
								          <?php } ?>									
								  <?php }?>
									   
							
                                     </ul>    
                                     

                            </div>

                        </div>
                        <div class="da-form-row">

                            <label class="da-form-label">อัพโหลดไฟล์</label>

                            <div class="da-form-item large" id="filecopy">

                                <span class="formNote"><strong>ชื่อใช้อ้างอิง</strong> </span>
								<input type="text" placeholder="ว่างไว้ถ้าต้องการให้สร้างชื่ออ้างอิงอัตโนมัติ" name="file_name_ref[]">
                                <input type="file" name="file_array[]" id="image"  class="span4"/>
                            	<label class="help-block">ไฟล์เอกสาร</label>

                            </div>

                        </div>
                     
                        <div class="da-form-row">
                            <label class="da-form-label">จัดลำดับ <span class="required">*</span></label>
                            <div class="da-form-item large">
                                <input type="text" name="sort" id="sort" value="<?php echo ($image_head->GetPrimary() != '') ? $image_head->GetValue('sort') : '0'; ?>" class="span12" />
                            </div>
                        </div>             
                        <div class="da-form-row">
                            <label class="da-form-label">สถานะ <span class="required">*</span></label>
                            <div class="da-form-item large">
                                <ul class="da-form-list">
                                	<?php
										$getStatus = $image_head->get_enum_values('status');
										$i = 1;
										foreach ($getStatus as $status) {
									?>
                                    <li><input type="radio" name="status" id="status" value="<?php echo $status?>" <?php echo ($image_head->GetPrimary() != "") ? ($image_head->GetValue('status') == $status) ? "checked=\"checked\"" : "" : ($i == 1) ? "checked=\"checked\"" : ""?> class="required"/> <label><?php echo $status?></label></li>
                                    <?php $i++; 
									     }        ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="btn-row">
                        <input type="submit" name="submit_bt" value="บันทึกข้อมูล" class="btn btn-success" />
                        <input type="submit" name="submit_bt" value="บันทึกข้อมูล และแก้ไขต่อ" class="btn btn-primary" />
                        <a href="<?php echo ADDRESS_ADMIN_CONTROL?>image_head" class="btn btn-danger">ยกเลิก</a>
                    </div>
                </form>
            </div>
        </div>
  	</div>
</div>
<?php }else{?> 


<div class="row-fluid">
    <div class="span12">
    	<?php
			// Report errors to the user
			SetAlert(GetAlert('error'));
			SetAlert(GetAlert('success'),'success');
		?>       
        <div class="da-panel collapsible">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    <i class="icol-grid"></i> รูปภาพ ทั้งหมด
                </span>
            </div>
            <div class="da-panel-toolbar">
                <div class="btn-toolbar">
                    <div class="btn-group"></div>
                </div>
            </div> 
            <div class="da-panel-content da-table-container">
                <table id="da-ex-datatable-sort" class="da-table" sort="0" order="asc" width="2000">
                    <thead>
                        <tr>
                            <th>รหัส</th>
                            <th>ชื่อภาพ</th>
							<th>ภาพสไลด์</th>
                            <th>สถานะ</th>                      
                            <th>แก้ไขล่าสุด</th>
                            <th>ตัวเลือก</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php
							$sql = "SELECT * FROM " . $image_head->getTbl();
							$query = $db->Query($sql);
							while ($row = $db->FetchArray($query)){
						?>
                        <tr>
                            <td class="center"><?php echo $row['id'];?></td>
                            <td><?php echo $row['image_name'];?></td>
                           	<td class="center"><img src="<?php echo   $image_head->getDataDesc("file_name","id = '" . $row['id'] . "'") == "" ? NO_IMAGE :  ADDRESS_HEAD. $image_head->getDataDesc("file_name","id = '" . $row['id'] . "'")?>" style="height:70px; width:150px;"></td>
                            <td class="center"><i class="icol-<?php echo ($row['status'] == 'ใช้งาน') ? 'accept' : 'cross'?>" title="<?php echo $row['status']?>"></i></td>
                            <td class="center"><?php echo $functions->ShowDateThTime($row['updated_at'])?></td>                           
                            <td class="center">
								<a href="<?php echo ADDRESS_ADMIN_CONTROL?>image_head&action=edit&id=<?php echo $row['id']?>" class="btn btn-primary btn-small">แก้ไข / ดู</a>
                                
							</td>
                        </tr>  
                        <?php }?>                      
                    </tbody>
                </table>
            </div>
        </div>        
    </div>                           	
</div>
<?php }?>
<script src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
<script type="text/javascript">

	
	function addfile(){
	
  	 $("#filecopy:first").clone().insertAfter("div #filecopy:last");
	}
	function delfile(){
  	 //$("#filecopy").clone().insertAfter("div #filecopy:last");
		 var conveniancecount = $("div #filecopy").length;
		 if(conveniancecount > 2){
			 $("div #filecopy:last").remove();
		 }
	}
	
	
//});
     
</script>

<style>
/*Colored Label Attributes*/
.label {
    background-color: #BFBFBF;
    border-bottom-left-radius: 3px;
    border-bottom-right-radius: 3px;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
    color: #FFFFFF;
    font-size: 9.75px;
    font-weight: bold;
    padding-bottom: 2px;
    padding-left: 4px;
    padding-right: 4px;
    padding-top: 2px;
    text-transform: uppercase;
    white-space: nowrap;
}

.label:hover {
	opacity: 80;
}

.label.success {
    background-color: #46A546;
}
.label.success2 {
    background-color: #CCC;
}
.label.success3 {
    background-color: #61a4e4;
	
}

.label.warning {
    background-color: #FC9207;
}

.label.failure {
    background-color: #D32B26;
}

.label.alert {
    background-color: #33BFF7;
}

.label.good-job {
    background-color: #9C41C6;
}




</style>