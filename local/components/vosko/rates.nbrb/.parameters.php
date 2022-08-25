<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
 
use Bitrix\Main\Localization\Loc;

$arComponentParameters = [
    // группы в левой части окна
    "GROUPS" => [
        "SETTINGS" => [
            "NAME" => Loc::getMessage('VOSKO_RATES_NBRB_PROP_SETTINGS'),
            "SORT" => 550,
        ],
    ],
    // поля для ввода параметров в правой части
    "PARAMETERS" => [
        "CUR_FROM" => [
            "PARENT" => "SETTINGS",
            "NAME" => Loc::getMessage('VOSKO_RATES_NBRB_PROP_CUR_FROM'),
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
            "DEFAULT" => "USD",
            "COLS" => 25
        ],
        "CUR_TO" => [
            "PARENT" => "SETTINGS",
            "NAME" => Loc::getMessage('VOSKO_RATES_NBRB_PROP_CUR_TO'),
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
            "DEFAULT" => "BYN",
            "COLS" => 25
        ],
        // Настройки кэширования
        "CACHE_TIME"  =>  Array("DEFAULT"=>36000000),
    ]
];
