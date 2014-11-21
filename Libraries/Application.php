<?php
namespace Tipsy\Libraries;

use Tipsy\Libraries\Loader;
use Tipsy\Libraries\Factory;

// Проверяет легален ли доступ к файлу.
defined('_TEXEC') or die;

/**
 * Базовый класс платформы.
 * По возможности здесь будет реализовываться API.
 */
class Application
{
	/**
	 * Конструктор
	 */
	public function __construct()
	{
		// Подключает Абстрактную фабрику.
		Loader::loadClass('\Libraries\Factory');
		// Получает настройки конфигурации системы.
		Factory::getConfig();
		// Подключает класс диспетчера компонентов системы
		Loader::loadClass('\Libraries\Dispatcher');
		#Loader::loadClass('\Libraries\Document\Model');
		$Dispatcher = new Dispatcher();

		$html = Factory::getDocument();
	}

	public function __destruct()
	{

	}
}