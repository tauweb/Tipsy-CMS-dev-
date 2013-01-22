<?php
namespace Tipsy\Libraries\Document;

use Tipsy\Config\Config;
use Tipsy\Libraries\Loader;
use Tipsy\Libraries\Router;
use Tipsy\Libraries\RuntimeException;
use Tipsy\Libraries\Errors;
use Tipsy\Libraries\Document\Head;
use Tipsy\Libraries\Debug;
use Tipsy\Libraries\Document\Content;

// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();

/**
 * Класс формирования данных для html страницы. Выстцпает связным звеном между страницей и модулями
 *
 */
class Document
{
	/**
	 * @var	string	Текущий шаблон
	 */
	private $template = '';

	/**
	 * @var	string	Контент, который будет выведен на страницу.
	 * Todo: Псосле того как контент будет загружаться из БД, удалять это свойство.
	 */
	private $content = 'Это контент поумолчанию. Если вы видите этот текст - это значит, что скорее всего, статьи не гтузятся из БД
	                    или нет активных статей';

	/**
	 * Конструктор. Используется для инициализации начальных состояний объекта.
	 */
	function __construct()
	{
		///Передает управлениемаршрутизатору адресной строки
		$this->getURL();
		// Подключает класс формирующий <HEAD> документа.
		Loader::autoload('\Libraries\Document\Head');

		Loader::autoload('\Libraries\Debug');

		// Определяет и подключает шаблон
		$this->getTemplate();

	}

	/**
	 * Метод устанавливающий кодировку страниц
	 * @param	string	имя кодировки для установки
	 */
	private function setCharset($charset)
	{
		Head::setCharset($charset);
	}

	/**
	 * Метод регистрирующий новую таблицу стилей
	 *
	 * @param	string	$name	Имя подключаемой таблицы.
	 */
	private function addStylesheet($name)
	{
	   Head::addStylesheet($name);
	}

	/**
	 * Метод формирующий содержимое тега <HEAD> и выводящий его на страницу. Формирование происходит в классе THead
	 */
	private function getHead()
	{
		Head::getHead();
	}

	/**
	 * Метод определяющий используемый шаблон html страниц.
	 */
	private function getTemplate()
	{
		// Путь к каталогу файлов шаблона.
		$template = 'Templates/' . Config::$template;

		// Проверяет наличие index файла шаблона и подключает его, если не находит - бросает исключение.
		if (file_exists($tmpl_index = $template . '/' . 'index.php')) {
			$this->template = $tmpl_index;
		} else {
			throw new RuntimeException('Не найден <b>index.php</b> выбранного шаблона');
		}
		// Подключает шаблон.
		require_once $this->template;
	}


	/**
	 * Метод формирующий горизонтальное меню.
	 */
	private function getMenuHorisontal()
	{
		// Содержит контент горизонтального меню	// Todo: продумать и переписать принцып и перенести в БД
		$nav = [
			'<a href="https://github.com/WhiskeyMan-Tau/Tipsy.git">Мы на githab</a>',
			'<a href="./logs/log.txt">Посмотреть логи</a>',

		];

		// Формирует и выводит содержимое как список <li>.
		echo '<ul class = "menu_horisontal">';
		foreach ($nav as $val){
			echo '<li>' . $val . '</li>';
		}
		echo '</ul>';
	}

	/**
	 * Метод формирующий левую часть страницы (как правило меню или контейнер nav)
	 */
	private function getLeft()
	{
		// Содержит контент блока nav	// Todo: продумать и переписать принцып и перенести в БД
		$nav = [
			'<a href="?component=user">Войти</a>',
			'<a href="http://php.net">PHP</a>',
			'<a href="http://w3.org">html5</a>',
			'<a href="https://github.com/WhiskeyMan-Tau/Tipsy.git">Исходники</a>',
			'<a href="./logs/log.txt">Посмотреть логи</a>',
		];

		// Формирует и выводит содержимое как список.
		echo '<ul>';
		foreach ($nav as $val){
			echo '<li>' . $val . '</li>';
		}
		echo '</ul>';
	}
	
	/**
	 * Метод получающий ошибки системы для html страницы.
	 */
	private function getErrors()
	{
		Errors::getErrors();
	}

	/**
	 * Метод получающий отладочную информацию системы для html страницы.
	 */
	private function getDebugMsg()
	{
		Debug::getDebugMsg();
	}

	/**
	 * Метод получающий содержимое страницы html (контент).
	 * @param	string	$part	Параметр указывающий какую часть контента нужно получить.
	 * Варианты $part пока что такие: title, fulltext
	 */
	private function getContent($part, $id = 1)
	{
		Content::getContent($part, $id);
	}

	/**
	 * Метод получающий переменные из адресной строки.
	 */
	public function getURL()
	{
		Loader::autoload('\Libraries\Router');
		Router::getURL();
	}
	
	
	/**
	 * Метод определяющий позиции на странице html.
	 */
	protected function getPosition($pos_name)
	{
		Position::getPosition($pos_name);
	}
}