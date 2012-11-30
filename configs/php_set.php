<?php
// Проверяю легален ли доступ к файлу
defined('_TEXEC') or die;

/**
 * Файл пока что не используется в системе
 * todo: Реализовать использование файла
 */

// Установки php.ini
ini_set('display_errors', 'on');

// Устанавливаю отображение ошибок php
error_reporting(E_CORE_ERROR | E_CORE_WARNING
	| E_COMPILE_ERROR | E_ERROR
	| E_WARNING | E_PARSE
	| E_USER_ERROR | E_USER_WARNING
	| E_RECOVERABLE_ERROR);
error_reporting(E_ALL);

?>