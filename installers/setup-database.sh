#! /bin/bash

echo SQL username:
read USER

echo SQL password:
read PASS

mysql --user=$USER --password=$PASS movies << END_SQL

/*Schemas*/
/*schema for person*/
CREATE TABLE person
(
    PRIMARY KEY (id),
    id INT AUTO_INCREMENT,
    first_name VARCHAR(15),
    last_name VARCHAR(15),
    birth_date DATE,
    death_date DATE
);


/*schema for movie*/
CREATE TABLE movie
(
    PRIMARY KEY (id),
    id INT AUTO_INCREMENT,
    title VARCHAR(30),
    release_date DATE,
    rating ENUM('G','PG','PG-13','R','NC-17','NR'),
    length INT,
    tagline VARCHAR(140),
    summary VARCHAR(500),
    budget FLOAT
);


/*schema for acts*/
CREATE TABLE acts
  (
    PRIMARY KEY(person_id, movie_id),
    FOREIGN KEY (person_id) REFERENCES person(id),
    FOREIGN KEY (movie_id) REFERENCES movie(id),
    person_id INT,
    movie_id INT,
    role_first_name VARCHAR(15),
    role_last_name VARCHAR(15)
  );

/*schema for critiques*/
CREATE TABLE critiques
  (
    PRIMARY KEY(person_id, movie_id),
    FOREIGN KEY (person_id) REFERENCES person(id),
    FOREIGN KEY (movie_id) REFERENCES movie(id),
    person_id INT,
    movie_id INT,
    stars FLOAT,
    content VARCHAR(140)
  );

/*schema for directs*/
CREATE TABLE directs
  (
    PRIMARY KEY(person_id, movie_id),
    FOREIGN KEY (person_id) REFERENCES person(id),
    FOREIGN KEY (movie_id) REFERENCES movie(id),
    person_id INT,
    movie_id INT
  );

/*schema for award organization*/
CREATE TABLE organization
(
    PRIMARY KEY (id),
    id INT AUTO_INCREMENT,
    name VARCHAR(30)
);

/*table for movie genre*/
CREATE TABLE genre
(
    PRIMARY KEY (id),
    id INT AUTO_INCREMENT,
    name VARCHAR(30)
);

/*join table for awards given by awards organization*/
CREATE TABLE awards
(
    PRIMARY KEY(organization_id, movie_id),
    FOREIGN KEY (organization_id) REFERENCES organization(id),
    FOREIGN KEY (movie_id) REFERENCES movie(id),
    organization_id INT,
    movie_id INT,
    award VARCHAR(30),
    date DATE
);

/*join table for movies in a genre*/
CREATE TABLE in_genre
(
    PRIMARY KEY(genre_id, movie_id),
    FOREIGN KEY (genre_id) REFERENCES organization(id),
    FOREIGN KEY (movie_id) REFERENCES movie(id),
    genre_id INT,
    movie_id INT,
);

/*Sample Datasets*/
/*sample dataset for person*/
INSERT INTO person
(first_name, last_name, birth_date, death_date)
VALUES
('Jennifer', 'Lawrence', '1990-08-15', null),
('Audrey', 'Hepburn', '1929-5-4', '1993-01-20'),
('Robert', 'Downey', '1965-4-4', null),
('RL', 'Shibe', '2001-12-21', null),
('Blake', 'Edwards', '1992-07-26', '2010-12-15'),
('David', 'Russell', '1958-08-20', null);


/*sample dataset for movie*/
INSERT INTO movie
(title, release_date, rating, length, tagline, summary, budget)
VALUES
('Breakfast at Tiffany\'s', '1961-11-4', 'NR', 115,
 'Audrey Hepburn plays that daring, darling Holly Golightly to a new high in entertainment delight!',
 'A young New York socialite becomes interested in a young man who has moved into her apartment building.',
 2.5),

('Silver Linings Playbook ', '2012-12-25', 'R', 122,
 'Watch for the signs',
 'After a stint in a mental institution, former teacher Pat Solitano moves back in with his parents and tries to reconcile with his ex-wife. Things get more challenging when Pat meets Tiffany, a mysterious girl with problems of her own',
21),

('The Avengers', '2012-05-04', 'PG-13', 143,
 'Avengers Assemble!',
 'Nick Fury of S.H.I.E.L.D. assembles a team of superhumans to save the planet from Loki and his army.',
 220);


/*sample dataset for acts*/
INSERT INTO acts
  (person_id, movie_id, role_first_name, role_last_name)
VALUES
  (2,1,'Holly', 'Golightly'),
  (1,2, 'Tiffany', null),
  (3,3, 'Tony', 'Stark');

INSERT INTO critiques
  (person_id, movie_id, stars, content)
VALUES
  (4,1,5,'many classic, such humor'),
  (4,2,5,'wow, such emotion, cry ere tim'),
  (4,3,5,'such scare, much real, wow ironhuman');

INSERT INTO directs
  (person_id, movie_id)
VALUES
  (5,1),
  (6,1);

  
INSERT INTO organization
 (name)
VALUES
  ('Golden Globe'),
  ('Grammys'),
  ('Sun Dance');

INSERT INTO genre
 (name)
VALUES
  ('Action'),
  ('Comedy'),
  ('Drama');

INSERT INTO awards
 (organization_id, movie_id, award, date)
VALUES
  (1,1,'Best Actress', '1960-12-1');

INSERT INTO in_genre
  (genre_id, movie_id)
VALUES
  (1,2),
  (1,3),
  (2,2),
  (2,3),
  (3,1);

END_SQL

end
