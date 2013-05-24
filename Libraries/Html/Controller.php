<?php
namespace Tipsy\Libraries\Html;


use Tipsy\Libraries\Loader;
use Tipsy\Libraries\Html\Head;
use Tipsy\Components\User\User;
use Tipsy\Libraries\Html\Position;

// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();

/**
 * Класс формирования данных для html страницы. Выступает связным звеном между страницей и модулями.
 *
 */
class Controller extends Model
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

		Loader::autoload('\Libraries\Html\Position');
		Position::getComponent();

		$this->getDebugMsg();

		$this::getHead();
	}

}