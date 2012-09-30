<?php
/**
 * Created by JetBrains PhpStorm.
 * User: whiskeyman
 * Date: 30.09.12
 * Time: 22:35
 * To change this template use File | Settings | File Templates.
 */
abstract class TDebug
{
	public static $messages = array();

	public static function GetMessages()
	{
		foreach (self::$messages as $DebugMessages)
			echo $DebugMessages;
		var_dump(self::$messages);
	}
}
