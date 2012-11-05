<?php
/**
 * 
 */
class TQuery
{
	public function __construct()
	{
		!empty(TDatabase::$DBDriver) ? TDatabase::connect(TSystem::GetDBOptions()) : ' ';
	}
	
	 /**
	 * Метод формирмирующий строку запроса выборки (SELECT) из БД.
	 * @param	string	$select_expr
	 * @param	string	$table_references
	 *
	 */
	public static function select($select_expr, $table_references)
	{
		#$QueryStr = 'SELECT ' . $select_expr . ' FROM ' . $table_references;
				$QueryStr = 'SELECT * FROM articles';
		
		// Отладка строки запроса
		TDebug::AddMessage('Строка запроса: ' . $QueryStr, __METHOD__);
		$QueryRes = TDatabase::$DBDriver->query($QueryStr);
		
		//Отладочная часть
		TDebug::AddMessage('Результат запроса: ' . var_dump($QueryRes), __METHOD__);

		#$num_result = $QueryRes->num_rows;
		
		#echo 'найдено строк:'. $num_result;
	}
}
