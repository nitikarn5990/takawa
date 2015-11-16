<?php
// If they are saving the Information	
if ($_POST['submit_bt'] == 'บันทึกข้อมูล' || $_POST['submit_bt'] == 'บันทึกข้อมูล และแก้ไขต่อ') {
    if ($_POST['submit_bt'] == 'บันทึกข้อมูล') {
        $redirect = true;
    } else {
        $redirect = false;
    }
    $arrData = array();
    $arrData = $functions->replaceQuote($_POST);

    if ($arrData['ref'] != "") {
        $arrData['manager_ref'] = $functions->seoTitle($arrData['ref']);
    } else {
        $arrData['manager_ref'] = $functions->seoTitle($arrData['manager_title']);
    }
   // print_r($arrData);
	
    $manager->SetValues($arrData);



    if ($manager->GetPrimary() == '') {
        $manager->SetValue('created_at', DATE_TIME);
        $manager->SetValue('updated_at', DATE_TIME);
    } else {
        $manager->SetValue('updated_at', DATE_TIME);
    }

    $manager->Save();
    if ($manager->Save()) {
        SetAlert('เพิ่ม แก้ไข ข้อมูลสำเร็จ', 'success');
        //Redirect if needed

        if (isset($_FILES['file_array'])) {

            $Allfile = "";
            $Allfile_ref = "";
            for ($i = 0; $i < count($_FILES['file_array']['tmp_name']); $i++) {
                if ($_FILES["file_array"]["name"][$i] != "") {
                    unset($arrData['webs_money_image']);

                    $targetPath = DIR_ROOT_FILES . "/";

                    $newImage = DATE_TIME_FILE . "_" . $_FILES['file_array']['name'][$i];

                    $cdir = getcwd(); // Save the current directory

                    chdir($targetPath);

                    copy($_FILES['file_array']['tmp_name'][$i], $targetPath . $newImage);

                    chdir($cdir); // Restore the old working directory   

                    $manager_file->SetValue('file_name', $newImage);
					
                    if ($_POST['file_name_ref'][$i] == '') {

                        //$Allfile_ref .= "|_|" . $newImage;
                        //$manager_file->SetValue('file_name', substr($Allfile, 3));
                        $manager_file->SetValue('file_name_ref', $newImage);
                    } else {
                        //$Allfile_ref .= "|_|" .   $functions->seoTitle($_POST['file_name_ref'][$i]);
                        $manager_file->SetValue('file_name_ref', $functions->seoTitle($_POST['file_name_ref'][$i]));
                    }

                    $manager_file->SetValue('manager_id', $manager->GetPrimary());
					$manager_file->SetValue('type', "image");
                    //$manager_file->Save();
                    if ($manager_file->Save()) {

                        //SetAlert('เพิ่ม แก้ไข ข้อมูลสำเร็จ','success');
                        $manager_file->ResetValues();
                    } else {
                        SetAlert('ไม่สามารถเพิ่ม แก้ไข ข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
                    }
                }
            }
        }


        if ($_FILES["cover_img_array"]["name"][0] != "") {

            $targetPath = DIR_ROOT_COVER . "/";

            $newImage = DATE_TIME_FILE . "_" . $_FILES['cover_img_array']['name'][0];

            $cdir = getcwd(); // Save the current directory

            chdir($targetPath);

            copy($_FILES['cover_img_array']['tmp_name'][0], $targetPath . $newImage);

            chdir($cdir); // Restore the old working directory   

            $manager->SetValue('cover_img', $newImage);

            if ($manager->Save()) {

                //SetAlert('เพิ่ม แก้ไข ข้อมูลสำเร็จ','success');
                //$manager->ResetValues();
            } else {
                SetAlert('ไม่สามารถเพิ่ม แก้ไข ข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
            }
        }
		
		//อัพโหลด ไฟล์เอกสาร
		
		  if ($_FILES["file_doc"]["name"] != "") {

            $targetPath = DIR_ROOT_DOCUMENT . "/";

            $newImage = DATE_TIME_FILE . "_" . $_FILES['file_doc']['name'];

            $cdir = getcwd(); // Save the current directory

            chdir($targetPath);

            copy($_FILES['file_doc']['tmp_name'], $targetPath . $newImage);

            chdir($cdir); // Restore the old working directory   
			$manager_file->SetValue('file_name', $newImage);
			$manager_file->SetValue('file_name_ref', $newImage);
			$manager_file->SetValue('type', "file");

                    $manager_file->SetValue('manager_id', $manager->GetPrimary());
                    //$manager_file->Save();
                    if ($manager_file->Save()) {

                        //SetAlert('เพิ่ม แก้ไข ข้อมูลสำเร็จ','success');
                        $manager_file->ResetValues();
                    } else {
                        SetAlert('ไม่สามารถเพิ่ม แก้ไข ข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
                    }

        }

   

        if ($redirect) {
            header('location:' . ADDRESS_ADMIN_CONTROL . 'manager');
            die();
        } else {
            header('location:' . ADDRESS_ADMIN_CONTROL . 'manager&action=edit&id=' . $manager->GetPrimary());
            die();
        }
    } else {
        SetAlert('ไม่สามารถเพิ่ม แก้ไข ข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
    }
}
//delete file
if ($_GET['manager_file_id'] != '' && $_GET['action'] == 'edit') {

    $manager_file->SetPrimary((int) $_GET['manager_file_id']);

    if ($manager_file->Delete()) {
        // Set alert and redirect
        if (unlink(DIR_ROOT_FILES . $manager_file->GetValue('file_name'))) {
            //	fulldelete($location); 
            SetAlert('Delete Data Success', 'success');
        }
    } else {
        SetAlert('ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
        //	echo $_GET['manager_file_id'];
    }
}
//delete cover image
if ($_GET['cover_img_id'] != '' && $_GET['action'] == 'edit') {

    $arrImage = array(
        'cover_img' => '',
        'updated_at' => DATE_TIME
    );

    $arrImgID = array("id" => $_GET['cover_img_id']);

    if ($manager->updateSQL($arrImage, $arrImgID)) {
        if (unlink(DIR_ROOT_COVER . $manager->GetValue('cover_img'))) {
            //SetAlert('Delete Data Success','success');
        }
    } else {
        SetAlert('ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
    }
}

//delete document
if ($_GET['document_id'] != '' && $_GET['action'] == 'edit') {

     $manager_file->SetPrimary((int) $_GET['document_id']);

    if ($manager_file->Delete()) {
        // Set alert and redirect
        if (unlink(DIR_ROOT_DOCUMENT . $manager_file->GetValue('file_name'))) {
            //	fulldelete($location); 
            SetAlert('Delete Data Success', 'success');
        }
    } else {
        SetAlert('ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
        //	echo $_GET['manager_file_id'];
    }
}

// If Deleting the Page
if ($_GET['id'] != '' && $_GET['action'] == 'del') {
    // Get all the form data
    $arrDel = array('id' => $_GET['id']);
    $manager->SetValues($arrDel);

    // Remove the info from the DB
    if ($manager->Delete()) {
        // Set alert and redirect
        SetAlert('Delete Data Success', 'success');
        header('location:' . ADDRESS_ADMIN_CONTROL . 'manager');
        die();
    } else {
        SetAlert('ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
    }
}

if ($_GET['id'] != '' && $_GET['action'] == 'edit') {
    // For Update
    $manager->SetPrimary((int) $_GET['id']);
    // Try to get the information
    if (!$manager->GetInfo()) {
        SetAlert('ไม่สามารถค้นหาข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
        $manager->ResetValues();
    }
}
?>
<?php if ($_GET['action'] == "add" || $_GET['action'] == "edit") { ?>
<div class="row-fluid">
  <div class="span12">
    <?php
            // Report errors to the user
            Alert(GetAlert('error'));
            Alert(GetAlert('success'), 'success');
            ?>
    <div class="da-panel collapsible">
      <div class="da-panel-header"> <span class="da-panel-title"> <i class="icol-<?php echo ($manager->GetPrimary() != '') ? 'application-edit' : 'add' ?>"></i> <?php echo ($manager->GetPrimary() != '') ? 'แก้ไข' : 'เพิ่ม' ?> โครงสร้างองค์กร </span> </div>
      <div class="da-panel-content da-form-container">
        <form id="validate" enctype="multipart/form-data" action="<?php echo ADDRESS_ADMIN_CONTROL ?>manager<?php echo ($manager->GetPrimary() != '') ? '&id=' . $manager->GetPrimary() : ''; ?>" method="post" class="da-form">
          <?php if ($manager->GetPrimary() != ''): ?>
          <input type="hidden" name="id" value="<?php echo $manager->GetPrimary() ?>" />
          <input type="hidden" name="created_at" value="<?php echo $manager->GetValue('created_at') ?>" />
          <input type="hidden" name="cover_img" value="<?php echo $manager->GetValue('cover_img') ?>" />
          <?php endif; ?>
          <div class="da-form-inline">
            <div class="da-form-row">
              <label class="da-form-label">เรื่องโครงสร้างองค์กร <span class="required">*</span></label>
              <div class="da-form-item large">
                <input type="text" name="manager_title" id="manager_title" value="<?php echo ($manager->GetPrimary() != '') ? $manager->GetValue('manager_title') : ''; ?>" class="span12 required" />
              </div>
            </div>
            <div class="da-form-row">
              <label class="da-form-label">ชื่อใช้อ้างอิง / URL</label>
              <div class="da-form-item large">
                <input type="text" name="ref" id="ref" value="<?php echo ($manager->GetPrimary() != '') ? $manager->GetValue('manager_ref') : ''; ?>" class="span12" />
                <label class="help-block">ว่างไว้ถ้าต้องการให้สร้างชื่ออ้างอิงอัตโนมัติ</label>
              </div>
            </div>
            <div class="da-form-row">
              <label class="da-form-label">กลุ่มโครงสร้างองค์กร <span class="required">*</span></label>
              <div class="da-form-item large">
                <select id="manager_categories_id" name="manager_categories_id" class="span12 select2 required">
                  <option value=""></option>
                  <?php $manager_categories->CreateDataList("id", "manager_categories", "status='ใช้งาน'", ($manager->GetPrimary() != "") ? $manager->GetValue('manager_categories_id') : "") ?>
                </select>
              </div>
            </div>
            <div class="da-form-row">
              <label class="da-form-label">เนื้อหาโครงสร้างองค์กร <span class="required">*</span></label>
              <div class="da-form-item large">
                <textarea name="manager" id="manager" class="span12 tinymce required"><?php echo ($manager->GetPrimary() != '') ? $manager->GetValue('manager') : ''; ?></textarea>
                <label for="manager" generated="true" class="error" style="display:none;"></label>
              </div>
            </div>
            <div class="da-form-row hidden">
              <label class="da-form-label">โครงสร้างองค์กรย่อ <span class="required">*</span></label>
              <div class="da-form-item large">
                <textarea name="short_manager" id="short_manager" class="span12"><?php echo ($manager->GetPrimary() != '') ? $manager->GetValue('short_manager') : ''; ?></textarea>
              </div>
            </div>
            <div class="da-form-row hidden">
              <label class="da-form-label">เพิ่มลิ้งภายนอก </label>
              <div class="da-form-item large">
                <input type="text" name="external_link" id="manager_title" value="<?php echo ($manager->GetPrimary() != '') ? $manager->GetValue('external_link') : ''; ?>" class="span12" />
              </div>
            </div>
            <div class="da-form-row hidden">
              <label class="da-form-label">ชื่อใช้อ้างอิงลิ้งภายนอก</label>
              <div class="da-form-item large">
                <input type="text" name="external_link_ref" id="ref" value="<?php echo ($manager->GetPrimary() != '') ? $manager->GetValue('external_link_ref') : ''; ?>" class="span12" />
                <label class="help-block"></label>
              </div>
            </div>
            <div style="visibility:hidden;">
              <div class="da-form-item large" id="filecopy"> <span class="formNote"><strong>ชื่อใช้อ้างอิง</strong> </span>
                <input type="text" placeholder="ว่างไว้ถ้าต้องการให้สร้างชื่ออ้างอิงอัตโนมัติ" name="file_name_ref[]">
                <input type="file" name="file_array[]" id="image"  class="span4" />
                <a href="javascript:addfile();" >เพิ่ม</a> <a href="javascript:delfile();" >ลบ</a>
                <label class="help-block">ไฟล์เอกสาร</label>
              </div>
            </div>
            <fieldset class="da-form-inline hidden">
              <legend><i class="fa fa-picture-o"></i> อัพโหลดภาพ [JPG, PNG, GIF]</legend>
              <div class="da-form-row">
                <label class="da-form-label">ไฟล์ที่อัพโหลด</label>
                <div class="da-form-item default">
                  <ul>
                    <?php
                                    $sql = "SELECT * FROM " . $manager_file->getTbl() . " WHERE manager_id = '" . $manager->GetPrimary() . "' AND type = 'image'";
                                    $query = $db->Query($sql);
                                    if ($db->NumRows($query) > 0) {
										
	
                                        while ($row = $db->FetchArray($query)) {
											
                                           ?>
                    <li>
                      <div class="span4">
                        <p> <a class="fancybox" href="<?php echo ADDRESS_FILE . $row['file_name'] ?>"> <img class="img-polaroid" src="<?php echo ADDRESS_FILE . $row['file_name'] ?>" style="width:150px; height:150px;"/></a> <span class=""> <a class="da-button red small" href="<?php echo ADDRESS_ADMIN_CONTROL ?>manager&action=edit&id=<?php echo $_GET['id'] ?>&manager_file_id=<?php echo $row['id'] ?>" style="color:#FFF; size:20px; text-decoration: none;" onclick="return confirm('Are you sure you want to delete?')" > ลบไฟล์ </a></span> </p>
                      </div>
                    </li>
                    <?php $k++;
                                        }
                                    }
                                    ?>
                  </ul>
                </div>
              </div>
              <div class="da-form-row">
                <label class="da-form-label">อัพโหลดไฟล์</label>
                <div class="da-form-item large" id="filecopy">
                  <?php if ($manager->GetValue('file_name') != "") { ?>
                  <div class="img-block" style="margin-bottom:10px"> <a href="<?php echo ADDRESS_FILE . "/" . $manager->GetValue('file_name') ?>">
                    <?php //echo $manager->GetValue('file_name_ref')?>
                    </a> </div>
                  <?php } ?>
                  <input type="hidden" placeholder="ว่างไว้ถ้าต้องการให้สร้างชื่ออ้างอิงอัตโนมัติ" name="file_name_ref[]">
                  <input id="input-2" type="file" class="file" name="file_array[]" data-show-upload="false" data-show-caption="true" multiple=true>
                  <div id="errorBlock43" class="help-block"></div>
                </div>
              </div>
            </fieldset>
            <fieldset class="da-form-inline hidden">
              <legend><i class="fa fa-picture-o"></i> อัพโหลดภาพหน้าปก [JPG, PNG, GIF]</legend>
              <div class="da-form-row">
                <label class="da-form-label">ภาพหน้าปก</label>
                <div class="da-form-item large">
                  <?php
                                    $sql = "SELECT * FROM " . $manager->getTbl() . " WHERE id = '" . $manager->GetPrimary() . "' AND cover_img not in('')";
                                    $query = $db->Query($sql);
                                    if ($db->NumRows($query) > 0) {

                                        while ($row = $db->FetchArray($query)) {
                                            ?>
                  <div class="span4">
                    <p> <a class="fancybox" href="<?php echo ADDRESS_COVER . $row['cover_img'] ?>"> <img class="img-polaroid" src="<?php echo ADDRESS_COVER . $row['cover_img'] ?>" style="max-width:150px;"/></a> <span class=""> <a class="da-button red small" href="<?php echo ADDRESS_ADMIN_CONTROL ?>manager&action=edit&id=<?php echo $_GET['id'] ?>&cover_img_id=<?php echo $row['id'] ?>" style="color:#FFF; size:20px; text-decoration: none;" onclick="return confirm('Are you sure you want to delete?')" > ลบไฟล์ </a></span> </p>
                  </div>
                  <?php
                                        }
                                    }
                                    ?>
                </div>
              </div>
              <div class="da-form-row">
                <label class="da-form-label">อัพโหลดภาพหน้าปก</label>
                <div class="da-form-item large">
                  <input id="input-3" type="file" class="file" name="cover_img_array[]" data-show-upload="false" data-show-caption="true" multiple=true>
                  <div id="errorBlock44" class="help-block"></div>
                </div>
              </div>
            </fieldset>
            <fieldset class="da-form-inline hidden">
              <legend><i class="fa fa-file-archive-o"></i> อัพโหลดไฟล์</legend>
              <div class="da-form-row">
                <label class="da-form-label">ไฟล์</label>
                <div class="da-form-item large">
                <ul>
                 <li>
                	 <?php
                                    $sql = "SELECT * FROM " . $manager_file->getTbl() . " WHERE manager_id = '" . $manager->GetPrimary() . "' AND type = 'file'";
                                    $query = $db->Query($sql);
                                    if ($db->NumRows($query) > 0) {

                                        while ($row = $db->FetchArray($query)) {
                                            ?>
                                           
                  <div class="row">
                    <p> <a class="file_link" href="<?php echo ADDRESS_DOCUMENT . $row['file_name_ref'] ?>"> <?=$row['file_name_ref']?></a> 
                    <span class=""> 
                    <a class="da-button red small" href="<?php echo ADDRESS_ADMIN_CONTROL ?>manager&action=edit&id=<?php echo $_GET['id'] ?>&document_id=<?php echo $row['id'] ?>" style="color:#FFF; size:20px; text-decoration: none;" onclick="return confirm('Are you sure you want to delete?')" > ลบไฟล์ </a></span> </p>
                  </div>
                  <?php
                                        }
										
                                    }
									
								
                                    ?>
                                    </li>
                 </ul>	
                </div>
              </div>
              <div class="da-form-row">
                <label class="da-form-label">อัพโหลดไฟล์</label>
                <div class="da-form-item large">
                  <input id="input-4" type="file" class="file" name="file_doc" data-show-upload="false" data-show-caption="true" data-show-preview="false">
                  <div id="errorBlock45" class="help-block"></div>
                </div>
              </div>
            </fieldset>
            <div class="da-form-row hidden">
              <label class="da-form-label">จัดลำดับ <span class="required">*</span></label>
              <div class="da-form-item large">
                <input type="number" name="sort" id="sort" value="<?php echo ($manager->GetPrimary() != '') ? $manager->GetValue('sort') : '0'; ?>" class="span12" />
              </div>
            </div>
            <div class="da-form-row">
              <label class="da-form-label">สถานะ <span class="required">*</span></label>
              <div class="da-form-item large">
                <ul class="da-form-list">
                  <?php
                                        $getStatus = $manager->get_enum_values('status');
                                        $i = 1;
                                        foreach ($getStatus as $status) {
                                            ?>
                  <li>
                    <input type="radio" name="status" id="status" value="<?php echo $status ?>" <?php echo ($manager->GetPrimary() != "") ? ($manager->GetValue('status') == $status) ? "checked=\"checked\"" : "" : ($i == 1) ? "checked=\"checked\"" : "" ?> class="required"/>
                    <label><?php echo $status ?></label>
                  </li>
                  <?php $i++;
                                        }
                                        ?>
                </ul>
              </div>
            </div>
            <div class="da-form-row hidden">
              <label class="da-form-label">โครงสร้างองค์กรของวันที <span class="required">*</span></label>
              <div class="da-form-item large">
                <input type="text" readonly="readonly" name="activity_date" id="activity_date" value="<?php echo DATE ?>" class="span12 required" />
              </div>
            </div>
          </div>
          <div class="btn-row">
            <input type="submit" name="submit_bt" value="บันทึกข้อมูล" class="btn btn-success" />
            <input type="submit" name="submit_bt" value="บันทึกข้อมูล และแก้ไขต่อ" class="btn btn-primary" />
            <a href="<?php echo ADDRESS_ADMIN_CONTROL ?>manager" class="btn btn-danger">ยกเลิก</a> </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php } else { ?>
<div class="row-fluid">
  <div class="span12">
    <?php
            // Report errors to the user
            Alert(GetAlert('error'));
            Alert(GetAlert('success'), 'success');
            ?>
    <div class="da-panel collapsible">
      <div class="da-panel-header"> <span class="da-panel-title"> <i class="icol-grid"></i> โครงสร้างองค์กร ทั้งหมด </span> </div>
      <div class="da-panel-toolbar">
        <div class="btn-toolbar">
          <div class="btn-group"> <a class="btn" href="<?php echo ADDRESS_ADMIN_CONTROL ?>manager&action=add"><i class="icol-add"></i> เพิ่มข้อมูล</a> </div>
        </div>
      </div>
      <div class="da-panel-content da-table-container">
       
          <table id="da-ex-datatable-sort" class="da-table" sort="0" order="asc" width="1000">
          <thead>
            <tr>
              <th>รหัส</th>
              <th>ชื่อโครงสร้างองค์กร</th>
              <th>กลุ่มโครงสร้างองค์กร</th>
              <th>สถานะ</th>
              <th>แก้ไขล่าสุด</th>
              <th>ตัวเลือก</th>
            </tr>
          </thead>
          <tbody>
            <?php
                            $sql = "SELECT * FROM " . $manager->getTbl();
                            $query = $db->Query($sql);
                            while ($row = $db->FetchArray($query)) {
                                ?>
            <tr>
              <td class="center"><?php echo $row['id']; ?></td>
          
              <td><div class="word-wrap"><?php echo $row['manager_title']; ?></div></td>
              <td><?php echo $manager_categories->getDataDesc("manager_categories", "id = '" . $row['manager_categories_id'] . "'") ?></td>
              <td class="center"><div class="word-wrap"><i class="icol-<?php echo ($row['status'] == 'ใช้งาน') ? 'accept' : 'cross' ?>" title="<?php echo $row['status'] ?>"></i></div></td>
              <td class="center"><div class="word-wrap"><?php echo $functions->ShowDateThTime($row['updated_at']) ?></div></td>
           
              <td class="center"><div class="word-wrap"> <a href="<?php echo ADDRESS_ADMIN_CONTROL ?>manager&action=edit&id=<?php echo $row['id'] ?>" class="btn btn-primary btn-small">แก้ไข / ดู</a> <a href="#" onclick="if (confirm('คุณต้องการลบข้อมูลนี้หรือใม่?') == true) {
                                                    document.location.href = '<?php echo ADDRESS_ADMIN_CONTROL ?>manager&action=del&id=<?php echo $row['id'] ?>'
                                                            }" class="btn btn-danger btn-small">ลบ</a> </div></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php } ?>
<script src="<?php echo ADDRESS_ADMIN ?>plugins/fileinput/js/fileinput.min.js" type="text/javascript"></script> 
<script src="<?php echo ADDRESS_ADMIN ?>plugins/fileinput/js/fileinput_locale_th.js" type="text/javascript"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script> 

<script type="text/javascript">
$('#short_manager').maxlength({max: 300});
                                                $("#input-2").fileinput({
                                                    language: "th",
                                                    allowedFileExtensions: ["jpg", "gif", "png"],
                                                    elErrorContainer: "#errorBlock43",
                                                });
                                                $("#input-3").fileinput({
                                                    language: "th",
                                                    allowedFileExtensions: ["jpg", "gif", "png"],
                                                    elErrorContainer: "#errorBlock44",
                                                });
												$("#input-4").fileinput({
                                                    language: "th",
                                                 
                                                    elErrorContainer: "#errorBlock45",
                                                });


                                                $(document).ready(function () {


                                                    $(".fancybox").fancybox({
                                                        prevEffect: 'none',
                                                        nextEffect: 'none',
                                                        closeBtn: false,
                                                        helpers: {
                                                            title: {type: 'inside'},
                                                            buttons: {}
                                                        }
                                                    });



                                                });


</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">


<script>
    $(function () {
        // $( "#datepicker" ).datepicker();
        $("#activity_date").datepicker({dateFormat: "yy-mm-dd"}).val()
    });
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
	table th{
		 overflow : auto;
	}


</style>
