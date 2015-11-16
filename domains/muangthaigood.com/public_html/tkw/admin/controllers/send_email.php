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



    // Get all the Form Data
    $send_email->SetValues($arrData);
    if ($send_email->GetPrimary() == '') {
        $send_email->SetValue('created_at', DATE_TIME);
        $send_email->SetValue('updated_at', DATE_TIME);
    } else {
        $send_email->SetValue('updated_at', DATE_TIME);
    }


    if ($send_email->Save()) {
        SetAlert('เพิ่ม แก้ไข ข้อมูลสำเร็จ', 'success');
        
        $str = $functions->stripslashes2($_POST['message']);
      
        require_once('../phpmailer/class.phpmailer.php');
        
        $mail = new PHPMailer();
        $mail->IsHTML(true);
        $mail->IsSMTP();
        $mail->SMTPAuth = true; // enable SMTP authentication
        $mail->SMTPSecure = "ssl"; // sets the prefix to the servier
        $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
        $mail->Port = 465; // set the SMTP port for the GMAIL server
        $mail->Username = "pittaya.mtl@gmail.com"; // GMAIL username
        $mail->Password = "0812833807"; // GMAIL password
        $mail->From = "bb@gmail.com"; // "name@yourdomain.com";
        $mail->FromName = "Chang Cooking & Restaurant";  // set from Name
        $mail->Subject = "Order Cooking Course";
        $mail->CharSet = "utf-8";
        $mail->Body = $str;

        $mail->AddAddress($_POST['email_target']); // to Address

        $mail->set('X-Priority', '1'); //Priority 1 = High, 3 = Normal, 5 = low
        if ($status == false) {
            if (!$mail->Send()) {
                echo "<script>alert('Error !!!')</script>";
            } else {
                echo "<script>alert('Send success')</script>";
            }
        }

        if ($redirect) {
          //  header('location:' . ADDRESS_ADMIN_CONTROL . 'send_email');
            //die();
        } else {
           // header('location:' . ADDRESS_ADMIN_CONTROL . 'send_email&action=edit&id=' . $send_email->GetPrimary());
           // die();
        }
    } else {
        SetAlert('ไม่สามารถเพิ่ม แก้ไข ข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
    }
}

// If Deleting the Page
if ($_GET['id'] != '' && $_GET['action'] == 'del') {
    // Get all the form data
    $arrDel = array('id' => $_GET['id']);
    $send_email->SetValues($arrDel);

    // Remove the info from the DB
    if ($send_email->Delete()) {
        // Set alert and redirect
        SetAlert('Delete Data Success', 'success');
        header('location:' . ADDRESS_ADMIN_CONTROL . 'send_email');
        die();
    } else {
        SetAlert('ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
    }
}

if ($_GET['id'] != '' && $_GET['action'] == 'edit') {
    // For Update
    $send_email->SetPrimary((int) $_GET['id']);
    // Try to get the information
    if (!$send_email->GetInfo()) {
        SetAlert('ไม่สามารถค้นหาข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
        $send_email->ResetValues();
    }
}
?>

<?php if ($_GET['action'] == "add" || $_GET['action'] == "edit") { ?>
    <div class="row-fluid">	
        <div class="span12">        
            <div class="da-panel collapsible">
                <div class="da-panel-header">
                    <span class="da-panel-title">
                        <i class="icol-<?php echo ($send_email->GetPrimary() != '') ? 'application-edit' : 'add' ?>"></i> <?php echo ($send_email->GetPrimary() != '') ? 'แก้ไข' : 'เพิ่ม' ?> ส่งเมล์
                    </span>
                </div>
                <div class="da-panel-content da-form-container">
                    <form id="validate" enctype="multipart/form-data" action="" method="post" class="da-form">
                        <?php if ($send_email->GetPrimary() != ''): ?>
                            <input type="hidden" name="id" value="<?php echo $send_email->GetPrimary() ?>" />
                            <input type="hidden" name="created_at" value="<?php echo $send_email->GetValue('created_at') ?>" />
                        <?php endif; ?>
                        <div class="da-form-inline">
                            <div class="da-form-row">
                                <label class="da-form-label">อีเมล์ผู้รับ <span class="required">*</span></label>
                                <div class="da-form-item large">
                                    <input type="email" name="email_target" id="email_target" value="<?php echo ($send_email->GetPrimary() != '') ? $send_email->GetValue('email_target') : ''; ?>" class="span12 required" />
                                </div>
                            </div>
                            <div class="da-form-row">
                                <label class="da-form-label">ข้อความ <span class="required">*</span></label>
                                <div class="da-form-item large">
                                    <textarea style="height: 500px;" name="message" id="message" class="span12 tinymce required"><?php echo ($send_email->GetPrimary() != '') ? $send_email->GetValue('message') : ''; ?></textarea>
                                    <label for="message" generated="true" class="error" style="display:none;"></label>
                                </div>
                            </div>

                        </div>
                        <div class="btn-row">
                            <input type="submit" name="submit_bt" value="บันทึกข้อมูล" class="btn btn-success" />
                            <input type="submit" name="submit_bt" value="บันทึกข้อมูล และแก้ไขต่อ" class="btn btn-primary" />
                            <a href="<?php echo ADDRESS_ADMIN_CONTROL ?>send_email" class="btn btn-danger">ยกเลิก</a>
                        </div>
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
                        <i class="icol-grid"></i> ส่งเมล์ ทั้งหมด
                    </span>
                </div>
                <div class="da-panel-toolbar">
                    <div class="btn-toolbar">
                        <div class="btn-group">
                            <a class="btn" href="<?php echo ADDRESS_ADMIN_CONTROL ?>send_email&action=add"><i class="icol-add"></i> เพิ่มข้อมูล</a>
                        </div>
                    </div>
                </div> 
                <div class="da-panel-content da-table-container">
                    <table id="da-ex-datatable-numberpaging" class="da-table">
                        <thead>
                            <tr>
                                <th>รหัส</th>
                                <th>อีเมล์</th>
                                <th>วันที่ส่ง</th>
                                <th>ตัวเลือก</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM " . $send_email->getTbl();
                            $query = $db->Query($sql);
                            while ($row = $db->FetchArray($query)) {
                                ?>
                                <tr>
                                    <td class="center"><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['email_target']; ?></td>
                                    <td class="center"><?php echo $functions->ShowDateThTime($row['created_at']) ?></td>
                                    <td class="center">
                                        <a href="<?php echo ADDRESS_ADMIN_CONTROL ?>send_email&action=edit&id=<?php echo $row['id'] ?>" class="btn btn-primary btn-small">แก้ไข / ดู</a>
                                        <a href="#" onclick="if (confirm('คุณต้องการลบข้อมูลนี้หรือใม่?') == true) {
                                                    document.location.href = '<?php echo ADDRESS_ADMIN_CONTROL ?>send_email&action=del&id=<?php echo $row['id'] ?>'
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
<?php
}?>