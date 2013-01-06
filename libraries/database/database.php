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
			// Переводим в режим отображаения всех ошибок и предупреждений (Для отлаживания)
			self::$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		}
		// Перерехватывает исключение PDO.
		catch(PDOException $e) {
			try{
				// todo: переписать Эту часть!
				// Если перехваченное ранее исключение PDO содержит ошибку, то бросаем новое исключение для вывода сообщения об ошибке на страницу. 
				if($e->getMessage()){
					throw new TRuntimeException('Ошибка базы данных: ' . $e->getMessage());
				}
			}catch (TRuntimeException $e){}
		}

	}
}

?>
