USE rick_and_morty_website;

CREATE TABLE comments (
	commentID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	email CHAR(50),
	comment_text TEXT,
	datetime_created TIMESTAMP
);
ALTER TABLE comments ADD nickname CHAR(30);

INSERT INTO comments (email, comment_text)
VALUES ('email@example.com', 'Great site bros!!\nKeep up the good job!');
UPDATE comments SET nickname = "birdperson17" WHERE commentID = 1;

INSERT INTO comments (comment_text)
VALUES ('This should be the official Rick and Morty site... For real!11!!');
UPDATE comments SET nickname = "1213" WHERE commentID = 2;
