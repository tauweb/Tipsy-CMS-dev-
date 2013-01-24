<?php
namespace Tipsy\Libraries\Document;

// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();

abstract class Position
{
	/**
	 * @var	array	Позиции текущего шаблона.
	 *
	 */
	public static $positions = array();
	
	public static function getPositionData($positionName)
	{
		// Для отладки
		echo '<b>Pos: </b>' . $positionName;
		
	}
	
	public static function getPosContent($position)
	{
		Content::getContent();
	}
	
	public static function setPosContent($position, $content)
	{
	
	}
}

?>