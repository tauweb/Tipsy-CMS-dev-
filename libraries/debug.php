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

	public function GetMessages()
	{
		echo self::$messages;
	}
}
