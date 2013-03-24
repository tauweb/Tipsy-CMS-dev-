<?php
namespace Tipsy\Libraries\Database;

use Tipsy\Config\Config;
use Tipsy\Libraries\RuntimeException;

use Tipsy\Libraries\PdoException;

// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();

/**
 * Подключение к базе данных
 * @package Tipsy_smc.DataBase
 */
abstract class Database
{
	/**
	 * @var	string	DataBaseHandler содержит в себе .
	 */
	public static $dbh = '';
	
	/**
	 * Метод устанавливающий подключение к БД.
	 * @param		array	$DBOptions	массив содержащий параметры подключения к базе данных.
	 */
	public static function connect($dbOptions)
	{
		// Определяет тип БД указанной в настройках системы ( для испольования в DBO )
		$dbDriver = strtolower(Config::$dbType);

		// Формирует строку DNS, имя источника данных или DSN, содержащее информацию, необходимую для подключения к базе данных.
		$dns = $dbDriver . ':'. 'dbname=' . $dbOptions['dbname'] . ';' . 'host=' . $dbOptions['host'];

		try {
			self::$dbh = new \PDO($dns, $dbOptions['username'], $dbOptions['password']);
			// Переводим в режим отображаения всех ошибок и предупреждений (Для отлаживания)
			self::$dbh->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			// Устанавливает кодировку данных БД.
			self::$dbh->exec('SET NAMES utf8');
		}
		// Перерехватывает исключение PDO.
		catch(PDOException $e) {
		self::$dbh->rollBack();
			print "Error!: " . $e->getMessage() . "<br/>";
			try{
				// todo: переписать Эту часть!
				// Если перехваченное ранее исключение PDO содержит ошибку, то бросаем новое исключение для вывода сообщения об ошибке на страницу. 
				if($e->getMessage()){
					throw new RuntimeException('Ошибка базы данных: ' . $e->getMessage());
				}
			}catch (RuntimeException $e){}
		}

	}
}