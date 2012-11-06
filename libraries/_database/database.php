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
	 * @var	string	Имя драйвера БД заданного в настройках системы.
	 */
	public static $DBDriver = '';
	
	// Метод устанавливающий подключение к БД
	public static function connect($DBOptions)
	{
		// Определяет текущий драйвер БД из настроек
		$DBDriver = strtolower('T' . TConfig::$db_type);
		
		// Загружает библиотеку драйвера текущей БД
		TLoader::load($DBDriver);

		self::$DBDriver = $DBDriver;

		// Создает объект БД, исеользуя заданный драйвер.
		self::$DBDriver = new $DBDriver($DBOptions);

	}
}

?>