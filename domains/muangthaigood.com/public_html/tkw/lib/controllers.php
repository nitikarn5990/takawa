<?php
$controllers = (isset($_GET['controllers'])) ? $_GET['controllers'] : '';
if($controllers == ""){
	define("PAGE_CONTROLLERS", "index");
}else{

	define("PAGE_CONTROLLERS", $controllers);	
}

?>