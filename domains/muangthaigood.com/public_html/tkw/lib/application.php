<?php

// Global Defines
include_once($_SERVER["DOCUMENT_ROOT"] . '/lib/define.php');

// Simpl Framework
include_once(FS_SIMPL . 'simpl.php');

// Custom Functions and Classes
include_once(FS_LIB . 'controllers.php');
include_once(FS_LIB . 'classes.php');
include_once(FS_LIB . 'btce-api.php');
include_once(FS_LIB . 'functions.php');
include_once(FS_LIB . 'pagination.php');


// Make the DB Connection
$db = new DB;
$db->Connect();


// New Class For Table
//$web_news = new Web_news;
//$web_news_category = new Web_news_category;
//$user_groups = new UserGroups;
$users = new Users;
//$provinces = new Provinces;
//$content_categories = new ContentCategories;
//$contents = new Contents;
//$static_blocks = new StaticBlocks;
//$currencies = new Currencies;
//$webs_money = new WebsMoney;
//	$webs_money_rates = new WebsMoneyRates;
$functions = new Utility;
//	$settings = new Settings;
//user_webs_money = new UserWebsMoney;
//$exchange_orders = new ExchangeOrders;
//$banks = new Banks;
//$confirm_payments = new ConfirmPayments;
//$feedbacks = new Feedbacks;
//	$gen_orders_code = new GenOrdersCode;

//$contents_file = new Contents_Files;
//$content_categories = new Content_Categories;

//$gallery_categories = new Gallery_Categories;
//$gallery = new Gallery;
//$gallery_file = new Gallery_Files;
$slides = new Slides;
$slides_file = new Slides_Files;
//$image_head = new Image_Head;
//$personnel = new Personnel;
//$board = new Board;
//$board_file = new Board_file;

$contact = new Contact;
//$contact_map = new Contact_map;
$contact_message = new Contact_message;

$about = new About;
//$activity_categories = new Activity_categories;
//$activity = new Activity;
//$activity_file = new Activity_files;

//$announce_categories = new Announce_categories;
//$announce = new Announce;
//$announce_file = new Announce_files;

//$manager_categories = new Manager_categories;
//$manager = new Manager;
//$manager_file = new Manager_files;

$home_title = new Home_title;

$coures = new Coures;
$coures_categories = new Coures_categories;
$booking = new Coures_book;
$coures_file = new Coures_file;
$coures_confirm_payment = new Coures_confirm_payment;

$guestbook= new Guestbook;
$send_email = new Send_email;
$menu = new Menu;
//$list_banks = new ListBanks;
//$news_sms = new NewsSMS;
//$users_topup = new Users_Topup;
//$BTCeAPI = new BTCeAPI('ULURYUJL-XGSXCXSC-YK4I82AC-J1DFCUO9-82VECLAI','050595ac8113382223876a1b1bf856a2c67fa9e67f36dd0dcd885c5bb91f40ce');
$tkw_design = new Tkw_design;

$tkw_management= new Tkw_management;











?>
