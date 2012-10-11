CREATE DATABASE whiskeyman_tipsy;
CREATE TABLE articles(
	ArticleID int unsigned not null auto_increment primary key,
	ArticleName char(50) not null,
	ArticleBody longtext not null,
	CreateDate date not null,
	Author char(50)
);