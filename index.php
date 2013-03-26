<?php
namespace Tipsy;

// Устанавливает что это главный файл.
use Tipsy\Config\Config;

/**
 * @package		Tipsy CMS
 * @version		0.0.1
 * @copyright           Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @author		Tkachenko Aleksey, e-mail: whiskeyman.tau@gmail.com
 */
define('_TEXEC', 1);

// Установки php.ini
ini_set('display_errors', 'on');

ini_set('session.use_cookies', 'On');
ini_set('session.use_trans_sid', 'Off');
session_set_cookie_params(0, '/');

// Устанавливаю отображение ошибок php
error_reporting(E_CORE_ERROR | E_CORE_WARNING
    | E_COMPILE_ERROR | E_ERROR
    | E_WARNING | E_PARSE
    | E_USER_ERROR | E_USER_WARNING
    | E_RECOVERABLE_ERROR);
// Отображать все ошибки и предупреждения (убрать, если задан пользовательский обработчик ошибок)
error_reporting(E_ALL);


// Проверяет версию php. Для работы системы нужна >= 5.4.
phpversion() < 5.4 ? die('<b>ВНИМАНИЕ!</b> Данная версия php не поддерживается.
					Для работы системы нужна версия >= 5.4') : '';		// Todo: Позже вынести в отдельный модуль!!!

// Подключаем настройки php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Config' .  DIRECTORY_SEPARATOR . 'php_set.php';

// Подключает каркас системы
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Framework.php';