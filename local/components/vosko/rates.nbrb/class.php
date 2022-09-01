<?php
use \Bitrix\Main\Loader,
    \Bitrix\Main\Application,
    \Bitrix\Main\Type\DateTime,
    \Bitrix\Main\ErrorCollection,
    \Bitrix\Main\Engine\Contract\Controllerable,
    lib\Currency;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

class VoskoCurrencyRates extends CBitrixComponent implements Controllerable{
   // private $_request;
    protected ErrorCollection $errorCollection;

    public function onPrepareComponentParams($arParams) {

        $this->errorCollection = new ErrorCollection();
        return $arParams;
    }

    public function executeComponent() {

        if ($this->startResultCache()) {

            if (empty($this->arParams["CACHE_TIME"])) {
                $this->AbortResultCache();
            }

            $arrItems = [];
        
            /*
             Получение данных из таблицы hr_rates и проверка на пустоту
             */
            $table = new Currency\AddRates();
            $arrTabble = $table -> getCurrencyTable();
    
            if($arrTabble)  $flag = true;
            else  $flag = false;
    
            if($flag){
                /*
                    Получаем дату из таблицы hr_rates
                */
                $arNameArr = array_map(function ($v) {
                    return $v['DATE']->format("d.m.Y");
                }, $arrTabble);
                $dateTable = array_unique( $arNameArr);
    
                /*
                    Сравнение дат - если меньше текущей - то делаем запрос для обновления курсов в таблице hr_rates
                */
                $result=(strtotime($dateTable[0])<strtotime( date('d.m.Y')));

                if($result){
                    $req = new Currency\RequestRates();
                    $req->getRates();
                    $arReq = $req->rateList();
    
                    $table ->ChangeTable($arReq, $flag);
    
                    unset($arrTabble);
                    $arrTabble = $table -> getCurrencyTable();
                    $this->clearResultCache();
                }
            }else{
                 /*
                    Если пустая таблица hr_rates
                */
                $req = new Currency\RequestRates();
                $req->getRates();
                $arReq = $req->rateList();
    
                $table ->ChangeTable($arReq, $flag);
                $arrTabble = $table -> getCurrencyTable();
                $dateTable[0]=date('d.m.Y');
            }
    
            $getkey = new Currency\ModTable();
            $keyCode = $getkey->getKey($arrTabble ,$this->arParams["CUR_FROM"]); 
            
    
            $arrItems["ACTUAL_DATE"] =$dateTable[0];
            $arrItems["CURRENT_CODE"] = $keyCode;
            $arrItems["ITEMS"]=  $arrTabble;
            $this->arResult =  $arrItems;
    
            $this->includeComponentTemplate();

        }
    }

    public function configureActions()
    {
        return [
            'send' => [
                'prefilters' => []
            ]
        ];
    }

    public function sendAction($curFrom, $valFrom, $curTo, $valTo): array
    {

        $cur = new Currency\AddRates();
        $niw = $cur->getCurrentCur($curFrom,$curTo, $valFrom, $valTo);

        return [
            'newValue' =>  $niw['RATE']*$valFrom,
			'curFrom' => $curFrom,
			'valFrom' => $valFrom,
            'curTo' =>  $curTo,
            'valTo' =>  $valTo,
            'arr'=>  $niw
		];
    }
}
