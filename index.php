<?php
/**
 * This is a main file of the Tipsy-CMS.
 * Using the main public Licency Open Source Apache v 2
 * @Author: Tkachenko Aleksey
 * @e-mail: whiskeyman.tau@gmail.com
 *
 * @package Tipsy
 *
 * @copyright Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE
 */
namespace Tipsy;

use Tipsy\Config\Config;

//use Tipsy\Libraries\Errors;

// Устанввливает, что это главный файл системы.
define('_TEXEC', 1);

// todo: Позволяет вывожить сообщения об ошибках на русском языке
//перенесена в Tipsy\Libraries\Exception
//echo '<meta charset="utf-8">';

// Подключаем настройки php
//require_once __DIR__ . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'php_set.php';
require_once __DIR__ . '/Libraries/Exception/RuntimeException.php';

// Подключает каркас системы
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Framework.php';
