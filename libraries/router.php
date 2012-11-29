<?php
// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();

abstract class TRouter
{
	public static function getURL()
	{
		foreach($_GET as $name)
			TDebug::AddMessage("<B>В данный момент компонет находится в разработке. </B>Component name is: $name", __METHOD__);
	}
}

?>