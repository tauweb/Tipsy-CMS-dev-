<?php
/**
 * 
 */
class TQuery
{
	
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
		
		//Отладочная часть
		TDebug::AddMessage('Результат запроса: ' . var_dump($QueryRes), __METHOD__);

		$num_result = $QueryRes->rowCount();

		echo 'найдено строк:'. $num_result;
	}
}
