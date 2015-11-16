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
			$arrData['content_categories_ref'] = $functions->seoTitle($arrData['ref']);
		}else{
			$arrData['content_categories_ref'] = $functions->seoTitle($arrData['content_categories']);
		}
		
		// Get all the Form Data
		$content_categories->SetValues($arrData);
		if($content_categories->GetPrimary() == ''){
			$content_categories->SetValue('created_at', DATE_TIME);
			$content_categories->SetValue('updated_at', DATE_TIME);
		}else{
			$content_categories->SetValue('updated_at', DATE_TIME);
		}
 
		$content_categories->Save();
		if($content_categories->Save()){			
			SetAlert('เพิ่ม แก้ไข ข้อมูลสำเร็จ','success');
			//Redirect if needed
			if ($redirect){
				header('location:' . ADDRESS_ADMIN_CONTROL . 'content_categories');
				die();
			}else{
				header('location:' . ADDRESS_ADMIN_CONTROL . 'content_categories&action=edit&id=' . $content_categories->GetPrimary());
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
		$content_categories->SetValues($arrDel);
		
		// Remove the info from the DB
		if ($content_categories->Delete()){
			// Set alert and redirect
			SetAlert('Delete Data Success','success');
			header('location:' . ADDRESS_ADMIN_CONTROL . 'content_categories');
			die();
		}else{
			SetAlert('ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
		}
	}
	
	if ($_GET['id'] != '' && $_GET['action'] == 'edit'){
		// For Update
		$content_categories->SetPrimary((int)$_GET['id']);
		// Try to get the information
		if (!$content_categories->GetInfo()){
			SetAlert('ไม่สามารถค้นหาข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
			$content_categories->ResetValues();
		}
	}
	
?>

<?php if($_GET['action'] == "add" || $_GET['action'] == "edit"){?>
<div class="row-fluid">	
    <div class="span12">        
        <div class="da-panel collapsible">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    <i class="icol-<?php echo ($content_categories->GetPrimary() != '') ? 'application-edit' : 'add'?>"></i> <?php echo ($content_categories->GetPrimary() != '') ? 'แก้ไข' : 'เพิ่ม'?> หมวดหมู่ข่าวสาร
                </span>
            </div>
            <div class="da-panel-content da-form-container">
                <form id="validate" enctype="multipart/form-data" action="<?php echo ADDRESS_ADMIN_CONTROL?>content_categories<?php echo ($content_categories->GetPrimary() != '') ? '&id=' . $content_categories->GetPrimary() : ''; ?>" method="post" class="da-form">
                	<?php if($content_categories->GetPrimary() != ''):?>
                    	<input type="hidden" name="id" value="<?php echo $content_categories->GetPrimary()?>" />
                  		<input type="hidden" name="created_at" value="<?php echo $content_categories->GetValue('created_at')?>" />
               		<?php endif;?>
                    <div class="da-form-inline">
                        <div class="da-form-row">
                            <label class="da-form-label">ชื่อหมวดหมู่ <span class="required">*</span></label>
                            <div class="da-form-item large">
                                <input type="text" name="content_categories" id="content_categories" value="<?php echo ($content_categories->GetPrimary() != '') ? $content_categories->GetValue('content_categories') : ''; ?>" class="span12 required" />
                            </div>
                        </div>
                        <div class="da-form-row">
                            <label class="da-form-label">ชื่อใช้อ้างอิง / URL</label>
                            <div class="da-form-item large">
                                <input type="text" name="ref" id="ref" value="<?php echo ($content_categories->GetPrimary() != '') ? $content_categories->GetValue('content_categories_ref') : ''; ?>" class="span12" />
                                <label class="help-block">ว่างไว้ถ้าต้องการให้สร้างชื่ออ้างอิงอัตโนมัติ</label>
                            </div>
                        </div>
                        <div class="da-form-row">
                            <label class="da-form-label">สถานะ <span class="required">*</span></label>
                            <div class="da-form-item large">
                                <ul class="da-form-list">
                                	<?php
										$getStatus = $content_categories->get_enum_values('status');
										$i = 1;
										foreach ($getStatus as $status) {
									?>
                                    <li><input type="radio" name="status" id="status" value="<?php echo $status?>" <?php echo ($content_categories->GetPrimary() != "") ? ($content_categories->GetValue('status') == $status) ? "checked=\"checked\"" : "" : ($i == 1) ? "checked=\"checked\"" : ""?> class="required"/> <label><?php echo $status?></label></li>
                                    <?php $i++; }?>
                                </ul>
                                <label for="status" class="error" generated="true" style="display:none;"></label>
                            </div>
                        </div>
                    </div>
                    <div class="btn-row">
                        <input type="submit" name="submit_bt" value="บันทึกข้อมูล" class="btn btn-success" />
                        <input type="submit" name="submit_bt" value="บันทึกข้อมูล และแก้ไขต่อ" class="btn btn-primary" />
                        <a href="<?php echo ADDRESS_ADMIN_CONTROL?>content_categories" class="btn btn-danger">ยกเลิก</a>
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
                    <i class="icol-grid"></i> หมวดหมู่ข่าวสาร ทั้งหมด
                </span>
            </div>
            <div class="da-panel-toolbar">
                <div class="btn-toolbar">
                    <div class="btn-group">
                        <a class="btn" href="<?php echo ADDRESS_ADMIN_CONTROL?>content_categories&action=add"><i class="icol-add"></i> เพิ่มข้อมูล</a>
                    </div>
                </div>
            </div> 
            <div class="da-panel-content da-table-container">
                <table id="da-ex-datatable-sort" class="da-table" sort="0" order="asc">
                    <thead>
                        <tr>
                            <th>รหัส</th>
                            <th>หมวดหมู่</th>
                            <th>อ้างอิง</th>
                            <th>สถานะ</th>
                            <th>แก้ไขล่าสุด</th>
                            <th>ตัวเลือก</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php
							$sql = "SELECT * FROM " . $content_categories->getTbl();
							$query = $db->Query($sql);
							while ($row = $db->FetchArray($query)){
						?>
                        <tr>
                            <td class="center"><?php echo $row['id'];?></td>
                            <td><?php echo $row['content_categories'];?></td>
                            <td><?php echo $row['content_categories_ref'];?></td>
                            <td class="center"><i class="icol-<?php echo ($row['status'] == 'ใช้งาน') ? 'accept' : 'cross'?>" title="<?php echo $row['status']?>"></i></td>
                            <td class="center"><?php echo $functions->ShowDateThTime($row['updated_at'])?></td>
                            <td class="center">
								<a href="<?php echo ADDRESS_ADMIN_CONTROL?>content_categories&action=edit&id=<?php echo $row['id']?>" class="btn btn-primary btn-small">แก้ไข / ดู</a>
                                <a href="#" onclick="if(confirm('คุณต้องการลบข้อมูลนี้หรือใม่?')==true){document.location.href='<?php echo ADDRESS_ADMIN_CONTROL?>content_categories&action=del&id=<?php echo $row['id']?>'}" class="btn btn-danger btn-small">ลบ</a>
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