#Delete Account
DELETE FROM Account WHERE email = 'email';

#Register account
insert into Account (email, pwd, fName, lName, pNum) VALUES ('email','pwd', 'fName', 'lName', '1234567890');

#login (retrieve account)
SELECT email, pwd FROM Account WHERE email = 'email';

#check if email is used
SELECT email FROM Account WHERE email = 'email';

#return listing info
SELECT * FROM Listing WHERE idList = 'idList';

#return property info
SELECT * FROM Property WHERE idProp = 'idProp';

#return account info
SELECT * FROM Account WHERE email = 'email';

#get Properties for email
SELECT * From Property WHERE email = 'email';

#get property images
SELECT image From Image WHERE idProp = 'idProp';

#create listing
#insert into Listing (idProp, email, dateStart, dateEnd, price, listType, stat, deposit, termLease) VALUES ('idProp', 'email', 'dateStart', 'dateEnd','price','listType','stat','deposit','termLease');
 # WHERE (Account) email = 'email' AND (Property) idProp = 'idProp';

#create property
#insert into Property (title, address, country,province,city,pCode,bedRoom,bathRoom,parkSpot,description,propType,stat,email,buildDate,utilities) VALUES ('title', 'address', 'country','province','city','pCode','bedRoom','bathRoom','parkSpot','description','propType','stat','test@gmail.com','buildDate','utilities');
 #WHERE (Account) email = 'email';

#add images 
insert into Image (image, imageId) values ('image', 'imageId');

#save listing to email
Select email,idList From Listing
Where idList = 'idList';

#get account information
Select email from Account where email = 'email';
#insert into Listing based on email
insert into Listing (idProp, email, dateStart, dateEnd, price, listType, stat, deposit, termLease) VALUES ('idProp', 'email', 'dateStart', 'dateEnd','price','listType','stat','deposit','termLease');

#get account information
Select email from Account where email = 'email';
#insert into property based on email
insert into Property (title, address, country,province,city,pCode,bedRoom,bathRoom,parkSpot,description,propType,stat,email,buildDate,utilities) VALUES ('title', 'address', 'country','province','city','pCode','bedRoom','bathRoom','parkSpot','description','propType','stat','test@gmail.com','buildDate','utilities');

#searchListings(city, builtBy, minBeds, maxBeds, minBaths, maxBaths, minParking, minRent, maxRent)
#get values 
select idList from Listing, Property
Where Listing.idProp = 'idProp' and Property.city ='city' and Property.buildDate = 'builtBy' and Property.bedRoom >= 'minBeds'and Property.bedRoom <= 'maxBeds' and Property.bathRoom >= 'minBaths' and Property.bathRoom <= 'maxBaths' and Property.parkSpot ='minParking' and Listing.price >= 'minRent' and Listing.price <= 'maxRent';
