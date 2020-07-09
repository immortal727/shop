<? namespace ishop;
class ErrorHandler{
    public function __construct(){
        // Проверяем значение константы DEBUG (в файле init.php)
        // которая предназанчена для скрытия или показов ошибок при разработе
        // Соответственно, если сайт в режиме разработки, то показываем все ошибки
        // если нет, то ошибки сохраняем в каком-нибудь файле логов
        if (DEBUG){ // по умолчанию 1 - режим разрботки
            error_reporting(-1); // показываем все ошибки
        } else{
            error_reporting(0); // выключаем показ ошибок
        }
        // Функция обработки исключений
        // обработаывается функция в текущем классе, поэтому $this
        set_exception_handler([$this,'expectionHadler']);
    }
    public function expectionHadler($e){
        $this->logErrors($e->getMessage(), $e->getFile(), $e->getLine());
        $this->displayError('Исключение', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }
    protected function logErrors($message='', $file='', $line=''){
        error_log("[".date('Y-m-d H:i:s')."] Текст ошибки:{$message} | Файл: {$file} | Строка: {$line}\n======\n", 3, ROOT."/tmp/errors.log");  
        // 3 - атритут функции error_log означающий что будет произведена запись в файл  
    }
    // Метод показа ошибок
    // Принимает в себя $errno - номер ошибки, текст ошибки, файл в котором произошла ошибка, строка в которой прозошла ошибка,
    // а также $responce - код, который мы должны отправить браузеру, если произошла ошибка
    // по умолчанию 404 - наиболее популярная ошибка
    protected function displayError($errno,$errstr, $errfile, $errline, $responce=404){
        http_response_code($responce);
        if($responce==404 && !DEBUG){
            require WWW."/errors/404.php";
            die; // завершение условия
        }
        if(DEBUG){
            require WWW."/errors/dev.php";
        } 
        else{
            require WWW."/errors/prod.php";
        }
        die;
    }    
}