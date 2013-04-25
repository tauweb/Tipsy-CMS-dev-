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

	protected static $menus = '';

	/**
	 * Метод инициализации.
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
		$menus = Query::select('SELECT *  FROM menus WHERE menus.published=1;');

		for($i=1; $i<count($menus); $i++){
			foreach($menus as $menu){
				self::$menus .= '
					<div id="menu_title" style="border: 1px solid black;">'.
					$menu['title'].
					'</div>'.
					'<div id="menu_body" style="border: 1px solid black;">'.
					self::getItems($menu['id']).
					'</div>';
			}
		}
		return self::$menus;
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
		// Если один пункт меню
		if(isset($items['id'])){
			$menu_item .='<li><a href="'. $items['link'].'">'.$items['title'].'</a></li>';
			return '<ul>'.$menu_item.'</ul>';
		}

		foreach ($items as $item){
			if(is_array($item)){
				foreach($item as $it){
					echo $it;
					 $menu_item ='<li><a href="'. $item['link'].'">'.$item['title'].'</a></li>';
				}
				return '<ul>'.$menu_item.'</ul>';
			}
			echo $menu_item .='<li><a href="'. $item['link'].'">'.$item['title'].'</a></li>';

		}

		return '<ul>'.$menu_item.'</ul>';

	}

	/**
	 *
	 */
	protected static function getDefault()
	{
		return self::getMenu();
	}
}