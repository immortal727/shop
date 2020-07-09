<? namespace ishop;
trait TSingletone{
    private static $instance;
    public static function instance(){
        // Если текущее свойство пусто, то мы вернем в него объект
        // После просто возвращаем объект
        if(self::$instance===null){
            self::$instance = new self;
        }
        return self::$instance;
    }
}
