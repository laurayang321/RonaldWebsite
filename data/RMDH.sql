DROP DATABASE IF EXISTS VolunteerStories;
CREATE DATABASE VolunteerStories;

USE VolunteerStories;

DROP TABLE IF EXISTS AdminUser;
CREATE TABLE AdminUser(
	id int(255) NOT NULL PRIMARY KEY auto_increment,
	username VARCHAR(1024) NOT NULL,
	password VARCHAR(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO AdminUser VALUES(1,"aaa@a.a","YWJjMTIz");

DROP TABLE IF EXISTS stories;
CREATE TABLE stories(
	id int(255) NOT NULL PRIMARY KEY auto_increment,
	reason TEXT NULL,
	action TEXT NULL,
	groupname VARCHAR(2046) NULL,
	textstories TEXT NULL,
	images VARCHAR(2046) NULL,
	video VARCHAR(2046) NULL,
	published int(1) NULL DEFAULT 0,
	agreetoshare int(1) NOT NULL DEFAULT 1,
	posttime DATE NOT NULL
);

INSERT INTO stories VALUES(1,"no reason","cooking","omg","hahaha thisis a test","fox,polarbear,fox,polarbear","video",0,1,"2017-01-01");
INSERT INTO stories VALUES(2,"no reason","cooking","omg","hahaha thisis a test","fox,polarbear,fox,polarbear,fox,fox,polarbear","video",1,0,"2017-02-02");
INSERT INTO stories VALUES(3,"no reason","cooking","omg","hahaha thisis a test","fox,polarbear,fox,polarbear","video",0,1,"2017-03-03");
INSERT INTO stories VALUES(4,"no reason","cooking","omg","hahaha thisis a test","cat,dog,liuliu,qiqi,bear,omg","video",0,0,"2017-02-01");
INSERT INTO stories VALUES(5,"no reason","cooking","omg","this hhhh","","d-bw5eV8BdY",1,1,"2017-05-01");