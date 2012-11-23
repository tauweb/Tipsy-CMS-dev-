<?php
// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();

/**
 * Подключение к базе данных
 * @package Tipsy_smc.DataBase
 */
abstract class TDatabase
{
	/**
	 * @var	string	DataBaseHandler содержит в себе .
	 */
	public static $DBH = '';
	
	/**
	 * Метод устанавливающий подключение к БД.
	 * @param	array	$DBOptions	массив содержащий параметры подключения к базе данных.
	 */
	public static function connect($DBOptions)
	{
		// Определяет тип БД указанной в настройках системы ( для испольования в DBO )
		$DBDriver = strtolower(TConfig::$db_type);

		// Формирует строку DNS, имя источника данных или DSN, содержащее информацию, необходимую для подключения к базе данных.
		$dns = $DBDriver . ':'. 'dbname=' . $DBOptions['dbname'] . ';' . 'host=' . $DBOptions['host'];

		try {
			self::$DBH = new PDO($dns, $DBOptions['username'], $DBOptions['password']);
		}
		catch(PDOException $e) {
			try{
				if($e->getMessage()){
					throw new TRuntimeException($e->getMessage());
				}
			}catch (TRuntimeException $e){}
		}

	}
}

?>