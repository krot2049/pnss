<?php
const DIR_ROOT = __DIR__ . '/../';
const DIR_CONFIG = 'config';
// пользовательская функция автозагрузки классов
spl_autoload_register(function ($className){
    $paths = include DIR_ROOT . 'config/path.php';
    $className = str_replace('\\', '/', $className);

   foreach ($paths['classes'] as $path) {
       $fileName = $_SERVER['DOCUMENT_ROOT'] .
           "/$paths[root]/$path/$className.php";
       if (file_exists($fileName)) {
           require_once $fileName;
       }
   }
});

// функция возвращающая массив всех настроек приложения
function getConfigs() : array {
    $settings = [];

    foreach (scandir(__DIR__ . '/../config') as $file) {
        $name = explode('.', $file)[0];
        if (!empty($name)) {
            $settings[$name] = include __DIR__ . '/../config/' . $file;
        }
    }
    return $settings;
}

$settings = getConfigs();

require_once DIR_ROOT . 'routes/web.php';

return new Src\Application(new Src\Settings($settings));