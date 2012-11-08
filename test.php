<?php
/**
 * User: whiskeyman
 * Date: 04.09.12
 *
 */
class TCheckSystem{

	public static $PDOSupDrv = '';
	
	public static $PHPVer = '';
	
	public static function check()
	{
		self::$PDOSupDrv = PDO::getSupportedDrivers();
		self::$PHPVer = phpversion();
	}
	
	
}
?>