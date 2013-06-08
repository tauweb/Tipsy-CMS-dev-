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
use Tipsy\Libraries\Html\Head;
use Tipsy\Libraries\Loader;
use Tipsy\Libraries\Html\Position;

class Model
{
	protected static $template = '';
	protected static $head = array();
	protected static $positions = array();
	
	protected static function head($method, $param)
	{
		Head::$method($param);
	}
	
	protected static function getTitle()
	{
		static::$head['title'] = "<title>".Config::$siteName."</title>";
	}

	/**
	 * Метод определяющий используемый шаблон html страниц.
	 */
	protected function getTemplate()
	{
		// Путь к каталогу файлов шаблона.
		$template = 'Templates/' . Config::$template;

		try{
			if (file_exists($tmpl_index = $template . '/' . 'index.php')) {
				static::$template = $template;
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

	protected function positions($positions)
	{
		foreach(explode(',', $positions) as $position)
			self::$positions[strtolower($position)] = '';
		
		Position::getComponent();
	}
}