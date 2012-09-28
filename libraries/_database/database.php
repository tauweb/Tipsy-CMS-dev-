<?php
/**
 * Подключение к базе данных
 * @package Tipsy_smc.DataBase_Connect
 */

// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();

abstract class TDatabase
{
	// Метод устанавливающий подключение к БД
	public static function connect($db_host, $db_user, $db_password, $db_dbname, $db_port, $db_socket)
	{
		// Определяет текущий драйвер БД из настроек
		$driver = strtolower('T' . TConfig::$db_type);
		
		// Загружает библиотеку драйвера текущей БД
		TLoader::load($driver);
		
		// Создает объект БД
		$Database = new $driver($db_host, $db_user, $db_password, $db_dbname, $db_port, $db_socket);
	}
	
	/**
	 * Метод формирмирующий строку запроса выборки (SELECT) из БД.
	 * @param	string		$FieldName
	 *
	 */
	public static function select($TableName, $FieldName)
	{
		$queryStr = 'SELECT' . $FieldName . 'FROM' . $TableName;
	}
}

?>