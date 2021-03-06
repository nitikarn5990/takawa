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



    $coures_confirm_payment->SetValues($arrData);

    if ($coures_confirm_payment->GetPrimary() == '') {
        $coures_confirm_payment->SetValue('created_at', DATE_TIME);
        $coures_confirm_payment->SetValue('updated_at', DATE_TIME);
    } else {
        $coures_confirm_payment->SetValue('updated_at', DATE_TIME);
    }

    if ($coures_confirm_payment->Save()) {
        SetAlert('เพิ่ม แก้ไข ข้อมูลสำเร็จ', 'success');
        //Redirect if needed




        if ($redirect) {
            header('location:' . ADDRESS_ADMIN_CONTROL . 'coures_confirm_payment');
            die();
        } else {
            header('location:' . ADDRESS_ADMIN_CONTROL . 'coures_confirm_payment&action=edit&id=' . $coures_confirm_payment->GetPrimary());
            die();
        }
    } else {
        SetAlert('ไม่สามารถเพิ่ม แก้ไข ข้อมูลได้ กรุณาลองใหม่อีกครั้ง 4');
    }
}

// If Deleting the Page
if ($_GET['id'] != '' && $_GET['action'] == 'del') {
    // Get all the form data
    $arrDel = array('id' => $_GET['id']);
    $coures_confirm_payment->SetValues($arrDel);

    // Remove the info from the DB
    if ($coures_confirm_payment->Delete()) {
        // Set alert and redirect
        SetAlert('Delete Data Success', 'success');
        header('location:' . ADDRESS_ADMIN_CONTROL . 'coures_confirm_payment');
        die();
    } else {
        SetAlert('ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
    }
}

if ($_GET['id'] != '' && $_GET['action'] == 'edit') {
    // For Update
    $coures_confirm_payment->SetPrimary((int) $_GET['id']);
    // Try to get the information
    if (!$coures_confirm_payment->GetInfo()) {
        SetAlert('ไม่สามารถค้นหาข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
        $coures_confirm_payment->ResetValues();
    }
}
?>
<?php
if ($_GET['action'] == "add" || $_GET['action'] == "edit") {

    if ($_GET['id'] != '' && $_GET['action'] == "edit") {
        $coures_confirm_payment->SetPrimary((int) $_GET['id']);
        $arrOrder = array(
            'status' => 1,
            'updated_at' => DATE_TIME
        );
        $arrOrderID = array('id' => $coures_confirm_payment->GetPrimary());

        $coures_confirm_payment->updateSQL($arrOrder, $arrOrderID);
    }
    ?>
    <div class="row-fluid">
        <div class="span12">
            <?php
            // Report errors to the user
            Alert(GetAlert('error'));
            Alert(GetAlert('success'), 'success');
            ?>
            <div class="da-panel collapsible">
                <div class="da-panel-header"> <span class="da-panel-title"> <i class="icol-<?php echo ($coures_confirm_payment->GetPrimary() != '') ? 'application-edit' : 'add' ?>"></i> <?php echo ($coures_confirm_payment->GetPrimary() != '') ? '' : '' ?> แจ้งการชำระเงิน </span> </div>
                <div class="da-panel-content da-form-container">
                    <form id="validate" enctype="multipart/form-data" action="<?php echo ADDRESS_ADMIN_CONTROL ?>coures_confirm_payment" method="post" class="da-form">
                        <?php if ($coures_confirm_payment->GetPrimary() != ''): ?>
                            <input type="hidden" name="id" value="<?php echo $coures_confirm_payment->GetPrimary() ?>" />
                            <input type="hidden" name="created_at" value="<?php echo $coures_confirm_payment->GetValue('created_at') ?>" />
                            <input type="hidden" name="book_id" value="<?php echo $coures_confirm_payment->GetValue('book_id') ?>" />
                            <input type="hidden" name="coures_id" value="<?php echo $coures_confirm_payment->GetValue('coures_id') ?>" />   


                        <?php endif; ?>
                        <div class="da-form-inline">
                            <fieldset class="da-form-inline">
                                <legend> ข้อมูลการแจ้งชำระ</legend>
                                <div class="da-form-row">
                                    <label class="da-form-label">ข้อมูลการจอง<span class="required">*</span></label>
                                    <div class="da-form-item large">
                                        <a href="<?php echo ADDRESS_ADMIN_CONTROL . 'booking&action=edit&id=' . $coures_confirm_payment->GetValue('booking_id') ?>" target="_blank" name="submit_bt" value="บันทึกข้อมูล" class="btn btn-primary">ดูข้อมูลการจอง</a>
                                    </div>
                                </div>
                                <div class="da-form-row">
                                    <label class="da-form-label">Booking ID <span class="required">*</span></label>
                                    <div class="da-form-item large">
                                        <input type="text" name="id" id="id"  value="<?php echo ($coures_confirm_payment->GetPrimary() != '') ? str_pad($coures_confirm_payment->GetValue('booking_id'), 5, '0', STR_PAD_LEFT) : ''; ?>" class="span12 required" />
                                    </div>
                                </div>
                                <div class="da-form-row">
                                    <label class="da-form-label">ชื่อผู้จอง <span class="required">*</span></label>
                                    <div class="da-form-item large">
                                        <input type="text" name="name"   id="name" value="<?php echo ($coures_confirm_payment->GetPrimary() != '') ? $coures_confirm_payment->GetValue('name') : ''; ?>" class="span12 required" />
                                    </div>
                                </div>

                                <div class="da-form-row">
                                    <label class="da-form-label">อีเมล์ผู้จอง<span class="required">*</span></label>
                                    <div class="da-form-item large">
                                        <input type="text" name="email"   id="email" value="<?php echo ($coures_confirm_payment->GetPrimary() != '') ? $coures_confirm_payment->GetValue('email') : ''; ?>" class="span12 required" />
                                    </div>
                                </div>

                                <div class="da-form-row">
                                    <label class="da-form-label">ชื่อหลักสูตร <span class="required">*</span></label>
                                    <div class="da-form-item large">
                                        <input type="text" name="coures_title"  id="coures_title" value="<?php echo $coures_confirm_payment->GetValue('coures_title') ?>" class="span12 required" />
                                    </div>
                                </div>
                                <div class="da-form-row">
                                    <label class="da-form-label">รุปแบบการชำระเงิน <span class="required">*</span></label>
                                    <div class="da-form-item large">
                                        <input type="text" class="span12"   name="payment_type" value="<?php echo ($coures_confirm_payment->GetValue('payment_type')) ?>">

                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="da-form-inline">
                                <legend><img src="<?= ADDRESS_ASSETS ?>payment_2.png"> ยอดการชำระ</legend>
                                <div class="da-form-row bg-success">
                                    <label class="da-form-label">จำนวนเงินที่ชำระ<span class="required">*</span></label>
                                    <div class="da-form-item large">
                                        <input type="text" class="span12 required" name="price_format" id="price_format" data-a-sign="฿ " value="<?php echo ($coures_confirm_payment->GetPrimary() != '') ? $coures_confirm_payment->GetValue('payment_amount') : '' ?>">
                                        <input type="hidden" class="span12" name="payment_amount" id="payment_amount">

                                    </div>
                                </div>

                            </fieldset>
                            <fieldset class="da-form-inline">
                                <legend>อื่นๆ</legend>
                                <div class="da-form-row">
                                    <label class="da-form-label">หมายเหตุ <span class="required">*</span></label>
                                    <div class="da-form-item large">
                                        <textarea name="note"   id="note"><?php echo ($coures_confirm_payment->GetPrimary() != '') ? $coures_confirm_payment->GetValue('note') : ''; ?></textarea>
                                    </div>
                                </div>
                                <div class="da-form-row">
                                    <label class="da-form-label">วันที่แจ้งชำระ <span class="required">*</span></label>
                                    <div class="da-form-item large">
                                        <input type="text" readonly=""  class="span12" name="paid_date" value="<?php echo ($coures_confirm_payment->GetPrimary() != '') ? $functions->ShowDateThTime($coures_confirm_payment->GetValue('paid_date')) : ''; ?>">

                                    </div>
                                </div>
                            </fieldset>


                        </div>
                        <div class="btn-row">
                            <input type="submit" name="submit_bt" value="บันทึกข้อมูล และแก้ไขต่อ" class="btn btn-primary" />
                            <a href="<?php echo ADDRESS_ADMIN_CONTROL ?>coures_confirm_payment" class="btn btn-danger">ยกเลิก</a> </div>
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
                <div class="da-panel-header"> <span class="da-panel-title"> <i class="icol-grid"></i> การแจ้งชำระเงิน ทั้งหมด </span> </div>
                <div class="da-panel-toolbar">
                    <div class="btn-toolbar hidden">
                        <div class="btn-group"> <a class="btn" href="<?php echo ADDRESS_ADMIN_CONTROL ?>coures_confirm_payment&action=add"><i class="icol-add"></i> เพิ่มข้อมูล</a> </div>
                    </div>
                </div>
                <div class="da-panel-content da-table-container">

                    <table id="da-ex-datatable-sort" class="da-table" sort="0" order="desc" width="1000">
                        <thead>
                            <tr>
                                <th>รหัส</th>
                                <th>Booking ID ที่แจ้ง</th>
                                <th>แจ้งเตือน</th>
                                <th>ภาพหน้าปก</th>
                                <th>หลักสูตรที่จอง</th>
                                <th>ชื่อผู้จอง</th>
                                <th>ชนิดการจ่าย</th>
                                <th>จำนวนเงินที่ชำระ</th>
                                <th>Order Date</th>
                                <th>ตัวเลือก</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM " . $coures_confirm_payment->getTbl();
                            $query = $db->Query($sql);
                            while ($row = $db->FetchArray($query)) {

                                $cover_img = $coures->getDataDesc('cover_img', 'id = ' . $row['coures_id']) == '' ? '' : $coures->getDataDesc('cover_img', 'id = ' . $row['coures_id']);
                                $new = $row['status'] == '0' ? '<img src=' . ADDRESS_ASSETS . 'icon_new.gif>' : '';
                                ?>
                                <tr>
                                    <td class="center"><?php echo $row['id'] ?></td>
                                    <td><?= str_pad($row['coures_id'], 5, '0', STR_PAD_LEFT) ?></td>
                                    <td><?= $new ?></td>
                                    <td style="text-align:center; max-width:100px;"><a class="fancybox" href="<?php echo $cover_img == '' ? NO_IMAGE : ADDRESS_COVER . $cover_img ?>">
                                            <?php echo $cover_img == '' ? '<img class="img_cover img-polaroid" src=' . NO_IMAGE . '>' : '<img class="img_cover img-polaroid" src=' . ADDRESS_COVER . $cover_img . '>' ?></a></td>
                                    <td><?php echo $row['coures_title'] ?></td>
                                    <td><div class="word-wrap"><?php echo $row['name']; ?></div></td>
                                    <td style="text-align: center;"><div class="word-wrap"><?php echo ucfirst($row['payment_type']) ?></div></td>
                                    <td class="center"><div class="word-wrap"><?php echo '฿ ' . $row['payment_amount'] ?> </div></td>
                                    <td class="center"><div class="word-wrap"><?php echo $functions->ShowDateThTime($row['updated_at']) ?></div></td>

                                    <td class="center"><div class="word-wrap"> <a href="<?php echo ADDRESS_ADMIN_CONTROL ?>coures_confirm_payment&action=edit&id=<?php echo $row['id'] ?>" class="btn btn-primary btn-small">แก้ไข / ดู</a> <a href="#" onclick="if (confirm('คุณต้องการลบข้อมูลนี้หรือใม่?') == true) {
                                                document.location.href = '<?php echo ADDRESS_ADMIN_CONTROL ?>coures_confirm_payment&action=del&id=<?php echo $row['id'] ?>'
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
                                            $('#short_coures_confirm_payment').maxlength({max: 300});
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

    jQuery(function ($) {
        $('#price_format').autoNumeric('init');
        $('#price_balance').autoNumeric('init');
        $('.price').autoNumeric('init');
        $('#price_format2').autoNumeric('init');
        $("input[name='submit_bt']").click(function () {
            $('#payment_amount').val($('#price_format').autoNumeric('get'));
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
    table th{
        overflow : auto;
    }


</style>
