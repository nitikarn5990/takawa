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


    $slides->SetValues($arrData);



    if ($slides->GetPrimary() == '') {
        $slides->SetValue('created_at', DATE_TIME);
        $slides->SetValue('updated_at', DATE_TIME);
    } else {
        $slides->SetValue('updated_at', DATE_TIME);
    }

    $slides->Save();
    if ($slides->Save()) {
        SetAlert('เพิ่ม แก้ไข ข้อมูลสำเร็จ', 'success');
        //Redirect if needed

        if (isset($_FILES['file_array'])) {

            $Allfile = "";
            $Allfile_ref = "";
            for ($i = 0; $i < count($_FILES['file_array']['tmp_name']); $i++) {
                if ($_FILES["file_array"]["name"][$i] != "") {


                    $targetPath = DIR_ROOT_SLIDES . "/";

                    $newImage = DATE_TIME_FILE . "_" . $_FILES['file_array']['name'][$i];

                    $cdir = getcwd(); // Save the current directory

                    chdir($targetPath);

                    copy($_FILES['file_array']['tmp_name'][$i], $targetPath . $newImage);

                    chdir($cdir); // Restore the old working directory   

                    $slides_file->SetValue('file_name', $newImage);

                    if ($_POST['file_name_ref'][$i] == '') {

                        //$Allfile_ref .= "|_|" . $newImage;
                        //$gallery_file->SetValue('file_name', substr($Allfile, 3));
                        $slides_file->SetValue('file_name_ref', $newImage);
                    } else {
                        //$Allfile_ref .= "|_|" .   $functions->seoTitle($_POST['file_name_ref'][$i]);
                        $slides_file->SetValue('file_name_ref', $functions->seoTitle($_POST['file_name_ref'][$i]));
                    }

                    $slides_file->SetValue('slides_id', $slides->GetPrimary());
                    //$gallery_file->Save();
                    if ($slides_file->Save()) {

                        //SetAlert('เพิ่ม แก้ไข ข้อมูลสำเร็จ','success');
                        $slides_file->ResetValues();
                    } else {
                        SetAlert('ไม่สามารถเพิ่ม แก้ไข ข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
                    }
                }
            }
        }
        ////////

        if ($redirect) {
            header('location:' . ADDRESS_ADMIN_CONTROL . 'slides');
            die();
        } else {
            header('location:' . ADDRESS_ADMIN_CONTROL . 'slides&action=edit&id=' . $slides->GetPrimary());
            die();
        }
    } else {
        SetAlert('ไม่สามารถเพิ่ม แก้ไข ข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
    }
}
if ($_GET['slides_file_id'] != '' && $_GET['action'] == 'edit') {

    $slides_file->SetPrimary((int) $_GET['slides_file_id']);

    if ($slides_file->Delete()) {
        // Set alert and redirect
        if (unlink(DIR_ROOT_SLIDES . $slides_file->GetValue('file_name'))) {
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
    $slides->SetValues($arrDel);

    // Remove the info from the DB
    if ($slides->DeleteMultiID($_GET['id'])) {

        // Set alert and redirect
        SetAlert('Delete Data Success', 'success');
        header('location:' . ADDRESS_ADMIN_CONTROL . 'slides');
        die();
    } else {
        SetAlert('ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
    }
}

if ($_GET['id'] != '' && $_GET['action'] == 'edit') {
    // For Update
    $slides->SetPrimary((int) $_GET['id']);
    // Try to get the information
    if (!$slides->GetInfo()) {
        SetAlert('ไม่สามารถค้นหาข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
        $slides->ResetValues();
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
                <div class="da-panel-header">
                    <span class="da-panel-title">
                        <i class="icol-<?php echo ($slides->GetPrimary() != '') ? 'application-edit' : 'add' ?>"></i> <?php echo ($slides->GetPrimary() != '') ? 'แก้ไข' : 'เพิ่ม' ?> รูปภาพ
                    </span>
                </div>
                <div class="da-panel-content da-form-container">
                    <form id="validate" enctype="multipart/form-data" action="<?php echo ADDRESS_ADMIN_CONTROL ?>slides<?php echo ($slides->GetPrimary() != '') ? '&id=' . $slides->GetPrimary() : ''; ?>" method="post" class="da-form">
                        <?php if ($slides->GetPrimary() != ''): ?>
                            <input type="hidden" name="id" value="<?php echo $slides->GetPrimary() ?>" />
                            <input type="hidden" name="created_at" value="<?php echo $slides->GetValue('created_at') ?>" />
                        <?php endif; ?>
                        <div class="da-form-inline">
                            <div class="da-form-row">
                                <label class="da-form-label">ชื่อภาพ <span class="required">*</span></label>
                                <div class="da-form-item large">
                                    <input type="text" name="slides_name" id="slides_name" value="<?php echo ($slides->GetPrimary() != '') ? $slides->GetValue('slides_name') : ''; ?>" class="span12 required" />
                                </div>
                            </div>


                            <div class="da-form-row">

                                <label class="da-form-label">ไฟล์ที่อัพโหลด</label>

                                <div class="da-form-item large">


                                    <?php
                                    $sql = "SELECT * FROM " . $slides_file->getTbl() . " WHERE slides_id = '" . $slides->GetPrimary() . "' ORDER BY id DESC LIMIT 0,1 ";
                                    $query = $db->Query($sql);
                                    if ($db->NumRows($query) > 0) {
                                        ?>
                                        <ul>

                                            <?php while ($row = $db->FetchArray($query)) { ?>
                                                <li>
                                                    <div class="span4">
                                                        <p> <a class="fancybox" href="<?php echo ADDRESS_SLIDES . $row['file_name'] ?>"> <img class="img-polaroid" src="<?php echo ADDRESS_SLIDES . $row['file_name'] ?>" style="width:150px; height:150px;"/></a> <span class=""> <a class="da-button red small" href="<?php echo ADDRESS_ADMIN_CONTROL ?>slides&action=edit&id=<?php echo $_GET['id'] ?>&slides_file_id=<?php echo $row['id'] ?>" style="color:#FFF; size:20px; text-decoration: none;" onclick="return confirm('Are you sure you want to delete?')" > ลบไฟล์ </a></span> </p>
                                                    </div>
                                                </li>



                                                <?php $k++; ?>

                                            <?php } ?>
                                        </ul>
                                    <?php } ?>





                                </div>

                            </div>
                            <div class="da-form-row">

                                <label class="da-form-label">อัพโหลดไฟล์</label>

                                <div class="da-form-item large" id="filecopy">


                                    <input type="hidden" placeholder="ว่างไว้ถ้าต้องการให้สร้างชื่ออ้างอิงอัตโนมัติ" name="file_name_ref[]">

                                                       <!--<input type="file" id="file-3" name="file_array[]"  class="file">-->
                                    <input id="input-2" type="file" class="file" name="file_array[]" data-show-upload="false" data-show-caption="true">
                                    <div id="errorBlock43" class="help-block"></div>	
                                </div>

                            </div>

                            <div class="da-form-row">
                                <label class="da-form-label">จัดลำดับ <span class="required">*</span></label>
                                <div class="da-form-item large">
                                    <input type="number" name="sort" id="sort" value="<?php echo ($slides->GetPrimary() != '') ? $slides->GetValue('sort') : '0'; ?>" class="span12" />
                                </div>
                            </div>             
                            <div class="da-form-row">
                                <label class="da-form-label">สถานะ <span class="required">*</span></label>
                                <div class="da-form-item large">
                                    <ul class="da-form-list">
                                        <?php
                                        $getStatus = $slides->get_enum_values('status');
                                        $i = 1;
                                        foreach ($getStatus as $status) {
                                            ?>
                                            <li><input type="radio" name="status" id="status" value="<?php echo $status ?>" <?php echo ($slides->GetPrimary() != "") ? ($slides->GetValue('status') == $status) ? "checked=\"checked\"" : "" : ($i == 1) ? "checked=\"checked\"" : "" ?> class="required"/> <label><?php echo $status ?></label></li>
                                            <?php
                                            $i++;
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="btn-row">
                            <input type="submit" name="submit_bt" value="บันทึกข้อมูล" class="btn btn-success" />
                            <input type="submit" name="submit_bt" value="บันทึกข้อมูล และแก้ไขต่อ" class="btn btn-primary" />
                            <a href="<?php echo ADDRESS_ADMIN_CONTROL ?>slides" class="btn btn-danger">ยกเลิก</a>
                        </div>
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
                <div class="da-panel-header">
                    <span class="da-panel-title">
                        <i class="icol-grid"></i> รูปภาพ ทั้งหมด
                    </span>
                </div>
                <div class="da-panel-toolbar">
                    <div class="btn-toolbar">
                        <div class="btn-group">
                            <a class="btn" href="<?php echo ADDRESS_ADMIN_CONTROL ?>slides&action=add"><i class="icol-add"></i> เพิ่มข้อมูล</a>
                        </div>
                        <div class="btn-group">
                            <a class="btn" href="javascript:void(0);" id="checkDel"><i class="icol-cross"></i> ลบที่เลือก</a>
                        </div> 
                    </div>
                </div> 
                <div class="da-panel-content da-table-container">
                    <table id="da-ex-datatable-numberpaging" class="da-table" sort="0" order="asc">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkAll"/></th>
                                <th>รหัส</th>
                                <th>ชื่อภาพ</th>
                                <th>ภาพสไลด์</th>
                                <th>สถานะ</th>                      
                                <th>แก้ไขล่าสุด</th>
                                <th>ลำดับ</th>
                                <th>ตัวเลือก</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM " . $slides->getTbl() . " ORDER BY sort";
                            $query = $db->Query($sql);
                            while ($row = $db->FetchArray($query)) {
                                ?>
                                <tr>
                                    <td class="text-center"><input type="checkbox" name="checkbox" id="checkbox" value="<?php echo $row['id']; ?>"/></td>
                                    <td  class="center"><?php echo $row['id']; ?></td>
                                    <td><div class="word-wrap"><?php echo $row['slides_name']; ?></div></td>
                                    <td class="center"> <a class="fancybox" rel="fancybox-button" href="<?php echo $slides_file->getDataDesc("file_name", "slides_id = '" . $row['id'] . "' ORDER BY id DESC LIMIT 0,1 ") == "" ? NO_IMAGE : ADDRESS_SLIDES . $slides_file->getDataDesc("file_name", "slides_id = '" . $row['id'] . "' ORDER BY id DESC LIMIT 0,1") ?>"> <img class="img-polaroid" src="<?php echo $slides_file->getDataDesc("file_name", "slides_id = '" . $row['id'] . "' ORDER BY id DESC LIMIT 0,1 ") == "" ? NO_IMAGE : ADDRESS_SLIDES . $slides_file->getDataDesc("file_name", "slides_id = '" . $row['id'] . "' ORDER BY id DESC LIMIT 0,1") ?>" style="height:70px; width:150px;"></a></td>
                                    <td class="center"><i class="icol-<?php echo ($row['status'] == 'ใช้งาน') ? 'accept' : 'cross' ?>" title="<?php echo $row['status'] ?>"></i></td>
                                    <td class="center"><?php echo $functions->ShowDateThTime($row['updated_at']) ?></td>
                                    <td class="center"><?php echo $row['sort']; ?></td>
                                    <td class="center">
                                        <a href="<?php echo ADDRESS_ADMIN_CONTROL ?>slides&action=edit&id=<?php echo $row['id'] ?>" class="btn btn-primary btn-small">แก้ไข / ดู</a>
                                        <a href="#" onclick="if (confirm('คุณต้องการลบข้อมูลนี้หรือใม่?') == true) {
                                                            document.location.href = '<?php echo ADDRESS_ADMIN_CONTROL ?>slides&action=del&id=<?php echo $row['id'] ?>'
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

<script src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
<script src="<?php echo ADDRESS_ADMIN ?>plugins/fileinput/js/fileinput.min.js" type="text/javascript"></script>
<script src="<?php echo ADDRESS_ADMIN ?>plugins/fileinput/js/fileinput_locale_th.js" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>


<script type="text/javascript">

    $('#checkAll').click(function () {
        $('input:checkbox').prop('checked', this.checked);
    });

    $('#checkDel').click(function () {
        var multi_id = '';
        $('input:checkbox[name=checkbox]').each(function ()
        {
            if ($(this).is(':checked')) {
                multi_id += ',' + $(this).val();
            }
        });

        if (multi_id != '') {
            if (confirm('คุณแน่ใจที่จะลบ?') == true) {
                $.blockUI({message: '<h4><i class="fa fa-circle-o-notch fa-spin"></i> กรุณารอสักครู่ </h4>'});
                document.location.href = '<?php echo ADDRESS_ADMIN_CONTROL ?>slides&action=del&id=' + multi_id.substr(1);
            }
        }

    });



    $("#input-2").fileinput({
        language: "th",
        allowedFileExtensions: ["jpg", "gif", "png"],
        elErrorContainer: "#errorBlock43",
    });


    $(document).ready(function () {

        /* This is basic - uses default settings */



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