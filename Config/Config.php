<?php
namespace Tipsy\Config;
// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die;

// Параметры конфигурации системы
abstract class Config
{
	// Параметры подключения к базе данных
	public static $dbType = 'mysql';

	public static $db_host = '127.0.0.1';	// Note: Для локального хоста использовать айпи а не localhost
	public static $db_user = 'root';
	public static $db_password = '_modaS';
	public static $db_dbname = 'whiskeyman_tipsy';
	public static $db_port = '';
	public static $db_socket = '';

	// Ошибки и отладка (none, simple, maximum)
	public static $errorReporting = 'maximum';
	// Отладка системы (1 - да, 0 - нет)
	public static $debug = 1;
	
	// Настройки временной зоны
	public static $timezone = 'Europe/Moscow';

	// Внешний вид (шаблон)
	public static $template = 'Light';
	
	// Время жизни куку
	public static $sessionLifetime = 15;
}