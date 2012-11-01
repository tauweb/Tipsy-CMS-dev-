<?php
/**
 * User: whiskeyman
 * Date: 04.09.12
 *
 */
$con = new mysqli('localhost', 'whiskeyman_tipsy', 'password', 'whiskeyman_tipsy');

		$QueryStr = 'SELECT * FROM articles;' ;
		
		$res = $con->query($QueryStr);
		// отладочная часть
		var_dump($res);
		while($row=mysql_fetch_array($res))
			echo $row;
?>