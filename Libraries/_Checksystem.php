<?php
// Проверяет легален ли доступ к файлу.
defined('_TEXEC') or die;

/**
 * Класс для проверки сервера на совместимость с системой или для проверки отдельных параметров сервера
 */
class CheckSystem{

	public static $pdoSupportedDrv = '';
	public static $phpVer = '';

	public static function check()
	{
		self::$pdoSupportedDrv = PDO::getAvailableDrivers();
		self::$phpVer = phpversion();
	}
}