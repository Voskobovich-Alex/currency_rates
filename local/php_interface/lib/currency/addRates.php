<?php

namespace lib\Currency;

use Bitrix\Main\Type\DateTime,
    lib\Currency\RatesTable;

class AddRates
{
    private $arResultCalc = [];
    public function getCurrencyTable()
    {
        $rsCalc = RatesTable::getList(array(
            'order' => ["ID" => 'ASC'],
            'select' => ['*'],
        ));
        while ($calc = $rsCalc->fetch()) {
            $this->arResultCalc[] = $calc;
        }
        return  $this->arResultCalc;
    }
    public function getCurrentCur($codeFrom, $codeTo, $valFrom, $valTo)
    {
        $rsCurrent = RatesTable::getList(array(
            'order' => ["ID" => 'ASC'],
            'select' => ['CURRENCY','RATE'],
            'filter' => ['CURRENCY' => $codeFrom],
        ));
        if ($current = $rsCurrent->fetch()) {
            return $current;
        }
       
    }
    public function ChangeTable(Array $obj, $flag)
    {
        $objDateTime='';
        foreach ($obj as $k => $item) {
            $objDateTime = new DateTime($item["Date"], "Y-m-d H:i:s");
        
            $mass[$k]["ID"]=$item["Cur_ID"];
            $mass[$k]["CURRENCY"]=$item["Cur_Abbreviation"];
            $mass[$k]["RATE"]=$item["Cur_OfficialRate"]/$item["Cur_Scale"];
            $mass[$k]["DATE"] = $objDateTime;
            if(!$flag){
                RatesTable::add($mass[$k]);
            }else{
                RatesTable::update($item["Cur_ID"], $mass[$k]);
            }
        }
        
        
    }
}