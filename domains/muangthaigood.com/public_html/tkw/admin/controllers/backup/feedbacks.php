<?php
	// If they are saving the Information	
	if ($_POST['submit_bt'] == 'บันทึกข้อมูล' || $_POST['submit_bt'] == 'บันทึกข้อมูล และแก้ไขต่อ'){
		if($_POST['submit_bt'] == 'บันทึกข้อมูล'){
			$redirect = true;
		}else{
			$redirect = false;
		}
		$arrData = array();
		$arrData = $functions->replaceQuote($_POST);
		
		// Get all the Form Data
		$feedbacks->SetValues($arrData);
		if($feedbacks->GetPrimary() == ''){
			$feedbacks->SetValue('created_at', DATE_TIME);
			$feedbacks->SetValue('updated_at', DATE_TIME);
		}else{
			$feedbacks->SetValue('updated_at', DATE_TIME);
		}
 
		$feedbacks->Save();
		if($feedbacks->Save()){			
			SetAlert('เพิ่ม แก้ไข ข้อมูลสำเร็จ','success');
			//Redirect if needed
			if ($redirect){
				header('location:' . ADDRESS_ADMIN_CONTROL . 'feedbacks');
				die();
			}else{
				header('location:' . ADDRESS_ADMIN_CONTROL . 'feedbacks&action=edit&id=' . $feedbacks->GetPrimary());
				die();
			}
		}else{
			SetAlert('ไม่สามารถเพิ่ม แก้ไข ข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
		}		
	}
	
	// If Deleting the Page
	if ($_GET['id'] != '' && $_GET['action'] == 'del'){
		// Get all the form data
		$arrDel = array('id' => $_GET['id']);
		$feedbacks->SetValues($arrDel);
		
		// Remove the info from the DB
		if ($feedbacks->Delete()){
			// Set alert and redirect
			SetAlert('Delete Data Success','success');
			header('location:' . ADDRESS_ADMIN_CONTROL . 'feedbacks');
			die();
		}else{
			SetAlert('ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
		}
	}
	
	if ($_GET['id'] != '' && $_GET['action'] == 'edit'){
		// For Update
		$feedbacks->SetPrimary((int)$_GET['id']);
		// Try to get the information
		if (!$feedbacks->GetInfo()){
			SetAlert('ไม่สามารถค้นหาข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
			$feedbacks->ResetValues();
		}
	}
	
?>

<?php if($_GET['action'] == "add" || $_GET['action'] == "edit"){?>
<div class="row-fluid">
    <div class="span12">
        <?php
			// Report errors to the user
			Alert(GetAlert('error'));
			Alert(GetAlert('success'),'success');
		?> 
        <div class="da-panel collapsible">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    <i class="icol-<?php echo ($feedbacks->GetPrimary() != '') ? 'application-edit' : 'add'?>"></i> <?php echo ($feedbacks->GetPrimary() != '') ? 'แก้ไข' : 'เพิ่ม'?> สมาชิก
                </span>
            </div>
            <div class="da-panel-content da-form-container">
                <form id="validate" enctype="multipart/form-data" action="<?php echo ADDRESS_ADMIN_CONTROL?>feedbacks<?php echo ($feedbacks->GetPrimary() != '') ? '&id=' . $feedbacks->GetPrimary() : ''; ?>" method="post" class="da-form">
                	<?php if($feedbacks->GetPrimary() != ''):?>
                    	<input type="hidden" name="id" value="<?php echo $feedbacks->GetPrimary()?>" />
                  		<input type="hidden" name="created_at" value="<?php echo $feedbacks->GetValue('created_at')?>" />
               		<?php endif;?>
                    <div class="da-form-inline">
                        <div class="da-form-row">
                            <label class="da-form-label">ชื่อ-นามสกุล <span class="required">*</span></label>
                            <div class="da-form-item large">
                                <input type="text" name="name" id="name" value="<?php echo ($feedbacks->GetPrimary() != '') ? $feedbacks->GetValue('name') : ''; ?>" class="span12 required" />
                            </div>
                        </div>
                        <div class="da-form-row">
                            <label class="da-form-label">ความคิดเห็น <span class="required">*</span></label>
                            <div class="da-form-item large">
                                <textarea name="comment" id="comment" class="span12 required"><?php echo ($feedbacks->GetPrimary() != '') ? $feedbacks->GetValue('comment') : ''; ?></textarea>
                            </div>
                        </div>                        
                        <div class="da-form-row">
                            <label class="da-form-label">สถานะ <span class="required">*</span></label>
                            <div class="da-form-item large">
                                <ul class="da-form-list">
                                	<?php
										$getStatus = $feedbacks->get_enum_values('status');
										$i = 1;
										foreach ($getStatus as $status) {
									?>
                                    <li><input type="radio" name="status" id="status" value="<?php echo $status?>" <?php echo ($feedbacks->GetPrimary() != "") ? ($feedbacks->GetValue('status') == $status) ? "checked=\"checked\"" : "" : ($i == 1) ? "checked=\"checked\"" : ""?> class="required"/> <label><?php echo $status?></label></li>
                                    <?php $i++; }?>
                                </ul>
                            </div>
                        </div>                        
                    </div>
                    <div class="btn-row">
                        <input type="submit" name="submit_bt" value="บันทึกข้อมูล" class="btn btn-success" />
                        <input type="submit" name="submit_bt" value="บันทึกข้อมูล และแก้ไขต่อ" class="btn btn-primary" />
                        <a href="<?php echo ADDRESS_ADMIN_CONTROL?>feedbacks" class="btn btn-danger">ยกเลิก</a>
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
			Alert(GetAlert('error'));
			Alert(GetAlert('success'),'success');
		?>          
        <div class="da-panel collapsible">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    <i class="icol-grid"></i> สมาชิก ทั้งหมด
                </span>
            </div>
            <div class="da-panel-toolbar">
                <div class="btn-toolbar">
                    <div class="btn-group">
                        <a class="btn" href="<?php echo ADDRESS_ADMIN_CONTROL?>feedbacks&action=add"><i class="icol-add"></i> เพิ่มข้อมูล</a>
                    </div>
                </div>
            </div> 
            <div class="da-panel-content da-table-container">
                <table id="da-ex-datatable-numberpaging" class="da-table">
                    <thead>
                        <tr>
                            <th>รหัส</th>
                            <th>ชื่อ-นามสกุล</th>
                            <th>สถานะ</th>                
                            <th>แก้ไขล่าสุด</th>
                            <th>ตัวเลือก</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php
							$sql = "SELECT * FROM " . $feedbacks->getTbl();
							$query = $db->Query($sql);
							while ($row = $db->FetchArray($query)){
						?>
                        <tr>
                            <td class="center"><?php echo $row['id'];?></td>
                            <td><?php echo $row['name'];?></td>
                            <td class="center"><i class="icol-<?php echo ($row['status'] == 'ยืนยันแล้ว') ? 'accept' : 'cross'?>" title="<?php echo $row['status']?>"></i></td>
                            <td class="center"><?php echo $functions->ShowDateThTime($row['updated_at'])?></td>
                            <td class="center">
								<a href="<?php echo ADDRESS_ADMIN_CONTROL?>feedbacks&action=edit&id=<?php echo $row['id']?>" class="btn btn-primary btn-small">แก้ไข / ดู</a>
                                <a href="#" onclick="if(confirm('คุณต้องการลบข้อมูลนี้หรือใม่?')==true){document.location.href='<?php echo ADDRESS_ADMIN_CONTROL?>feedbacks&action=del&id=<?php echo $row['id']?>'}" class="btn btn-danger btn-small">ลบ</a>
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