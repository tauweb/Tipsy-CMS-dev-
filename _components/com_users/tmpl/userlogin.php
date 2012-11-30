<?php
/**
 * Created by JetBrains PhpStorm.
 * User: whiskeyman
 * Date: 29.11.12
 * Time: 15:03
 * To change this template use File | Settings | File Templates.
 */
abstract class TUserLogin
{
	public static function login()
	{
		self::getTemplate();
	}

	protected static function getTemplate()
	{
		$tmpl = require_once __DIR__ . DIRECTORY_SEPARATOR . 'tmpl_default.php';
		TContent::putContent($tmpl);
	}
}

?>