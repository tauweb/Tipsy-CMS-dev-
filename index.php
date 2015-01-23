<?php
namespace Tipsy;

/**
 * This is a main file of the Tipsy-CMS.
 * Using the main public Licency Open Source Apache v 2
 * @Author: Tkachenko Aleksey
 * @e-mail: whiskeyman.tau@gmail.com
 */

// Устанавливает что это главный файл.
define('_TEXEC', 1);

use Tipsy\Config\Config;

echo '<meta charset="utf-8">'; // Для отладки вывода сообщений на русском

// Подключаем настройки php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'php_set.php';

// Подключает каркас системы
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Framework.php';
