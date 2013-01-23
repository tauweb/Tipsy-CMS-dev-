<?php
namespace Tipsy\Libraries;

use Tipsy\Libraries\Logger;
use Tipsy\Config\Config;

// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die;

/**
 * Системный объект
 */
class Factory
{
	/**
	 * Конструктор, служит для автоматической загрузки некоторых системных компонентов и настроек
	 *
	 */
	public function __construct()
	{
		self::loadCoreLibraries();
		// Получает настройки конфигурации системы.
		self::getConfig();
		// Определяет уровень отчета об ошибках.
		self::setErrorReporting();
		// Временная зона системы.
		self::setTimeZone();
		// Определяет время жизни сессий.
		self::getSession_lifetime();
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
		// Устанавливает соединение с БД
		// Подключает отладчик системы
		Loader::autoload('\Libraries\Debug');
		// Подключает библиотеку выполняющие запросы к БД
		Loader::autoload('\Libraries\Database\Query');
		// Подключает компонент отвечающий за формирование и вывод контента на страницу.
		Loader::autoload('\Libraries\Document\Content');
		//
		Loader::autoload('\Libraries\Session');

		Loader::autoload('\Components\User\User');


	}
	
	/**
	 * Метод определяющий временную зону системы из файла настроек.
	 *
	 */
	public function setTimeZone()
	{
		date_default_timezone_set(Config::$timezone);
	}
	
	/**
	 * Метод подключения файлов конфигурации.
	 *
	 * @return	boolean	true, если конфигурация загружена и запись лога с сообщением о том что не найден файл
	 *							конфигурации и прекращение выполнения сценария
	 */
	public static function getConfig()
	{
		// Подключает настройки системы
		if (Loader::autoload('Config\Config'))
		{
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
	public static function getDbOptions()
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
	public static function setErrorReporting()
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
	public static function getSession_lifetime()
	{
		session_set_cookie_params(Config::$sessionLifetime * 60);
	}
}