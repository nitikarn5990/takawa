<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php include_once($_SERVER["DOCUMENT_ROOT"] . '/lib/application.php'); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>CHANG COOKING & RESTAURANT</title>
        <meta name="keywords" content="CHANG COOKING & RESTAURANT">
            <meta name="description" content="CHANG COOKING & RESTAURANT">
                <link rel="shortcut icon" href="<?= ADDRESS ?>images/icon.png">
                    <link rel="stylesheet" href="<?= ADDRESS ?>style.css" type="text/css">
                        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
                        <script src="<?= ADDRESS ?>dist/slippry.min.js"></script>
                        <script src="//use.edgefonts.net/cabin;source-sans-pro:n2,i2,n3,n4,n6,n7,n9.js"></script>
                        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
                            <meta name="viewport" content="width=device-width">
                                <link rel="stylesheet" href="<?= ADDRESS ?>slide.css">
                                    <link rel="stylesheet" href="<?= ADDRESS ?>dist/slippry.css">
                                        <link href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css"
                                              rel="stylesheet" type="text/css" />                                                                      
                                        <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>


                                        <link rel="stylesheet" href="<?= ADDRESS ?>date_picker/css/pickmeup.css">
                                            <script src="<?= ADDRESS ?>date_picker/js/jquery.pickmeup.min.js"></script>

                                            <!-- jQuery -->

                                            <!-- Verify.js (with Notify.js included) -->
                                            <script src="<?= ADDRESS ?>verify.notify.min.js"></script>
                                            <style>
                                                .pickmeup{
                                                    z-index: 99999999;
                                                }
                                                #Reservations,#_people {
                                                    height:  25px;

                                                }
                                                #_payments,#_course{
                                                    height:  31px;
                                                }
                                                .btn{
                                                    display: inline-block;
                                                    margin-bottom: 0;
                                                    font-weight: normal;
                                                    text-align: center;
                                                    vertical-align: middle;
                                                    touch-action: manipulation;
                                                    cursor: pointer;
                                                    background-image: none;
                                                    border: 1px solid transparent;
                                                    white-space: nowrap;
                                                    padding: 6px 12px;
                                                    font-size: 12px;
                                                    line-height: 1.42857;
                                                    border-radius: 0px;
                                                    -webkit-user-select: none;
                                                    -moz-user-select: none;
                                                    -ms-user-select: none;
                                                    user-select: none;
                                                }
                                                .btn-default{
                                                    color: #333;
                                                    background-color: #fff;
                                                    border-color: #ccc;
                                                }
                                                .btn-book{
                                                    color: white;
                                                    background-color: #d25c04;
                                                    border-color: #f54303;
                                                }

                                                fieldset { border:1px solid green ;

                                                           border:1px solid #D2D2D2;
                                                           border-radius:8px;

                                                           background-color: white;
                                                }

                                                legend {
                                                    padding: 0.2em 0.5em;
                                                    border:1px solid #B6B6B6;
                                                    color:black;
                                                    font-size:90%;
                                                    text-align:left;
                                                    margin-left: 17px;
                                                }
                                                em.required{
                                                    color: red;
                                                }
                                                .form-control {
                                                    display: block;
                                                    width: 100%;
                                                    height: 24px;

                                                    font-size: 14px;
                                                    line-height: 1.42857143;
                                                    color: #555;
                                                    background-color: #fff;
                                                    background-image: none;
                                                    border: 1px solid #ccc;
                                                    border-radius: 4px;
                                                    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
                                                    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
                                                    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
                                                    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
                                                    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
                                                }
                                                .alert{
                                                    padding: 15px;
                                                    margin-bottom: 20px;
                                                    border: 1px solid transparent;
                                                    border-radius: 4px;
                                                }
                                                .alert-success {
                                                    color: #3c763d;
                                                    background-color: #dff0d8;
                                                    border-color: #d6e9c6;
                                                }
                                            </style>
                                            </head>

                                            <body>

                                                <div id="logo-menu">

                                                    <div id="sizelogo-menu">
                                                        <div class="logo"><a href=""><img src="<?= ADDRESS ?>images/logo.png"  width="122" height="170" /></a></div>
                                                        <div class="menu">
                                                            <ul>
                                                                <li><a href="<?= ADDRESS ?>">HOME</a></li>
                                                                <li><a href="<?= ADDRESS ?>about.html">ABOUT US</a></li>
                                                                <li><a href="<?= ADDRESS ?>menu.html">MENU</a></li>
                                                                <li><a href="<?= ADDRESS ?>course.html">COURSE</a></li>
                                                                <li><a href="<?= ADDRESS ?>guestbook.html">GUESTBOOK</a></li>
                                                                <li><a href="<?= ADDRESS ?>contact.html">CONTACT US</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="slide">
                                                    <article class="demo_block">
                                                        <ul id="demo1">
                                                            <?php
                                                            $sql = "SELECT * FROM " . $slides->getTbl() . " WHERE status = 'ใช้งาน' ORDER BY sort ASC";


                                                            $query = $db->Query($sql);


                                                            while ($row = $db->FetchArray($query)) {
                                                                $image = $slides_file->getDataDescLastID("file_name", "slides_id = '" . $row['id'] . "'");
                                                                ?>
                                                                <li><img src="<?php echo ADDRESS_SLIDES . $image ?>" alt="<?php echo $row['slides_name'] ?>" /> </li>



                                                            <?php } ?>

                                                        </ul>
                                                    </article>

                                                    <script>
                                                        $(function () {
                                                            var demo1 = $("#demo1").slippry({
                                                                transition: 'fade',
                                                                useCSS: true,
                                                                speed: 1000,
                                                                pause: 3000,
                                                                auto: true,
                                                                preload: 'visible'
                                                            });

                                                            $('.stop').click(function () {
                                                                demo1.stopAuto();
                                                            });

                                                            $('.start').click(function () {
                                                                demo1.startAuto();
                                                            });

                                                            $('.prev').click(function () {
                                                                demo1.goToPrevSlide();
                                                                return false;
                                                            });
                                                            $('.next').click(function () {
                                                                demo1.goToNextSlide();
                                                                return false;
                                                            });
                                                            $('.reset').click(function () {
                                                                demo1.destroySlider();
                                                                return false;
                                                            });
                                                            $('.reload').click(function () {
                                                                demo1.reloadSlider();
                                                                return false;
                                                            });
                                                            $('.init').click(function () {
                                                                demo1 = $("#demo1").slippry();
                                                                return false;
                                                            });
                                                        });
                                                    </script>
                                                </div>
                                                <div id="boxbook">
                                                    <div class="boxbook">
                                                        <div class="linebook">


                                                            <form action="<?= ADDRESS ?>course-confirm.html" method="post" id="frmbook">
                                                                <input type="text" onkeyup="cleartext(this)" data-validate="required"  name="Reservations" id="Reservations" placeholder="Reservations date" style="margin-right: 35px;"/>
                                                                <select  id="_course" name="course_id" data-validate="required"  style="margin-right: 35px;width: 165px;">
                                                                    <option value="">Course</option>
                                                                    <?php
                                                                    $sql = "SELECT * FROM " . $coures->getTbl() . " WHERE status = 'ใช้งาน' ORDER BY sort ASC";

                                                                    $query = $db->Query($sql);
                                                                    while ($row = $db->FetchArray($query)) {
                                                                        $image = $slides_file->getDataDescLastID("file_name", "slides_id = '" . $row['id'] . "'");
                                                                        ?>
                                                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['coures_title'] ?></option>


                                                                    <?php } ?>
                                                                </select>

                                                                <select  id="_payments" name="payments" data-validate="required"   style="margin-right: 35px;width: 165px;">
                                                                    <option value="">Payments</option>
                                                                    <option value="full">Full </option>
                                                                    <option value="half">Half </option>
                                                                </select>
                                                                <select  data-validate="required"  id="_people" name="people" style="width: 173px;height: 31px;text-align: center;margin-right: 35px;">
                                                                    <option value="">Total people</option>
                                                                    <?php for ($i = 1; $i <= 100; $i++) { ?>
                                                                        <option value="<?= $i ?>" <?= $i == $people ? 'selected' : '' ?>><?= $i ?></option>
                                                                    <?php }
                                                                    ?>

                                                                </select>      
                                                                <button type="submit" class="btn btn-book" value="btn_st" name="btn_st" id="btn_st"><span style="font-size: 14px;">Book Now</span></button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php
                                                if (PAGE_CONTROLLERS == '' || PAGE_CONTROLLERS == 'index') {
                                                    // include 'inc/slides.php';
                                                    include 'controllers/index.php';
                                                } else {
                                                    include 'controllers/' . PAGE_CONTROLLERS . '.php';
                                                }

                                                include 'inc/footer.php';
                                                ?>

                                                <script>
                                                    $(function () {
                                                        $('#Reservations').datepicker({
                                                            minDate: "1",
                                                            dateFormat: "yy-mm-dd",
                                                        });
                                                    });
                                                    function cleartext(ele) {
                                                        $(ele).val('');
                                                    }
                                                </script>
                                                <script>
                                                    var format = function (num) {
                                                        var str = num.toString().replace("฿", ""), parts = false, output = [], i = 1, formatted = null;
                                                        if (str.indexOf(".") > 0) {
                                                            parts = str.split(".");
                                                            str = parts[0];
                                                        }
                                                        str = str.split("").reverse();
                                                        for (var j = 0, len = str.length; j < len; j++) {
                                                            if (str[j] != ",") {
                                                                output.push(str[j]);
                                                                if (i % 3 == 0 && j < (len - 1)) {
                                                                    output.push(",");
                                                                }
                                                                i++;
                                                            }
                                                        }
                                                        formatted = output.reverse().join("");
                                                        return("฿ " + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
                                                    };
                                                    $(function () {
                                                        $("#cc").keyup(function (e) {
                                                            $(this).val(format($(this).val()));
                                                        });
                                                    });


                                                    $(document).ready(function () {
                                                        var newc1 = format($("#cc_totaltopay").text());
                                                        $("#cc_totaltopay").text(newc1);

                                                        var newc2 = format($("#cc_totalamount").text());
                                                        $("#cc_totalamount").text(newc2);

                                                        var newc3 = format($("#cc_paycash").text());
                                                        $("#cc_paycash").text(newc3);




                                                    });
                                                </script>
                                           


                                                            </body>
                                                            </html>
