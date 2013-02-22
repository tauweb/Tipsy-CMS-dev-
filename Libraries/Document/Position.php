<?php
namespace Tipsy\Libraries\Document;

use Tipsy\Libraries\Document\Content;
use Tipsy\Libraries\Database\Query;

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
		if(!in_array($positionName, self::$positions)){
			// Регистрирует позицию в список позиций.
			self::$positions[] = $positionName;
			Query::query('insert into positions (name) values ("'.$positionName.'");');
		}
		
		self::getPosContent($positionName);
	}
	
	public static function getPosContent($position)
	{
		$queryStr = 'SELECT `*` FROM `positions` WHERE `name` = \''.$position.'\';';
		#Query::query($queryStr);
		#Content::getPosContent($position);
	}
}