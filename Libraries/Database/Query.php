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

			Database::$dbh->commit();
#$res = $result->fetchAll();
#var_dump($res);
#echo count($res);

#echo $queryStr.'='.count($result->fetchAll()).'<p>';
if(count($r=$result->fetchAll())==1){
	return $r[0];
	#return $result->fetch();
}else if(count($r)==0){
	var_dump($r);
	return $r;
	#return $result->fetch();
}
return $r[0];

		#return $result->fetchAll();
			
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

			$result->setFetchMode(\PDO::FETCH_ASSOC);
			
			Database::$dbh->commit();
			
		} catch(PdoException $e) {
			Database::$dbh->rollBack();
		}
	}
}