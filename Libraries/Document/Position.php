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
			// Заполняет массив-список позиций шаблона.
			self::$positions[] = $positionName;
			if(Query::select("select `name` FROM `positions` where `name` = $positionName;")){
				Query::insert('insert into positions (name) values ("'.$positionName.'");');
			}
		}
		
		self::getPosContent($positionName);
	}
	
	public static function getPosContent($position)
	{
		$queryStr = 'SELECT * FROM `positions` WHERE `name` = \''.$position.'\';';
		$posContent = Query::select($queryStr);
		if($posContent) {
			echo $posContent['name'];
		}
	}
}