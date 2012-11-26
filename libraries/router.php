<?php
// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();

abstract class TRouter
{
	public static function getPathCom()
	{
		foreach($_GET as $pathParam)
			TDebug::AddMessage("<B>В данный момент компонет находится в разработке. </B>Component name is: $pathParam", __METHOD__);
	}
}

?>