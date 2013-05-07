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
 * @package Tipsy\Libraries\Html
 */
abstract class Position extends Html
{

	/**
	 * @var array Позиции текущего шаблона. Пока что используется parent.
	 */
	#private static $positions = '';


	/**
	 * @var array Теги применяемые в шаблоне.
	 */
	protected static $tags = array('{content}', '{always}');


	/**
	 * Метод определяющий компонент, привязанный к позиции по дефолту (тип выводимого контента).
	 */
	public static function getComponent($position='')
	{
		// Проверяет наличие данных о позиции в базе данных...
		if(!Query::select("SELECT name FROM positions WHERE name = \"$position\";")){

			// В случае отсутствия информации - регистрирует позицию в БД.
			Query::insert("INSERT INTO positions (name) VALUES (\"$position\");");
		}

		$posCom = Query::select("SELECT com FROM positions WHERE name = \"$position\";");
echo $posCom['com'];
		// Определяет тип контента текущей позиции, заданный пользователем.
		if(empty($posСom['com'])){
			#echo $posCom['com'];
			#self::parse($position);
		}

		// Получает контент позиции.
		self::getData($position, $posCom['com']);
	}



	protected static function getData($position, $posCom='', $id='')
	{
		// Формирует название компонента, который привязан к позиции шаблона.
		$com_ns = ucfirst($posCom);

		// Формирует имя пространста имен компонента.
		$com_ns  = "\\Tipsy\\Components\\$com_ns\\$com_ns";

		class_exists($com_ns) ? $com_data = $com_ns::init($id) : $com_data = '';

		self::$positions[$position] = $com_data;

		self::parse($position, $posCom, $com_data);
	}


	/**
	 * Метод получающий данные для компонента привязанного к позиции.
	 */
	protected static function parse($position, $posCom='', $com_data)
	{
		// Выводит название позиции на страницу, если разрешена отладка шаблона в настройках.
		//Todo: Переписать отдельным методом.
		#if($posCom and Config::$tmplDebug) {echo '<fieldset><legend>'.$position.'</legend>';}

		// Подключает шаблон текущей позиции в шаблон страницы, указанный в родительском классе (Html).
		@$pos_tmpl = file_get_contents(parent::$template.DIRECTORY_SEPARATOR.'Positions'.DIRECTORY_SEPARATOR.
			ucfirst($position).'.tpl');

		if(!$pos_tmpl){
			// Todo: Здесь тоже нужно будет поколдоват, пока модуль отладки не дописан, оставлю так как есть.
			echo "Ух ты, никак не найти $position.tpl ";

			Debug::AddMessage("Ух ты, никак не найти $position.tpl", __CLASS__);
			return;
		}

		// Выполняет инициализацию компонента привязанного к позиции, если существует его класс,
		// для получения контента заданного пользователем поумолчанию.
		if(!empty($com_data)){

			$content = str_replace('{content}', $com_data, $pos_tmpl);

			// Убирает теги из шаблона.
			$content = str_replace(self::$tags,'', $content);

			// Ищет и выполняет код php в шаблоне, заключается в теги.
			self::run_php($content);

		}elseif(substr($pos_tmpl, 0, 8) == '{always}'){

			$pos_tmpl = str_replace(self::$tags,'', $pos_tmpl);

			self::run_php($pos_tmpl);
		}

		// Здесь завершается вывод отладки шаблона.
		#if($posCom and  Config::$tmplDebug) {echo '</fieldset>';}
	}


	/**
	 * Метод выполняющий код из шаблона позиции.
	 * @param $content конткнт в котором производится поиск и выполнение кода.
	 */
	protected static function run_php($content)
	{
		// Ищет в шаблоне позиции тег кода PHP и исполняет код заключенный между открывающим и закрывающим тегом.
		while (stripos($content, '{php}')){
			$start_php = stripos($content, '{php}');
			$end_php = stripos($content, '{/php}');
			$lenght = $end_php-$start_php + 6;
			$php_code = '<?' . substr($content, $start_php+5, $lenght - 11) . '?>';
			$content = substr_replace($content, $php_code, $start_php, $lenght);
		}
		eval('?>' . $content);

	}
}