<?php
// Проверяет легален ли доступ к файлу.
defined('_TEXEC') or die;

// Подключает класс загрузчика библиотек и компонентов системы.
require_once _TPATH_LIBRARIES . DIRECTORY_SEPARATOR . 'loader.php';

// Сканирует директорию с библиотеками на наличие библиотек классов, рекурсивно.
TLoader::discover('T', _TPATH_LIBRARIES, 'true');

// Подключает компонент логирования.
TLoader::load('TLogger');

// Подключает обработчик исключений.
TLoader::load('TException');

// Сканирует директорию с файлами конфигурации на наличие библиотек конфигурации системы.
TLoader::discover('T', _TPATH_CONFIG);

// Подключает системный модуль.
TLoader::load('TSystem');
$System = new TSystem;

// Подключает модуль отладки системы.
TLoader::load('TDebug');

// Тестовая часть ------------------------------------------------------------------------------------------------------

// Подключает ядро системы
TLoader::load('TApplication');
// Создает объект приложения
$app = (new TApplication)->run();
?>
