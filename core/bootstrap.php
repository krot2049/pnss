<?php
const DIR_ROOT = __DIR__ . '/../';
const DIR_CONFIG = 'config';

// пользовательская функция автозагрузки классов
spl_autoload_register(function ($className) {
    if (strpos($className, 'App\\') === 0) {
        $className = str_replace('App\\', 'app/', $className);
        $className = str_replace('\\', '/', $className);
        $fileName = DIR_ROOT . $className . '.php';
    }
    elseif (strpos($className, 'Src\\') === 0) {
        $className = str_replace('Src\\', 'core/Src/', $className);
        $className = str_replace('\\', '/', $className);
        $fileName = DIR_ROOT . $className . '.php';
    }

    if (isset($fileName) && file_exists($fileName)) {
        require_once $fileName;
        return;
    }

    throw new \Exception("Class $className not found");
});

if (file_exists(DIR_ROOT . 'vendor/autoload.php')) {
    require_once DIR_ROOT . 'vendor/autoload.php';
}
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

Src\Route::setPrefix('/pop-it-mvc/pnss');

require_once DIR_ROOT . 'routes/web.php';

return new Src\Application(new Src\Settings($settings));