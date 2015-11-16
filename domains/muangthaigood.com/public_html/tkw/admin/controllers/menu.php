
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
        $arrData['ref'] = $functions->seoTitle($arrData['ref']);
    } else {
        $arrData['ref'] = $functions->seoTitle($arrData['menu_title']);
    }
    // Get all the Form Data
    $menu->SetValues($arrData);
    if ($menu->GetPrimary() == '') {
        $menu->SetValue('created_at', DATE_TIME);
        $menu->SetValue('updated_at', DATE_TIME);
    } else {
        $menu->SetValue('updated_at', DATE_TIME);
    }





    $menu->SetValues($arrData);



    if ($menu->GetPrimary() == '') {


        $menu->SetValue('created_at', DATE_TIME);


        $menu->SetValue('updated_at', DATE_TIME);
    } else {


        $menu->SetValue('updated_at', DATE_TIME);
    }



    //	$menu->Save();


    if ($menu->Save()) {


        SetAlert('เพิ่ม แก้ไข ข้อมูลสำเร็จ', 'success');


        //Redirect if needed


        if (isset($_FILES['file_array'])) {


            $Allfile = "";


            $Allfile_ref = "";


            for ($i = 0; $i < count($_FILES['file_array']['tmp_name']); $i++) {


                if ($_FILES["file_array"]["name"][$i] != "") {


                    unset($arrData['webs_money_image']);





                    $targetPath = DIR_ROOT_GALLERY . "/";





                    $newImage = DATE_TIME_FILE . "_" . $_FILES['file_array']['name'][$i];





                    $cdir = getcwd(); // Save the current directory





                    chdir($targetPath);





                    copy($_FILES['file_array']['tmp_name'][$i], $targetPath . $newImage);





                    chdir($cdir); // Restore the old working directory   





                    $menu_files->SetValue('file_name', $newImage);





                    if ($_POST['alt_tag'][$i] == '') {





                        //$Allfile_ref .= "|_|" . $newImage;
                        //$menu_files->SetValue('file_name', substr($Allfile, 3));


                        $menu_files->SetValue('alt_tag', $newImage);
                    } else {


                        //$Allfile_ref .= "|_|" .   $functions->seoTitle($_POST['alt_tag'][$i]);


                        $menu_files->SetValue('alt_tag', $functions->seoTitle($_POST['alt_tag'][$i]));
                    }


                    $menu_files->SetValue('menu_id', $menu->GetPrimary());


                    //$menu_files->Save();


                    if ($menu_files->Save()) {

                        //SetAlert('เพิ่ม แก้ไข ข้อมูลสำเร็จ','success');


                        $menu_files->ResetValues();
                    } else {


                        SetAlert('ไม่สามารถเพิ่ม แก้ไข ข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
                    }
                }
            }
        }


        ////////

        if ($redirect) {


            header('location:' . ADDRESS_ADMIN_CONTROL . 'menu');


            die();
        } else {


            header('location:' . ADDRESS_ADMIN_CONTROL . 'menu&action=edit&id=' . $menu->GetPrimary());


            die();
        }
    } else {


        SetAlert('ไม่สามารถเพิ่ม แก้ไข ข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
    }
}


if ($_GET['gallery_file_id'] != '' && $_GET['action'] == 'edit') {





    $menu_files->SetPrimary((int) $_GET['gallery_file_id']);


    if ($menu_files->Delete()) {


        // Set alert and redirect


        if (unlink(DIR_ROOT_GALLERY . $menu_files->GetValue('file_name'))) {


            //	fulldelete($location); 


            SetAlert('Delete Data Success', 'success');
        }
    } else {


        SetAlert('ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง');


        //	echo $_GET['gallery_file_id'];
    }
}


// If Deleting the Page


if ($_GET['id'] != '' && $_GET['action'] == 'del') {


    // Get all the form data


    $arrDel = array('id' => $_GET['id']);


    $menu->SetValues($arrDel);





    // Remove the info from the DB


    if ($menu->Delete()) {


        // Set alert and redirect


        SetAlert('Delete Data Success', 'success');


        header('location:' . ADDRESS_ADMIN_CONTROL . 'menu');


        die();
    } else {


        SetAlert('ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
    }
}





if ($_GET['id'] != '' && $_GET['action'] == 'edit') {


    // For Update


    $menu->SetPrimary((int) $_GET['id']);


    // Try to get the information


    if (!$menu->GetInfo()) {


        SetAlert('ไม่สามารถค้นหาข้อมูลได้ กรุณาลองใหม่อีกครั้ง');


        $menu->ResetValues();
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
                <div class="da-panel-header"> <span class="da-panel-title"> <i class="icol-<?php echo ($menu->GetPrimary() != '') ? 'application-edit' : 'add' ?>"></i> <?php echo ($menu->GetPrimary() != '') ? 'แก้ไข' : 'เพิ่ม' ?> menu </span> </div>
                <div class="da-panel-content da-form-container">
                    <form id="validate" enctype="multipart/form-data" action="<?php echo ADDRESS_ADMIN_CONTROL ?>menu<?php echo ($menu->GetPrimary() != '') ? '&id=' . $menu->GetPrimary() : ''; ?>" method="post" class="da-form">
                        <?php if ($menu->GetPrimary() != ''): ?>
                         <input type="hidden" name="_ref" value="<?php echo $menu->GetValue('ref') ?>" />
                            <input type="hidden" name="id" value="<?php echo $menu->GetPrimary() ?>" />
                            <input type="hidden" name="created_at" value="<?php echo $menu->GetValue('created_at') ?>" />
                        <?php endif; ?>
                        <div class="da-form-inline">
                            <div class="da-form-row">
                                <label class="da-form-label">ชื่อเมนู <span class="required">*</span></label>
                                <div class="da-form-item large">
                                    <input type="text" name="menu_title" id="menu_title" value="<?php echo ($menu->GetPrimary() != '') ? $menu->GetValue('menu_title') : ''; ?>" class="span12 required" />
                                </div>
                            </div>
                            <div class="da-form-row">
                                <label class="da-form-label">ชื่อใช้อ้างอิง / URL</label>
                                <div class="da-form-item large">
                                    <input type="text" name="ref" id="ref" value="<?php echo ($menu->GetPrimary() != '') ? $menu->GetValue('ref') : ''; ?>" class="span12" />
                                    <label class="help-block">ว่างไว้ถ้าต้องการให้สร้างชื่ออ้างอิงอัตโนมัติ</label>
                                </div>
                            </div>
                            <div class="da-form-row">
                                <label class="da-form-label">รายละเอียด<span class="required">*</span></label>
                                <div class="da-form-item large">
                                    <textarea name="menu_detail" id="menu_detail" class="span12 tinymce required"><?php echo ($menu->GetPrimary() != '') ? $menu->GetValue('menu_detail') : ''; ?></textarea>
                                    <label for="menu_detail" generated="true" class="error" style="display:none;"></label>
                                </div>
                            </div>
                            <div class="da-form-row">
                                <label class="da-form-label">ลำดับ <span class="required">*</span></label>
                                <div class="da-form-item large">
                                    <input type="number" name="sort" id="menu_title" value="<?php echo ($menu->GetPrimary() != '') ? $menu->GetValue('sort') : ''; ?>" class="span12 required" />
                                </div>
                            </div>
                        </div>
                        <div class="btn-row">
                            <input type="submit" name="submit_bt" value="บันทึกข้อมูล" class="btn btn-success" />
                            <input type="submit" name="submit_bt" value="บันทึกข้อมูล และแก้ไขต่อ" class="btn btn-primary" />

                    </form>
                </div>
            </div>
        </div>
    </div>
<?php }else { ?>

    <div class="row-fluid">
        <div class="span12">
            <?php
            // Report errors to the user
            Alert(GetAlert('error'));
            Alert(GetAlert('success'), 'success');
            ?>       
            <div class="da-panel collapsible">
                <div class="da-panel-header">
                    <span class="da-panel-title">
                        <i class="icol-grid"></i> Sub Menu ทั้งหมด
                    </span>
                </div>
                <div class="da-panel-toolbar">
                    <div class="btn-toolbar">
                        <div class="btn-group">
                            <a class="btn" href="<?php echo ADDRESS_ADMIN_CONTROL ?>menu&action=add"><i class="icol-add"></i> เพิ่มข้อมูล</a>
                        </div>
                        <div class="btn-group hidden">
                            <a class="btn" href="javascript:void(0);" id="checkDel"><i class="icol-cross"></i> ลบที่เลือก</a>
                        </div> 
                    </div>
                </div> 
                <div class="da-panel-content da-table-container">
                    <table id="da-ex-datatable-numberpaging" class="da-table" sort="0" order="asc">
                        <thead>
                            <tr>
                        
                                <th>รหัส</th>
                                <th>ชื่อ</th>
                                <th>แก้ไขล่าสุด</th>
                                <th>ลำดับ</th>
                                <th>ตัวเลือก</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM " . $menu->getTbl() . " ORDER BY sort";
                            $query = $db->Query($sql);
                            while ($row = $db->FetchArray($query)) {
                                ?>
                                <tr>
                                    <td  class="center"><?php echo $row['id']; ?></td>
                                    <td><div class="word-wrap"><?php echo $row['menu_title']; ?></div></td>
                                    <td class="center"><?php echo $functions->ShowDateThTime($row['updated_at']) ?></td>
                                    <td class="center"><?php echo $row['sort']; ?></td>
                                    <td class="center">
                                        <a href="<?php echo ADDRESS_ADMIN_CONTROL ?>menu&action=edit&id=<?php echo $row['id'] ?>" class="btn btn-primary btn-small">แก้ไข / ดู</a>
                                        <a href="#" onclick="if (confirm('คุณต้องการลบข้อมูลนี้หรือใม่?') == true) {
                                                            document.location.href = '<?php echo ADDRESS_ADMIN_CONTROL ?>menu&action=del&id=<?php echo $row['id'] ?>'
                                                                    }" class="btn btn-danger btn-small">ลบ</a>
                                    </td>
                                </tr>  
                            <?php } ?>                      
                        </tbody>
                    </table>
                </div>
            </div>        
        </div>                           	
    </div> 

<?php } ?>
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
