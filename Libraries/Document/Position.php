<?php
namespace Tipsy\Libraries\Document;

use Tipsy\Libraries\Document\Content;

// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();

abstract class Position
{
	/**
	 * @var	array	Позиции текущего шаблона.
	 *
	 */
	protected static $positions = array();
	
	public static function getPositionData($positionName)
	{
		// Для отладки......................
		echo '<b>Pos: </b>' . $positionName;
		
		// Регистрирует позицию в список позиций.
		self::$positions[] = $positionName;
		
		self::getPosContent($positionName);
	}
	
	public static function getPosContent($position)
	{
		#Content::getContent($position);
		Content::getPosContent($position);
	}
}