<?php
namespace Tipsy\Libraries\Html;

use Tipsy\Libraries\Database\Query;

// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();

abstract class Content{

	/*
	protected static $positionsContent = [
											"autorize" => 'авторизация',
											"nav" => [
													// Содержит контент блока nav	// Todo: продумать и переписать принцып и перенести в БД
													'<a href="?component=user">Войти</a>',
													'<a href="http://php.net">PHP</a>',
													'<a href="http://w3.org">html5</a>',
													'<a href="https://github.com/WhiskeyMan-Tau/Tipsy.git">Исходники</a>',
													'<a href="./logs/log.txt">Посмотреть логи</a>'
												],
											"menu_horisontal" => [
												'<a href="https://github.com/WhiskeyMan-Tau/Tipsy.git">Мы на githab</a>',
												'<a href="./logs/log.txt">Посмотреть логи</a>'
											],

											"footer" => "Это фуутер!"
										];

		public static function getPosContent($position, $contentType = 2)
		{
			$position = strtolower($position);
			 // Проверяет существует ли позиция в списке и не является ли она массивом(для создания списков и т.п.)
			if(!empty(self::$positionsContent[$position]) and is_array(self::$positionsContent[$position])){
				// Проверяет тип элемента списка контента:
				// 1 - как есть, 2 - горизонтальный список, 3 - вертикальный список.
				$contentType == 2 ?  print('<ul class = "menu_horisontal">') : '';
				$contentType == 3 ?  print('<ul>') : '';

				foreach(self::$positionsContent[$position] as $item){
					switch($contentType){
						case 1:
							echo $item;
							break;
						case 2:
							echo '<li>' . $item . '</li>';
							break;
						case 3:
							echo '<li>' .$item . '</li>';
							break;
					}
				}

			$contentType != 1 ? print('</ul>') : '';
			// Выводит одиночный элемент.
			}else if(!empty(self::$positionsContent[$position])){
				echo self::$positionsContent[$position];
			}
		}
	*/


	public static function getContent($param, $id)
	{
		$queryParam = $param == '*' ? $param  : '`' . $param . '`';
		// Формирует строку запроса
		$sql = "SELECT $queryParam FROM `articles` WHERE `articleid` = $id;";

		$row = Query::select($sql);
		// Эта часть будет нужа для последующего формирования таблицы вывода, когда, например будут выбираться все поля

		if($param == 'all' or $param == '*'){
			foreach (array_keys($row) as $colName){
				echo $colName . '<p>';
			}
		}else{
			// Это обычный вывод
			echo  $row[$param];
		}
	}
}