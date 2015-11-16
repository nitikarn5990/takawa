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
			$arrData['coures_categories_ref'] = $functions->seoTitle($arrData['ref']);
		}else{
			$arrData['coures_categories_ref'] = $functions->seoTitle($arrData['coures_categories']);
		}
		
		// Get all the Form Data
		$coures_categories->SetValues($arrData);
		if($coures_categories->GetPrimary() == ''){
			$coures_categories->SetValue('created_at', DATE_TIME);
			$coures_categories->SetValue('updated_at', DATE_TIME);
		}else{
			$coures_categories->SetValue('updated_at', DATE_TIME);
		}
 
		$coures_categories->Save();
		if($coures_categories->Save()){			
			SetAlert('เพิ่ม แก้ไข ข้อมูลสำเร็จ','success');
			//Redirect if needed
			if ($redirect){
				header('location:' . ADDRESS_ADMIN_CONTROL . 'coures_categories');
				die();
			}else{
				header('location:' . ADDRESS_ADMIN_CONTROL . 'coures_categories&action=edit&id=' . $coures_categories->GetPrimary());
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
		$coures_categories->SetValues($arrDel);
		
		// Remove the info from the DB
		if ($coures_categories->Delete()){
			// Set alert and redirect
			SetAlert('Delete Data Success','success');
			header('location:' . ADDRESS_ADMIN_CONTROL . 'coures_categories');
			die();
		}else{
			SetAlert('ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
		}
	}
	
	if ($_GET['id'] != '' && $_GET['action'] == 'edit'){
		// For Update
		$coures_categories->SetPrimary((int)$_GET['id']);
		// Try to get the information
		if (!$coures_categories->GetInfo()){
			SetAlert('ไม่สามารถค้นหาข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
			$coures_categories->ResetValues();
		}
	}
	
?>

<?php if($_GET['action'] == "add" || $_GET['action'] == "edit"){?>
<div class="row-fluid">	
    <div class="span12">        
        <div class="da-panel collapsible">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    <i class="icol-<?php echo ($coures_categories->GetPrimary() != '') ? 'application-edit' : 'add'?>"></i> <?php echo ($coures_categories->GetPrimary() != '') ? 'แก้ไข' : 'เพิ่ม'?> หมวดหมู่หลักสูตร
                </span>
            </div>
            <div class="da-panel-content da-form-container">
                <form id="validate" enctype="multipart/form-data" action="<?php echo ADDRESS_ADMIN_CONTROL?>coures_categories<?php echo ($coures_categories->GetPrimary() != '') ? '&id=' . $coures_categories->GetPrimary() : ''; ?>" method="post" class="da-form">
                	<?php if($coures_categories->GetPrimary() != ''):?>
                    	<input type="hidden" name="id" value="<?php echo $coures_categories->GetPrimary()?>" />
                  		<input type="hidden" name="created_at" value="<?php echo $coures_categories->GetValue('created_at')?>" />
               		<?php endif;?>
                    <div class="da-form-inline">
                        <div class="da-form-row">
                            <label class="da-form-label">ชื่อหมวดหมู่ของหลักสูตร <span class="required">*</span></label>
                            <div class="da-form-item large">
                                <input type="text" name="coures_categories" id="coures_categories" value="<?php echo ($coures_categories->GetPrimary() != '') ? $coures_categories->GetValue('coures_categories') : ''; ?>" class="span12 required" />
                            </div>
                        </div>
                        <div class="da-form-row">
                            <label class="da-form-label">ชื่อใช้อ้างอิง / URL</label>
                            <div class="da-form-item large">
                                <input type="text" name="ref" id="ref" value="<?php echo ($coures_categories->GetPrimary() != '') ? $coures_categories->GetValue('coures_categories_ref') : ''; ?>" class="span12" />
                                <label class="help-block">ว่างไว้ถ้าต้องการให้สร้างชื่ออ้างอิงอัตโนมัติ</label>
                            </div>
                        </div>
                           <div class="da-form-row">
                                <label class="da-form-label">จัดลำดับ <span class="required">*</span></label>
                                <div class="da-form-item large">
                                    <input type="number" name="sort" id="sort" value="<?php echo ($coures_categories->GetPrimary() != '') ? $coures_categories->GetValue('sort') : '0'; ?>" class="span12" />
                                </div>
                            </div> 
                        <div class="da-form-row">
                            <label class="da-form-label">สถานะ <span class="required">*</span></label>
                            <div class="da-form-item large">
                                <ul class="da-form-list">
                                	<?php
										$getStatus = $coures_categories->get_enum_values('status');
										$i = 1;
										foreach ($getStatus as $status) {
									?>
                                    <li><input type="radio" name="status" id="status" value="<?php echo $status?>" <?php echo ($coures_categories->GetPrimary() != "") ? ($coures_categories->GetValue('status') == $status) ? "checked=\"checked\"" : "" : ($i == 1) ? "checked=\"checked\"" : ""?> class="required"/> <label><?php echo $status?></label></li>
                                    <?php $i++; }?>
                                </ul>
                                <label for="status" class="error" generated="true" style="display:none;"></label>
                            </div>
                        </div>
                    </div>
                    <div class="btn-row">
                        <input type="submit" name="submit_bt" value="บันทึกข้อมูล" class="btn btn-success" />
                        <input type="submit" name="submit_bt" value="บันทึกข้อมูล และแก้ไขต่อ" class="btn btn-primary" />
                        <a href="<?php echo ADDRESS_ADMIN_CONTROL?>coures_categories" class="btn btn-danger">ยกเลิก</a>
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
                    <i class="icol-grid"></i> หมวดหมู่หลักสูตร ทั้งหมด
                </span>
            </div>
            <div class="da-panel-toolbar">
                <div class="btn-toolbar">
                    <div class="btn-group">
                        <a class="btn" href="<?php echo ADDRESS_ADMIN_CONTROL?>coures_categories&action=add"><i class="icol-add"></i> เพิ่มข้อมูล</a>
                    </div>
                </div>
            </div> 
            <div class="da-panel-content da-table-container">
                <table id="da-ex-datatable-numberpaging" class="da-table">
                    <thead>
                        <tr>
                            <th>รหัส</th>
                            <th>หมวดหมู่</th>
                            <th>สถานะ</th>
                            <th>แก้ไขล่าสุด</th>
                            <th>ลำดับ</th>
                            <th>ตัวเลือก</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php
							$sql = "SELECT * FROM " . $coures_categories->getTbl();
							$query = $db->Query($sql);
							while ($row = $db->FetchArray($query)){
						?>
                        <tr>
                            <td class="center"><?php echo $row['id']; ?></td>
                            <td><?php echo $row['coures_categories'];?></td>
                            <td class="center"><i class="icol-<?php echo ($row['status'] == 'ใช้งาน') ? 'accept' : 'cross'?>" title="<?php echo $row['status']?>"></i></td>
                            <td class="center"><?php echo $functions->ShowDateThTime($row['updated_at'])?></td>
                            <td class="center"><?php echo $row['sort'];?></td>
                            <td class="center">
								<a href="<?php echo ADDRESS_ADMIN_CONTROL?>coures_categories&action=edit&id=<?php echo $row['id']?>" class="btn btn-primary btn-small">แก้ไข / ดู</a>
                                <a href="#" onclick="if(confirm('คุณต้องการลบข้อมูลนี้หรือใม่?')==true){document.location.href='<?php echo ADDRESS_ADMIN_CONTROL?>coures_categories&action=del&id=<?php echo $row['id']?>'}" class="btn btn-danger btn-small">ลบ</a>
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