<?php
/**
 * Подключение к базе данных
 * @package Tipsy_smc.DataBase_Connect
 */

// Проверяю легален ли доступ к файлу
defined('_TEXEC') or die();

abstract class TDatabase
{

	public static function connect($db_host, $db_user, $db_password, $db_dbname, $db_port, $db_socket)
	{
		// Текущий драйвер
		$driver = strtolower('T' . TConfig::$db_type);

		TLoader::load($driver);

		$Database = new $driver($db_host, $db_user, $db_password, $db_dbname, $db_port, $db_socket);
	}
}

?>