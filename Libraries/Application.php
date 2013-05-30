<?php
namespace Tipsy\Libraries;

use Tipsy\Libraries\Html\Controller;
use Tipsy\Libraries\Loader;
use Tipsy\Libraries\Html\Html;
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

		// Подключает библиотекии MVC.
		Loader::autoload('\Libraries\Html\Model');
		Loader::autoload('\Libraries\Html\Controller');
		Loader::autoload('\Libraries\Html\View');
		Loader::autoload('\Libraries\Html\Position');
		Loader::autoload('\Libraries\Html\Head');
		Loader::autoload('\Libraries\Router');

		// Создает объект формирующий страницу html
		$Html = new Controller();
	}

	public function __destruct()
	{
		Database::$dbh = null;
	}
}