<?php
namespace Tipsy\Components\User;

use Tipsy\Libraries\Loader;
use Tipsy\Components\User\UserLogin;

// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();
/**
 * User: whiskeyman
 * Date: 08.11.12
 * Time: 17:32
 */
abstract class User
{
	/**
	 * Метод выполняющий авторизацию пользователя (перенаправляет на класс авторизации)
	 */
	public static function login()
	{
		Loader::autoload('\Components\User\UserLogin');
		UserLogin::login();
	}

	/**
	 * Метод инициализации. Проверяет состояние пользователей.
	 *
	 */
	public static function init()
	{
		// Проверяет нет ли авторизованных пользователей
		if(!isset($_SESSION['user'])){
			return "<a href=\"?component=userlogin\">Вход </a>" .
					"<a href=\"?component=userreg\"> Регистрация</a>";
			self::login();
		}else{
			Loader::autoload('\Components\User\UserLogout');
			echo "Привет  ". $_SESSION['user'] . "<a href=\"?component=\\Components\\User\\UserLogout\">Выйти</a>";
			return true;
		}
	}
}