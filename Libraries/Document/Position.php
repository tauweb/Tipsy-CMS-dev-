<?php
namespace Tipsy\Libraries\Document;

use Tipsy\Libraries\Document\Content;
use Tipsy\Libraries\Database\Database;
use Tipsy\Libraries\Database\Query;
use Tipsy\Config\Config;
use Tipsy\Libraries\Loader;

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
			if(!Query::select("SELECT name FROM positions WHERE name = \"$positionName\";")){
				// В случае отсутствия информации - регистрирует позицию в БД.
				Query::insert("INSERT INTO positions (name) VALUES (\"$positionName\");");
			}
		}
		// Получает контент позиции.
		self::getPosContent($positionName);
	}
	
	protected static function getPosContent($position)
	{
		$posContentType = Query::select("SELECT * FROM positions WHERE name = \"$position\";");

		// Выодит название позиции на страницу, если разрешена отладка шаблона в настройках.
		if($posContentType and  Config::$tmplDebug) {
			echo $posContentType['name'];
		}

		$com =  ucfirst($posContentType['name']);

		$com = "\\Tipsy\\Components\\$com\\$com";

		if(class_exists($com)){
			$com::init();
		}

	}
}