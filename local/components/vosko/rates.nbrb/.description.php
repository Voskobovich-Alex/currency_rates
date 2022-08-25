<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Localization\Loc;

$arComponentDescription = [
    "NAME" => Loc::getMessage("VOSKO_RATES_NBRB_COMPONENT"),
    "DESCRIPTION" => Loc::getMessage("VOSKO_RATES_NBRB_COMPONENT_DESCRIPTION"),
    "COMPLEX" => "N",
    "PATH" => [
        "ID" => Loc::getMessage("VOSKO_RATES_NBRB_COMPONENT_PATH_ID"),
        "NAME" => Loc::getMessage("VOSKO_RATES_NBRB_COMPONENT_PATH_NAME"),
    ],
];
?>
