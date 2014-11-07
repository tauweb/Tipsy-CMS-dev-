<?php
// Проверяю легален ли доступ к файлу
defined('_TEXEC') or die;

/**
 * Настройки PHP.
 */

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