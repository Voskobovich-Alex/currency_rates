<?php

namespace lib\Currency;

use Bitrix\Main\Entity;
use Bitrix\Main\Localization\Loc;

class RatesTable extends Entity\DataManager
{
    public static function getFilePath()
    {
        return __FILE__;
    }

    public static function getTableName()
    {
        return 'hr_rates';
    }

    public static function getMap()
    {
        return array(
            'ID' => array(
                'data_type' => 'integer',
                'primary' => true,
                'autocomplete' => true,
                'title' => Loc::getMessage("ID"),
            ),
            'CURRENCY' => array(
                'data_type' => 'string',
                'required' => true,
                'title' => Loc::getMessage("CURRENCY"),
            ),
            'RATE' => array(
                'data_type' => 'float',
                'title' =>  Loc::getMessage("RATE"),
            ),
            'DATE' => array(
                'data_type' => 'datetime',
                'title' =>  Loc::getMessage("DATE"),
            )
        );
    }
}