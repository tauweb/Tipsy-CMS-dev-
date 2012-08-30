<?php
/**
 * @package   Tipsy CMS
 * @version   0.0.1
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 * @author    Tkachenko Aleksey, e-mail: whiskeyman.tau@gmail.com
 */
// Устанавливаю что это главный файл.
define('_TEXEC', 1);

// Проверяем версию php. Для работы системы нужна >= 5.4.
phpversion() < 5.4 ? die('ВНИМАНИЕ! Данная версия php не поддерживается.
                Для работы системы нужна версия >= 5.4') : ''; // Todo: Позже вынести в отдельный модуль!!!

// Отображать все ошибки
ini_set('display_errors', 'on'); // УБРАТЬ ПОСЛЕ ДОПИСАНИЯ КОМПОНЕНТА ОТВЕЧАЮЩЕГО ЗА ОШИБКИ!!

// Отображать все ошибки и предупреждения (убрать, если задан пользовательский обработчик ошибок)
error_reporting(E_ALL | E_STRICT); // УБРАТЬ ПОСЛЕ ДОПИСАНИЯ КОМПОНЕНТА ОТВЕЧАЮЩЕГО ЗА ОШИБКИ!!

// Определяю корневую директорию
if (!defined('_TPATH_ROOT')) define('_TPATH_ROOT', dirname(__FILE__));

// Подключаю файл с объявлениями констант
require_once _TPATH_ROOT . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'defines.php';

// Подключаю каркас системы
require_once _TPATH_INCLUDE . DIRECTORY_SEPARATOR . 'framework.php';

?>