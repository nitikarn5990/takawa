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




    $home_title->SetValues($arrData);



    if ($home_title->GetPrimary() == '') {


        $home_title->SetValue('created_at', DATE_TIME);


        $home_title->SetValue('updated_at', DATE_TIME);
    } else {


        $home_title->SetValue('updated_at', DATE_TIME);
    }



    //	$home_title->Save();


    if ($home_title->Save()) {


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





                    $home_title_files->SetValue('file_name', $newImage);





                    if ($_POST['alt_tag'][$i] == '') {





                        //$Allfile_ref .= "|_|" . $newImage;
                        //$home_title_files->SetValue('file_name', substr($Allfile, 3));


                        $home_title_files->SetValue('alt_tag', $newImage);
                    } else {


                        //$Allfile_ref .= "|_|" .   $functions->seoTitle($_POST['alt_tag'][$i]);


                        $home_title_files->SetValue('alt_tag', $functions->seoTitle($_POST['alt_tag'][$i]));
                    }


                    $home_title_files->SetValue('about_id', $home_title->GetPrimary());


                    //$home_title_files->Save();


                    if ($home_title_files->Save()) {

                        //SetAlert('เพิ่ม แก้ไข ข้อมูลสำเร็จ','success');


                        $home_title_files->ResetValues();
                    } else {


                        SetAlert('ไม่สามารถเพิ่ม แก้ไข ข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
                    }
                }
            }
        }


        ////////





        if ($redirect) {


            header('location:' . ADDRESS_ADMIN_CONTROL . 'home_title');


            die();
        } else {


            header('location:' . ADDRESS_ADMIN_CONTROL . 'home_title&action=edit&id=' . $home_title->GetPrimary());


            die();
        }
    } else {


        SetAlert('ไม่สามารถเพิ่ม แก้ไข ข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
    }
}


if ($_GET['gallery_file_id'] != '' && $_GET['action'] == 'edit') {





    $home_title_files->SetPrimary((int) $_GET['gallery_file_id']);


    if ($home_title_files->Delete()) {


        // Set alert and redirect


        if (unlink(DIR_ROOT_GALLERY . $home_title_files->GetValue('file_name'))) {


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


    $home_title->SetValues($arrDel);





    // Remove the info from the DB


    if ($home_title->Delete()) {


        // Set alert and redirect


        SetAlert('Delete Data Success', 'success');


        header('location:' . ADDRESS_ADMIN_CONTROL . 'gallery');


        die();
    } else {


        SetAlert('ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
    }
}





if ($_GET['id'] != '' && $_GET['action'] == 'edit') {


    // For Update


    $home_title->SetPrimary((int) $_GET['id']);


    // Try to get the information


    if (!$home_title->GetInfo()) {


        SetAlert('ไม่สามารถค้นหาข้อมูลได้ กรุณาลองใหม่อีกครั้ง');


        $home_title->ResetValues();
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
                <div class="da-panel-header"> <span class="da-panel-title"> <i class="icol-<?php echo ($home_title->GetPrimary() != '') ? 'application-edit' : 'add' ?>"></i> <?php echo ($home_title->GetPrimary() != '') ? 'แก้ไข' : 'เพิ่ม' ?> title </span> </div>
                <div class="da-panel-content da-form-container">
                    <form id="validate" enctype="multipart/form-data" action="<?php echo ADDRESS_ADMIN_CONTROL ?>home_title<?php echo ($home_title->GetPrimary() != '') ? '&id=' . $home_title->GetPrimary() : ''; ?>" method="post" class="da-form">
    <?php if ($home_title->GetPrimary() != ''): ?>
                            <input type="hidden" name="id" value="<?php echo $home_title->GetPrimary() ?>" />
                            <input type="hidden" name="created_at" value="<?php echo $home_title->GetValue('created_at') ?>" />
    <?php endif; ?>
                        <div class="da-form-inline">
                            <div class="da-form-row hidden">
                                <label class="da-form-label">หัวข้อ <span class="required">*</span></label>
                                <div class="da-form-item large">
                                    <input type="text" name="home_title" id="home_title" value="<?php echo ($home_title->GetPrimary() != '') ? $home_title->GetValue('home_title') : ''; ?>" class="span12 hidden" />
                                </div>
                            </div>
                            <div class="da-form-row">
                                <label class="da-form-label">รายละเอียด<span class="required">*</span></label>
                                <div class="da-form-item large">
                                    <textarea name="home_detail" id="home_detail" class="span12 tinymce required"><?php echo ($home_title->GetPrimary() != '') ? $home_title->GetValue('home_detail') : ''; ?></textarea>
                                    <label for="home_detail" generated="true" class="error" style="display:none;"></label>
                                </div>
                            </div>
                        </div>
                        <div class="btn-row">

                            <input type="submit" name="submit_bt" value="บันทึกข้อมูล และแก้ไขต่อ" class="btn btn-primary" />

                    </form>
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
