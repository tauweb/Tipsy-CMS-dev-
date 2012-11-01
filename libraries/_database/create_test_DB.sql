CREATE DATABASE whiskeyman_tipsy;
CREATE TABLE articles(
	id int(10) unsigned not null auto_increment primary key,
	title char(50) not null,
	fulltext longtext not null,
	created date not null,
	created_by char(50)
);

INSERT INTO articles (ArticleName, ArticleBody) VALUES 
	("Тестовая стать", "Содержание тестовой статьи");
	
SELECT ArticleName from Articles WHERE ArticleID = 1;