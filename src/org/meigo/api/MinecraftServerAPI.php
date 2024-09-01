<?php
namespace org\meigo\api;

use org\meigo\net\jURL,
	php\util\Regex;

/**
 * @packages MinecraftAPI
 */
class MinecraftServerAPI {
	
	const VERSION = '1.0';
	
	private $isBedrock = false,         // Сервер для Bedrock-издания?
			$serverIP = null;					// айпи сервера, вместе с портом если есть, либо домен.
	
	public function __construct($ip = null){
            // Установка параметров по умолчанию
            $this->isBedrock = false;
			//$this->serverIP = $ip;
			// Проверка валидности IP
			if ($ip != null) {
				// Проверяем наличие в IP хотябы одной точки
				//
				// Выведет 1 если есть хотябы одна точка, если нет, то вывод - null
				$regex = Regex::match("\\.", $ip);
				if ($regex != null){
					$this->serverIP = base64_encode($ip);
					
				} else {
					echo "[ERROR] Code: 11"; echo "\n";
					return 11;
				}
			} else {
				echo "[ERROR] Code: 10"; echo "\n";
				return 10;
			}
    }
	
	/**
    * --RU--
    * Является ли сервер для Bedrock-издания?
    * @return bool
    */
    public function isBedrock($bool){
		$this->isBedrock = $bool;
		return $bool;
	}
	
	/**
    * --RU--
    * Получить данные о сервере
    * @return bool
    */
    public function get(){
		$bedrock = $this->isBedrock;
		$ip = $this->serverIP;
		
		if ($bedrock = true){
			$url = "aHR0cHM6Ly9hcGkubWNzcnZzdGF0LnVzL2JlZHJvY2svMy8=".$ip;
		} else {
			$url = "aHR0cHM6Ly9hcGkubWNzcnZzdGF0LnVzLzMv".$ip;
		}
		
        $ch = new jURL(base64_decode($url));
        $ch->AsyncExec(function($result, $ch){
            var_dump($result);
        });
	}
}