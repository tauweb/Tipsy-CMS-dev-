<?php
/**
 * Компонент системы отвечающий за формирование и вывод меню в позиции шаблона.
 * User: whiskeyman
 * Date: 15.04.13
 */

namespace Tipsy\Components\Menu;

use Tipsy\Libraries\Database\Query;

abstract class Menu {

	public static function init()
	{
		self::getDefault();
	}

	protected static function getDefault()
	{
		$query = Query::select('SELECT menu_items.* FROM menu_items
				LEFT JOIN menus ON menu_items.menu_id=menus.id
				WHERE menu_items.menu_id=1;
		');

		#return $query['name'];
	}
}