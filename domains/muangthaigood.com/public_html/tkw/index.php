<?php include_once($_SERVER["DOCUMENT_ROOT"] . '/lib/application.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Takawa Design and Construction Co., Ltd.</title>
        <meta name="description" content="Takawa Design and Construction Co., Ltd." />
        <meta name="keywords" content="Takawa Design and Construction Co., Ltd." />
        <link rel="shortcut icon" href="<?= ADDRESS ?>images/icon.png">
            <link href="<?= ADDRESS ?>style.css" rel="stylesheet" type="text/css" />
            <script src="<?= ADDRESS ?>js/jquery.min.js"></script>
            <script src="<?= ADDRESS ?>dist/slippry.min.js"></script>
            <script src="//use.edgefonts.net/cabin;source-sans-pro:n2,i2,n3,n4,n6,n7,n9.js"></script>
            <meta name="viewport" content="width=device-width">
                <link rel="stylesheet" href="<?= ADDRESS ?>slide.css">
                    <link rel="stylesheet" href="<?= ADDRESS ?>dist/slippry.css">
                        </head>
                        <body> 

                            <div id="logo-menu">
                                <div id="widthlogo-menu">
                                    <div class="logo"><a href=""><img src="<?= ADDRESS ?>images/logo.jpg" title="Takawa Design and Construction Co., Ltd." /></a></div>
                                    <div class="menu">
                                        <ul>
                                            <li><a href="<?= ADDRESS ?>">HOME</a></li>
                                            <li><a href="<?= ADDRESS ?>about.html">ABOUT US </a></li>
                                            <li><a href="<?= ADDRESS ?>takawa-international.html">TAKAWA INTERNATIONAL</a></li>
                                            <li><a href="<?= ADDRESS ?>takawa-design.html">TAKAWA DESIGN</a></li>
                                            <li><a href="<?= ADDRESS ?>management.html">MANAGEMENT</a></li>
                                            <li><a href="<?= ADDRESS ?>contact.html">CONTACT</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div id="slide">
                                <div class="imgslide">
                                    <article class="demo_block">
                                        <ul id="demo1" style="list-style:none; position:0; margin:0;">

                                            <?php
                                            $sql = "SELECT * FROM " . $slides->getTbl() . " WHERE status = 'ใช้งาน' ORDER BY sort ASC";


                                            $query = $db->Query($sql);


                                            while ($row = $db->FetchArray($query)) {
                                                $image = $slides_file->getDataDescLastID("file_name", "slides_id = '" . $row['id'] . "'");
                                                ?>
                                                <li><img src="<?php echo ADDRESS_SLIDES . $image ?>" alt=""  style="height: 317px; width: 800px;"/> </li>



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
                                <div class="title" style="overflow:scroll; overflow-x: hidden;">
                                    <ul>
                                        <?php
                                        $sql = "SELECT * FROM " . $menu->getTbl() . " ORDER BY sort ASC";


                                        $query = $db->Query($sql);


                                        while ($row = $db->FetchArray($query)) {
                                            ?>
                                            <li><a href="<?= ADDRESS . $row['ref'] . '/' . $row['id'] ?>.html"><?=$row['menu_title']?></a></li>


                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>

                            <?php
                            if ($_GET['id'] != '') {
                              //  echo  ;
                                
                                 echo '<div id="contant">' .$menu->getDataDesc('menu_detail', 'id = '.$_GET['id']) .'</div>';
                            } else {
                                if (PAGE_CONTROLLERS == '' || PAGE_CONTROLLERS == 'index') {
                                    // include 'inc/slides.php';
                                    include 'controllers/index.php';
                                } else {
                                    include 'controllers/' . PAGE_CONTROLLERS . '.php';
                                }
                            }


                            //   include 'inc/footer.php';
                            ?>




                            <div id="footer">
                                <div class="txtfooter">
                                    <p>416/5 Changklan RD, A.MuangChiangmai,Thailand 50100<br />
                                        TEL.+6653-274451,+6682-6201884E-mail : takawadesign@gmail.com</p>
                                    <p>Copyright 2015 Takawa Design and Construction Co., Ltd.</p>
                                </div>
                            </div>
                        </body>
                        </html>
