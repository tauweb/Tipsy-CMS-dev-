<?php
// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();

/**
 * Created by JetBrains PhpStorm.
 * User: whiskeyman
 * Date: 29.11.12
 * Time: 15:03
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

	}

	protected static function checkUser()
	{
		 $_SERVER['REQUEST_URL'] = '/';
		if ($_POST) echo 'Вы вошли как: ' . $_POST['name'];
		$query = 'SELECT `username` FROM `users` WHERE username = "whiskeyman";';
		$table = TQuery::query($query);
		#echo $table['username'];
		#foreach($table as $t){echo $t;}
		return true;
	}
}
?>