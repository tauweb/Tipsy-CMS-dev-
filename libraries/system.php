<?php
// Проверяю легален ли доступ к файлу
defined('_TEXEC') or die;

/**
 * Системный объект
 */
class TSystem
{

	/**
	 * Конструктор, служит для автоматической загрузки некоторых системных настрок
	 *
	 */
	public function __construct()
	{
		self::getConfig();
		self::setError_reporting();
		self::setTimeZone();
	}

	public function setTimeZone()
	{
		date_default_timezone_set(TConfig::$timezone);
	}
	/**
	 * Метод подключения файлов конфигурации.
	 *
	 * @return  true если конфигурация загружена и запись лога с сообщением о том что не найден файл
	 *			конфигурации и прекращение выполнения сценария
	 */
	public static function getConfig()
	{
		// Подключаю конфигурацию системы
		if (TLoader::load('TConfig'))
		{
			return true;
		}else{
			TLogger::WriteLogs('Не найден файл конфигурации config.php');
			die('Не найден файл конфигурации <b>config.php</b>');
		}
	}

	/**
	 * Метод установки уровня отчетов об ошибках из файла конфигурации системы.
	 */
	public static function setError_reporting()
	{
		// Устанавливаю уровень отчета об ошибках.
		switch (TConfig::$error_reporting) {
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
}
?>