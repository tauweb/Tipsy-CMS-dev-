<?php
// Проверяет легален ли доступ к файлу.
defined('_TEXEC') or die;

/**
 * Класс управления сессиями
 */
abstract class TSession
{   /*
    * Метод проверяющий существует ли сессия, если сессия не активна - начинает новую.
    * @returns	true если сессия существует или запущена.
    */
	public static function check(){
		if(!session_id()){
			session_start();
			return true;
		}
	}

	public static function start($SessionName)
	{
		// Если было получено имея сессии и если еще не используется, то запускает новую сессию
		if (!empty($SessionName) && !isset($_SESSION['user']))
		{
			if($SessionName == isset($_SESSION['user']))
			return true;

			// Запускает сессию
			session_start();

			// Имя пользователя сесии
			$_SESSION['user'] = $SessionName;
			
			// Количество посещений пользователя, общее или после чистки куки
			empty($_SESSION['count'])
					? $_SESSION['count'] = 1
					: $_SESSION['count']++;
							
		// Добавляет сообщение в сообщения отладки системы
		TDebug::AddMessage("Страница показана <b>" . $_SESSION['count'] .
			"</b> раз за время сессии" . ' (' .TConfig::$Session_lifetime . ' мин)');
		}
	}
}
?>