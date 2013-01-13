<?php
// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();

abstract class TContent
{
	protected $content = '';
	
	public function getContent($QueryStr = '')
	{
	 	// тестовая часть
		$QuerySrt = "SELECT `fulltext`FROM `whiskeyman_tipsy`.`articles` where articleid = 1;";

		self::$content = TDatabase::$DBH->query($QuerySrt);

		foreach($this->content as $key){
			self::$content = $key['fulltext'];
		}
	}
}

?>