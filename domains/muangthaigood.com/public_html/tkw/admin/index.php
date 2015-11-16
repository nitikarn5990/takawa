<?php
// Prerequisites
include_once($_SERVER["DOCUMENT_ROOT"] . '/lib/application.php');

if (PAGE_CONTROLLERS == 'logout') {
    session_start();
    session_destroy();
    header('location:' . ADDRESS_ADMIN . 'login.php');
}
if ($_SESSION['admin_id'] != "") {
    $users->SetPrimary($_SESSION['admin_id']);
    $users->GetInfo();
} else {
    header('location:' . ADDRESS_ADMIN . 'login.php');
    die();
}
if (!isset($_COOKIE['id'])){
    header('location:' . ADDRESS_ADMIN . 'login.php');
    die();
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
    </head>

    <body>

        <!-- Main Wrapper. Set this to 'fixed' for fixed layout and 'fluid' for fluid layout' -->
        <div id="da-wrapper"> 

            <!-- Header -->
            <div id="da-header">
                <?php include("inc/header.php") ?>
            </div>

            <!-- Content -->
            <div id="da-content"> 

                <!-- Container -->
                <div class="da-container clearfix"> 

                    <!-- Sidebar Separator do not remove -->
                    <div id="da-sidebar-separator"></div>

                    <!-- Sidebar -->
                    <div id="da-sidebar"> 

                        <!-- Navigation Toggle for < 480px -->
                        <div id="da-sidebar-toggle"></div>

                        <!-- Main Navigation -->
                        <div id="da-main-nav" class="btn-container">
                            <?php include("inc/navigation.php") ?>
                        </div>
                    </div>

                    <!-- Main Content Wrapper -->
                    <div id="da-content-wrap" class="clearfix"> 

                        <!-- Content Area -->
                        <div id="da-content-area">
                            <?php 
							if(PAGE_CONTROLLERS == '' || PAGE_CONTROLLERS == 'index'){
								include("controllers/slides.php"); 
								
							}else{
								include("controllers/" . PAGE_CONTROLLERS . ".php"); 
							}
							
							
							?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div id="da-footer">
                <div class="da-container clearfix">
                    <p>Copyright 2016. </p>
                </div>
            </div>
        </div>
        <script src="http://malsup.github.io/jquery.blockUI.js"></script> 
        <script>
            
            
            
            
            $("input[type='submit']").click(function () {
                //	$.blockUI({ message: '<h4><i class="fa fa-circle-o-notch fa-spin"></i> กรุณารอสักครู่ </h4>' });
            });
            
            
            
            
        </script> 
        <!-- Localized -->
        <style>
            tr {
                font-size:12px;
            }
            .word-wrap {
                max-width: 200px;
                word-wrap: break-word;
            }

            .text-center{
                text-align:center !important;
            }
            ul li{
                list-style:none;
            }
            a.file_link{
                color: #000 !important;
            }
            a.file_link:hover{
                color: #000 !important;
            }
            .hidden{
                display:none !important;
            }
            .img_cover{
                max-width:75px;
                max-height:75px;

            }


        </style>
    </body>
</html>