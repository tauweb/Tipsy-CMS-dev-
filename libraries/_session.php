<?php

// Проверяет легален ли доступ к файлу.
defined('_TEXEC') or die;

/**
 * 
 */
class TSession
{
	public static function start($SessionName)
	{
		if (!empty($SessionName))
		{
			session_start();
			
			// Имя пользователя сесии
			$_SESSION['name'] = $SessionName;
			
			// Количество посещений пользователя, общее или после чистки куки
			empty($_SESSION['count'])
					? $_SESSION['count'] = 1
					: $_SESSION['count']++;
		}
	}
}
