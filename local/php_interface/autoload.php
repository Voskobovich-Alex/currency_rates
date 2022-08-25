<?php

Bitrix\Main\Loader::registerAutoLoadClasses(null, [
    'lib\Currency\RatesTable' => '/local/php_interface/lib/currency/rates.php',
    'lib\Currency\RequestRates' => '/local/php_interface/lib/currency/requestRates.php',
    'lib\Currency\AddRates' => '/local/php_interface/lib/currency/addRates.php',
    'lib\Currency\ModTable' => '/local/php_interface/lib/currency/modTable.php'
]);
