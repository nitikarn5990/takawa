<?php
 @session_start();
 $cpt = $_GET['cpt'];
 if($cpt == $_SESSION['CAPTCHA']) {
  echo "success";
 }
 else {
  echo "error";
 }
?>