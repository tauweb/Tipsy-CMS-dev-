<?php
// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();

//Устанавливает кодировку страницы
$this->setCharset('utf-8');

// Добавляет таблицы стилей.
$this->addStylesheet('template.css');

$this->getPositions('Footer');
?>

<!DOCTYPE html>
<html>

<head>
	<?php $this->getHead();?>
</head>

<body>
<div id="debug" class="text-success">
	<?php $this->getDebugMsg(); ?>
</div>

<div id="autorize" class="autorize">
	<?php 
		#$this->User();
		$this->putPosition('Autorize');
	?>
</div>

<header>
	<h1>Домашняя страница проета Tipsy cms</h1>
</header>
<div id="errors" class="text-error">
	<?php
		$this->putPosition('Errors');
		$this->getErrors();
	?>
</div>

<div id="menu_horisontal">
	<?php
		$this->putPosition('Menu_Horisontal');
		$this->getMenuHorisontal();
	?>
</div>

<div id="container">
<?php $this->putPosition('Conteiner'); ?>
	<nav>
		<?php
			$this->putPosition('NAV');
			$this->getLeft();
		?>
	</nav>

	<section>
		<article>
			<div id="article_name">
				<h1><?php $this->getContent('title'); ?></h1>
			</div>
				<?php $this->getContent('fulltext');
				#$this->getPosition('center');
				?>
			<div id="article_footer">
				<h2>Дата создания материала: <?php $this->getContent('created');?></h2>
			</div>
		</article>
	</section>

</div>

<footer>
	<?php $this->putPosition('Footer'); ?>
	<p>Сайт работает на Tipsy CMS. Автор: <a href="http://vk.com/whiskeyman"><b>WhiskeyMan</a></b></p>
</footer>
</body>

</html>