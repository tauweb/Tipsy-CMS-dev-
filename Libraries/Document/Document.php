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
use Tipsy\Components\User\User;
use Tipsy\Libraries\Document\Position;

// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();

/**
 * Класс формирования данных для html страницы. Выступает связным звеном между страницей и модулями.
 *
 */
class Document
{
	/**
	 * @var	string	Текущий шаблон
	 */
	public static $template = '';

	public static $templatePositions = array();

	/**
	 * Конструктор. Используется для инициализации начальных состояний объекта.
	 */
	public function __construct()
	{
		// Подключает класс формирующий <HEAD> документа.
		Loader::autoload('\Libraries\Document\Head');
		//Подключает библиотеку маршрутизатора
		Loader::autoload('\Libraries\Router');
		///Передает управлениемаршрутизатору адресной строки
		$this->getURL();
		// Определяет и подключает шаблон
		$this->getTemplate();
	}

	/**
	 * Метод устанавливающий кодировку страниц
	 * @param	string	имя кодировки для установки
	 */
	protected function setCharset($charset)
	{
		Head::setCharset($charset);
	}

	/**
	 * Метод регистрирующий новую таблицу стилей
	 *
	 * @param	string	$name	Имя подключаемой таблицы.
	 */
	protected function addStylesheet($name)
	{
		Head::addStylesheet($name);
	}

	/**
	 * Метод формирующий содержимое тега <HEAD> и выводящий его на страницу. Формирование происходит в классе THead
	 */
	protected function getHead()
	{
		Head::getHead();
	}

	/**
	 * Метод определяющий используемый шаблон html страниц.
	 */
	protected function getTemplate()
	{
		// Путь к каталогу файлов шаблона.
		$template = 'Templates/' . Config::$template;

		try{
			// Проверяет наличие index файла шаблона и формирует путь к index файлу, если не находит - бросает исключение.
			if (file_exists($tmpl_index = $template . '/' . 'index.php')) {
				// Путь к папке текущего шаблона (длЯ использования в других классах, наеример в наследуемом Positions).
				self::$template = $template;
			} else {
				throw new RuntimeException('Не найден <b>index.php</b> выбранного шаблона');
			}
			// Подключает шаблон.
			require_once $tmpl_index;

		} catch (RuntimeException $e) {
			// Выводит ошибку на страницу.
			Errors::getErrors();
		}
	}

	/**
	 * Метод получающий ошибки системы для html страницы.
	 */
	protected function getErrors()
	{
		Errors::getErrors();
	}

	/**
	 * Метод получающий отладочную информацию системы для html страницы.
	 */
	protected function getDebugMsg()
	{
		Debug::getDebugMsg();
	}

	/**
	 * Метод получающий содержимое страницы html (контент).
	 * @param	string	$part	Параметр указывающий какую часть контента нужно получить.
	 * Варианты $part пока что такие: title, fulltext
	 */
	protected function getContent($part, $id = 1)
	{
		Content::getContent($part, $id);
	}

	/**
	 * Метод получающий переменные из адресной строки.
	 */
	protected function getURL()
	{
		Router::getURL();
	}

	protected function position($positionName)
	{
		Loader::autoload('\Libraries\Document\Position');
		Position::get($positionName);

	}
}