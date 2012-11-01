<?php
/**
 * 
 */
class TQuery
{

protected $QueryStr = array();

	public function __construct()
	{
		!empty(TDatabase::$DBDriver) ? TDatabase::connect() : ' ';
	}
	
	/**
	 *Метод для выполнения CREATE  запроса к базе данных.
	 * @param
	 *
	 */
	public static function create($TabeName, $FieldName)
	{
		
	}
	
	public static function Create_installation_mysql()
	{
		#exec(mysql -h TConfig::$db_host -u TConfig::$db_user -p TConfig::$db_password);
	}
	
	 /**
	 * Метод формирмирующий строку запроса выборки (SELECT) из БД.
	 * @param	string		$select_expr
	 * @param	string		$table_references
	 *
	 */
	public static function select($select_expr, $table_references)
	{
		$QueryStr = 'SELECT ' . $select_expr . ' FROM ' . $table_references;
		
		TDebug::AddMessage('Строка запроса: ' . $QueryStr, __METHOD__);

		$QueryRes = TDatabase::$DBDriver->query($QueryStr) ;
		
		//Отладочная часть
		TDebug::AddMessage('Результат запроса: ' . var_dump($QueryRes), __METHOD__);
	}
}
