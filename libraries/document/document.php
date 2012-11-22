<?php
// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();

TLoader::load('_head');
/**
 * Класс формирования данных для html страницы
 *
 */
class TDocument
{
	public $template = '';

	// Todo: Псосле того как контент будет загружаться из БД, удалять это свойство.
	public $content = 'Это контент поумолчанию. Если вы видите этот текст - это значит, что скорее всего, статьи не гтузятся из БД
	                    или нет активных статей';

	/**
	 * Конструктор. Используется для инициализации начальных состояний объекта.
	 */
	public function __construct()
	{
		// Определяет и подключает шаблон
		$this->getTemplate();
		$this->getContent();
	}
	
	/**
	 * Метод устанавливающий кодировку страниц
	 * @param	string	имя кодировки для установки
	 */
	public function setCharset($charset)
	{
		THead::$charset = '<meta charset="' . $charset . '" />';
	}

	/**
	 * Метод регистрирующий новую таблицу стилей
	 *
	 * @param	string		$name	Имя подключаемой таблицы.
	 */
	public function addStylesheet($name)
	{
	   THead::addStylesheet($name);
	}

	public function getHead()
	{
		THead::getHead();
	}

	/**
	 * Метод определяющий используемый шаблон html страниц.
	 * @return	bool	true, если удалось определить и подключить шаблоблон.
	 *
	 */
	public function getTemplate()
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

	/**
	 * Метод формирующий левую часть страницы (как правило меню или контейнер nav)
	 *
	 */
	public function getLeft()
	{
		// Содержит контент блока nav		// Todo: продумать и переписать принцып и перенести в БД
		$nav = [
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

	public function getErrors()
	{
		TErrors::getErrors();
	}
	
	public function getDebugMsg()
	{
		TDebug::getDebugMsg();
	}

	public function getContent()
	{
		TLoader::load('TContent');
		TContent::getContent();

	}

}

?>
