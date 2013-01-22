<?php
namespace Tipsy\Libraries\Document;

use Tipsy\Libraries\Database\Database;
use Tipsy\Libraries\Debug;

// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();

abstract class Content
{
	protected static $content = '';
	
	public static function getContent($QueryStr = '')
	{
		if(!is_object(Database::$dbh)){
			echo 'YTN' ;
			return false;
		}
	 	// тестовая часть
		$querySrt = "SELECT `fulltext`FROM `whiskeyman_tipsy`.`articles` where articleid = 1;";

		self::$content = Database::$dbh->query($querySrt);

		foreach(self::$content as $key){
			self::$content = $key['fulltext'];
		}
	}
}