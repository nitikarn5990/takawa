<?php

include_once($_SERVER["DOCUMENT_ROOT"] . '/lib/application.php');

$sql2 = "SELECT * FROM " . $coures->getTbl() . " WHERE status='ใช้งาน' ORDER BY sort";
$query2 = $db->Query($sql2);

$price = $coures->getDataDesc('price', 'id = ' . $_GET['course_id']);
$course_id = $_GET['course_id'];
$people = $_GET['people'];
$Reservations = $_GET['Reservations'];

if ($_GET['payments'] == 'half') {

    $total_amount = ($price * $people);
    $total_paynow = ($price * $people) / 2;
    $total_paycash = ($price * $people) / 2;
} else {
    $total_amount = ($price * $people);
    $total_paynow = ($price * $people);
    $total_paycash = 0;
}

$arrData = array(
    "total_amount" => $total_amount,
    "total_paynow" => $total_paynow,
    "total_paycash" => $total_paycash,
    "Reservations" => $Reservations

);
echo json_encode($arrData);




