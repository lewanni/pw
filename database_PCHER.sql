-- CREATE DATABASE PCHER CHARACTER SET 'utf8';

CREATE TABLE users (
	ID INT(255) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	login VARCHAR(255) NOT NULL,
	password VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL
);

CREATE TABLE chat (
	id INT(255) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	login VARCHAR(255) NOT NULL,
	message VARCHAR(500) NOT NULL,
	date DATETIME NOT NULL
);

INSERT INTO users VALUES (0,'lvtq','f29bc91bbdab169fc0c0a326965953d11c7dff83','lvt_quang@hotmail.fr'); -- mot de passe : a1
INSERT INTO users VALUES (1,'quang','9b2c3280ccea0ba408270c45185bfbcd36164237','quang532@gmail.com'); -- mot de passe : 1a


INSERT INTO chat VALUES (0,'lvtq','yo','2015-10-15 16:28:59');
INSERT INTO chat VALUES (1,'quang','salut','2015-10-15 16:29:30');
INSERT INTO chat VALUES (2,'lvtq','c''est tro bien ce site mec aucune arnaque et tout pas cher mec','2015-10-15 16:29:35');
INSERT INTO chat VALUES (3,'quang','sure ?','2015-10-15 16:28:40');
INSERT INTO chat VALUES (4,'lvtq','oui oui essai tu verra tu sera pas decu mec','2015-10-15 16:28:55');
INSERT INTO chat VALUES (5,'quang','ça sent l''arnaque c''est bizarre ce qu''il propose le site','2015-10-15 16:29:01');
INSERT INTO chat VALUES (6,'lvtq','je te dis ca mec j''ai aucun probleme c''est juste qu''il faut trouver un lieu de render-vous et j''ai un peu galere la dessus','2015-10-15 16:29:30');
INSERT INTO chat VALUES (7,'lvtq','sinon no problem je te garati 0 arnaque j''étai aussi tres surpris que le site deconne 0','2015-10-15 16:29:45');
INSERT INTO chat VALUES (8,'lvtq','fais comme tu veux mais je te recommande d''en profiter maintenant sinon plus tard ils vont augmenter les prix avec le succès qu''il y aura','2015-10-15 16:29:59');
INSERT INTO chat VALUES (9,'quang','ok je verrais','2015-10-15 16:30:15');
INSERT INTO chat VALUES (10,'quang','mon dieu c''est une blague j''en reviens pas, j''ai acheté sans problème un iphone 6s','2015-10-17 10:29:13');
INSERT INTO chat VALUES (11,'quang','trop trop content merci beaucoup PCHER j''économise beaucoup du coup','2015-10-17 10:29:20');
INSERT INTO chat VALUES (12,'lvtq','tu voi mec 0 arnaque je t''avais bien dit profite-en un max','2015-10-17 10:30:48');
INSERT INTO chat VALUES (13,'quang','ouais merci toi aussi','2015-10-17 10:30:55');
INSERT INTO chat VALUES (14,'lvtq','peace :) bro','2015-10-17 10:31:01');