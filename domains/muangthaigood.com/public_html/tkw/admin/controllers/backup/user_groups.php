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
		
		if($arrData['ref'] != ""){
			$arrData['user_groups_ref'] = $functions->seoTitle($arrData['ref']);
		}else{
			$arrData['user_groups_ref'] = $functions->seoTitle($arrData['user_groups']);
		}
		
		// Get all the Form Data
		$user_groups->SetValues($arrData);
		if($user_groups->GetPrimary() == ''){
			$user_groups->SetValue('created_at', DATE_TIME);
			$user_groups->SetValue('updated_at', DATE_TIME);
		}else{
			$user_groups->SetValue('updated_at', DATE_TIME);
		}
 
		$user_groups->Save();
		if($user_groups->Save()){			
			SetAlert('เพิ่ม แก้ไข ข้อมูลสำเร็จ','success');
			//Redirect if needed
			if ($redirect){
				header('location:' . ADDRESS_ADMIN_CONTROL . 'user_groups');
				die();
			}else{
				header('location:' . ADDRESS_ADMIN_CONTROL . 'user_groups&action=edit&id=' . $user_groups->GetPrimary());
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
		$user_groups->SetValues($arrDel);
		
		// Remove the info from the DB
		if ($user_groups->Delete()){
			// Set alert and redirect
			SetAlert('Delete Data Success','success');
			header('location:' . ADDRESS_ADMIN_CONTROL . 'user_groups');
			die();
		}else{
			SetAlert('ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
		}
	}
	
	if ($_GET['id'] != '' && $_GET['action'] == 'edit'){
		// For Update
		$user_groups->SetPrimary((int)$_GET['id']);
		// Try to get the information
		if (!$user_groups->GetInfo()){
			SetAlert('ไม่สามารถค้นหาข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
			$user_groups->ResetValues();
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
                    <i class="icol-<?php echo ($user_groups->GetPrimary() != '') ? 'application-edit' : 'add'?>"></i> <?php echo ($user_groups->GetPrimary() != '') ? 'แก้ไข' : 'เพิ่ม'?> กลุ่มของสมาชิก
                </span>
            </div>
            <div class="da-panel-content da-form-container">
                <form id="validate" enctype="multipart/form-data" action="<?php echo ADDRESS_ADMIN_CONTROL?>user_groups<?php echo ($user_groups->GetPrimary() != '') ? '&id=' . $user_groups->GetPrimary() : ''; ?>" method="post" class="da-form">
                	<?php if($user_groups->GetPrimary() != ''):?>
                    	<input type="hidden" name="id" value="<?php echo $user_groups->GetPrimary()?>" />
                  		<input type="hidden" name="created_at" value="<?php echo $user_groups->GetValue('created_at')?>" />
               		<?php endif;?>
                    <div class="da-form-inline">
                        <div class="da-form-row">
                            <label class="da-form-label">ชื่อกลุ่มสมาชิก <span class="required">*</span></label>
                            <div class="da-form-item large">
                                <input type="text" name="user_groups" id="user_groups" value="<?php echo ($user_groups->GetPrimary() != '') ? $user_groups->GetValue('user_groups') : ''; ?>" class="span12 required" />
                            </div>
                        </div>
                        <div class="da-form-row">
                            <label class="da-form-label">ชื่อใช้อ้างอิง</label>
                            <div class="da-form-item large">
                                <input type="text" name="ref" id="ref" value="<?php echo ($user_groups->GetPrimary() != '') ? $user_groups->GetValue('user_groups_ref') : ''; ?>" class="span12" />
                                <label class="help-block">ว่างไว้ถ้าต้องการให้สร้างชื่ออ้างอิงอัตโนมัติ</label>
                            </div>
                        </div>
                        <div class="da-form-row">
                            <label class="da-form-label">สถานะ <span class="required">*</span></label>
                            <div class="da-form-item large">
                                <ul class="da-form-list">
                                	<?php
										$getStatus = $user_groups->get_enum_values('status');
										$i = 1;
										foreach ($getStatus as $status) {
									?>
                                    <li><input type="radio" name="status" id="status" value="<?php echo $status?>" <?php echo ($user_groups->GetPrimary() != "") ? ($user_groups->GetValue('status') == $status) ? "checked=\"checked\"" : "" : ($i == 1) ? "checked=\"checked\"" : ""?> class="required"/> <label><?php echo $status?></label></li>
                                    <?php $i++; }?>
                                </ul>
                                <label for="status" class="error" generated="true" style="display:none;"></label>
                            </div>
                        </div>
                    </div>
                    <div class="btn-row">
                        <input type="submit" name="submit_bt" value="บันทึกข้อมูล" class="btn btn-success" />
                        <input type="submit" name="submit_bt" value="บันทึกข้อมูล และแก้ไขต่อ" class="btn btn-primary" />
                        <a href="<?php echo ADDRESS_ADMIN_CONTROL?>user_groups" class="btn btn-danger">ยกเลิก</a>
                    </div>
                </form>
            </div>
        </div>
  	</div>
</div>
<?php }else{?> 
<div class="row-fluid">	
    <div class="span12">      
        <div class="da-panel collapsible">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    <i class="icol-grid"></i> กลุ่มของสมาชิก ทั้งหมด
                </span>
            </div>
            <div class="da-panel-toolbar">
                <div class="btn-toolbar">
                    <div class="btn-group">
                        <a class="btn" href="<?php echo ADDRESS_ADMIN_CONTROL?>user_groups&action=add"><i class="icol-add"></i> เพิ่มข้อมูล</a>
                    </div>
                </div>
            </div> 
            <div class="da-panel-content da-table-container">
                <table id="da-ex-datatable-numberpaging" class="da-table">
                    <thead>
                        <tr>
                            <th>รหัส</th>
                            <th>ชื่อกลุ่ม</th>
                            <th>อ้างอิง</th>
                            <th>สถานะ</th>
                            <th>แก้ไขล่าสุด</th>
                            <th>ตัวเลือก</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php
							$sql = "SELECT * FROM " . $user_groups->getTbl();
							$query = $db->Query($sql);
							while ($row = $db->FetchArray($query)){
						?>
                        <tr>
                            <td class="center"><?php echo $row['id'];?></td>
                            <td><?php echo $row['user_groups'];?></td>
                            <td><?php echo $row['user_groups_ref'];?></td>
                            <td class="center"><i class="icol-<?php echo ($row['status'] == 'ใช้งาน') ? 'accept' : 'cross'?>" title="<?php echo $row['status']?>"></i></td>
                            <td class="center"><?php echo $functions->ShowDateThTime($row['updated_at'])?></td>
                            <td class="center">
								<a href="<?php echo ADDRESS_ADMIN_CONTROL?>user_groups&action=edit&id=<?php echo $row['id']?>" class="btn btn-primary btn-small">แก้ไข / ดู</a>
                                <a href="#" onclick="if(confirm('คุณต้องการลบข้อมูลนี้หรือใม่?')==true){document.location.href='<?php echo ADDRESS_ADMIN_CONTROL?>user_groups&action=del&id=<?php echo $row['id']?>'}" class="btn btn-danger btn-small">ลบ</a>
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