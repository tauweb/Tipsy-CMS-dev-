<?php
// Проверяю легален ли доступ к файлу
defined('_TEXEC') or die();
$doc = new TDocument();
$doc->getTemplate();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="<?php echo $doc->charset; ?>"/>
    <title><?php echo $doc->head_data["title"]; ?></title>
    <link rel="stylesheet" href=" <?php echo $doc->stylesheet; ?>">
</head>
<?php echo $doc->description; ?>
<body>

<header>
    <h1>Домашняя страница проета Tipsy cms</h1>
    <h4><?php echo $doc->h4;?></h4>
</header>

<div id="errors">
    <?php
    $doc->getErrors();
    ?>
</div>

<div id="container">

    <nav>
        <a href="http://php.net">PHP</a>
        <a href="http://w3.org">html5</a>

    </nav>

    <section>
        <article>
            <header>
                <h1>Заголовок статьи</h1>
            </header>

            <p>Пример текста стьи.</p>
            <footer>
                <h2>Article Footer</h2>
            </footer>
        </article>

    </section>

    <aside>
        <h3>Aside</h3>

        <p>Some text</p>
    </aside>
    <footer>
        <h2>Tipsy CMS 2012 by Aleksey Tkachenko</h2>

        <p>Tipsy CMS 2012 by Aleksey Tkachenko</p>
    </footer>
</div>
</body>

</html>
