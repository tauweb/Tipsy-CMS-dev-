<?php
/**
 * Библеотека диспетчерра компонентов системы.
 */

namespace Tipsy\Libraries;

use Tipsy\Libraries\Loader;
use Tipsy\Libraries\Database\Query;

/**
 * Class Dispatcher - Диспетчер компонентов системы. Отвечает за инициализацию и регистрацию компонента в системе.
 */
class Dispatcher {

	public function __construct()
	{
		#self::autoComInit();
		self::comRegister();
		self::loadCoreLibraries();
	}

	/**
	 * @var array Список зарегистрированных компонентов в системе.
	 */
	protected static $components = array();


	protected function loadCoreLibraries()
	{
		// Подключает компонент логирования.
		Loader::autoload('\Libraries\Logger');
		// Подключает обработчик исключений.
		Loader::autoload('\Libraries\Exception');
		// Подключает модуль отладки системы.
		Loader::autoload('\Libraries\Debug');
		// Загружает класс работы с БД
		Loader::autoload('\Libraries\Database\Database');
		// Подключает отладчик системы
		Loader::autoload('\Libraries\Debug');
		// Подключает класс обработчика сессий.
		Loader::autoload('\Libraries\Session');
		// Подключает класс диспетчера компонетов.
		#Loader::autoload('\Libraries\Dispatcher');
	}
	
	/**
	 * Метод отвечающий за автоматическую инициализацию компонентов в системе.
	 */
	protected static function autoComInit()
	{
		// Список исключенний из списка компонентов.
		$exclude_list = array(".", "..");

		// Создаёт список компонентов системы, лежащих в директории компонентов.
		$com_dir = array_diff(scandir('Components'), $exclude_list);

		foreach($com_dir as $com){
			// Загружает класс компонента.
			Loader::autoload('\Components\\'.$com.'\\'.$com);
			// Регистрирует компонент в списке известных.
			self::$components[] = $com;
		}
	}

	/**
	 * Метод регистрирующий компоненты в системе (заносит в реестр компонентов в БД).
	 */
	protected static function comRegister()
	{
		foreach(self::$components as $com){
			if(!Query::select("SELECT * FROM components WHERE name = \"$com\"")){
				Query::insert("INSERT INTO components (name) value (\"$com\") ");
			}
		}
	}
}