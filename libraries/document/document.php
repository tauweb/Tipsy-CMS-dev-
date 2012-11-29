<?php
// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();

TLoader::load('THead');
/**
 * Класс формирования данных для html страницы
 *
 */
class TDocument
{
	private $template = '';

	// Todo: Псосле того как контент будет загружаться из БД, удалять это свойство.
	private $content = 'Это контент поумолчанию. Если вы видите этот текст - это значит, что скорее всего, статьи не гтузятся из БД
	                    или нет активных статей';

	/**
	 * Конструктор. Используется для инициализации начальных состояний объекта.
	 */
	function __construct()
	{
		// Определяет и подключает шаблон
		$this->getTemplate();
	}
	
	/**
	 * Метод устанавливающий кодировку страниц
	 * @param	string	имя кодировки для установки
	 */
	private function setCharset($charset)
	{
		THead::setCharset($charset);
	}

	/**
	 * Метод регистрирующий новую таблицу стилей
	 *
	 * @param	string	$name	Имя подключаемой таблицы.
	 */
	private function addStylesheet($name)
	{
	   THead::addStylesheet($name);
	}

	private function getHead()
	{
		THead::getHead();
	}

	/**
	 * Метод определяющий используемый шаблон html страниц.
	 * @return	bool	true, если удалось определить и подключить шаблоблон.
	 *
	 */
	private function getTemplate()
	{
		// Путь к каталогу файлов шаблона.
		$template = _TPATH_TEMPLATES . '/' . TConfig::$template;

		if (file_exists($tmpl_index = $template . '/' . 'index.php')) {
			$this->template = $tmpl_index;
		} else {
			throw new TRuntimeException('Не найден <b>index.php</b> выбранного шаблона');
		}
		require_once $this->template;

		return true;
	}

	private function getMenuHorisontal()
	{
		// Содержит контент блока nav		// Todo: продумать и переписать принцып и перенести в БД
		$nav = [
			'<a href="https://github.com/WhiskeyMan-Tau/tipsy_cms.git">Мы на githab</a>',
			'<a href="./logs/log.txt">Посмотреть логи</a>',

		];

		// Формирует и выводит содержимое как список.
		echo '<ul class = "menu_horisontal">';
		foreach ($nav as $val){
			echo '<li>' . $val . '</li>';
		}
		echo '</ul>';		
	}

	/**
	 * Метод формирующий левую часть страницы (как правило меню или контейнер nav)
	 *
	 */
	private function getLeft()
	{
		// Содержит контент блока nav		// Todo: продумать и переписать принцып и перенести в БД
		$nav = [
			'<a href="?user=login">Войти</a>',
			'<a href="http://php.net">PHP</a>',
			'<a href="http://w3.org">html5</a>',
			'<a href="https://github.com/WhiskeyMan-Tau/tipsy_cms.git">Исходники</a>',
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
	 *
	 */
	private function getErrors()
	{
		TErrors::getErrors();
	}

	/**
	 * Метод получающий отладочную информацию системы для html страницы.
	 *
	 */
	private function getDebugMsg()
	{
		if(TConfig::$debug){
			TDebug::getDebugMsg();
		}
	}
	
	/**
	 * Метод получающий содержимое страницы html (контент).
	 * @param	string	$part	Параметр указывающий какую часть контента нужно получить.
	 * Варианты $part пока что такие: title, fulltext
	 */
	private function getContent($part, $id = 1)
	{
		TContent::getContent($part, $id);
	}
	
	public function getURL()
	{
	TLoader::load('TRouter');
		TRouter::getURL();
	}

}

?>
