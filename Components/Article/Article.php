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

	public static function init($id)
	{
		if(empty($id)){
			return self::getDefault();
		}

		return self::getData($id);
	}

	/**
	 * Получает дефолтовые данные для позиции шаблона.
	 */
	public static function getDefault()
	{
		$query = Query::select("SELECT articles.* FROM articles
 					LEFT JOIN positions ON articles.id=positions.com_id
					WHERE positions.com = 'Article';");

		$article_data =
			'<div id="article_header_" class="_header">'.
				$query['title'].
				'</div>'.
				'<div id="article_body_" class="_body">'.
				$query['fulltext'];
		'</div>';
		return $article_data;
	}

	public static function getData($id)
	{
		$query = Query::select("SELECT * FROM articles
 					WHERE id=$id;");

		$article_data =
			'<div id="article_header_" class="_header">'.
				$query['title'].
				'</div>'.
				'<div id="article_body_" class="_body">'.
				$query['fulltext'];
		'</div>';
		return $article_data;
	}
}