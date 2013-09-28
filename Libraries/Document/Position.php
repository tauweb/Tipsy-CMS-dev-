<?php
namespace Tipsy\Libraries\Html;

use Tipsy\Libraries\Html\Content;
use Tipsy\Libraries\Database\Database;
use Tipsy\Libraries\Database\Query;
use Tipsy\Config\Config;
use Tipsy\Libraries\Debug;
use Tipsy\Libraries\Loader;

// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();

/**
 * Class Position - Класс отвечающий за позиции (блоки для разного типа контента) в шаблоне html.
 *
 */
abstract class Position extends Model
{
	/**
	 * Метод определяющий компонент, привязанный к позиции по дефолту (тип выводимого контента).
	 */
	public static function getComponent()
	{
		foreach (static::$positions as $position=>$data)
		{
			// Проверяет наличие данных о позиции в базе данных...
			if(!empty($position) and !Query::select("SELECT name FROM positions WHERE name = \"$position\";"))
			{
				// В случае отсутствия информации - регистрирует позицию в БД.
				Query::insert("INSERT INTO positions (name) VALUES (\"$position\");");
			}

			$posCom = Query::select("SELECT * FROM positions WHERE name = \"$position\";");

			// Получает контент позиции.
			self::getData($position, isset($posCom['com']) ? $posCom['com'] : '');
		}
	}

	protected static function getData($position, $posCom='', $id='')
	{
		// Формирует название компонента, который привязан к позиции шаблона.
		$com_ns = ucfirst($posCom);

		// Формирует имя пространста имен компонента.
		$com_ns  = "\\Tipsy\\Components\\$com_ns\\$com_ns";

		class_exists($com_ns) ? $data = $com_ns::init($id) : $data = '';

		self::getPosTemplate($position, $data);
	}

	/**
	 * Метод получающий данные для компонента привязанного к позиции.
	 */
	private static function getPosTemplate($position, $data)
	{
		// Подключает шаблон текущей позиции в шаблон страницы, указанный в родительском классе (Html).
		$pos_tmpl = parent::$template.DIRECTORY_SEPARATOR.'Positions'.DIRECTORY_SEPARATOR.ucfirst($position).'.tpl';

		if(!file_exists($pos_tmpl)){
			// Todo: Здесь тоже нужно будет поколдовать, пока модуль отладки не дописан, оставлю так как есть.
			echo "Ух ты, никак не найти $position.tpl ";
			Debug::AddMessage("Ух ты, никак не найти $position.tpl", __CLASS__);
			return;
		}
		ob_start();
		require_once($pos_tmpl);
		static::$positions[$position] = ob_get_contents();
		ob_end_clean();
	}
}