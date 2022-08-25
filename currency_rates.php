<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Курсы валют");


$APPLICATION->IncludeComponent(
	"vosko:rates.nbrb", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"CUR_FROM" => "USD",
		"CUR_TO" => "BYN",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000"
	),
	false
);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");