-- --------------------------------------------------------

--
-- Structure de la TABLE  users
--

CREATE TABLE users (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  username varchar(50) NOT NULL,
  password varchar(255) NOT NULL,
  role varchar(20) NOT NULL,
  created datetime,
  modified datetime
);

-- --------------------------------------------------------

--
-- Structure de la TABLE  coordinators
--

CREATE TABLE coordinators (
  id int(11) PRIMARY KEY AUTOINCREMENT,
  id_user int(11) NOT NULL,
  prefix varchar(255)NOT NULL,
  last_name varchar(255)NOT NULL,
  first_name varchar(255)NOT NULL,
  title varchar(255),
  location varchar(255),
  address varchar(255),
  city varchar(255),
  province varchar(255),
  postal_code varchar(255),
  email varchar(255),
  phone varchar(255),
  extension varchar(255),
  cellphone varchar(255),
  fax varchar(255),
  created datetime,
  modified datetime,
  FOREIGN KEY(id_user) REFERENCES users(id)
);

-- --------------------------------------------------------

--
-- Structure de la TABLE  employers
--

CREATE TABLE employers (
  id int(11) PRIMARY KEY AUTOINCREMENT,
  id_user int(11) NOT NULL,
  prefix varchar(255)NOT NULL,
  last_name varchar(255)NOT NULL,
  first_name varchar(255)NOT NULL,
  title varchar(255),
  location varchar(255),
  address varchar(255),
  city varchar(255),
  province varchar(255),
  postal_code varchar(255),
  email varchar(255),
  phone varchar(255),
  extension varchar(255),
  cellphone varchar(255),
  fax varchar(255),
  created datetime,
  modified datetime
);

-- --------------------------------------------------------

--
-- Structure de la TABLE  internship_environments
--

CREATE TABLE internship_environments (
  id int(11) PRIMARY KEY AUTOINCREMENT,
  name varchar(255)NOT NULL,
  address varchar(255),
  city varchar(255),
  province varchar(255),
  postal_code varchar(255),
  region varchar(255),
  active tinyint(4) ,
  employer_id int(11) NOT NULL,
  created datetime ,
  modified datetime
);

-- --------------------------------------------------------

--
-- Structure de la TABLE  students
--

CREATE TABLE students (
id INTEGER PRIMARY KEY AUTOINCREMENT,
id_user INTEGER NOT NULL,
da INTEGER NOT NULL,
last_name varchar(255)NOT NULL,
first_name varchar(255)NOT NULL,
phone varchar(255),
email varchar(255),
additional_info varchar(255),
note varchar(255),
active tinyint(4),
created datetime ,
modified datetime 
);


--
-- Contenu de la TABLE  users
--

INSERT INTO users (id, username, password, role, created, modified) VALUES
(3, 'dsdfsasdfgs', '$2y$10$uKXXnPe8mwyfL8r7uAI4RuHG4IgoR8yFkRo/zVLclu4luT.Afu2hm', 'student', '2018-09-19 19:42:22', '2018-09-19 19:42:22'),
(4, 'testetudiant', '$2y$10$N9GuFq7BkIW/j9wlZGfvDOegDuNxN0PZNJ8qgvvZ2Al.Ecg4WEg3a', 'student', '2018-09-19 19:42:47', '2018-09-19 19:42:47'),
(5, 'admin', '$2y$10$UF4DDWtohnAVoX4xceP/2eTyFukJ6XEk1mu1tQtbsqPfLrT9t4hVG', 'admin', '2018-09-19 19:53:12', '2018-09-19 19:53:12'),
(6, 'testemployeur', '$2y$10$JThYRDgzESk6zvG/St3cZeOq6uSn/8PmVq1jNgEWk2rDUaKWJsR6C', 'employer', '2018-09-19 20:14:43', '2018-09-19 20:14:43'),
(7, 'emp', '$2y$10$QbIN4SJGjj1BwFLtn46zLO92hS/DTLZUQmoKyuc8qs5/CfRb0JzUi', 'employer', '2018-09-19 20:17:15', '2018-09-19 20:17:15');