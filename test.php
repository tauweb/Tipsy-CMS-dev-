<?php
/**
 * User: whiskeyman
 * Date: 04.09.12
 *
 */
class TCheckSys{

	public static $PDOSupDrv = '';
	
	public static $PHPVer = '';
	
	public static function check()
	{
		self::$PDOSupDrv = PDO::getSupportedDrivers();
		self::$PHPVer = phpversion();
		
		var_dupm(self);
	}
	
	
}
?>