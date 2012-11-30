<?php
// Проверяет легален ли доступ к файлу.
defined('_TEXEC') or die;

/**
 * Класс для проверки сервера на совместимость с системой или для проверки отдельных параметров сервера
 */
class TCheckSystem{

	public static $PDOSupDrv = '';

	public static $PHPVer = '';

	public static function check()
	{
		self::$PDOSupDrv = PDO::getAvailableDrivers();
		self::$PHPVer = phpversion();
	}


}
?>