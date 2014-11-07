<?php
namespace Tipsy\Libraries;

use Tipsy\Libraries\Loader;
use Tipsy\Libraries\Factory;

// Проверяет легален ли доступ к файлу.
defined('_TEXEC') or die;

/**
 * Базовый класс платформы.
 * По возможности здесь будет реализовываться API.
 *
 */
class Application
{
	/**
	 *
	 */
	public function __construct()
	{
		// Подключает Абстрактную фабрику.
		Loader::autoload('\Libraries\Factory');
		// Получает настройки конфигурации системы.
		Factory::getConfig();
		//
		Loader::autoload('\Libraries\SystemDispatcher',__METHOD__,__LINE__);
		#Loader::autoload('\Libraries\Document\Model');
		$Dispatcher = new SystemDispatcher();

		$html = Factory::getDocument();
	}


	public function __destruct()
	{

	}
}