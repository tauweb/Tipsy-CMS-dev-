<?php
namespace Tipsy;
/**
 * @package		Tipsy CMS
 * @version		0.0.1
 * @copyright           Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @author		Tkachenko Aleksey, e-mail: whiskeyman.tau@gmail.com
 */

// Устанавливает что это главный файл.
define('_TEXEC', 1);

// Проверяет версию php. Для работы системы нужна >= 5.4.
phpversion() < 5.4 ? die('<b>ВНИМАНИЕ!</b> Данная версия php не поддерживается.
					Для работы системы нужна версия >= 5.4') : '';		// Todo: Позже вынести в отдельный модуль!!!

#require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'iniset.php';

require_once __DIR__ . DIRECTORY_SEPARATOR . 'Framework.php';