<?php
namespace Tipsy\Libraries\Document;

use Tipsy\Config\Config;

abstract class Head{

	// Заголовок документа (html5)
	// http://www.w3schools.com/html5/tag_title.asp
	public static $title = "<title>Домашняя страница Tipsy CMS</title>";

	// Массив, содержаший список подключаемых таблиц стилей html страницы.
	public static $stylesheets = array();

	// Кодеровка html страницы.
	public static $charset = '';

	// Применяется для определения стилей элементов веб-страницы
	// http://www.w3schools.com/html5/tag_style.asp
	protected static $style = [
			// Определяет устройство вывода, для работы с которым предназначена таблица стилей.
			"media" => "", // [text/css]
			// Сообщает браузеру, какой синтаксис использовать, чтобы правильно интерпретировать стили.
			"type" => "", // [media_query]
			// Specifies that the styles only apply to this element's parent element and that element's child elements (HTML5)
			"scoped" => "" // [scoped]
		];

	// Инструктирует браузер относительно полного базового адреса текущего документа
	// http://www.w3schools.com/html5/tag_base.asp
	protected static $base = [
		// Адрес, который должен использоваться для указания полного пути к файлам.
		"href" => "", // [URL]
		// Имя окна или фрейма, куда будет загружаться документ, открываемый по ссылке.
		"target" => "" // [_blank, _parent, _self, _top, framename]
	];

	// Устанавливает связь с внешним документом вроде файла со стилями или со шрифтами
	// http://www.w3schools.com/html5/tag_link.asp
	protected static $link = [
		// Путь к связываемому файлу.
		"href" => "", // [URL]
		// Specifies the language of the text in the linked Document
		"hreflang" => "", // [language_code]
		// Определяет устройство, для которого следует применять стилевое оформление.
		"media" => "", // [media_query]
		// Определяет отношения между текущим документом и файлом, на который делается ссылка.
		"rel" => "", // [alternate, archives, author, bookmark, external, first, help, icon, last, licence, next, nofollow, noreferrer, pingback, prefetch, prev, search, sidebar, stylesheet, tag, up]
		// Указывает размер иконок для визуального отображения.
		"sizes" => "", // [HeightxWidth, any]
		// MIME-тип данных подключаемого файла.
		"type" => "" // [MIME_type]
	];

	// Определяет метатеги, которые используются для хранения информации предназначенной для браузеров и поисковых систем.
	// http://www.w3schools.com/html5/tag_meta.asp
	protected static  $meta = [
		// Задает кодировку документа.
		#"charset" => "utf-8", // [character_set]
		// Устанавливает значение атрибута, заданного с помощью name или http-equiv.
		"content" => "", // [text]
		// Предназначен для конвертирования метатега в заголовок HTTP.
		"http-equiv" => "", // [content-type, default-style, refresh]
		// Имя метатега, также косвенно устанавливает его предназначение.
		"name" => "" // [application-name, author, description, generator, keywords]
	];

	// Предназначен для описания скриптов, может содержать ссылку на программу или ее текст на определенном языке.
	protected static  $script = [
		// Specifies that the script is executed asynchronously (only for external scripts)
		"async" => "", // [async]
		// Откладывает выполнение скрипта до тех пор, пока вся страница не будет загружена полностью.
		"defer" => "", // [defer]
		// Определяет тип содержимого тега <script>.
		"type" => "", // [MIME_type]
		// Specifies the character encoding used in an external script file
		"charset" => "", // [character_set]
		// Адрес скрипта из внешнего файла для импорта в текущий документ.
		"src" => "" // [URL]
	];

	// Показывает свое содержимое, если браузер не поддерживает работу со скриптами или их поддержка отключена
	protected static $noscript = "";

	protected static $command = "";

	/**
	 * Метод регистрирующий новую таблицу стилей
	 *
	 * @param	string		$name	Имя подключаемой таблицы.
	 */
	public static function addStylesheet($name)
	{
		self::$stylesheets[$name] = '<link rel = "stylesheet" href="'
			. 'Templates/' . Config::$template . '/css/' . $name . ' ">';
	}

	/**
	 * Метод устанавливающий кодировку страниц
	 * @param	string	имя кодировки для установки
	 */
	public static function setCharset($charset)
	{
		self::$charset = '<meta charset="' . $charset . '" />';
	}

	/**
	 * Метод устанавливающий тег связи с внешним документом(<link>), например файлом со стилями, и выводящий их на страницу
	 * @param	string		$name	имя подключаем таблицы
	 */
	public static function getStylesheets($name = '')
	{
		if (!empty(self::$stylesheets)) {
			foreach ((array)self::$stylesheets as $stylesheet) {
				echo '<link rel = "stylesheet" href="' . $stylesheet . ' ">';
			}
		}
	}

	public static function getHead()
	{
		foreach(get_class_vars(__CLASS__) as $tag){
			if( is_array($tag) and !empty($tag) ){
				foreach($tag as $subTag){
					echo $subTag . "\n";
				}
			}elseif(!empty($tag)){
				echo $tag ."\n";
			}
		}
	}
}