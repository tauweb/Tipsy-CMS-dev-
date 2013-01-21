<?php
namespace Tipsy\Libraries;
// Проверяет легален ли доступ к файлу.
defined('_TEXEC') or die;

/**
 * Базовый класс платформы Tipsy CMS
 * По возможности здесь будет реализовываться API
 *
 */
class TApplication
{
	/**
	 * Метод запускающий формирование страцы
	 */
	public function run()
	{
		// Загружает класс работы с БД
		TLoader::load('TDatabase');
		// Устанавливает соединение с БД
		TDatabase::connect(TSystem::getDBOptions());
		// Подключает отладчик системы
		TLoader::load('TDebug');
		// Подключает библиотеку выполняющие запросы к БД
		TLoader::load('TQuery');
		// Подключает компонент отвечающий за формирование и вывод контента на страницу.
		TLoader::discover('T',_TPATH_COMPONENTS);
		// Загружает класс формирующий контент.
		TLoader::load('TContent');
		// З
		TLoader::load('TSession');
		// Проверяет и и запускает сессию в случае если нет активной.
		TSession::check();

		TLoader::load('TUser');


		try {
			// Подключает библиотеку формирующую страницы html
			TLoader::load('TDocument');
			// Создает объект формирующий страницу html
			$TDocument = new TDocument();
		} catch (TRuntimeException $e) {
			// Выводит ошибку на страницу.
			TErrors::getErrors();
		}
	}
}
?>