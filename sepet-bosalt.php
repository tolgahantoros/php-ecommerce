<?php  
foreach ($_COOKIE['siteurlmiz'] as $key => $value) {
	setcookie('siteurlmiz['.$key.']',null,strtotime('-30 day'));
}
?>
