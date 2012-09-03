<?php
// Проверяю легален ли доступ к файлу
defined('_TEXEC') or die();

// Создаю объект генерирующий содержимое html
$doc = new TDocument();
$doc->getTemplate();

// Добавляю таблицы стилей
$doc->addStylesheet('template.css');
#$doc->addStylesheet('tipsy.css');

?>

<!DOCTYPE html>
<html>

<head>
	<?php echo $doc->charset;?>
	<title><?php echo $doc->head_data["title"];?></title>
	<?php $doc->setStylesheet('tipsy');?>
</head>

<body>
<header>
	<h1>Домашняя страница проета Tipsy cms</h1>
</header>

<div id="container">
	<div id="errors">
		<?php $doc->getErrors();?>
	</div>

	<div id="menu_horisontal">
		<a href="http://php.net">PHP</a>
		<a href="http://w3.org">html5</a>
		<a href="<?php  echo shell_exec('./make_source.sh'); ?> ">Обновить исходники</a>
		'<a href="https://github.com/WhiskeyMan-Tau/tipsy_cms.git"> Скачать или посмотреть исходники</a>'
	</div>

	<div id="left">
		<?php $doc->getLeft(); ?>
	</div>

	<div id="section">
		<div id="article">
			<div id="article_name">
				<h1>Заголовок статьи</h1>
			</div>
			<?php echo $doc->content; ?>
			<div id="article_footer">
				<h2>Footer статьи</h2>
			</div>
		</div>
		<!-- Article -->
	</div>

	<div id="right">
		<p>Some text</p>
	</div>
</div>

<div id="footer">
	<p>Tipsy CMS 2012 by <a href="http://vk.com/whiskeyman">Aleksey Tkachenko aka <b>WhiskeyMan</a></b></p>
</div>
</body>

</html>
