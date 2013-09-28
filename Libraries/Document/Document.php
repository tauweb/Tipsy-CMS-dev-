<?php
namespace Tipsy\Libraries\Document;

use Tipsy\Libraries\Loader;
use Tipsy\Libraries\Factory;
use Tipsy\Libraries\Document\Position;

// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();

/**
 * Класс контроллер формирования данных для html страницы. Выступает связным звеном между страницей и модулями.
 *
 */
class Document
{
	protected $template = null;
	protected $errors = array();
	protected $head = null;
	protected $positions = array();
	protected $pageData = null;

	/**
	 * Конструктор. Используется для инициализации начальных состояний объекта.
	 */
	public function __construct()
	{
		Loader::autoload('\Libraries\Document\Head');
		self::$head = new Head();
		self::getTemplate();
	}
	
	/**
	 * Метод определяющий используемый шаблон html страниц.
	 */
	protected function getTemplate()
	{
		// Путь к каталогу файлов шаблона.
		$cfg = Factory::getConfig();
		#$template = 'Templates/' . Config::$template;
		$template = 'Templates/' . $cfg->getTemplate();

		try{
			if (file_exists($tmpl_index = $template . '/' . 'index.php')) {
				$this->$template = $template;
			} else {
				throw new RuntimeException('Не найден <b>index.php</b> выбранного шаблона');
			}
			require_once $tmpl_index;
		} catch (RuntimeException $e){
			// Выводит ошибку на страницу.
			Errors::getErrors();
		}
	}
	
	protected function positions($positions)
	{
		foreach(explode(',', $positions) as $position)
			self::$positions[strtolower($position)] = '';
		
		Position::getComponent();
	}
}