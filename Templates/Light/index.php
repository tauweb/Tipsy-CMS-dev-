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
<!-- HEAD AREA ------------------------------------------------------------------------------------------------------->
<head>
	<?php $this->getHead();?>
</head>
<!-- BODY AREA ------------------------------------------------------------------------------------------------------->
<body>
<!-- Debug AREA ------------------------------------------------------------------------------------------------------>
<div id="debug" class="text-success">
	<?php
        $this->putPosition('Debug');
        $this->getDebugMsg();
    ?>
</div>
<!-- Autorize AREA --------------------------------------------------------------------------------------------------->
<div id="autorize" class="autorize">
	<?php 
		#$this->User();
		$this->putPosition('Autorize');
	?>
</div>
<!-- HEADER AREA ----------------------------------------------------------------------------------------------------->
<header>
	<h1>Домашняя страница проета Tipsy cms</h1>
</header>
<!-- Errors AREA ----------------------------------------------------------------------------------------------------->
<div id="errors" class="text-error">
	<?php
		$this->putPosition('Errors');
		$this->getErrors();
	?>
</div>
<!-- Menu_Horizontal AREA -------------------------------------------------------------------------------------------->
<div id="menu_horisontal">
	<?php
		$this->putPosition('Menu_Horisontal');
		$this->getMenuHorisontal();
	?>
</div>
<!-- Conteiner AREA -------------------------------------------------------------------------------------------------->
<div id="container">
	<nav>
		<?php
			$this->putPosition('NAV');
			$this->getLeft();
		?>
	</nav>

	<section>
		<article>
			<?php $this->putPosition('Article'); ?>
			<div id="article_name">
				<h1><?php $this->getContent('title'); ?></h1>
			</div>
				<?php $this->getContent('fulltext');?>
			<div id="article_footer">
				<h2>Дата создания материала: <?php $this->getContent('created');?></h2>
			</div>
		</article>
	</section>
</div>
<!-- FOOTER AREA ----------------------------------------------------------------------------------------------------->
<footer>
	<?php $this->putPosition('Footer'); ?>
	<p>Сайт работает на Tipsy CMS. Автор: <a href="http://vk.com/whiskeyman"><b>WhiskeyMan</a></b></p>
</footer>
</body>

</html>