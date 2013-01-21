<?php
namespace Tipsy\Libraries\Document;
// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();

abstract class TPositions
{
	/**
	 * @var	array	Позиции текущего шаблона.
	 *
	 */
	public static $positions = array();
	
	public static function getPosition($name, $contParam, $contID)
	{
		self::$positions = $name;
	}
	
	public static function getPosContent($position)
	{
		TContent::getContent();
	}
	
	public static function setPosContent($position, $content)
	{
	
	}
}

?>