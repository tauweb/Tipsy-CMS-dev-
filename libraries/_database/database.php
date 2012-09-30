<?php
/**
 * Подключение к базе данных
 * @package Tipsy_smc.DataBase_Connect
 */

// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();

abstract class TDatabase
{

	public static $driver = '';
	
	// Метод устанавливающий подключение к БД
	public static function connect($DBOptions)
	{
		// Определяет текущий драйвер БД из настроек
		$driver = strtolower('T' . TConfig::$db_type);
		
		// Загружает библиотеку драйвера текущей БД
		TLoader::load($driver);
		
		// Создает объект БД
		$DBDriver = new $driver($DBOptions);
		
		self::$driver = $DBDriver;
	}
	
	/**
	 * Метод формирмирующий строку запроса выборки (SELECT) из БД.
	 * @param	string		$select_expr
	 * @param	string		$table_references
	 *
	 */
	public static function select($select_expr , $table_references )
	{
		$QueryStr = 'SELECT ' . $select_expr . ' FROM ' . $table_references;
		TDebug::$messages[] =  $QueryStr .'<p>';
		
		$driver = self::$driver;
		
		$res =	$driver->query($QueryStr)  ;
	}
}

?>