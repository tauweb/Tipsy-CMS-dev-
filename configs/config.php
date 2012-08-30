<?php
// Проверяю легален ли доступ к файлу
defined('_TEXEC') or die;

// Параметры конфигурации системы
abstract class TConfig
{

  // Параметры подключения к базе данных
  public static $db_type = 'mysqli';
  public static $db_host = 'localhost';
  public static $db_server_port = '';
  public static $db_user = 'user';
  public static $db_password = 'passblalba';
  public static $db_dbname = 'test';
  public static $db_port = 3306;
  public static $db_socket = '';

  // Ошибки и отладка (none, simple, maximum)
  public static $error_reporting = 'maximum';

  // Внешний вид
  public static $template = 'tipsy';
}

?>
