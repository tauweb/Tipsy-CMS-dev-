<?php
/**
 * Данный файл автоматически генерирует список проектов на локальном хосте.
 * Для правильной работы достаточно просто положить файл к корень директории WEB-сервера,
 * и просто перейти по адресу http://localhost (имя зависит от настроек вашего сервера)
 *
 * Дополнительно скрипт выводит ссылку на PhpMyAdmin и WebMin
 */

// Создает список папок локалхоста.
$directory = scandir(__DIR__);

// Формирует ссылки на локальные службы.
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Локальные проекты</title>
	<style>
		#utils {
			position: absolute; /* Абсолютное позиционирование */
			left: 0; /* Положение элемента от правого края */
			min-width: 130px;
			padding: 5px; /* Поля вокруг текста */
			border: 1px solid #eeeeee;
			border-radius: 5px;
			background-color: white;
		}
		.bod{
			background: #F2F1F0;
		}
		
	</style>
</head>
<body class="bod">
<fieldset id="utils"><legend>Утилиты</legend>
	<a href='phpmyadmin'>PhpMyAdmin</a><p>
	<hr color=#eeeeee size="1px">
	<a href='localhost:10000'>WebMin</a><p>
</fieldset>
<?php
echo '<b><H1 align="center">Проекты:</H1></b><p>';

// Выводит поодной директории локального хоста.
echo '<table border="1px" align="center">';

foreach($directory as $dir)
{
	if (!is_file($dir) && $dir!='.' && $dir!='..')
	{

		echo "<td><a href='$dir'>$dir</a></td>";

	}
}

echo '</table>';
?>
</body>
</html>
