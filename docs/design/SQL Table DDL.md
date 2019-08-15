CREATE TABLE Account (
  email VARCHAR(255),
  pwd VARCHAR(255),
  fName VARCHAR(255),
  lName VARCHAR(255),
  pNum char(11),
  subId INTEGER(10),
  PRIMARY KEY (email)
  );

CREATE TABLE Subscription (
  subId INTEGER (10),
  name VARCHAR(255),
  description TEXT(4294967295),
  cost DECIMAL (10,2),
  PRIMARY KEY (subId)
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
  PRIMARY KEY (email)
  );
CREATE TABLE Listing (
  idProp INTEGER(10),
  email VARCHAR(255),
  dateStart DATE,
  dateEnd DATE,
  price DECIMAL(19,2),
  listType VARCHAR(255),
  stat VARCHAR(255),
  deposit decimal(10,2),
  termLease VARCHAR(255),
  PRIMARY KEY (idProp, email)
  );
  CREATE TABLE Property (
  idProp INTEGER(10),
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
   buildDate date,
   utilities VARCHAR(255),
  PRIMARY KEY (idProp)
  );

CREATE TABLE Image (
   idProp INTEGER(10),
   imageId INTEGER(10),
   image BLOB,
   PRIMARY KEY (idProp)
    );

CREATE TABLE Admin (
  email VARCHAR(255),
  pwd VARCHAR(255),
  PRIMARY KEY (email)
  );

CREATE TABLE SearchAgent (
  timeInterval INTEGER(10)
  );