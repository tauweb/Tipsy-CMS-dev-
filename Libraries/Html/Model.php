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
use Tipsy\Config\Config;

class Model
{
	protected static $template = '';
	protected static $head = array();
	protected static $positions = array();

	/**
	 * Метод определяющий используемый шаблон html страниц.
	 */
	protected function getTemplate()
	{
		// Путь к каталогу файлов шаблона.
		$template = 'Templates/' . Config::$template;

		try{
			if (file_exists($tmpl_index = $template . '/' . 'index.php')) {
				self::$template = $template;
			} else {
				throw new RuntimeException('Не найден <b>index.php</b> выбранного шаблона');
			}
			require_once $tmpl_index;
		} catch (RuntimeException $e){
			// Выводит ошибку на страницу.
			Errors::getErrors();
		}
	}

	/**
	 * Метод устанавливающий кодировку страниц
	 * @param	string	имя кодировки для установки
	 */
	public static function setCharset($charset)
	{
		static::$head['charset'] = '<meta charset="' . $charset . '" />';
	}

	public static function addStylesheet($name)
	{
		static::$head['stylesheets'][$name] =
			'<link rel = "stylesheet" href="' . 'Templates/' . Config::$template . '/css/' . $name . ' ">';
	}

	protected static function getHead()
	{
		foreach(static::$head as $tag){
			if(is_array($tag) and !empty($tag) ){
				foreach($tag as $subTag){
					if(!empty($subTag)) echo $subTag . "\n";
				}
			}elseif(!empty($tag)){
				echo $tag ."\n";
			}
		}
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