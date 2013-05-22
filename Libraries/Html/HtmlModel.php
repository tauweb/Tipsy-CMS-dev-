<?php
/**
 * Created by JetBrains PhpStorm.
 * User: whiskeyman
 * Date: 22.05.13
 * Time: 17:59
 * To change this template use File | Settings | File Templates.
 */

namespace Tipsy\Libraries\Html;

use Tipsy\Libraries\Router;
use Tipsy\Libraries\Errors;
use Tipsy\Libraries\Debug;

class HtmlModel {
	protected  static $template = '';

	protected static $head = array();

	protected static $positions = array();

	/**
	 * Метод устанавливающий кодировку страниц
	 * @param	string	имя кодировки для установки
	 */
	protected static function setCharset($charset)
	{
		#Head::setCharset($charset);
	}

	/**
	 * Метод регистрирующий новую таблицу стилей
	 *
	 * @param	string	$name	Имя подключаемой таблицы.
	 */
	protected static function addStylesheet($name)
	{
		Head::addStylesheet($name);
	}

	/**
	 * Метод формирующий содержимое тега <HEAD> и выводящий его на страницу. Формирование происходит в классе THead
	 */
	protected static function getHead()
	{
		Head::getHead();
	}

	/**
	 * Метод получающий переменные из адресной строки.
	 */
	protected function getURL()
	{
		Router::getURL();
	}


	/**
	 * Метод получающий ошибки системы для html страницы.
	 */
	protected static function getErrors()
	{
		Errors::getErrors();
	}

	/**
	 * Метод получающий отладочную информацию системы для html страницы.
	 */
	protected function getDebugMsg()
	{
		Debug::getDebugMsg();
	}

	protected function position($positionName)
	{
		self::$positions[$positionName] = '' ;
	}

}