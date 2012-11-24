<?php
// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();

abstract class TContent{

	public $content = null;
	
	public static function getArticleTitle()
	{
		$SQL = 'SELECT tittle from articles WHERE articleid = 1;';
		$result = TDatabase::$DBH->prepare($SQL)->execute();

		#$result = TQuery::query($title);
		 echo $result;
	}
	
	public static function getArticle($param)
	{
		$SQL = "SELECT `$param` from `articles` WHERE `articleid` = 1;";

		#$result = TQuery::query($content);;
		$row = TQuery::query($SQL);
		echo $row[$param] . "\n";
	}

}

?>