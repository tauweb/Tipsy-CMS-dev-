<?php
namespace Tipsy\Libraries\Html;

use Tipsy\Config\Config;

abstract class Head extends Model{

	/**
	 * Метод устанавливающий кодировку страниц
	 * @param	string	имя кодировки для установки
	 */
	protected static function charset($charset)
	{
		static::$head['charset'] = '<meta charset="' . $charset . '" />';
	}
	
	
	protected static function stylesheet($name)
	{
		static::$head['stylesheets'][$name] =
			'<link rel = "stylesheet" href="' . 'Templates/' . Config::$template . '/css/' . $name . ' ">';
	}
	
}