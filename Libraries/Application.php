<?php
namespace Tipsy\Libraries;

use Tipsy\Libraries\Loader;
use Tipsy\Libraries\Factory;

// Проверяет легален ли доступ к файлу.
defined('_TEXEC') or die;

/**
 * Базовый класс платформы Tipsy CMS
 * По возможности здесь будет реализовываться API
 *
 */
class Application
{

	/**
	 * Метод запускающий формирование страны.
	 */
	public function __construct()
	{	
		// Подключает системный модуль.
		Loader::autoload('\Libraries\Factory');
		// Получает настройки конфигурации системы.
		Factory::getConfig();
		Loader::autoload('\Libraries\Dispatcher');
		#Loader::autoload('\Libraries\Document\Model');
		$Dispatcher = new Dispatcher();
		
		$html = Factory::getDocument();
	}
	
		/**
	 * Метод загружающий системные библиотеки.
	 *
	 */

	public function __destruct()
	{

	}
}