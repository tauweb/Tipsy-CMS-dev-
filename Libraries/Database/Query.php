<?php
namespace Tipsy\Libraries\Database;
// Проверяет легален ли доступ к файлу.
defined('_TEXEC') or die;

/**
 * Библиотека выполняющая запросы к БД.
 */
abstract class TQuery
{
	public static function query($QueryStr)
	{	
		// Проверяет установленно ли подключение к БД.
		if(!is_object(TDatabase::$DBH)){
			// Если нет - выводит сообщение и возвращает false.
			echo ('<b>' . __CLASS__.'</b>' .' Не могу подключиться к БД');
			return false;
		}

		$result = TDatabase::$DBH->query($QueryStr);

		$result->setFetchMode(PDO::FETCH_ASSOC);
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
		$QueryStr = 'SELECT ' . $select_expr . ' FROM ' . $table_references;
		
		// Отладка строки запроса
		TDebug::AddMessage('Строка запроса: ' . $QueryStr, __METHOD__);

		$QueryRes = TDatabase::$DBH->query($QueryStr);

		$num_result = $QueryRes->rowCount();

		// Отладка. Количество найдетнных строк соответствующих запросу
		TDebug::AddMessage('найдено строк:'. $num_result, __METHOD__);

		//Отладочная часть
		TDebug::AddMessage('Результат запроса: ' . var_dump($QueryRes), __METHOD__);
	}
}
