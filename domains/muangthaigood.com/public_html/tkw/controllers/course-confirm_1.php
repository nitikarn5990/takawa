<?php
session_start();
//session_destroy();
//exit();

if ($_POST['continue'] == 'Continue') {
    ?>
    <form action="" method="post">

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
                        <td style="text-align: right; width: 190px;">Course</td>
                        <td><?= $_SESSION['coures_title'] ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">Payments</td>
                        <td><?= ucfirst($_SESSION['_payments']) ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">Reservations date</td>
                        <td><?php
                            $arrDate = explode('-', $_SESSION['Reservations']);
                            $_SESSION['ReservationsFormat'] = $arrDate[2] . '/' . $arrDate[1] . '/' . $arrDate[0];
                            echo $arrDate[2] . '/' . $arrDate[1] . '/' . $arrDate[0];
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">Total People</td>
                        <td><?= $_SESSION['people'] ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">Price/course</td>
                        <td ><?= $_SESSION['currency_snytax'] . ' ' . $_SESSION['price'] ?></td>
                    </tr>
                    <?php
                    if ($_SESSION['_payments'] == 'half') {

                        $still = ($_SESSION['price'] * $_SESSION['people']) - $_SESSION['total'];
                        $_SESSION['still'] = $still;
                        ?>
                        <tr>
                            <td style="text-align: right;">Still to Pay</td>
                            <td ><?= $_SESSION['currency_snytax'] . ' ' . $still ?></td>
                        </tr>
                    <?php } ?>

                    <tr>
                        <td style="text-align: right;font-weight: bold;">Total</td>
                        <td style="font-weight: bold;"><?= $_SESSION['currency_snytax'] . ' ' . $_SESSION['total'] ?></td>
                    </tr>
                </table>

            </fieldset>

            <fieldset style="margin-bottom: 20px; padding-bottom: 35px;">
                <legend style="  font-size: 14px;">Detail Customer</legend>
                <table style="width: 500px;">
                    <tr>
                        <td></td>
                        <td><h2>Customer Information</h2></td>
                    </tr>
                    <tr>
                        <td style="text-align: right; width: 190px;">Name <em class="required">*</em></td>
                        <td><input required="" style="width: 100%;" type="text" name="name" class="form-control"></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">Email <em class="required">*</em></td>
                        <td><input required="" style="width: 100%;" type="email" name="email" class="form-control"></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">Tel <em class="required">*</em></td>
                        <td><input  required=""style="width: 100%;" type="text" name="tel" class="form-control"></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">Hotel name <em class="required">*</em></td>
                        <td><input style="width: 100%;" required="" type="text" name="hotel_name" class="form-control"></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">Hotel address <em class="required">*</em></td>
                        <td><textarea required="" style="height: 100px;" name="hotel_address" class="form-control"></textarea></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">Note</td>
                        <td><textarea style="height: 100px;" name="note" class="form-control"></textarea></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <button type="submit" value="Confirm Order" name="btn_confirm_order" class="btn btn-default"><i class="fa fa-shopping-cart "></i> Confirm Order</button>
                            <a class="btn btn-default" href="<?= ADDRESS ?>course.html">Cancel</a>
                        </td>
                    </tr>

                </table>
            </fieldset>

        </div>
        <input type="hidden" name="_course" value="<?= $_POST['_course'] ?>"
               <input type="hidden" name="_people" value="<?= $_POST['_people'] ?>"
               <input type="hidden" name="Reservations" value="<?= $_POST['Reservations'] ?>"
               <input type="hidden" name="payments" value="<?= $_POST['payments'] ?>"
               <input type="hidden" name="total2" value="<?= $_POST['total2'] ?>"
               <input type="hidden" name="coures_name" value="<?= $_POST['coures_name'] ?>" 
               <input type="hidden" name="still" value="<?= $still ?>" 
    </form>

    <?php
} else if ($_POST['btn_confirm_order'] == 'Confirm Order') {

    //save order
    require_once('../phpmailer/class.phpmailer.php');

    $booking->SetValue('coures_id', $_SESSION['_course']);
    $booking->SetValue('people', $_SESSION['people']);
    $booking->SetValue('name', $_POST['name']);
    $booking->SetValue('email', $_POST['email']);
    $booking->SetValue('tel', $_POST['tel']);
    $booking->SetValue('hotel_name', $_POST['hotel_name']);
    $booking->SetValue('hotel_address', $_POST['hotel_address']);
    $booking->SetValue('booking_date', $_SESSION['Reservations']);
    $booking->SetValue('payment_type', $_SESSION['_payments']);
    $booking->SetValue('payment_1_status', 'รอชำระเงิน');
    $booking->SetValue('payment_2_status', 'รอชำระเงิน');
    $booking->SetValue('note', $_POST['note']);
    $booking->SetValue('created_at', DATE_TIME);
    // $booking->SetValue('pay_1_total', $_SESSION['']);
    $booking->Save();
    
           
    $time_pickup = $functions->getTime($coures->getDataDesc('pickup_time_start','id='.$_SESSION['_course'])) .'-'. $functions->getTime($coures->getDataDesc('pickup_time_end','id='.$_SESSION['_course'])) ;
     $time_coures = $functions->getTime($coures->getDataDesc('time_start','id='.$_SESSION['_course'])) .'-'. $functions->getTime($coures->getDataDesc('time_end','id='.$_SESSION['_course'])) ;
    /// echo $booking->GetPrimary();
    if ($booking->Save()) { 

        $btnpay = "<form action='https://www.sandbox.paypal.com/cgi-bin/webscr' method='post' id='frmPayPal1' name='frmPayPal1'>
    <input type='hidden' name='business' value='business.text@gmail.com'>
    <input type='hidden' name='cmd' value='_ext-enter'> 
    <input type='hidden' name='redirect_cmd' value='_xclick'> 
    <input type='hidden' name='item_name' value='" . $_SESSION['coures_title'] . "'>
    <input type='hidden' name='amount' value='" . $_SESSION['total'] . "'>
    <input type='hidden' name='rm' value='2'> 
    <input type='hidden' name='currency_code' value='THB'>
    <input type='hidden' name='cancel_return' value='".ADDRESS."course.html'>
    <input type='hidden' name='return' value='".ADDRESS."course.html'>
    <input type='image' src='https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif' border='0' name='submit' alt='PayPal - The safer, easier way to pay online!'>
    <img alt='' border='0' src='https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif' width='1' height='1'>
   
</form>";


        $detail_order = "<table style='width: 100%;'>
                    <tbody><tr>
                        <td colspan='2'>
                            <h2>Booking course information and payments</h2>
                        </td>

                    </tr>
                    <tr>
                        <td colspan='2' style='text-align: center;'><img src='" . ADDRESS . "images/logo.png' style='max-width: 70px;padding-right: 98px;'></td>

                    </tr>
                     <tr>
                        <td style='text-align: right; width: 190px;'>Order ID</td>
                        <td>" . $booking->GetPrimary() . "</td>
                    </tr>
                    <tr>
                        <td style='text-align: right; width: 190px;'>Course</td>
                        <td>" . $_SESSION['coures_title'] . "</td>
                    </tr>
                    <tr>
                        <td style='text-align: right;'>Payments</td>
                        <td>" . $_SESSION['_payments'] . "</td>
                    </tr>
                    <tr>
                        <td style='text-align: right;'>Reservations date</td>
                        <td>" . $_SESSION['ReservationsFormat'] . "                       </td>
                    </tr>
                    <tr>
                        <td style='text-align: right;'>Total People</td>
                        <td>" . $_SESSION['people'] . "</td>
                    </tr>
                    <tr>
                        <td style='text-align: right;'>Price/course</td>
                        <td>฿ " . $_SESSION['price'] . "</td>
                    </tr>
                
                    <tr>
                        <td style='text-align: right;font-weight: bold;'>Total</td>
                        <td style='font-weight: bold;'>฿ " . $_SESSION['total'] . "</td>
                    </tr>
                    <tr colspan='2'>
                         <td style='text-align: right;font-weight: bold;'></td>
                        <td style='font-weight: bold;  padding-left: 120px;'> " . $btnpay . "</td>
                    </tr>
                </tbody></table>";

        $detail2 = "<table border='0' cellpadding='0' cellspacing='0' width='100%'>
					<tbody>
						<tr>
							<td>
								<table border='0' cellpadding='0' cellspacing='1' width='100%'>
									<tbody>
									</tbody>
								</table>
								<table border='0' cellpadding='0' cellspacing='0' width='100%'>
									<tbody>
										<tr>
											<td bgcolor='#000000' height='30' width='170'>
												<div align='center'>
													<span style='font-size:12px'><span style='font-family:tahoma,geneva,sans-serif'><span style='color:rgb(255,255,255)'><strong><span class='il'></span><span class='il'></span>Booking course information and payments</strong></span></span></span></div>
											</td>
											
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td bgcolor='#efefef'>
								<table bgcolor='#dddddd' border='0' cellpadding='0' cellspacing='0' width='100%'>
									<tbody>
										<tr>
											<td height='100'>
												<ul>
													<li>
														<font color='#000000'><strong><span style='font-size:12px'><span style='font-family:tahoma,geneva,sans-serif'>Order ID : " .str_pad($booking->GetPrimary(),5,'0', STR_PAD_LEFT)  . "</span></span></strong></font></li>
													<li>
														<font color='#000000'><strong><span style='font-size:12px'><span style='font-family:tahoma,geneva,sans-serif'>Course :<span style='color:rgb(0,0,255)'> </span><span style='color:rgb(255,0,0)'>" . $_SESSION['coures_title'] . "</span></span></span></strong></font></li>
												
                                                                                                         <li>
														<font color='#000000'><strong><span style='font-size:12px'><span style='font-family:tahoma,geneva,sans-serif'>Reservations date : <span style='color:rgb(255,0,0)'>" . $_SESSION['ReservationsFormat'] . " </span></span></span></strong></font></li>  
                                                                                           
                                                                                                                     <li>
														<font color='#000000'><strong><span style='font-size:12px'><span style='font-family:tahoma,geneva,sans-serif'>Pick up time : <span style='color:rgb(255,0,0)'>" . $time_pickup. " </span></span></span></strong></font></li>  
                                                                                                                    
                                                                                                            <li>
														<font color='#000000'><strong><span style='font-size:12px'><span style='font-family:tahoma,geneva,sans-serif'>Time course : <span style='color:rgb(255,0,0)'>" . $time_coures . " </span></span></span></strong></font></li> 
                                                                                                                             
                                                                                                            <li>
														<font color='#000000'><strong><span style='font-size:12px'><span style='font-family:tahoma,geneva,sans-serif'>Hotel name : <span style='color:rgb(255,0,0)'>" .  $booking->GetValue('hotel_name') . " </span></span></span></strong></font></li>  
                                                                                                                             
                                                                                                            <li>
														<font color='#000000'><strong><span style='font-size:12px'><span style='font-family:tahoma,geneva,sans-serif'>Hotel address : <span style='color:rgb(255,0,0)'>" . $booking->GetValue('hotel_address') . " </span></span></span></strong></font></li>  
 	<li>
														<font color='#000000'><strong><span style='font-size:12px'><span style='font-family:tahoma,geneva,sans-serif'>Payments : <span style='color:rgb(255,0,0)'>" . $_SESSION['_payments'] . " </span></span></span></strong></font></li>
<li>
														<font color='#000000'><strong><span style='font-size:12px'><span style='font-family:tahoma,geneva,sans-serif'>People : <span style='color:rgb(255,0,0)'>" . $_SESSION['people'] . " </span></span></span></strong></font></li>                                                                                                                       

<li>
														<font color='#000000'><strong><span style='font-size:12px'><span style='font-family:tahoma,geneva,sans-serif'>Price/course: <span style='color:rgb(255,0,0)'>฿ " . $_SESSION['price'] . " </span></span></span></strong></font></li>  
                                                                                                                      <li>
														<font color='#000000'><strong><span style='font-size:12px'><span style='font-family:tahoma,geneva,sans-serif'>Total : <span style='color:rgb(255,0,0)'>฿ " . $_SESSION['total'] . " </span></span></span></strong></font></li>  
                                                                                                                     <li>
														<font color='#000000'><strong><span style='font-size:12px'><span style='font-family:tahoma,geneva,sans-serif'>Pay now : <span style='color:rgb(255,0,0)'>" . $btnpay . " </span></span></span></strong></font></li>  
                                                                                                                  
                                                                                                            </ul>
											</td> 
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					</tbody>
				</table>";

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
        $mail->Body = $detail2;

        $mail->AddAddress($_POST['email']); // to Address

        $mail->set('X-Priority', '5'); //Priority 1 = High, 3 = Normal, 5 = low
        if ($status == false) {
            if (!$mail->Send()) {
                echo "<script>alert('Error !!!')</script>";
            } else {
                ?>
                <div id="contant" style="background-color: white;padding: 20px;">
                    <div class="alert alert-success">
                        <strong><i class="fa fa-check"></i> Order Success, Thank you for order</strong><br>
                        Booking courses and payments sent to your e-mail. Please check your email.
                    </div>
                    
                    <div style="display: none;">
                        <?=$btnpay?>
                    </div>
                    <script>
                            
    $(document).ready(function(){

            $.blockUI({
                css: { 
            padding: '15px', 
          
        } 
            }); 
           $('#frmPayPal1').submit();
      
    
    });
                    </script>
                </div>
                <?php
              
                foreach($_SESSION as $key => $val)
                        {

                            if ($key !== 'admin_id')
                            {

                              unset($_SESSION[$key]);

                            }

                        }
            }
        }
    }
    ?>




    <?php
} else {
    if ($_POST['btn_st'] == 'btn_st' || $_SESSION['_course'] != '') {
        if ($_POST['_course'] == '') {
            header('location:' . ADDRESS . 'course.html');
            die();
        }
        $_SESSION['currency'] = 'THB';
        $_SESSION['Reservations'] = $_POST['Reservations'];
        $_SESSION['people'] = $_POST['people'];

        $_SESSION['_course'] = $_POST['_course'];
        $_SESSION['_payments'] = $_POST['_payments'];

        $_SESSION['price'] = $coures->getDataDesc('price', 'id=' . $_SESSION['_course']);

        if ($_POST['_payments'] == 'half') {
            $_SESSION['total'] = ($_POST['people'] * $coures->getDataDesc('price', 'id=' . $_SESSION['_course'])) / 2;
        } else {
            $_SESSION['total'] = $_SESSION['people'] * $_SESSION['price'];
        }


        $_SESSION['currency_snytax'] = '฿';
        $_SESSION['coures_title'] = $coures->getDataDesc('coures_title', 'id=' . $_POST['_course']);
        $_SESSION['still'] = $_SESSION['total'] - $_SESSION['price'];
        if ($_POST['update_cart'] == 'Update cart') {

            $_SESSION['coures_title'] = $coures->getDataDesc('coures_title', 'id=' . $_SESSION['_course']);
            $_SESSION['_payments'] = $_POST['payments'];
            $_SESSION['people'] = $_POST['_people'];
            $_SESSION['total'] = $_SESSION['price'] * $_SESSION['people'];
            $_SESSION['Reservations'] = $_POST['Reservations'];
            $_SESSION['currency_snytax'] = '฿';
            $_SESSION['price'] = $coures->getDataDesc('price', 'id=' . $_SESSION['_course']);
            $_SESSION['still'] = $_SESSION['total'] - $_SESSION['price'];
            $price = $coures->getDataDesc('price', 'id=' . $_SESSION['_course']);
            if ($_POST['currency'] == 'USD') {
                $currency_from = "THB";
                $currency_to = "USD";
                $_SESSION['currency_snytax'] = '$';
                $currency_input = $coures->getDataDesc('price', 'id=' . $_SESSION['_course']);
                $currency = $functions->currencyConverter($currency_from, $currency_to, $currency_input);
                // $_SESSION['price'] = $currency;
                $price = $currency;
            }

            if ($_POST['payments'] == 'full') {
                $total = $price * $_POST['_people'];
            }
            if ($_POST['payments'] == 'half') {
                $total = ($price * $_POST['_people']) / 2;
            }
            $_SESSION['total'] = $total;
            $_SESSION['price'] = $price;
            $_SESSION['_payments'] = $_POST['payments'];
        }
        ?>

        <form action='<?= ADDRESS ?>course-confirm.html' method='POST'>
            <div id="contant" style="background-color: white;padding: 20px;">
                <div style="float: right;" class="hidden">
                    <em>currency convert </em>
                    <select id="currency" name="currency">
                        <option <?= $_POST['currency'] == 'THB' ? 'selected' : '' ?> value="THB">THB (&#3647;)</option>
                        <option <?= $_POST['currency'] == 'USD' ? 'selected' : '' ?> value="USD">USD ($)</option>
                    </select>
                </div>
                <h1 style="padding-left: 174px;font-weight: bold; color: #656565;">

                    <img src="<?= ADDRESS_ASSETS ?>cart.png">
                    Order Confirmation 
                </h1>

                <table style="width: 990px;">
                    <caption></caption>
                    <thead>
                        <tr>
                            <th style="width: 100px;">Item Image</th>
                            <th style="width:250px;">Item</th>
                            <th style="width: 100px;">Payments</th>
                            <th style="width: 100px;">Reservations date</th>
                            <th style="width: 200px;">Total People</th>
                            <th  style="width: 200px;">Price/Course</th>
                            <th  style="width: 200px;">Total</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td style="max-width: 220px;"><img src="<?= ADDRESS ?>images/coures1.jpg" style="max-width: 200px;"/></td>
                            <td style="text-align: left;width: 250px;  word-wrap: break-word;"><?= $coures->getDataDesc('coures_title', 'id=' . $_POST['_course']) ?></td>
                            <td> <select id="payments" required="" name="payments" class="form-control">
                                    <option <?= $_SESSION['_payments'] == 'full' ? 'selected' : '' ?> value="full">Full</option>
                                    <option <?= $_SESSION['_payments'] == 'half' ? 'selected' : '' ?> value="half">Half </option>
                                </select></td>
                            <td><input type="text" required=""  name="Reservations" class="date form-control" value="<?= $_SESSION['Reservations'] ?>"></td>
                            <td style="width: 200px;"><input required="" class="form-control" type="number" value="<?= $_SESSION['people'] ?>" name="_people"  id="_people" style="width: 40px;text-align: center;margin: auto;"></td>
                            <td style="width: 200px;"><span class="curency_snytax"><?= $_SESSION['currency_snytax'] . ' ' ?></span><?= $_SESSION['price'] ?></td>
                            <td style="width: 200px;"><span class="curency_snytax"><?= $_SESSION['currency_snytax'] . ' ' ?></span><?= $_SESSION['total'] ?></td>

                        </tr>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="6">Total Amount</th>
                            <th><span class="curency_snytax"><?= $_SESSION['currency_snytax'] . ' ' ?></span><?= $_SESSION['total'] ?></th>
                        </tr>
                        <tr>
                            <th colspan="7" style="  padding-right: 15px;">
                                <input type="submit" class="btn btn-default" name="update_cart" value="Update cart"> 
                                <input type="submit" class="btn btn-default" name="continue" value="Continue">
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>


            <input type="hidden" name="Reservations2" value="<?= $_POST['Reservations'] ?>">
            <input type="hidden" name="people2" value="<?= $_SESSION['people'] ?>">
            <input type="hidden" name="_course" value="<?= $_POST['_course'] ?>">
            <input type="hidden" name="payments2" value="<?= $_SESSION['_payments'] ?>">
            <input type="hidden" name="total2" value="<?= $_SESSION['total'] ?>">
            <input type="hidden" name="price2" value="<?= $_SESSION['price'] ?>"
                   <input type="hidden" name="coures_name" value="<?= $coures->getDataDesc('coures_title', 'id=' . $_POST['_course']) ?>"       
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
</script>

<script>
    $(function () {
        $('.date').pickmeup({
            format: 'Y-m-d'
        });
    });

</script>

<style>
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

    table {
        font-family: "Helvetica Neue", Helvetica, sans-serif;
        margin: auto;
    }

    caption {
        text-align: left;
        color: silver;
        font-weight: bold;
        text-transform: uppercase;
        padding: 5px;
    }

    thead {
        background: #DDD;
        color: #656565;
    }

    th,
    td {
        padding: 10px 10px;
    }


    tbody tr:nth-child(even) {
        background: WhiteSmoke;
    }

    tbody tr td:nth-child(2) {
        text-align:center;
    }

    tbody tr td:nth-child(3),
    tbody tr td:nth-child(4) {
        text-align: right;
        font-family: monospace;
    }

    tfoot {
        background: #DDD;
        color: black;
        text-align: right;
    }

    tfoot tr th:last-child {
        font-family: monospace;
    }

</style>
