<?php
namespace Tipsy\Libraries\Document;

use Tipsy\Libraries\Document\Content;
use Tipsy\Libraries\Database\Database;
use Tipsy\Libraries\Database\Query;
use Tipsy\Config\Config;

// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();

abstract class Position
{
	/**
	 * @var	array	Позиции текущего шаблона.
	 *
	 */
	protected static $positions = array();
	
	
	/**
	 * Метод пределяющий компонент, привязанный к позиции (тип выводимого контента)
	 */
	public static function getPositionData($positionName)
	{
		$positionName = strtolower($positionName);
		// Если позиция не зарегистрирована в списке, тогда:
		if(!in_array($positionName, self::$positions)){
			// Заполняет массив-список позиций шаблона.
			self::$positions[] = $positionName;
			// Проверяет наличие данных о позиции в базе данных...
			if(!Query::select("select `name` FROM `positions` where `name` = \"$positionName\";")){
				// В случае отсутствия информации - регистрирует позицию в БД.
				Query::insert('insert into positions (name) values ("'.$positionName.'");');
			}
		}
		// Получает контент позиции.
		self::getPosContent($positionName);
	}
	
	public static function getPosContent($position)
	{
		$queryStr = 'SELECT * FROM `positions` WHERE `name` = \''.$position.'\';';
		$posContent = Query::select($queryStr);

		if($posContent and  Config::$tmplDebug) {
			echo $posContent['name'];
		}
	}
}