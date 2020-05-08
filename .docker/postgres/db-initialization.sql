-- Tables creation
CREATE TABLE users (
  username VARCHAR NOT NULL PRIMARY KEY,
  password VARCHAR NOT NULL,
  name VARCHAR,
  surname VARCHAR,
  admin BOOLEAN default FALSE
);
CREATE TABLE grades (
  exam_date DATE NOT NULL DEFAULT CURRENT_DATE,
  username VARCHAR NOT NULL REFERENCES users(username),
  subject VARCHAR NOT NULL,
  grade INT,
  passed BOOLEAN,
  PRIMARY KEY (exam_date, username)
);

-- Insert some data...
INSERT INTO users(username, password, name, surname, admin) VALUES
  ('denis', MD5('awas2020'), 'Denis', 'Donadel', FALSE),
	('carina', MD5('awas2020'), 'Carina', 'Deaconu', FALSE),
	('professor', MD5('awas2020'), 'prof', 'surname', TRUE),
  ('user1', MD5('awas2020'), 'name1', 'surname1', FALSE),
  ('user2', MD5('awas2020'), 'name2', 'surname2', FALSE),
  ('user3', MD5('awas2020'), 'name3', 'surname3', FALSE);

INSERT INTO grades(username, subject, grade, passed) VALUES
  ('denis', 'awas', 29, TRUE),
	('carina', 'awas', 30, TRUE);

INSERT INTO grades(exam_date, username, subject, grade, passed) VALUES
  ('2020-01-20', 'denis', 'awas2', 29, TRUE),
  ('2020-01-20', 'carina', 'awas2', 30, TRUE),
  ('2020-01-20', 'user1', 'awas2', 18, TRUE),
  ('2020-01-20', 'user2', 'awas2', 19, TRUE),
  ('2020-01-20', 'user3', 'awas2', 20, TRUE);
