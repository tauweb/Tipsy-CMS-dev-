<?php
namespace Tipsy\Libraries\Database;

use Tipsy\Libraries\PdoException;
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
			echo ('<b>' . __CLASS__.'</b>' .' Нет подключения к БД');
			return false;
		}
		
		try {
			Database::$dbh->beginTransaction();
			
			$result = Database::$dbh->query($queryStr);

			$result->setFetchMode(\PDO::FETCH_ASSOC);
			
			throw new PdoException('Ошибка Транзакции');
			
			Database::$dbh->commit();
		
			return $result->fetch();
			
		} catch (PdoException $e) {
			Database::$dbh->rollBack();
		}
	}

	 /**
	 * Метод формирмирующий строку запроса выборки (SELECT) из БД.
	 *
	 */
	public static function select($queryStr)
	{
		// Отладка строки запроса
		Debug::AddMessage('Строка запроса: ' . $queryStr, __METHOD__);

		$queryRes = Database::$dbh->query($queryStr);

		$num_result = $queryRes->rowCount();

		// Отладка. Количество найдетнных строк соответствующих запросу
		Debug::AddMessage('найдено строк:'. $num_result, __METHOD__);

		//Отладочная часть
		Debug::AddMessage('Результат запроса: ' . var_dump($queryRes), __METHOD__);
	}
}