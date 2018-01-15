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

CREATE TABLE quiz (
	questionID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	question TEXT,
	possible_answers TEXT,
	right_answer_index INT
);

INSERT INTO quiz (question, possible_answers, right_answer_index)
VALUES ('Question1', 'answer1;answer2;answer3;answer4', 1);

INSERT INTO quiz (question, possible_answers, right_answer_index)
VALUES ('Question2', 'answer1;answer2;answer3', 1);

INSERT INTO quiz (question, possible_answers, right_answer_index)
VALUES ('Question3', 'answer1;answer2;answer3', 1);

INSERT INTO quiz (question, possible_answers, right_answer_index)
VALUES ('Question4', 'answer1;answer2;answer3;answer4;answer5', 1);


GRANT select, insert ON rick_and_morty_website.comments TO 'nikiforos'@'localhost';
GRANT select ON rick_and_morty_website.quiz TO 'nikiforos'@'localhost';
