<?php
namespace Tipsy\Components\User;

use Tipsy\Libraries\Session;
use Tipsy\Libraries\Database\Query;
// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();

/**
 * Created by JetBrains PhpStorm.
 * User: whiskeyman
 * Date: 29.11.12
 * Time: 15:03
 */
abstract class UserLogin
{
	public static function login()
	{
		// Проверяет введенные пользователем данные и обрабатывает их.
		self::check();
	}

	protected static function getTemplate($tmpl = 'tmpl_default.php')
	{
		$tmpl = require_once __DIR__ . DIRECTORY_SEPARATOR .'tmpl'. DIRECTORY_SEPARATOR . $tmpl;

	}

	protected static function check()
	{
		// Подключает шаблон формы авторизации пользоватея.
		self::getTemplate();
		if(empty($_POST['name'])){
			echo  'Для авторизации необходимо ввести имя пользователя.';
			return false;
		}

		//Создает которткие имена переменных формы.
		$user =  $_POST['name'];
		$password = $_POST['password'];
		// Строка запроса к БД, выбирающая данные о пользователе.
		$query = "SELECT `username`, `password` FROM `users` WHERE username = \"" . $user . "\";";

		$table = Query::query($query);
		Session::start($table['username']);
		

		header("Location: ./");
		echo 'Вы вошли как: ' . $_SESSION['user'];
		return true;
	}
}