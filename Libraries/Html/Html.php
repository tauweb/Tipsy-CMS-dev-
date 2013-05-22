<?php
namespace Tipsy\Libraries\Html;

use Tipsy\Config\Config;
use Tipsy\Libraries\Loader;

use Tipsy\Libraries\RuntimeException;

use Tipsy\Libraries\Html\Head;

use Tipsy\Libraries\Html\Content;
use Tipsy\Components\User\User;
use Tipsy\Libraries\Html\Position;

// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();

/**
 * Класс формирования данных для html страницы. Выступает связным звеном между страницей и модулями.
 *
 */
class Html extends HtmlModel
{
	/**
	 * Конструктор. Используется для инициализации начальных состояний объекта.
	 */
	public function __construct()
	{

		// Подключает класс формирующий <HEAD> документа.
		Loader::autoload('\Libraries\Html\Head');

		//Подключает библиотеку маршрутизатора
		Loader::autoload('\Libraries\Router');

		///Передает управлениемаршрутизатору адресной строки
		$this->getURL();

		// Определяет и подключает шаблон
		$this->getTemplate();

		foreach(static::$head as $i=>$tag){
			echo $tag;}

		Loader::autoload('\Libraries\Html\Position');
		Position::getComponent();

		$this->getDebugMsg();
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
}