CREATE DATABASE whiskeyman_tipsy;
CREATE TABLE articles(
	articleid int unsigned not null auto_increment primary key,
	title char(50) not null,
	fulltext longtext not null,
	created date not null,
	crrated_by char(50)
);

INSERT INTO articles (title, fulltext) VALUES 
	("Тестовая статья", "Содержание тестовой статьи");
	
SELECT title from articles WHERE articleid = 1;