CREATE DATABASE whiskeyman_tipsy;
CREATE TABLE articles(
	articleid int unsigned not null auto_increment primary key,
	title char(50) not null,
	fulltext longtext not null,
	created date not null,
	crrated_by char(50)
);

INSERT INTO articles (title, fulltext) VALUES 
	("О сайте", "Tipsy cms находится в начальной стадии разработки. Так как она пишется практически вся на коленках в метро, параллельно изучению php, mySQL, html и css, сроки ее завершения совершенно не определены :)

Сайт создан для отлаживания исходников, когда я их пишу, например, в метро, когда другой возможности протестить работоспособность нет. А исходя из того, что, в основном, написание происходит в дороге с мобильного девайса, сиё творение будет чаще не работать, чем работать. ;)

Для работы Tipsy CMS требуется php версии не ниже 5.4, html5 и css3<p>
<b>Ведутся работы по переписанию кода, переход на использование простаранста имен.</b>");