<?php
/**
 * Компонент системы отвечающий за формирование и вывод меню в позиции шаблона.
 * User: whiskeyman
 * Date: 15.04.13
 */

namespace Tipsy\Components\Menu;

use Tipsy\Libraries\Database\Query;

/**
 * Class Menu
 * @package Tipsy\Components\Menu
 */
abstract class Menu {

	/**
	 *
	 */
	public static function init()
	{
		return self::getDefault();
	}

	/**
	 * @return string
	 */
	protected static function getMenu()
	{
		$menus = Query::select('SELECT *  FROM menus
				WHERE menus.published=1;
		');

		foreach ($menus as $menu){

		}

		$menu_item = '';
		foreach ($menus as $element){
			if(!is_array($element)){

			}else{
				$menu_item .='<li><a href="'. $element['link'].'">'.$element['title'].'</a></li>';
			}

		}
		return '<ul>'.$menu_item.'</ul>';
	}

	/**
	 * @param $menuId
	 * @return string
	 */
	protected static function getItems($menuId)
	{
		$items = Query::select("SELECT menu_items.* FROM menu_items
				LEFT JOIN menus ON menu_items.menu_id=menus.id
				WHERE menu_items.menu_id=$menuId;
		");
		$menu_item = '';
		foreach ($items as $item){
			if(!is_array($item)){

			}else{
				$menu_item .='<li><a href="'. $item['link'].'">'.$item['title'].'</a></li>';
			}

		}
		return '<ul>'.$menu_item.'</ul>';

	}

	/**
	 *
	 */
	protected static function getDefault()
	{
		self::getMenu();
	}
}