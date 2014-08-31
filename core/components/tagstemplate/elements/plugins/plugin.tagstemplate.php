<?php
/*
	<normal>
		<p>You use PC</p>
		[[$chunk_for_normal]]
	</normal>
	<mobile>
		<p>You use mobile</p>
		[[$chunk_for_mobile]]
	</mobile>
	<blind>
		<p>You use blind version</p>
		[[$chunk_for_blind]]
	</blind>
*/

/*	Options	*/
global $useCookie,$nameCookie,$normalTag,$mobileTag,$blindTag,$value_normal,$value_mobile,$value_blind;

$useCookie = 1;
$nameCookie = 'ttTemplate';
// Теги сущностей
$normalTag = 'normal';
$mobileTag = 'mobile';
$blindTag = 'blind';
// Название переменной и её значения
$variable = 'theme';
$value_detect = 'detect';
$value_normal = 'normal';
$value_mobile = 'mobile';
$value_blind = 'blind';
// Дополнительные условия разбора
$ipad = 1;
$iphone = 1;
$otherMobile = 1;

/*	Cookies work	*/

function tmSetCookie($val) {
	global $useCookie,$nameCookie;
   if ($useCookie == 1) {
		setcookie($nameCookie,$val,time()+604800, "/", "", 0);
   }
}
function tmGetCookie() {
	global $nameCookie;
	return $_COOKIE[$nameCookie];
}
function tmClearCookie() {
	global $nameCookie;
    setcookie($nameCookie,'',time()-3600, "/", "", 0);
}

/*	Handling tags	*/

function preserveTag($p) {
    global $modx;
    $p = preg_quote($p);
    $pattern = '/\<[\/]?'.$p.'\>/Usi';
    $modx->resource->_output = preg_replace($pattern,'',$modx->resource->_output);
}
function deleteTags($d) {
    global $modx;
    $d = preg_quote($d);
    $pattern = '/\<'.$d.'\>(.*)\<\/'.$d.'\>/Usi';
    $modx->resource->_output = preg_replace($pattern,'',$modx->resource->_output);
}

/*	choose active tag	*/

function show_mobile() {
	global $normalTag,$mobileTag,$blindTag,$value_mobile;
	tmSetCookie($value_mobile);
	deleteTags($blindTag);
	deleteTags($normalTag);
	preserveTag($mobileTag);
}
function show_normal() {
	global $normalTag,$mobileTag,$blindTag,$value_normal;
	tmSetCookie($value_normal);
	deleteTags($mobileTag);
	deleteTags($blindTag);
	preserveTag($normalTag);
}
function show_blind() {
	global $normalTag,$mobileTag,$blindTag,$value_blind;
	tmSetCookie($value_blind);
	deleteTags($mobileTag);
	deleteTags($normalTag);
	preserveTag($blindTag);
}

include("assets/components/mobiletemplate/mdetect.php");
$uao = new uagent_info();
$var = $_GET[$variable];
if($var == $value_mobile){
	show_mobile();
}else if ($var == $value_normal){
	show_normal();
}else if ($var == $value_blind){
	show_blind();
}else if ($var == $value_detect){
    tmClearCookie();
    if (($uao->DetectTierIphone() == $uao->true) && ($iphone == 1)){
		show_mobile();
    } else if (($uao->DetectIpad() == $uao->true) && ($ipad == 1)){
		show_mobile();
    } else if (($uao->DetectTierOtherPhones() == $uao->true) && ($otherMobile == 1)){
		show_mobile();
    } else {
		show_normal();
    }
}else if ( tmGetCookie() == $normalTag ) {
	show_normal();
}else if ( tmGetCookie() == $blindTag ) {
	show_blind();
}else if ( tmGetCookie() == $mobileTag ) {
	show_mobile();
} else if (($uao->DetectTierIphone() == $uao->true) && ($iphone == 1)){
	show_mobile();
} else if (($uao->DetectIpad() == $uao->true) && ($ipad == 1)){
	show_mobile();
} else if (($uao->DetectTierOtherPhones() == $uao->true) && ($otherMobile == 1)){
	show_mobile();
} else {
	show_normal();
}