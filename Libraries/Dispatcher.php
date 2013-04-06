<?php
/**
 * Created by JetBrains PhpStorm.
 * User: whiskeyman
 * Date: 06.04.13
 * Time: 14:52
 */

namespace Tipsy\Libraries;

use Tipsy\Libraries\Loader;
use Tipsy\Libraries\Database\Query;

/**
 * Class Dispatcher - Диспетчер компонентов системы. Отвечает за инициализацию и регистрацию компонента в сестеме.
 * @package Tipsy\Libraries
 */
abstract class Dispatcher {

	public static function init()
	{
		self::autoComInit();
		self::comRegister();

	}


	/**
	 * @var array Список зарегистрированных компонентов в системе.
	 */
	protected static $components = array();

	/**
	 * Метод отвечающий за инициализацию компонентов в системе.
	 */
	protected  static function autoComInit()
	{
		$exclude_list = array(".", "..");

		$com_dir = array_diff(scandir('Components'), $exclude_list);

		foreach($com_dir as $com){
			Loader::autoload('\Components\\'.$com.'\\'.$com);
			self::$components[] = $com;
		}
	}


	/**
	 * Метод регистрирующий компоненты в системе (заносит в реестр компонентов в БД).
	 */
	protected static function comRegister()
	{
		foreach(self::$components as $com){
			if(!Query::select("SELECT * FROM components WHERE name = \"$com\"")){
				Query::insert("INSERT INTO components (name) value (\"$com\") ");
			}
		}
	}
}