<?php
namespace Tipsy\Libraries\Document;

use Tipsy\Libraries\Database\Database;
// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();

abstract class Content
{
	protected static $content = '';
	
	public static function getContent($QueryStr = '')
	{
	 	// тестовая часть
		$QuerySrt = "SELECT `fulltext`FROM `whiskeyman_tipsy`.`articles` where articleid = 1;";

		self::$content = Database::$dbh->query($QuerySrt);

		foreach(self::$content as $key){
			self::$content = $key['fulltext'];
		}
	}
}