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
	#public $errors = array();

	#public $debugMesages = array();

	/**
	 * Метод запускающий формирование страцы
	 */
	public function run()
	{
	// Устанавливает подключение к БД
		Database::connect(Factory::getDbOptions());

		// Проверяет и и запускает сессию в случае если нет активной.
		Session::check();

		try {
			// Подключает библиотеку формирующую страницы html
			Loader::autoload('\Libraries\Document\Document');
			// Создает объект формирующий страницу html
			$document = new Document();
		} catch (RuntimeException $e) {
			// Выводит ошибку на страницу.
			Errors::getErrors();
		}
	}
}