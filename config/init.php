<?
// 1 - режим разработки (показываются все ошибки)
// 0 - скрыть ошибки
define("DEBUG",1);
// ROOT указываем на корень нашего сайта
define("ROOT", dirname(__DIR__));
// корень нашего приложения
define("WWW", ROOT . '/public');
// пака, которая ведет на котролеры, виды, модели...
define("APP", ROOT . '/app');
// ядро приложения
define("CORE", ROOT . '/ishop/core');
// библиотеки
define("LIBS", ROOT . '/ishop/core/libs');
// кэш
define("CACHE", ROOT . '/tmp/cache');
// папка на конфигурационные файлы
define("CONF", ROOT . '/config');
// шаблон нашего сайта
define("LAYOUT", 'default');
// url главной страницы
$app_path="{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}";
// вырезаем все лишнее http://main-shop/public/index.php,
// #[^/]+$# искать все после последнего / и заменяем пустой строкой ''
// в итоге получим http://main-shop/public/
$app_path=preg_replace("#[^/]+$#", '',$app_path);
// Получаем url главной страницы,
// вместо /public/ подставив пустую строку ''
$app_path=str_replace('/public/','',$app_path);
// Теперь записываем url главной страницы в константу
define("PATH", $app_patch);
// путь к админке сайта
define("ADMIN", PATH.'/admin');

// подключаем автозагрузчик composer
require_once ROOT .'/vendor/autoload.php';