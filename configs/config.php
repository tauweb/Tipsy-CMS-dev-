<?php
// Проверяю легален ли доступ к файлу
defined('_TEXEC') or die;

// Параметры конфигурации системы
abstract class TConfig
{
	// Параметры подключения к базе данных
// Todo: Правильная база whiskeyman_tipsy, параметры базы данных изменены на неверные для проверки модулей логирования и исключения
	public static $db_type = 'mysqli';
	public static $db_host = 'localhost';
	public static $db_server_port = '';
	public static $db_user = 'whiskeyman_tipsy';
	public static $db_password = 'password';
	public static $db_dbname = 'whiskeyman_tipsy1';
	public static $db_port = 3306;
	public static $db_socket = '';

	// Ошибки и отладка (none, simple, maximum)
	public static $error_reporting = 'maximum';
	
	// Настройки времени
	public static $timezone = 'Europe/Moscow';

	// Внешний вид
	public static $template = 'tipsy';
}

?>
