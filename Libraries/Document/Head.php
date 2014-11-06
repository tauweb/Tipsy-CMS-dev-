<?php
namespace Tipsy\Libraries\Document;

use Tipsy\Config\Config;
use Tipsy\Libraries\Factory;

class Head{

	protected $title = 'This is default page title';

	protected $charset = 'utf-8';

	// protected $metaTags = array();

	// public function __set($tagName, $value){

	// }

	// public function __get($tagName){

	// }

	/**
	 * Метод устанавливающий кодировку страниц
	 * @param string	имя кодировки для установки
	 */
	public function setCharset($charset)
	{
		static::$head['charset'] = '<meta charset="' . $charset . '" />';
	}

	public function setStylesheet($stylesheetName)
	{
		$this->head['stylesheets'][$stylesheetName] =
			'<link rel = "stylesheet" href="' . 'Templates/' . Config::$template . '/css/' . $stylesheetName . ' ">';
	}

	public function getTitle()
	{
		return $this->$head['title'] = "<title>".Factory::getConfig()->getTitle()."</title>";
	}

	public function getHead()
	{
		// реализация рендеринга контейнера head.
		echo 'Отладка метода getHead';
	}
}