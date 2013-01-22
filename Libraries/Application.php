<?php
namespace Tipsy\Libraries;

use Tipsy\Libraries\Loader;
use Tipsy\Libraries\Document\Document;
use Tipsy\Libraries\Database\Database;
use Tipsy\Libraries\Session;

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
	public function run()
	{
		// Загружает класс работы с БД
		Loader::autoload('\Libraries\Database\Database');
		// Устанавливает соединение с БД
		Database::connect(Factory::getDbOptions());
		// Подключает отладчик системы
		Loader::autoload('\Libraries\Debug');
		// Подключает библиотеку выполняющие запросы к БД
		Loader::autoload('\Libraries\Database\Query');
		// Подключает компонент отвечающий за формирование и вывод контента на страницу.
		Loader::autoload('\Libraries\Document\Content');
		// З
		Loader::autoload('\Libraries\Session');
		// Проверяет и и запускает сессию в случае если нет активной.
		Session::check();

		Loader::autoload('\Components\User\User');


		try {
			// Подключает библиотеку формирующую страницы html
			Loader::autoload('\Libraries\Document\Document');
			// Создает объект формирующий страницу html
			$doc = new Document();
		} catch (RuntimeException $e) {
			// Выводит ошибку на страницу.
			Errors::getErrors();
		}
	}
}
?>