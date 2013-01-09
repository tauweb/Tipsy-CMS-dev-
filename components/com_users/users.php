<?php
// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();
/**
 * User: whiskeyman
 * Date: 08.11.12
 * Time: 17:32
 */
abstract class TUsers
{
	public static function login()
	{
		TLoader::load('TUserLogin');
		TUserLogin::login();
	}

	public static function init()
	{
		if(empty($_SESSION['user'])){
			self::login();
		}else{
			return $_SESSION['user'];
		}
	}
}
