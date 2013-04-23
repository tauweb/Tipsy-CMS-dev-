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
	 * @var	array Позиции текущего шаблона.
	 */
	protected static $positions = array();

	#protected static $ns_com ='';

	/**
	 * @var array Теги применяемые в шаблоне.
	 */
	protected static $tags = array('{content}','{always}');

	/**
	 * Метод определяющий компонент, привязанный к позиции (тип выводимого контента).
	 */
	public static function get($positionName)
	{
		$positionName = strtolower($positionName);
		// Если позиция не зарегистрирована (например новая) в списке, тогда:
		if(!in_array($positionName, self::$positions)){
			// Заполняет массив-список позиций шаблона.
			self::$positions[] = $positionName;
			// Проверяет наличие данных о позиции в базе данных...
			if(count(Query::select("SELECT name FROM positions WHERE name = \"$positionName\";"))==0){
				// В случае отсутствия информации - регистрирует позицию в БД.
				Query::insert("INSERT INTO positions (name) VALUES (\"$positionName\");");
			}
		}
		// Получает контент позиции.
		self::parse($positionName);
	}


	/**
	 * Метод выполняющий код из шаблона позиции.
	 * @param $content конткнт в котором производится поиск и выполнение кода
	 */
	protected static function run_php($content)
	{
		while (stripos($content,'{php}')){
			$start_php = stripos($content,'{php}');
			$end_php = stripos($content,'{/php}');
			$lenght = $end_php-$start_php+6;
			$php_code = '<?'.substr($content,$start_php+5,$lenght-11).'?>';
			$content = substr_replace($content,$php_code,$start_php,$lenght);
		}
		eval('?>'.$content);
    }

	/**
	 * Метод получающий данные для компонента привязанного к позиции.
	 */
	protected static function parse($position)
	{
		// Определяет тип контента текущей позиции, заданный пользователем.
		if(!$posContentType = Query::select("SELECT * FROM positions WHERE name = \"$position\";"))
			return;

		// Формирует название компонента, который привязан к позиции шаблона.
		$com =  ucfirst($posContentType['name']);
		// Формирует имя пространста имен компонента.
		$com_ns = "\\Tipsy\\Components\\$com\\$com";

		// Выодит название позиции на страницу, если разрешена отладка шаблона в настройках.
		if($posContentType and  Config::$tmplDebug) {
			echo '<fieldset><legend>'.$posContentType['name'].'</legend>';
		}

		// Подключает шаблон текущей позиции в шаблон страницы, указанный в родительском классе Html.
		@$pos_tmpl = file_get_contents(parent::$template.DIRECTORY_SEPARATOR.'Positions'.DIRECTORY_SEPARATOR.$com.'.tpl');
		if(!$pos_tmpl){
			#echo 'Ух ты, никак не найти  ';
			Debug::AddMessage('test debug из Position',__CLASS__,'fdf');
			#return;
		}

		// Выполняет инициализацию компонента, если существует его класс,
		// для получения контента заданного пользователем поумолчанию.
		if(class_exists($com_ns)){
			$content = str_replace('{content}',  $com_ns::init(), $pos_tmpl);
			$content = str_replace(self::$tags,'', $content);
			self::run_php($content);

		}elseif(substr($pos_tmpl,0,8)=='{always}'){
			$pos_tmpl = str_replace(self::$tags,'', $pos_tmpl);
			self::run_php($pos_tmpl);
		}

		// Здесь завершается вывод отладки шаблона.
		if($posContentType and  Config::$tmplDebug) {
			echo '</fieldset>';
		}
	}
}