<?php
/**
 * User: whiskeyman
 * Date: 04.09.12
 *
 */
$con = new mysqli('localhost', 'whiskeyman_tipsy', 'password', 'whiskeyman_tipsy');

		$QueryStr = 'SELECT * FROM articles;' ;
		
		$res = $con->query($QueryStr);

$num_result = $res->num_rows;

echo 'найдено строк:'. $num_result;
?>