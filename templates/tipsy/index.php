<?php
// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();

TLoader::load('_Session');

TSession::start('wm');

echo $_SESSION['count'];

// Создает объект генерирующий содержимое html
$doc = new TDocument();
$doc->getTemplate();

//Устанавливает кодировку страницы
$doc->setCharset('utf-8');

// Добавляет таблицы стилей
$doc->addStylesheet('template.css');
?>

<!DOCTYPE html>
<html>

<head>
	<?php echo $doc->charset;?>
	<title><?php echo $doc->head_data["title"];?></title>
	<?php $doc->setStylesheet('template.css');?>
</head>

<body>
<header>
	<h1>Домашняя страница проета Tipsy cms</h1>
</header>
<div id="errors">
	<p class="text-error"><?php $doc->getErrors();?></p>
</div>

<div id="menu_horisontal">
	<a href="http://php.net">PHP</a>
	<a href="http://w3.org">html5</a>
	<a href="<?php  echo shell_exec('./make_source.sh'); ?> ">Обновить исходники</a>
	'<a href="https://github.com/WhiskeyMan-Tau/tipsy_cms.git"> Скачать или посмотреть исходники</a>'
</div>

<div id="container">

	<nav>
		<?php $doc->getLeft(); ?>
	</nav>

	<section>
		<article>
			<div id="article_name">
				<h1>Заголовок статьи</h1>
			</div>
			<?php echo $doc->content; ?>
			<div id="article_footer">
				<h2>Footer статьи</h2>
			</div>
		</article>
	</section>

</div>

<footer>
	<p>Tipsy CMS 2012 by <a href="http://vk.com/whiskeyman"><b>WhiskeyMan</a></b></p>
</footer>
</body>

</html>
