<?php
// Проверяет легален ли доступ к файлу.
defined('_TEXEC') or die;

/**
 * Тестовая библиотека запросов к БД через PDO
 */
abstract class TQuery
{
	public static function query($QueryStr)
	{

		$QueryRes = TDatabase::$DBH->prepare($QueryStr);

		$num_result = $QueryRes->rowCount();
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
