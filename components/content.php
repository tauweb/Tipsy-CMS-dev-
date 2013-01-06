<?php
// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();

abstract class TContent{

	public static function getContent($param, $id)
	{
		$queryParam = $param == '*' ? $param  : '`' . $param . '`';
		// Формирует строку запроса
		$SQL = "SELECT $queryParam from `articles` WHERE `articleid` = $id;";
		
		$row = TQuery::query($SQL);
		// Эта часть будет нужа для последующего формирования таблицы вывода, когда, например будут выбираться все поля
		if($param == 'all' or $param == '*'){
			foreach (array_keys($row) as $colName){
				echo $colName . '<p>';
			}
		}else{
			// Это обычный вывод
			echo  $row[$param];
		}
	}

	public static function putContent($content)
	{
		echo $content;
	}
}

?>