<?php
namespace Tipsy\Libraries\Database;
// Проверяет легален ли доступ к файлу.
defined('_TEXEC') or die;

/**
 * Библиотека выполняющая запросы к БД.
 */
abstract class Query
{
	public static function query($queryStr)
	{	
		// Проверяет установленно ли подключение к БД.
		if(!is_object(Database::$dbh)){
			// Если нет - выводит сообщение и возвращает false.
			echo ('<b>' . __CLASS__.'</b>' .' Не могу подключиться к БД');
			return false;
		}

		$result = Database::$dbh->query($queryStr);

		$result->setFetchMode(\PDO::FETCH_ASSOC);
		return $result->fetch();

	}

	 /**
	 * Метод формирмирующий строку запроса выборки (SELECT) из БД.
	 * @param	string	$select_expr
	 * @param	string	$table_references
	 *
	 */
	public static function select($select_expr, $table_references)
	{
		$queryStr = 'SELECT ' . $select_expr . ' FROM ' . $table_references;
		
		// Отладка строки запроса
		TDebug::AddMessage('Строка запроса: ' . $queryStr, __METHOD__);

		$queryRes = Database::$dbh->query($queryStr);

		$num_result = $queryRes->rowCount();

		// Отладка. Количество найдетнных строк соответствующих запросу
		Debug::AddMessage('найдено строк:'. $num_result, __METHOD__);

		//Отладочная часть
		Debug::AddMessage('Результат запроса: ' . var_dump($queryRes), __METHOD__);
	}
}