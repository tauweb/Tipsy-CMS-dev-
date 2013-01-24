<?php
namespace Tipsy;

// Проверяет легален ли доступ к файлу.
defined('_TEXEC') or die;

use Tipsy\Libraries\Loader;

// Подключает класс загрузчика библиотек и компонентов системы.
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Libraries' . DIRECTORY_SEPARATOR . 'Loader.php';

// Подключает системный модуль.
Loader::autoload('\Libraries\Factory');
$factory = new Libraries\Factory();

// Подключает ядро системы
Loader::autoload('\Libraries\Application');

// Создает объект приложения
$app = (new Libraries\Application)->run();