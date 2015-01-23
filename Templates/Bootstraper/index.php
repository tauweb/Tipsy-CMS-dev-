<?php
// Проверяет легален ли доступ к файлу.
defined('_TEXEC') or die('No Direct Access');

?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>Шаблон на бутстрап</title>
	<link rel="stylesheet" href="<?=$_SERVER["DOCUMENT_ROOT"]?>/Bootstrap/css/bootstrap.css"
</head>
<body>
<h1>Minimal system... It's Work</h1>
<?php echo 'the template variable:'. $this->template;
var_dump($this->template);?>
</body>

</html>