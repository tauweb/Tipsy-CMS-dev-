<?php
namespace Tipsy\Libraries\Database;

use Tipsy\Libraries\Database\Database;
use Tipsy\Libraries\PdoException;

// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();

abstract class Query
{
	
	public static function select($queryStr)
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
// пересмотреть использование исключений
#throw new PdoException("Ошибка Транзакции при запросе: <b>$queryStr</b>");
	
			Database::$dbh->commit();

			return $result->fetch();
			
		} catch(PdoException $e) {
			Database::$dbh->rollBack();
		}
	}
	
	public static function insert($queryStr)
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

// пересмотреть использование исключений.
#throw new PdoException("Ошибка Транзакции при запросе: <b>$queryStr</b>");
			$result->setFetchMode(\PDO::FETCH_ASSOC);
			
			Database::$dbh->commit();
		
			#return $result->fetch();
			
		} catch(PdoException $e) {
			Database::$dbh->rollBack();
		}
	}
}