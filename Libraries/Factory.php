<?php
namespace Tipsy\Libraries;

use Tipsy\Libraries\Logger;
use Tipsy\Config\Config;
use Tipsy\Libraries\Database\Database;

// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die;

/**
 * Системный класс. Инициализирует состояние и настройки системы, а так же выполняет все настройки и прооверки.
 */
class Factory
{
	/**
	 * Конструктор, служит для автоматической загрузки некоторых системных компонентов и настроек
	 *
	 */
	public function __construct()
	{
		// Загружает базовые библиотеки ядра.
		self::loadCoreLibraries();

		// Получает настройки конфигурации системы.
		self::getConfig();

		#self::init();
		// Определяет уровень отчета об ошибках.
		self::setErrorReporting();
		// Временная зона системы.
		self::setTimeZone();
		// Определяет время жизни сессий.
		self::getSession_lifetime();
		self::init();
	}

	/**
	 * Метод загружающий системныемы библиотеки.
	 *
	 */
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
		// Подключает библиотеку выполняющие запросы к БД.
		Loader::autoload('\Libraries\Database\Query');
		// Подключает класс компонента отвечающего за формирование и вывод контента на страницу.
		Loader::autoload('\Libraries\Document\Content');
		// Подключает класс обработчика сессий.
		Loader::autoload('\Libraries\Session');
		// Подключает класс диспетчера компонетов.
		Loader::autoload('\Libraries\Dispatcher');
	}

	protected function init()
	{
		#перенести cюда database и прочее.
		// Устанавливает подключение к БД
		Database::connect(self::getDbOptions());

		Dispatcher::init();
	}

	/**
	 * Метод определяющий временную зону системы из файла настроек.
	 *
	 */
	protected function setTimeZone()
	{
		date_default_timezone_set(Config::$timezone);
	}

	/**
	 * Метод подключения файлов конфигурации.
	 *
	 * @return	boolean	true, если конфигурация загружена и запись лога с сообщением о том что не найден файл
	 *												конфигурации и прекращение выполнения сценария
	 */
	protected static function getConfig()
	{
		// Подключает класс настроек системы.
		if(Loader::autoload('\Config\Config')) {
			return true;
		}else{
			// Пишет сообщение в лог о ненайденном файле конфигурации.
			Logger::WriteLogs('Не найден файл конфигурации Config.php');
			// Завершает работу и выводит сообщение.
			die('Не найден файл конфигурации <b>Config.php</b>');
		}
	}

	/**
	 * Метод формирования опций сервера с подключаемой БД в виде массива.
	 *
	 * @return	array	$DBOptions[host,username,password,dbname,port,socket]	Массив с параметрами БД
	 */
	protected static function getDbOptions()
	{
		$DBOptions = array(
			"host" => Config::$db_host ,
			"username" => Config::$db_user ,
			"password" => Config::$db_password,
			"dbname" => Config::$db_dbname,
			"port" => Config::$db_port,
			"socket" => Config::$db_socket
		);

		return $DBOptions;
	}

	/**
	 * Метод установки уровня отчетов об ошибках из файла конфигурации системы.
	 */
	protected static function setErrorReporting()
	{
		// Устанавливает уровень отчета об ошибках.
		switch (Config::$errorReporting) {
			// Не показывать ошибки
			case 'none':
				error_reporting(0);
				ini_set('display_errors', 0);
				break;

			// Показывать важные
			case 'simple':
				error_reporting(E_ERROR | E_WARNING | E_PARSE);
				ini_set('display_errors', 1);
				break;

			// Показывать все
			case 'maximum':
				// Note: E_STRICT включен в E_ALL начиная с версии PHP >= 5.4
				error_reporting(E_ALL | E_STRICT);
				ini_set('display_errors', 1);
				break;
		}
	}

	/**
	 * Метод почучения времени жизни сессии из настроек.
	 */
	protected static function getSession_lifetime()
	{
		session_set_cookie_params(Config::$sessionLifetime * 60);
	}
}