<?php
namespace Tipsy\Libraries\Document;

use Tipsy\Config\Config;
use Tipsy\Libraries\Factory;

class Head {

	/**
	 * Метод устанавливающий кодировку страниц
	 * @param string	имя кодировки для установки
	 */
	public function setCharset($charset)
	{
		static::$head['charset'] = '<meta charset="' . $charset . '" />';
	}
		
	public function addStylesheet($name)
	{
		static::$head['stylesheets'][$name] =
			'<link rel = "stylesheet" href="' . 'Templates/' . Config::$template . '/css/' . $name . ' ">';
	}
	
	public function getTitle()
	{
		return static::$head['title'] = "<title>".Factory::getConfig()->getTitle()."</title>";
	}
	
	public function getHead()
	{
	
	}
}