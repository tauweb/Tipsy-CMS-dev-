<?php
namespace Tipsy\Libraries;

use Tipsy\Libraries\Loader;
use Tipsy\Libraries\Document\Document;
use Tipsy\Libraries\Session;
use Tipsy\Libraries\Factory;
use Tipsy\Libraries\Database\Database;

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
	 * Метод запускающий формирование страцы
	 */
	public function __construct()
	{	
		// Подключает системный модуль.
		Loader::autoload('\Libraries\Factory');

		// Создает объект ядра приложения
		$factory = new Factory();

		// Проверяет и запускает сессию в случае, если нет активной.
		Session::check();

		// Подключает библиотеку формирующую страницы html
		Loader::autoload('\Libraries\Document\Document');
		
		// Создает объект формирующий страницу html
		$document = new Document();	
	}
	
	public function __destruct()
	{
		Database::$dbh = null;
	}
}