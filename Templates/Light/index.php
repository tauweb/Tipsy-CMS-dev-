<?php
// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();

//Устанавливает кодировку страницы
$this->setCharset('utf-8');

// Добавляет таблицы стилей.
$this->addStylesheet('template.css');
?>

<!DOCTYPE html>
<html lang="ru">

<head>
	<?php
	// Получает содержимое контейнера <head>.
	$this->getHead();
	?>
</head>

<body>
<?$this->position('Control_panel');?>

<div id="debug" class="text-success">
	<?php
	// Выводит сообщения об отладке системы.
	$this->getDebugMsg();
	?>
</div>

<?php	$this->position('Autorize');?>

<header>
	<h1 class="site_name">Домашняя страница проета Tipsy cms</h1>
</header>
<div id="errors" class="text-error">
	<?php
	// Задает имя и получает содержимое позиции.
	$this->position('Errors');
	// Выводит сообщения об ошибках.
	$this->getErrors();
	?>
</div>

	<?php $this->position('menu_horisontal');?>

<div id="container">
	<?php
	// Задает имя и получает содержимое позиции.
	$this->position('Conteiner');
	?>
	<section>
		<?php $this->Position('nav');?>
		<? $this->Position('Article');?>
	</section>

</div>

<footer>
	<?php $this->position('footer');?>
	<p>Сайт работает на Tipsy CMS. Автор: <a href="http://vk.com/whiskeyman"><b>WhiskeyMan</b></a></p>
</footer>
</body>

</html>