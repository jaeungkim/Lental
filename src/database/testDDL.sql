# Create Testuser
CREATE USER 'web_user'@'localhost' IDENTIFIED BY 'web_user';
GRANT SELECT,INSERT,UPDATE,DELETE,CREATE,DROP ON *.* TO 'web_user'@'localhost';

# Set password for test user
SET PASSWORD FOR 'web_user'@'localhost' = PASSWORD('password');

# Create DB
CREATE DATABASE IF NOT EXISTS `lental` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `lental`;

CREATE TABLE Subscription (
 subId INTEGER(10),
 name VARCHAR(255),
 description TEXT(4294967295),
 cost DECIMAL(10,2),
 PRIMARY KEY (subId)
  );


CREATE TABLE Account (
 email VARCHAR(255),
 pwd VARCHAR(255),
 fName VARCHAR(255),
 lName VARCHAR(255),
 pNum char(11),
 subId INTEGER(10) DEFAULT 0,
 stat VARCHAR(255) DEFAULT "online",
 token VARCHAR(255),
 PRIMARY KEY (email),
 foreign key (subId) references Subscription (subId)
	ON delete cascade on update cascade
  );


CREATE TABLE Filter (
 title VARCHAR(255),
 email VARCHAR(255),
 pLow DECIMAL (10,2),
 pHigh DECIMAL (10,2),
 listType VARCHAR(255),
 city VARCHAR(255),
 rangeKm INTEGER(20),
 bedsLow INTEGER(3),
 bedsHigh INTEGER(10),
 bathsLow INTEGER(3),
 bathsHigh INTEGER(3),
 parkMin INTEGER(3),
 propertyType VARCHAR(255),
 deposit decimal(10,2),
 termLease VARCHAR(255),
 furnishing VARCHAR(255),
 buildDate date,
 utilities VARCHAR(255),
PRIMARY KEY (email),
foreign key (email) references Account (email)
	ON delete cascade on update cascade
  );

 CREATE TABLE Property (
  idProp INTEGER(10) AUTO_INCREMENT,
 title VARCHAR(255),
 address VARCHAR(255),
  country VARCHAR(255),
  province VARCHAR(255),
  city VARCHAR(255),
 pCode VARCHAR(6),
 bedRoom INTEGER(3),
  bathRoom INTEGER(3),
  parkSpot INTEGER(3),
 description TEXT(4294967295),
  propType VARCHAR(255),
  stat VARCHAR(255),
 email VARCHAR(255),
   buildDate INTEGER(4),
  utilities VARCHAR(255),
  PRIMARY KEY (idProp),
 foreign key (email) references Account (email)
	ON delete cascade on update cascade
  );

CREATE TABLE Listing (
    idList INTEGER(10) AUTO_INCREMENT,
  idProp INTEGER(10),
  email VARCHAR(255),
  title VARCHAR(255),
  dateStart DATE,
  dateEnd DATE,
  price DECIMAL(19,2),
  listType VARCHAR(255),
  stat VARCHAR(255),
 deposit decimal(10,2),
  termLease VARCHAR(255),
  PRIMARY KEY (idList,idProp, email),
 foreign key (idProp) references Property (idProp)
	ON delete cascade on update cascade,
  foreign key (email) references Account (email)
	ON delete cascade on update cascade
  );



CREATE TABLE Image (
  idProp INTEGER(10),
   imageId INTEGER(10) AUTO_INCREMENT,
   image varchar(255),
   PRIMARY KEY (imageId),
   foreign key (idProp) references Property (idProp)
	ON delete cascade on update cascade
    );


CREATE TABLE Admin (
  email VARCHAR(255),
  pwd VARCHAR(255),
  PRIMARY KEY (email)
  );


CREATE TABLE SearchAgent (
  timeInterval INTEGER(10)
  );

-- subscriptions
Insert Into Subscription(subId, name, description, cost) VALUES (0,'Free', 'Description', 0);
Insert Into Admin(email,pwd) VALUES('admin','5f4dcc3b5aa765d61d8327deb882cf99');

-- insert into Property (title, address, country,province,city,pCode,bedRoom,bathRoom,parkSpot,description,propType,stat,email,buildDate,utilities) VALUES ('title', 'address', 'country','province','city','pCode',1,1,1,'description','propType','stat','test@gmail.com','2008-04-04','utilities');
