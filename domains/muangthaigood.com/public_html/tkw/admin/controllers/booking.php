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
        $arrData['booking_ref'] = $functions->seoTitle($arrData['ref']);
    } else {
        $arrData['booking_ref'] = $functions->seoTitle($arrData['booking_title']);
    }


    $booking->SetValues($arrData);


    if ($booking->GetPrimary() == '') {
        $booking->SetValue('created_at', DATE_TIME);
        $booking->SetValue('updated_at', DATE_TIME);
    } else {
        $booking->SetValue('updated_at', DATE_TIME);
    }

    if ($booking->Save()) {
        SetAlert('เพิ่ม แก้ไข ข้อมูลสำเร็จ', 'success');
        //Redirect if needed


        if ($redirect) {
            header('location:' . ADDRESS_ADMIN_CONTROL . 'booking');
            die();
        } else {
            header('location:' . ADDRESS_ADMIN_CONTROL . 'booking&action=edit&id=' . $booking->GetPrimary());
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
    $booking->SetValues($arrDel);

    // Remove the info from the DB
    if ($booking->Delete()) {
        // Set alert and redirect
        SetAlert('Delete Data Success', 'success');
        header('location:' . ADDRESS_ADMIN_CONTROL . 'booking');
        die();
    } else {
        SetAlert('ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
    }
}

if ($_GET['id'] != '' && $_GET['action'] == 'edit') {
    // For Update
    $booking->SetPrimary((int) $_GET['id']);
    // Try to get the information
    if (!$booking->GetInfo()) {
        SetAlert('ไม่สามารถค้นหาข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
        $booking->ResetValues();
    }
}
?>
<?php
if ($_GET['action'] == "add" || $_GET['action'] == "edit") {

    if ($_GET['id'] != '' && $_GET['action'] == "edit") {
        $booking->SetPrimary((int) $_GET['id']);
        $arrOrder = array(
            'status' => 1,
            'updated_at' => DATE_TIME
        );
        $arrOrderID = array('id' => $booking->GetPrimary());

        $booking->updateSQL($arrOrder, $arrOrderID);
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
                <div class="da-panel-header"> <span class="da-panel-title"> <i class="icol-<?php echo ($booking->GetPrimary() != '') ? 'application-edit' : 'add' ?>"></i> <?php echo ($booking->GetPrimary() != '') ? '' : '' ?> การจองคอร์ส </span> </div>
                <div class="da-panel-content da-form-container">
                    <form id="validate" enctype="multipart/form-data" action="<?php echo ADDRESS_ADMIN_CONTROL ?>booking" method="post" class="da-form">
                        <?php if ($booking->GetPrimary() != ''): ?>
                            <input type="hidden" name="id" value="<?php echo $booking->GetPrimary() ?>" />
                            <input type="hidden" name="coures_id" value="<?php echo $booking->GetValue('coures_id') ?>" />
                            <input type="hidden" name="created_at" value="<?php echo $booking->GetValue('created_at') ?>" />
                            <input type="hidden" name="cover_img" value="<?php echo $booking->GetValue('cover_img') ?>" />
                            <input type="hidden" name="booking_date" value="<?php echo $booking->GetValue('booking_date') ?>" />

                            <input type="hidden" name="people" value="<?php echo $booking->GetValue('people') ?>" />
                        <?php endif; ?>
                        <div class="da-form-inline">
                            <fieldset class="da-form-inline">
                                <legend><img src="<?= ADDRESS_ASSETS ?>information.png" style="width: 18px;"> ข้อมูลผู้จอง</legend>
                                <div class="da-form-row">
                                    <label class="da-form-label">Booking ID <span class="required">*</span></label>
                                    <div class="da-form-item large">
                                        <input type="text" name="id" id="id" disabled="" value="<?php echo ($booking->GetPrimary() != '') ? str_pad($booking->GetValue('id'), 5, "0", STR_PAD_LEFT) : ''; ?>" class="span12 required" />
                                    </div>
                                </div>
                                <div class="da-form-row">
                                    <label class="da-form-label">ชื่อผู้จอง <span class="required">*</span></label>
                                    <div class="da-form-item large">
                                        <input type="text" name="first_name" id="name" value="<?php echo ($booking->GetPrimary() != '') ? $booking->GetValue('first_name') : ''; ?>" class="span12 required" />
                                    </div>
                                </div>
                                <div class="da-form-row">
                                    <label class="da-form-label">นามสกุลผู้จอง <span class="required">*</span></label>
                                    <div class="da-form-item large">
                                        <input type="text" name="last_name" id="name" value="<?php echo ($booking->GetPrimary() != '') ? $booking->GetValue('last_name') : ''; ?>" class="span12 required" />
                                    </div>
                                </div>
                                <div class="da-form-row">
                                    <label class="da-form-label">เบอร์ติดต่อ<span class="required">*</span></label>
                                    <div class="da-form-item large">
                                        <input type="text" name="tel" id="tel" value="<?php echo ($booking->GetPrimary() != '') ? $booking->GetValue('tel') : ''; ?>" class="span12 required" />
                                    </div>
                                </div>
                                <div class="da-form-row">
                                    <label class="da-form-label">อีเมล์<span class="required">*</span></label>
                                    <div class="da-form-item large">
                                        <input type="email" name="email" id="email" value="<?php echo ($booking->GetPrimary() != '') ? $booking->GetValue('email') : ''; ?>" class="span12 required" />
                                    </div>
                                </div>

                                <div class="da-form-row">
                                    <label class="da-form-label">ชื่อโรงแรม<span class="required">*</span></label>
                                    <div class="da-form-item large">
                                        <input type="text" name="hotel_name" id="hotel_name" value="<?php echo ($booking->GetPrimary() != '') ? $booking->GetValue('hotel_name') : ''; ?>" class="span12 required" />
                                    </div>
                                </div>
                                <div class="da-form-row">
                                    <label class="da-form-label">ที่อยู่โรงแรม<span class="required">*</span></label>
                                    <div class="da-form-item large">
                                        <textarea name="hotel_address" id="hotel_address" style="width: 100%;"><?php echo ($booking->GetPrimary() != '') ? $booking->GetValue('hotel_address') : ''; ?></textarea>

                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="da-form-inline">
                                <legend>หลักสูตรที่จอง</legend>
                                <div class="da-form-row">
                                    <label class="da-form-label">ชื่อหลักสูตร <span class="required">*</span></label>
                                    <div class="da-form-item large">
                                        <input type="text" disabled="" id="booking_title" value="<?php echo ($booking->GetPrimary() != '') ? $coures->getDataDesc('coures_title', 'id = ' . $booking->GetValue('coures_id')) : '' ?>" class="span12 required" />
                                    </div>
                                </div>
                                <div class="da-form-row">
                                    <label class="da-form-label">จำนวนคน <span class="required">*</span></label>
                                    <div class="da-form-item large">
                                        <input type="number" name="people" id="people" value="<?php echo ($booking->GetPrimary() != '') ? $booking->GetValue('people') : '' ?>" class="span12 required" />
                                    </div>
                                </div>
                                <div class="da-form-row">
                                    <label class="da-form-label">ราคาคอร์ส (บาท)</label>
                                    <div class="da-form-item large">
                                        <input type="text" disabled="" class="span12 required" name="" id="price_format" data-a-sign="฿ " value="<?php echo ($booking->GetPrimary() != '') ? $coures->getDataDesc('price', 'id=' . $booking->GetValue('coures_id')) : ''; ?>">
                                        <input type="hidden" class="span12" name="" id="price">

                                    </div>
                                </div>
                                <div class="da-form-row">
                                    <label class="da-form-label">รวม</label>
                                    <div class="da-form-item large">
                                        <input type="text" disabled="" class="span12 required" name="" id="price_total" data-a-sign="฿ " value="<?php echo ($booking->GetPrimary() != '') ? $coures->getDataDesc('price', 'id=' . $booking->GetValue('coures_id')) * $booking->GetValue('people') : ''; ?>">


                                    </div>
                                </div>
                            </fieldset>


                            <fieldset class="da-form-inline">
                                <legend><img src="<?= ADDRESS_ASSETS ?>payment_2.png" style="width: 18px;"> การชำระเงิน</legend>

                                <?php
                                $_hidden = '';
                                $Str = '';
                                if ($booking->GetValue('payment_type') == 'full') {
                                    $_hidden = 'hidden';
                                    $Str = 'hidden';
                                }
                                ?>
                                <div class="da-form-row">
                                    <label class="da-form-label">รูปแบบการชำระเงิน <span class="required">*</span></label>
                                    <div class="da-form-item large">
                                        <ul class="da-form-list">
                                            <?php
                                            $getStatus_type = $booking->get_enum_values('payment_type');
                                            $i = 1;
                                            foreach ($getStatus_type as $statusType) {
                                                ?>
                                                <li>
                                                    <input  type="radio"  name="payment_type" id="payment_type" value="<?php echo ($statusType) ?>" <?php echo ($booking->GetPrimary() != "") ? ($booking->GetValue('payment_type') == $statusType) ? "checked=\"checked\"" : "" : ($i == 1) ? "checked=\"checked\"" : "" ?> class="required"/>
                                                    <label><?php echo ucfirst($statusType) ?><?php echo $statusType == 'full' ? ' (ชำระเต็มราคา)' : ' (ชำระครึ่งราคา)' ?></label>
                                                </li>
                                                <?php
                                                $i++;
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="da-form-row" id="box-pay-1">
                                    <label class="da-form-label">การชำระเงิน <span id="str" class="<?= $Str ?>">(ส่วนแรก)</span> <span class="required">*</span></label>
                                    <div class="da-form-item large">
                                        <ul class="da-form-list">
                                            <?php
                                            $getStatus = $booking->get_enum_values('payment_1_status');
                                            $i = 1;

                                            foreach ($getStatus as $status) {
                                                if ($status == 'ชำระเงินแล้ว') {
                                                    $fn1 = "enableRadioPay1()";
                                                    $status_p = 'pay1';
                                                } else {
                                                    $status_p = 'unpay1';
                                                }
                                                ?>
                                                <li>
                                                    <input id="<?= $status_p ?>" onclick="<?= $fn1 ?>" <?= $booking->GetValue('payment_1_status') == 'ชำระเงินแล้ว' ? 'readonly' : '' ?> type="radio" name="payment_1_status"  value="<?php echo $status ?>" <?php echo ($booking->GetPrimary() != "") ? ($booking->GetValue('payment_1_status') == $status) ? "checked=\"checked\"" : "" : ($i == 1) ? "checked=\"checked\"" : "" ?> class="required"/>
                                                    <label><?php echo $status ?></label>

                                                </li>
                                                <?php
                                                $i++;
                                            }
                                            ?>
                                        </ul>
                                    </div>

                                    <label class="da-form-label">จำนวนที่ชำระ (บาท)</label>
                                    <div class="da-form-item large">
                                        <input type="text" data-a-sign="฿ " <?= $booking->GetValue('payment_1_status') == 'รอชำระเงิน' ? "readonly" : '' ?> class="span12" id="pre_pay_1_total" name="pre_pay_1_total" value="<?php echo ($booking->GetPrimary() != '') ? $booking->GetValue('pay_1_total') : ''; ?>">
                                        <input type="hidden" name="pay_1_total" id="pay_1_total">
                                    </div>

                                </div>

                                <div class="da-form-row <?= $_hidden ?>" id="box-pay-2">
                                    <label class="da-form-label">การชำระเงิน (ส่วนสอง)<span class="required">*</span></label>
                                    <div class="da-form-item large">
                                        <ul class="da-form-list">
                                            <?php
                                            $getStatus = $booking->get_enum_values('payment_2_status');
                                            $i = 1;

                                            foreach ($getStatus as $status) {
                                                if ($status == 'ชำระเงินแล้ว') {
                                                    $fn2 = "enableRadioPay2()";

                                                    $status_p2 = 'pay2';
                                                } else {
                                                    $status_p2 = 'unpay2';
                                                }
                                                ?>
                                                <li>
                                                    <input id="<?= $status_p2 ?>" onclick="<?= $fn2 ?>" type="radio" name="payment_2_status" value="<?php echo $status ?>" <?php echo ($booking->GetPrimary() != "") ? ($booking->GetValue('payment_2_status') == $status) ? "checked=\"checked\"" : "" : ($i == 1) ? "checked=\"checked\"" : "" ?> class="required"/>
                                                    <label><?php echo $status ?></label>
                                                </li>
                                                <?php
                                                $i++;
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                    <label class="da-form-label">จำนวนที่ชำระ (บาท)</label>
                                    <div class="da-form-item large">
                                        <input type="text" class="span12" data-a-sign="฿ " id="pre_pay_2_total" name="pre_pay_2_total" <?= $booking->GetValue('payment_2_status') == 'รอชำระเงิน' ? 'readonly' : '' ?> value="<?php echo ($booking->GetPrimary() != '') ? $booking->GetValue('pay_2_total') : ''; ?>">
                                        <input type="hidden" name="pay_2_total" id="pay_2_total">
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="da-form-inline">
                                <legend> อื่นๆ</legend>
                                <div class="da-form-row">
                                    <label class="da-form-label">หมายเหตุ</label>
                                    <div class="da-form-item large">
                                        <textarea  name="note"><?php echo ($booking->GetPrimary() != '') ? $booking->GetValue('note') : ''; ?></textarea>
                                    </div>
                                </div>

                                <div class="da-form-row">
                                    <label class="da-form-label">วันที่จอง<span class="required">*</span></label>
                                    <div class="da-form-item large">
                                        <input type="text" id="booking_date" readonly="" class="span12" name="booking_date" value="<?php echo ($booking->GetPrimary() != '') ? $booking->GetValue('booking_date') : ''; ?>">

                                    </div>
                                </div>
                            </fieldset>


                        </div>
                        <div class="btn-row">
                            <input type="submit" name="submit_bt" value="บันทึกข้อมูล และแก้ไขต่อ" class="btn btn-primary" />
                            <a href="<?php echo ADDRESS_ADMIN_CONTROL ?>booking" class="btn btn-danger">ยกเลิก</a> </div>
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
                <div class="da-panel-header"> <span class="da-panel-title"> <i class="icol-grid"></i> ข้อมูลการจอง ทั้งหมด</span> </div>
                <div class="da-panel-toolbar">
                    <div class="btn-toolbar hidden">
                        <div class="btn-group"> <a class="btn" href="<?php echo ADDRESS_ADMIN_CONTROL ?>booking&action=add"><i class="icol-add"></i> เพิ่มข้อมูล</a> </div>
                    </div>
                </div>
                <div class="da-panel-content da-table-container">

                    <table id="da-ex-datatable-sort" class="da-table" sort="0" order="desc" width="100%">
                        <thead>
                            <tr>
                                <th>รหัส</th>
                                <th>ภาพหน้าปกของคอร์ส</th>
                                <th>หลักสูตรที่จอง</th>
                                <th>ชื่อผู้จองคอร์ส</th>
                                <th>Email</th>
                                <th>ชนิดการจ่าย</th>
                                <th>สถานะ</th>
                                <th>วันที่จอง</th>
                                <th>ตัวเลือก</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM " . $booking->getTbl();
                            $query = $db->Query($sql);
                            while ($row = $db->FetchArray($query)) {
                                $bg = 'bg-success';
                                $new = $row['status'] == '0' ? '<img src=' . ADDRESS_ASSETS . 'icon_new.gif>' : '';
                                $_status = '';
                                if ($row['payment_type'] == 'full') {
                                    if ($row['payment_1_status'] == 'ชำระเงินแล้ว') {
                                        $_status = 'จ่ายแล้ว';
                                        $bg = 'bg-success';
                                    } else if ($row['payment_1_status'] == 'รอชำระเงิน') {
                                        $_status = 'ชำระเต็ม รอยืนยัน';
                                        $bg = 'bg-danger';
                                    }
                                    $typePay = $row['payment_type'];
                                }
                                if ($row['payment_type'] == 'half') {
                                    if ($row['payment_1_status'] == 'ชำระเงินแล้ว' &&
                                            $row['payment_2_status'] == 'ชำระเงินแล้ว') {
                                        $_status = 'ครบแล้ว';
                                        $bg = 'bg-success';
                                        $typePay = 'full';
                                    } else {
                                        if ($row['payment_1_status'] == 'ชำระเงินแล้ว' &&
                                                $row['payment_2_status'] == 'รอชำระเงิน') {
                                            $_status = 'จ่ายครึ่ง เหลืออีกครึ่ง';
                                            $bg = 'bg-warning';
                                        }
                                        if ($row['payment_1_status'] == 'รอชำระเงิน' &&
                                                $row['payment_2_status'] == 'รอชำระเงิน') {
                                            $_status = 'รอชำระเงิน';
                                            $bg = 'bg-danger';
                                        }
                                        
                                        $typePay = $row['payment_type'];
                                    }
                                }
                                ?>
                                <tr class="<?= $bg ?>">
                                    <td class="center"><?php echo str_pad($row['id'], 5, "0", STR_PAD_LEFT) ?></td>
                                    <td style="text-align:center; max-width:100px;"><a class="fancybox" href="<?php echo $coures->getDataDesc('cover_img', 'id = ' . $row['coures_id']) == '' ? NO_IMAGE : ADDRESS_COVER . $coures->getDataDesc('cover_img', 'id = ' . $row['coures_id']) ?>">
                                            <?php echo $coures->getDataDesc('cover_img', 'id = ' . $row['coures_id']) == '' ? '<img class="img_cover img-polaroid" src=' . NO_IMAGE . '>' : '<img class="img_cover img-polaroid" src=' . ADDRESS_COVER . $coures->getDataDesc('cover_img', 'id = ' . $row['coures_id']) . '>' ?></a></td>
                                    <td><?php echo $coures->getDataDesc("coures_title", "id = '" . $row['coures_id'] . "'") ?></td>
                                    <td><div class="word-wrap"><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></div></td>
                                    <td><div class="word-wrap"><?php echo $row['email'] ?></div></td>
                                    <td style="text-align: center;">
                                        <div class="word-wrap">
                                            <?php echo ucfirst($typePay) ?>
                                        </div></td>
                                    <td class="center"><div class=""><?php echo $_status ?> </div></td>
                                    <td class="center"><div class="word-wrap"><?php echo $functions->ShowDateTh($row['booking_date']) ?></div></td>

                                    <td class="center"><div class="word-wrap"> 
                                            <a href="<?php echo ADDRESS_ADMIN_CONTROL ?>booking&action=edit&id=<?php echo $row['id'] ?>" class="btn btn-primary btn-small">แก้ไข / ดู</a> 
                                            <a href="#" onclick="if (confirm('คุณต้องการลบข้อมูลนี้หรือใม่?') == true) {
                                                        document.location.href = '<?php echo ADDRESS_ADMIN_CONTROL ?>booking&action=del&id=<?php echo $row['id'] ?>'
                                                                }" class="btn btn-danger btn-small">ลบ</a>
                                        </div></td>
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
                                                    $('#short_booking').maxlength({max: 300});
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

    function enableRadioPay1() {
        // alert('1');
        $('input[name="pre_pay_1_total"]').attr('readonly', false);

    }
    function enableRadioPay2() {
        //  alert('2');

        $('input[name="pre_pay_2_total"]').attr('readonly', false);

    }
    $('#unpay1').click(function () {
        $('input[name="pre_pay_1_total"]').attr('readonly', true);
        $('input[name="pre_pay_1_total"]').val('0');
    });
    $('#unpay2').click(function () {
        $('input[name="pre_pay_2_total"]').attr('readonly', true);
        $('input[name="pre_pay_2_total"]').val('0');

    });


    $(function () {
        // $( "#datepicker" ).datepicker();
        $("#activity_date").datepicker({dateFormat: "yy-mm-dd"}).val()
    });

    $(document).ready(function () {

        $('#price_format').autoNumeric('init');
        $('#price_format2').autoNumeric('init');
        $('#price_total').autoNumeric('init');
        $('#pre_pay_1_total').autoNumeric('init');
        $('#pre_pay_2_total').autoNumeric('init');

        $("input[name='submit_bt']").click(function () {
            $('#price').val($('#price_format').autoNumeric('get'));

            $('#pay_1_total').val($('input[name="pre_pay_1_total"]').autoNumeric('get'));
            $('#pay_2_total').val($('input[name="pre_pay_2_total"]').autoNumeric('get'));

        });

    });



    $('input[name="payment_type"]').click(function () {
        if ($(this).val() == 'full') {
            $('#box-pay-2').addClass('hidden');
            $('#str').addClass('hidden');
            //alert('f');str
        }
        if ($(this).val() == 'half') {
            // alert('h');
            $('#box-pay-2').removeClass('hidden');
            $('#str').removeClass('hidden');
        }
    });

    $(function () {
        $('#booking_date').datepicker({
            minDate: "1",
            dateFormat: "yy-mm-dd"
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
    .bg-danger{
        color: #a94442;
        background-color: #f2dede !important;
        border-color: #ebccd1;
    }
    .bg-warning{
        color: #8a6d3b;
        background-color: #fcf8e3;
        border-color: #faebcc;
    }

</style>
