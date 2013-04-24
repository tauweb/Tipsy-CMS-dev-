<?php
/**
 * Библиотека отвечающая за вывод и создание статей в системе.
 * CalledFrom:
 * User: whiskeyman
 * Date: 05.04.13
 */

namespace Tipsy\Components\Article;

use Tipsy\Libraries\Database\Query;

/**
 * Класс Article - Отвечает за создание и вывод статей в системе.
 */
abstract class Article {

	public static function init()
	{
		return self::getDefault();
	}

	/**
	 * Получает дефолтовые данные для позиции шаблона.
	 */
	public static function getDefault()
	{
		$query = Query::select("SELECT articles.* FROM articles
 					LEFT JOIN positions ON articles.id=positions.com_id
					WHERE positions.com = 'Article';");

		#return $query['fulltext'];

		$article_data =
			'<div id="article_header">'.
				$query['title'].
			'</div>'.
			'<div id="article_body">'.
				$query['fulltext'];
			'</div>';
		return $article_data;


	}

	public static function get($param, $id)
	{

	}
}