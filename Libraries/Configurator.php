<?php
namespace Tipsy\Libraries;

use Tipsy\Config\Config;

class Configurator
{
	public function __construct()
	{
		self::getConfig();
		self::getErrorReporting();
		self::getSessionLifetime();
		self::getTimeZone();
	}

		/**
	 * Метод подключения файлов конфигурации.
	 *
	 * @return	boolean	true, если конфигурация загружена и запись лога с сообщением о том что не найден файл
	 *			конфигурации и прекращение выполнения сценария
	 */
	protected function getConfig()
	{
		// Подключает класс настроек системы.
		if(Loader::loadClass('\Config\Config')) {
			return true;
		}else{
			// Пишет сообщение в лог о не найденном файле конфигурации.
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
	public function getDbOptions()
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
	 * Метод установки уровня отчётов об ошибках из файла конфигурации системы.
	 */
	protected function getErrorReporting()
	{
		// Устанавливает уровень отчёта об ошибках.
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
				// Note: E_STRICT включён в E_ALL начиная с версии PHP >= 5.4
				error_reporting(E_ALL | E_STRICT);
				ini_set('display_errors', 1);
				break;
		}
	}

	/**
	 * Метод получения времени жизни сессии из настроек.
	 */
	protected function getSessionLifetime()
	{
		session_set_cookie_params(Config::$sessionLifetime * 60);
	}

	/**
	 * Метод определяющий временную зону системы из файла настроек.
	 *
	 */
	protected function getTimeZone()
	{
		date_default_timezone_set(Config::$timezone);
	}

	public function getTitle()
	{
		return Config::$siteName;
	}

	public function getTemplate()
	{
		return Config::$template;
	}
}