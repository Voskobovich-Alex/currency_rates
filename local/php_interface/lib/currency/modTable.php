<?php

namespace lib\Currency;
class ModTable
{
    public function getKey(array $arr, string $cur){
        foreach($arr as $key => $val){
            if($val["CURRENCY"] == $cur){
                return $key;
            }
        }
     }

}