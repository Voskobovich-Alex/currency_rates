<?php

namespace lib\Currency;

class RequestRates
{
    private $url = "https://www.nbrb.by/api/exrates/rates?periodicity=0";
    private $arRate = [];

    public function getRates()
    {
        header('Content-Type: text/html; charset=utf-8');
        // Создаём новый сеанс:
        $curl = curl_init();
    
        // Указываем адрес целевой страницы:
        curl_setopt($curl, CURLOPT_URL, $this->url);
    
        // О отключаем проверку SSL сертификата:
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            

        // Устанавливаем заголовки для имитации браузера:
        $headers = [];
        $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
        $headers[] = 'Accept-Encoding: identity';
        $headers[] = 'Accept-Language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7';
        $headers[] = 'Cache-Control: no-cache';
        $headers[] = 'Connection: keep-alive';
        $headers[] = 'Host: ' . parse_url($this->url)['host'];
        $headers[] = 'Pragma: no-cache';
        $headers[] = 'Sec-Fetch-Dest: document';
        $headers[] = 'Sec-Fetch-Mode: navigate';
        $headers[] = 'Sec-Fetch-Site: none';
        $headers[] = 'Sec-Fetch-User: ?1';
        $headers[] = 'Upgrade-Insecure-Requests: 1';
        $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.193 Safari/537.36';
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    

        // Разрешаем переадресацию:
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    
        // Запрещаем прямой вывод результата запроса:
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        // Делаем сам запрос:
        $result = curl_exec($curl);
        $resultArray = json_decode($result, true);
    
        // Завершаем сеанс:
        curl_close($curl);
    
        $this->arRate =$resultArray;
    }
    public function rateList(){
        return $this->arRate;
    }
}