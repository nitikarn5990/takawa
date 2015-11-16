<?php
session_start();

if ($_POST['continue'] == 'Continue') {
    ?>


    <div id="contant" style="background-color: white;padding: 20px;">

        <fieldset style="margin-bottom: 20px; padding-bottom: 35px;">
            <legend style="  font-size: 14px;">Detail Order</legend>
            <table style="width: 500px;">
                <tr>
                    <td colspan="2">
                        <h2>Order Detail</h2>
                    </td>

                </tr>
                <tr>
                    <td colspan="2"><img src="<?= ADDRESS ?>images/logo.png" style="max-width: 70px;"></td>

                </tr>
                <tr>
                    <td style=" width: 190px;" class="td-L">Course</td>
                    <td class="td-R"><?= $coures->getDataDesc('coures_title', 'id=' . $_POST['course_id']) ?></td>
                </tr>

                <tr>
                    <td class="td-L">Reservations date</td>
                    <td class="td-R"><?php
                        $arrDate = explode('-', $_POST['Reservations2']);
                        echo $arrDate[2] . '/' . $arrDate[1] . '/' . $arrDate[0];
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="td-L">Total People</td>
                    <td class="td-R"><?= $_POST['people2'] ?></td>
                </tr>
                <tr>
                    <td class="td-L">Total Amounts</td>
                    <td class="td-R">
                        <span id="cc_totalamount"><?= ($coures->getDataDesc('price', 'id=' . $_POST['course_id']) * $_POST['people2']) ?></span>
                    </td>
                </tr>
                <tr>
                    <td class="td-L">Payments</td>
                    <td class="td-R"><?= ucfirst($_POST['payments2']) ?></td>
                </tr>

                <?php
                $unpiad = '฿ 0';
                if ($_POST['payments2'] == 'half') {
                    $unpiad = ($coures->getDataDesc('price', 'id=' . $_POST['course_id']) * $_POST['people2']) / 2;
                }
                ?>



                <tr>
                    <td style="font-weight: bold;" class="td-L">Total to pay now</td>
                    <td style="font-weight: bold;" class="td-R">

                        <span id="cc_totaltopay"><?= $_POST['total2'] ?></span>

                    </td>
                </tr>


            </table>
            <div style="clear: both;margin-bottom: 20px;"></div>
            <table style="width: 500px;">

                <tr>
                    <td  class="td-L" style="width: 20px;"></td>
                    <td class="td-R" style="font-weight: bold;">Note:</td>

                </tr>
                <tr>
                    <td style="background-color: white;"></td>
                    <td  style="background-color: white;" class="td-R">Pay cash at Chang Cooking &nbsp;&nbsp;<span id="cc_paycash"><?= $unpiad ?></span></td>
                </tr>
                <tr >
                    <td style="background-color: white;"></td>
                    <td style="background-color: white;" class="td-R">Pay CASH ONLY when arriving at Chang Cooking & Restaurant on the reservation date.</td>
                </tr>

            </table>
            <div style="clear: both;margin-bottom: 20px;"></div>
            <table style="width: 500px;">

                <tr>
                    <td  class="td-L" style="width: 20px;"></td>
                    <td class="td-R" style="font-weight: bold;">Term and condition of booking</td>

                </tr>
                <tr>
                    <td style="background-color: white;"></td>
                    <td  style="background-color: white;" class="td-R">1. “Full” means paying at a full price of the course.</td>
                </tr>
                <tr >
                    <td style="background-color: white;"></td>
                    <td style="background-color: white;" class="td-R">2. “Half” means paying at a half price of the course, or paying a deposit 50% of the course.</td>
                </tr>
                <tr>
                    <td style="background-color: white;"></td>
                    <td style="background-color: white;" class="td-R"> &nbsp;&nbsp; 2.1 Pay the rest of the course by “CASH ONLY” when arriving at the school.</td>
                </tr>
                <tr>
                    <td style="background-color: white;"></td>
                    <td style="background-color: white;" class="td-R"> &nbsp;&nbsp; 2.2 Cash payment must be made prior to the booked class starts.</td>
                </tr>
                <tr>
                    <td style="background-color: white;"></td>
                    <td style="background-color: white;" class="td-R">3. Bring the Receipt Number with you (from your email) and show to staff when checking in.</td>
                </tr>
                <tr>
                    <td style="background-color: white;"></td>
                    <td style="background-color: white;" class="td-R">4. Booking cancellation or postpone must be made 7 days prior to the booking date starts. Otherwise, there will not be any refund.</td>
                </tr>





            </table>


        </fieldset>
        <form action="" method="post">
            <fieldset style="margin-bottom: 20px; padding-bottom: 35px;">
                <legend style="  font-size: 14px;">Detail Customer</legend>
                <table style="width: 500px;">
                    <tr>
                        <td></td>
                        <td><h2>Customer Information</h2></td>
                    </tr>
                    <tr>
                        <td style=" width: 190px;">First Name <em class="required">*</em></td>
                        <td><input data-validate="required"  style="width: 100%;" type="text" name="first_name" class="form-control"></td>
                    </tr>
                    <tr>
                        <td style=" width: 190px;">Last Name <em class="required">*</em></td>
                        <td><input data-validate="required"  style="width: 100%;" type="text" name="last_name" class="form-control"></td>
                    </tr>
                    <tr>
                        <td >Email <em class="required">*</em></td>
                        <td><input data-validate="required,email" style="width: 100%;" type="email" name="email" class="form-control"></td>
                    </tr>
                    <tr>
                        <td >Tel <em class="required">*</em></td>
                        <td><input data-validate="required,number" style="width: 100%;" type="text" name="tel" class="form-control tel"></td>
                    </tr>
                    <tr>
                        <td >Hotel name <em class="required">*</em></td>
                        <td><input data-validate="required" style="width: 100%;"  type="text" name="hotel_name" class="form-control"></td>
                    </tr>
                    <tr>
                        <td >Hotel address <em class="required">*</em></td>
                        <td><textarea data-validate="required" style="height: 100px;" name="hotel_address" class="form-control"></textarea></td>
                    </tr>
                    <tr>
                        <td >Note</td>
                        <td><textarea style="height: 100px;" name="note" class="form-control"></textarea></td>
                    </tr>
                    <tr>
                        <td >Enter Code <em class="required">*</em></td>
                        <td >
                            <input type="text" name="capt" id="capt" data-validate="required" /> <img src="image_capt.php" id="mycapt" align="absmiddle" />
                            <img id="changeCpt" src="https://www.e-cnhsp.sp.gov.br/GFR/imagens/refresh.png" style="vertical-align: middle;cursor: pointer;">
                            <span id="statuscode"></span>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <input type="hidden" name="course_id" value="<?= $_POST['course_id'] ?>">
                            <input type="hidden" name="people" value="<?= $_POST['people2'] ?>">
                            <input type="hidden" name="Reservations" value="<?= $_POST['Reservations2'] ?>">
                            <input type="hidden" name="payments" value="<?= $_POST['payments2'] ?>">
                            <input type="hidden" name="total" value="<?= $_POST['total2'] ?>">
                            <input type="hidden" name="coures_name" value="<?= $coures->getDataDesc('coures_title', 'id=' . $_POST['course_id']) ?>" >
                            
                        </td>
                        <td>
                            <button type="submit" value="Confirm Order" id="btn_confirm_order" name="btn_confirm_order" class="btn btn-default"><i class="fa fa-shopping-cart "></i> Confirm Order</button>
                             <input type="hidden" name="btn_confirm_order" value="Confirm Order">
                            <a class="btn btn-default" href="<?= ADDRESS ?>course.html">Cancel</a>
                        </td>
                    </tr>

                </table>
            </fieldset>
        </form>

    </div>
    <input type="hidden" name="chkerror">

    <script>

        function chkajax(cpt, callback) {

            $.ajax({
                type: 'GET',
                url: '<?= ADDRESS ?>chkcapt.php',
                data: {cpt: cpt},
                success: callback

            });

        }

        function chkcpt() {
            var cpt = $('#capt').val();
            var datas = $("input[name$='chkerror']").val();

            chkajax(cpt, function (data) {


                $("input[name$='chkerror']").val(data);


            });


        }
        $("#capt").keyup(function () {
            var cpt = $('#capt').val();


            chkajax(cpt, function (data) {
                if (data == 'error') {
                    $("#statuscode").html('<div style=color:red;>error</div>');
                    $("#btn_confirm_order").attr("disabled", true);
                } else {
                    $("#statuscode").html('<div style=color:green;>success</div>');
                    $("#btn_confirm_order").removeAttr("disabled");
                }


            });

        });


    </script>

    <?php
} 
else if ($_POST['btn_confirm_order'] == 'Confirm Order') {


    $sql = "SELECT * FROM " . $booking->getTbl() . " WHERE first_name = '" . $_POST['first_name'] . "' AND last_name='" . $_POST['last_name'] . "' AND email ='" . $_POST['email'] . "' ";
    $query = $db->Query($sql);
    $row = $db->FetchArray($query);
    if (mysql_numrows($query) > 0) {

        if ($row['payment_type'] == 'full') {
            if ($row['payment_1_status'] == 'ชำระเงินแล้ว') {
                $_status = 'ชำระเงินแล้ว';
            } else if ($row['payment_1_status'] == 'รอชำระเงิน') {
                $_status = 'รอชำระเงิน';
            }
        }
        if ($row['payment_type'] == 'half') {
            if ($row['payment_1_status'] == 'ชำระเงินแล้ว' &&
                    $row['payment_2_status'] == 'ชำระเงินแล้ว') {
                $_status = 'ชำระเงินแล้วครบแล้ว';
            } else {
                if ($row['payment_1_status'] == 'รอชำระเงิน') {
                    $_status = 'รอชำระเงิน';
                }
                if ($row['payment_2_status'] == 'รอชำระเงิน') {
                    $_status = 'รอชำระเงิน';
                }
            }
        }
        if ($_status == 'รอชำระเงิน') {
            $booking->DeleteMultiID($row['id']);
        }

        $booking->SetValue('coures_id', $_POST['course_id']);
        $booking->SetValue('people', $_POST['people']);
        $booking->SetValue('first_name', $_POST['first_name']);
        $booking->SetValue('last_name', $_POST['last_name']);
        $booking->SetValue('email', $_POST['email']);
        $booking->SetValue('tel', $_POST['tel']);
        $booking->SetValue('hotel_name', $_POST['hotel_name']);
        $booking->SetValue('hotel_address', $_POST['hotel_address']);
        $booking->SetValue('booking_date', $_POST['Reservations']);
        $booking->SetValue('payment_type', $_POST['payments']);
        $booking->SetValue('payment_1_status', 'รอชำระเงิน');
        $booking->SetValue('payment_2_status', 'รอชำระเงิน');
        $booking->SetValue('note', $_POST['note']);
        $booking->SetValue('created_at', DATE_TIME);
        // $booking->SetValue('pay_1_total', $_POST['']);
        // $time_pickup = $functions->getTime($coures->getDataDesc('pickup_time_start', 'id=' . $_POST['_course'])) . '-' . $functions->getTime($coures->getDataDesc('pickup_time_end', 'id=' . $_POST['_course']));
        // $time_coures = $functions->getTime($coures->getDataDesc('time_start', 'id=' . $_POST['_course'])) . '-' . $functions->getTime($coures->getDataDesc('time_end', 'id=' . $_POST['_course']));
        /// echo $booking->GetPrimary();
        if ($booking->Save()) {

            $btnpay = "<form action='https://www.paypal.com/cgi-bin/webscr' method='post' id='frmPayPal1' name='frmPayPal1'>
    <input type='hidden' name='business' value='changcooking@gmail.com'>
    <input type='hidden' name='cmd' value='_ext-enter'> 
    <input type='hidden' name='redirect_cmd' value='_xclick'> 
    <input type='hidden' name='item_name' value='" . $_POST['coures_name'] . "'>
    <input type='hidden' name='amount' value='" . $_POST['total'] . "'>
    <input type='hidden' name='rm' value='2'> 
    <input type='hidden' name='currency_code' value='THB'>
    <input type='hidden' name='cancel_return' value='" . ADDRESS . "course.html'>
    <input type='hidden' name='return' value='" . ADDRESS . "course.html'>
    <input type='image' src='https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif' border='0' name='submit' alt='PayPal - The safer, easier way to pay online!'>
    <img alt='' border='0' src='https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif' width='1' height='1'>
   
</form>";
            ?>
            <div id="contant" style="background-color: white;padding: 20px;">
                <div class="alert alert-success">
                    <strong><i class="fa fa-check"></i> Order Success, Thank you for order</strong><br>

                </div>

                <div style="display: none;">
                    <?= $btnpay ?>
                </div>
                <script>

                    $(document).ready(function () {

                        $.blockUI({
                            css: {
                                padding: '15px',
                            }
                        });
                        $('#frmPayPal1').submit();
                    });</script>
            </div>
            <?php
            foreach ($_POST as $key => $val) {

                if ($key !== 'admin_id') {

                    unset($_POST[$key]);
                }
            }
        }
    } else {

        $booking->SetValue('coures_id', $_POST['course_id']);
        $booking->SetValue('people', $_POST['people']);
        $booking->SetValue('first_name', $_POST['first_name']);
        $booking->SetValue('last_name', $_POST['last_name']);
        $booking->SetValue('email', $_POST['email']);
        $booking->SetValue('tel', $_POST['tel']);
        $booking->SetValue('hotel_name', $_POST['hotel_name']);
        $booking->SetValue('hotel_address', $_POST['hotel_address']);
        $booking->SetValue('booking_date', $_POST['Reservations']);
        $booking->SetValue('payment_type', $_POST['payments']);
        $booking->SetValue('payment_1_status', 'รอชำระเงิน');
        $booking->SetValue('payment_2_status', 'รอชำระเงิน');
        $booking->SetValue('note', $_POST['note']);
        $booking->SetValue('created_at', DATE_TIME);
        // $booking->SetValue('pay_1_total', $_POST['']);
        /// echo $booking->GetPrimary(); 
        if ($booking->Save()) {

            $btnpay = "<form action='https://www.paypal.com/cgi-bin/webscr' method='post' id='frmPayPal1' name='frmPayPal1'>
    <input type='hidden' name='business' value='changcooking@gmail.com'>
    <input type='hidden' name='cmd' value='_ext-enter'> 
    <input type='hidden' name='redirect_cmd' value='_xclick'> 
    <input type='hidden' name='item_name' value='" . $_POST['coures_name'] . "'>
    <input type='hidden' name='amount' value='" . $_POST['total'] . "'>
    <input type='hidden' name='rm' value='2'> 
    <input type='hidden' name='currency_code' value='THB'>
    <input type='hidden' name='cancel_return' value='" . ADDRESS . "course.html'>
    <input type='hidden' name='return' value='" . ADDRESS . "course.html'>
    <input type='image' src='https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif' border='0' name='submit' alt='PayPal - The safer, easier way to pay online!'>
    <img alt='' border='0' src='https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif' width='1' height='1'>
   
</form>";
            ?>
            <div id="contant" style="background-color: white;padding: 20px;">
                <div class="alert alert-success">
                    <strong><i class="fa fa-check"></i> Order Success, Thank you for order</strong><br>

                </div>

                <div style="display: none;">
                    <?= $btnpay ?>
                </div>
                <script>

                    $(document).ready(function () {

                        $.blockUI({
                            css: {
                                padding: '15px',
                            }
                        });
                        $('#frmPayPal1').submit();
                    });</script>
            </div>
            <?php
            foreach ($_POST as $key => $val) {

                if ($key !== 'admin_id') {

                    unset($_POST[$key]);
                }
            }
        }
    }
} else {



    if ($_POST['course_id'] == '') {

        echo "<META HTTP-EQUIV='Refresh' CONTENT='0;URL=" . ADDRESS . "course.html'>";
        die();
    }
    if ($_POST['btn_st'] == 'btn_st' || $_POST['update_cart'] == 'Update cart') {


        $Reservations = $_POST['Reservations'];
        $people = $_POST['people'] == '' ? '1' : $_POST['people'];

        $course_id = $_POST['course_id'];
        $payment = $_POST['payments'];

        $price_coures = $coures->getDataDesc('price', 'id=' . $course_id);
        $coverImg = $coures->getDataDesc('cover_img', 'id=' . $course_id) == '' ? 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS_fV5SFcSSGvr76IAV2bMBgLvyR4P1PqMcG-3Pd0nSCuAsx3k2ZXtnH1k' : ADDRESS_COVER . $coures->getDataDesc('cover_img', 'id=' . $course_id);

        $fullcost = $people * $price_coures;
        $payatchang = 0;
        if ($payment == 'half') {
            $totalAmt = ($people * $price_coures) / 2;
            $payatchang = $totalAmt;
        } else {
            $totalAmt = $people * $price_coures;
        }

        $coures_title = $coures->getDataDesc('coures_title', 'id=' . $course_id);
        ?>

        <form action='<?= ADDRESS ?>course-confirm.html' method='POST'>
            <div id="contant" style="background-color: white;padding: 20px;">

                <h1 style="padding-left: 174px;font-weight: bold; color: #656565;">

                    <img src="<?= ADDRESS_ASSETS ?>cart.png">
                    Order Confirmation 
                </h1>

                <table style="width: 990px;">
                    <thead>
                        <tr>
                            <th style="width: 100px;">Item Image</th>
                            <th style="width:250px;">Item</th>
                            <th style="width: 100px;">Reservations date</th>
                            <th style="width: 100px;">Total People</th>
                            <th  style="width: 100px;">Price/Course</th>
                            <th  style="width: 100px;">Total Amount</th>
                            <th style="width: 100px;">Payments</th>
                            <th style="width: 200px;">Pay online</th>
                            <th style="width: 100px;">Pay cash at Chang Cooking</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td style="max-width: 220px;"><img src="<?= $coverImg ?>" style="max-width: 200px;"/></td>
                            <td style="width: 250px;  word-wrap: break-word;"><?= $coures_title ?></td>
                            <td><input type="text" readonly="" required="" onchange="updatecart(this, 'Reservations')" id="datetobooking"  name="Reservations" class="date form-control" value="<?= $Reservations ?>"></td>
                            <td style="width: 200px;">
                                <select id="selectBox " class="form-control" name="people" onchange="updatecart(this, 'people')" style="width: 45px;text-align: center;margin: auto;">

                                    <?php for ($i = 1; $i <= 100; $i++) { ?>
                                        <option value="<?= $i ?>" <?= $i == $people ? 'selected' : '' ?>><?= $i ?></option>
                                    <?php }
                                    ?>

                                </select>
                            </td>
                            <td style="width: 200px;"><span class="curency_snytax"><?= '฿ ' ?></span><?= $price_coures ?></td>
                            <td style="width: 200px;"><span class="curency_snytax"><?= '฿ ' ?></span><span class="update_totalamount"><?= $fullcost ?></span></td>
                            <td> <select id="payments" required="" name="payments" class="form-control" onchange="updatecart(this, 'payments')">
                                    <option <?= $payment == 'full' ? 'selected' : '' ?> value="full">Full</option>
                                    <option <?= $payment == 'half' ? 'selected' : '' ?> value="half">Half </option>
                                </select></td>
                            <td style="width: 200px;"><span class="curency_snytax"><?= '฿ ' ?></span><span class="update_payonline"><?= $totalAmt ?></span></td>
                            <td style="width: 200px; color: red;"><span class="curency_snytax"><?= '฿ ' ?></span><span class="update_paycash"><?= $payatchang ?></span></td>
                        </tr>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="7" style="text-align: right;">Total to pay now</th>
                            <th><span class="curency_snytax" ><?= '฿ ' ?></span><span class="update_totalpay"><?= $totalAmt ?></span></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th colspan="9" style="  padding-right: 15px;">
                                <input  type="submit" class="btn btn-default" name="update_cart" value="Update cart" style="display: none;"> 
                                <input type="submit" class="btn btn-default" name="continue" value="Continue">
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>


            <input type="hidden" name="Reservations2" value="<?= $Reservations ?>">
            <input type="hidden" name="people2" value="<?= $people ?>">
            <input type="hidden" name="course_id" value="<?= $course_id ?>">
            <input type="hidden" name="payments2" value="<?= $payment ?>">
            <input type="hidden" name="total2" value="<?= $totalAmt ?>">
            <input type="hidden" name="price2" value="<?= $price_coures ?>">
            <input type="hidden" name="coures_name2" value="<?= $coures_title ?>"       
        </form>

        <?php
    }
}
?>

<script src="http://malsup.github.io/jquery.blockUI.js"></script>

<script>
                                function getData() {

                                    var currency = $('#currency').val();
                                    $.ajax({
                                        type: 'GET',
                                        url: '<?= ADDRESS ?>ajax.php',
                                        data: {data: currency},
                                        success: function (data) {
                                            alert(data);
                                        }
                                    });
                                }
                                function updatecart(ele, type) {
                                    if (type == 'Reservations') {
                                        $("input[name='Reservations2']").val($(ele).val());

                                    }
                                    if (type == 'people') {


                                        $('[name=people2]').val($(ele).val());

                                    }
                                    if (type == 'payments') {
                                        $("[name='payments2']").val($(ele).val());

                                    }
                                    var Reservations2 = $("input[name='Reservations2']").val();
                                    var people2 = $("input[name='people2']").val();
                                    var course_id = $("input[name='course_id']").val();
                                    var payments2 = $("input[name='payments2']").val();
                                    var total2 = $("input[name='total2']").val();
                                    var price2 = $("input[name='price2']").val();
                                    //var coures_name2 = $("input[name='coures_name2']").val();
                                    // alert($(ele).val()+type);
                                    // alert(course_id);
                                    //  alert(Reservations2);
                                    //  alert(people2);
                                    //  alert(payments2);


                                    $.ajax({
                                        method: "get",
                                        url: "<?= ADDRESS ?>ajax.php",
                                        data: {
                                            course_id: course_id,
                                            people: people2,
                                            payments: payments2,
                                            Reservations: Reservations2,
                                        },
                                        beforeSend: function () {
                                            $('div#contant').block({
                                                message: '<h1>Processing...</h1>',
                                                css: {
                                                    padding: '15px',
                                                }
                                            });
                                        },
                                        success: function (data) {
                                            var v = JSON.parse(data);
                                            //console.log(v.total_amount);




                                            $("input[name='total2']").val(v.total_paynow);
                                            $(".update_paycash").text(v.total_paycash);
                                            $(".update_payonline").text(v.total_paynow);
                                            $(".update_totalpay").text(v.total_paynow);
                                            $(".update_totalamount").text(v.total_amount);

                                            $('div#contant').unblock();
                                        }
                                    });
                                }
</script>

<script>
    $(function () {
        $('#datetobooking').datepicker({
            minDate: "1",
            dateFormat: "yy-mm-dd"
        });
    });</script>
<script type="text/javascript">
    $(document).ready(function (e) {

        $('#changeCpt').click(function (e) {
            var v = Math.random();
            $('#mycapt').attr('src', 'image_capt.php?v=' + v);
        });

        //called when key is pressed in textbox
        $(".tel").keypress(function (e) {
            //if the letter is not digit then display error and don't type anything
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                //display error message
                //$("#errmsg").html("Digits Only").show().fadeOut("slow");
                return false;
            }
        });
    });



</script>

<style>
    #ui-datepicker-div{
        z-index: 9999 !important;
    }
    .hidden{
        display: none;
    }

    #currency, .date ,._people,#payments{
        height: 30px;
    }
    #contant{
        text-align: center;
        margin-left: auto;
        margin-right: auto;
    }
    .boxcoures li{
        margin-bottom:15px;
    }
    a{
        text-decoration: none;
        color: black;
    }

    #contant table {
        font-family: "Helvetica Neue", Helvetica, sans-serif;
        margin: auto;
    }

    #contant caption {

        color: silver;
        font-weight: bold;
        text-transform: uppercase;
        padding: 5px;
    }

    #contant thead {
        background: #DDD;
        color: #656565;
    }

    #contant th,
    #contant td {
        padding: 5px 10px;
    }


    #contant tbody tr:nth-child(even) {
        background: WhiteSmoke;
    }

    #contant tbody tr td:nth-child(2) {

    }

    #contant tbody tr td:nth-child(3),
    #contant tbody tr td:nth-child(4) {

        font-family: monospace;
    }

    #contant tfoot {
        background: #DDD;
        color: black;

    }

    #contant tfoot tr th:last-child {
        font-family: monospace;
    }
    #contant .td-L{
        text-align: right;
        padding-right: 30px;
    }
    #contant .td-R{
        text-align: left;
        padding-left: 30px;
    }

</style>
