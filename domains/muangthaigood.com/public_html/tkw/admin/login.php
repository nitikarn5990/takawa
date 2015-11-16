<?php
// Prerequisites

include_once($_SERVER["DOCUMENT_ROOT"] . '/lib/application.php');
?>

<?php
if ($_POST['submit_bt'] == 'เข้าสู่ระบบ') {

    $username = trim($_POST['username']);

    $password = trim($_POST['password']);



    $sql = "SELECT * FROM " . $users->getTbl() . " WHERE username = '" . $username . "' AND user_groups_id = '1'";

    $query = $db->Query($sql);

    $con = $db->NumRows($query);

    if ($con > 0) {

        $row = $db->FetchArray($query);

        $getKey = $row['hash_key'];

        $getPass = $row['password'];

        $decodePass = $functions->deCrypted($getPass, $getKey);


        if ($password == $decodePass) {

            $_SESSION['admin_id'] = $row['id'];

            setcookie('id', $row['id'], time() + (86400 * 30), "/"); // 86400 = 1 day
            header('location:' . ADDRESS_ADMIN_CONTROL.'slides');
            die();
        } else {

            SetAlert('ชื่อผู้ใช้ กับรหัสผ่านไม่ตรงกัน กรุณาลองใหม่อีกครั้ง');
        }
    } else {

        SetAlert('ไม่มีชื่อผู้ใช้นี้ กรุณาลองใหม่อีกครั้ง');
    }
}
?>

<!DOCTYPE html>

<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->

<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->

<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->

<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->



    <head>

        <meta charset="utf-8">



        <?php include("inc/head.php") ?>

        <!-- Login Stylesheet -->

        <link rel="stylesheet" href="assets/css/login.min.css" media="screen">

        <link rel="stylesheet" href="plugins/zocial/zocial.css" media="screen">


    </head>



    <body>



        <div id="da-home-wrap">

            <?php
// Report errors to the user

            Alert(GetAlert('error'));

            Alert(GetAlert('success'), 'success');
            ?>

            <div id="da-home-wrap-inner">

                <div id="da-home-inner">

                    <div id="da-home-box">

                        <div id="da-home-box-header" style="text-align: center;">

                            <img src="<?= ADDRESS_ASSETS ?>logo.png" style="max-width: 207px;">

                        </div>

                        <form class="da-form da-home-form" method="post" action="">

                            <div class="da-form-row">

                                <div class=" da-home-form-big">

                                    <input type="text" name="username" id="da-login-username" placeholder="Username">

                                </div>

                                <div class=" da-home-form-big">

                                    <input type="password" name="password" id="da-login-password" placeholder="Password">

                                </div>

                            </div>

                            <div class="da-home-form-btn-big">

                                <input type="submit" value="เข้าสู่ระบบ" name="submit_bt" id="da-login-submit" class="btn btn-warning btn-block">

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>



    </body>



</html>

<style>
    body{
        background: rgb(255,255,255) !important;
        background: -moz-radial-gradient(center, ellipse cover, rgba(255,255,255,1) 0%, rgba(229,229,229,1) 100%) !important;
        background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%,rgba(255,255,255,1)), color-stop(100%,rgba(229,229,229,1))) !important;
        background: -webkit-radial-gradient(center, ellipse cover, rgba(255,255,255,1) 0%,rgba(229,229,229,1) 100%) !important;
        background: -o-radial-gradient(center, ellipse cover, rgba(255,255,255,1) 0%,rgba(229,229,229,1) 100%) !important;
        background: -ms-radial-gradient(center, ellipse cover, rgba(255,255,255,1) 0%,rgba(229,229,229,1) 100%) !important;
        background: radial-gradient(ellipse at center, rgba(255,255,255,1) 0%,rgba(229,229,229,1) 100%) !important;
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#e5e5e5',GradientType=1 ) !important;
    }
</style>



<!-- Localized -->