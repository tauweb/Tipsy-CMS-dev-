<?php
/**
 * Классотвечающий за вывод и создание статей в системе..
 * User: whiskeyman
 * Date: 05.04.13
 * Time: 12:38
 */

namespace Tipsy\Components\Article;

use Tipsy\Libraries\Database\Query;

abstract class Article {

	public static function init()
	{
		self::getPosData();
	}

	public static function getPosData()
	{
		$res = Query::select("SELECT articles.* FROM articles
 					LEFT JOIN positions ON articles.id=positions.com_id
					WHERE positions.com = 'Article';");
		echo $res['fulltext'];
	}

	public static function get($param, $id)
	{
		$queryParam = $param == '*' ? $param  : '`' . $param . '`';
		// Формирует строку запроса
		$sql = "SELECT $queryParam FROM `articles` WHERE `articleid` = $id;";

		$row = Query::select($sql);
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
}