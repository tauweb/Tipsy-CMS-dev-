<?php
/**
 * Created by JetBrains PhpStorm.
 * User: whiskeyman
 * Date: 08.11.12
 * Time: 11:38
 * To change this template use File | Settings | File Templates.
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
