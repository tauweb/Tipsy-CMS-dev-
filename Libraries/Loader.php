<?php
namespace Tipsy\Libraries;
// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die;

abstract class Loader
{
	public static function autoload($className)
	{
		if(class_exists($className)){
			return true;
		}

		$className = ltrim($className, '\\');
		$fileName  = '';
		$namespace = '';
		if ($lastNsPos = strrpos($className, '\\')) {
			$namespace = substr($className, 0, $lastNsPos);
			$className = substr($className, $lastNsPos + 1);
			$fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
		}
		$fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
		
		if(file_exists($fileName)){
			require_once $fileName;
			return true;
		}else{
			print("Загрузчик: не могу найти файл: <b>$fileName</b><p>");
			return false;
		}
	}
}