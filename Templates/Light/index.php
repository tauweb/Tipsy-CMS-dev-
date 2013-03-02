<?php
// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();

//Устанавливает кодировку страницы
$this->setCharset('utf-8');

// Добавляет таблицы стилей.
$this->addStylesheet('template.css');
?>

<!DOCTYPE html>
<html>

<head>
	<?php
		// Получает содержимое контейнера <head>.
		$this->getHead();
	?>
</head>

<body>
	<div id="debug" class="text-success">
		<?php
			// Выводтт сообщения об отладке сисьемы.
			$this->getDebugMsg();
		?>
	</div>

	<div id="autorize" class="autorize">
		<?php
			// Задает имя и получает содержимое позиции.
			$this->position('Autorize');
		?>
	</div>

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

	<div id="menu_horisontal">
		<?php
			// Задает имя и получает содержимое позиции.
			$this->position('menu_horisontal');
		?>
	</div>

	<div id="container">
	<?php
		// Задает имя и получает содержимое позиции.
		$this->position('Conteiner');
	?>
		<nav>
			<?php
				// Задает имя и получает содержимое позиции.
				$this->Position('nav');
			?>
		</nav>

		<section>
			<article>
				<div id="article_name">
					<h1><?php $this->getContent('title'); ?></h1>
				</div>
					<?php $this->getContent('fulltext');?>
			</article>
		</section>

	</div>

	<footer>
		<?php
			// Задает имя и получает содержимое позиции.
			$this->position('footer');
		?>
		<p>Сайт работает на Tipsy CMS. Автор: <a href="http://vk.com/whiskeyman"><b>WhiskeyMan</b></a></p>
	</footer>
</body>

</html>