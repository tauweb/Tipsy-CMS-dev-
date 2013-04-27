<?php
// Проверяет легален ли доступ к файлу.
defined('_TEXEC') or die();

//Устанавливает кодировку страницы.
$this->setCharset('utf-8');

// Добавляет таблицы стилей.
$this->addStylesheet('template.css');
$this->addStylesheet('Footer.css');
$this->addStylesheet('Header.css');
?>

<!DOCTYPE html>
<html lang="ru">

<head>
	<?php
	// Получает содержимое контейнера <head>.
	$this->getHead();?>
</head>

<body>
<div id="container">
	<?$this->position('Control_panel');?>

	<div id="debug" class="text-success">
		<?php
		// Выводит сообщения об отладке системы.
		$this->getDebugMsg();
		?>
	</div>

	<?php $this->position('Autorize');?>
	<?php $this->position('Header'); ?>

	<div id="errors" class="text-error">
		<?php
		// Задает имя и получает содержимое позиции.
		$this->position('Errors');
		// Выводит сообщения об ошибках.
		$this->getErrors();
		?>
	</div>
	<?php $this->position('menu_horisontal');?>

	<?php $this->Position('Menu');?>
	<section>
		<?php $this->Position('Article');?>
	</section>

	<?php $this->position('Footer');?>
</div>
</body>

</html>