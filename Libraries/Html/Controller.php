<?php
namespace Tipsy\Libraries\Html;


use Tipsy\Libraries\Loader;
use Tipsy\Libraries\Html\Head;
use Tipsy\Components\User\User;
use Tipsy\Libraries\Html\Position;
use Tipsy\Libraries\Html\View;

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
		///Передает управлениемаршрутизатору адресной строки
		$this->getURL();

		$this->getDebugMsg();

		$View = new View();
	}

}