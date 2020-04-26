<?php

namespace Ramapriya\Request;

/**
 * Ребольшая библиотека для работы с HTTP-запросами
 *
 * @author Roman Gonyukov
 */
class Request {
    
    /**
     * Проверяет, является ли запрос GET.
     * 
     * @return bool
     */

    public static function isGet() : bool {
        $result = false;
        if($_GET) {
            $result = true;
        }
        
        return $result;
    }
    
    /**
     * Проверяет, является ли запрос POST
     * 
     * @return bool
     */
    
    public static function isPost() : bool {
        $result = false;
        if($_POST) {
            $result = true;
        }
        
        return $result;
    }
    
    /**
     * Проверяет наличие php://input
     * 
     * @return bool
     */
    
    public static function isRaw() : bool {
        
        $result = false;
        $raw = self::GetRawRequest();
        
        if(!empty($raw)) {
            $result = true;
        }
        
        return $result;
        
    }

    /**
     * Получает сырой json из php://input
     * 
     * @return object
     */
    
    public static function GetRawRequest() : object {
        $phpInput = file_get_contents('php://input');
        if(!empty($phpInput)) {
            return json_decode($phpInput);
        }
    }


    /**
     * Получает содержимое глобальной переменной $_GET
     * 
     * @param $param string or null
     * 
     * В случае, если передан параметр param, метод возвращает GET-параметр $_GET['param']
     * Если параметр не передан, возвращается вся переменная, сконвертированная в объект
     * 
     * @return string/object
     */
    
    public static function Get($param = null) {
        
        if($param !== null) {
            $result = $_GET[$param];
        } else {
            $result = (object)$_GET;
        }
        
        return $result;
        
    }
    
    /**
     * Получает содержимое глобальной переменной $_POST
     * 
     * @param $param string or null
     * 
     * В случае, если передан параметр param, метод возвращает POST-параметр $_POST['param']
     * Если параметр не передан, возвращается вся переменная, сконвертированная в объект
     * 
     * @return string/array
     */
    
    public static function Post($param = null) {
        
        if($param !== null) {
            $result = $_POST[$param];
        } else {
            $result = (object)$_POST;
        }
        
        return $result;
        
    }
    
    /**
     * Получает список GET-параметров
     * 
     * @uses Request::isGet(), Request::Get()
     * 
     * @return array
     */
    
    public static function GetParams() : array {
        
        $result = [];
        
        if(self::isGet() === true) {
            foreach(self::Get() as $key => $value) {
                $result[] = $key;
            }
        }
        
        return $result;
    }
    
    /**
     * Получает список POST-параметров
     * 
     * @uses Request::isPost(), Request::Post()
     * 
     * @return array
     */
    
    public static function PostParams() : array {
        
        $result = [];
        
        if(self::isPost() === true) {
            foreach(self::Post() as $key => $value) {
                $result[] = $key;
            }
        }
        
        return $result;
    }
    
    /**
     * Получает тип запроса
     * 
     * @return string
     */
    
    public static function GetRequestMethod() : string {
        
        if(self::isGet() === true) {
            $result = 'GET';
        } else if(self::isPost() === true) {
            $result = 'POST';
        }
        
        return $result;
    }

    /**
     * Получает заголовки запроса
     * 
     * @return array
     */
    
    public static function GetAllHeaders() : array {
        $result = getallheaders();
        return $result;
    }
    
    /**
     * Получает имя хоста
     * 
     * @uses Request::GetAllHeaders()
     * 
     * @return string
     */
    
    public static function GetHostname() : string {
        $headers = self::GetAllHeaders();
        return $headers['Host'];
    }
    
    /**
     * Проверяет https
     * 
     * @return bool
     */
    
    public static function isHttps() : bool {
        $headers = self::GetAllHeaders();
        $result = false;
        if($headers['X-Forwarded-Proto'] === 'https') {
            $result = true;
        }
        
        return $result;
    }
    
    /**
     * Получает User_agent
     * 
     * @uses Request::GetAllHeaders()
     * 
     * @return string
     * 
     */
    
    public static function GetUserAgent() : string {
        $headers = self::GetAllHeaders();
        return $headers['User-Agent'];
    }
    
}
