drop database if exists userDB;
create database if not exists userDB;
use userDB;
create table user (
ID int unsigned auto_increment,
username varchar(255) NOT NULL unique,
password char(60) NOT NULL,
primary key(ID)
);

create table userHighscore (
HighscoreID int unsigned auto_increment,
UserID int unsigned,
Highscore int unsigned,
primary key(HighscoreID),
FOREIGN KEY(UserID) REFERENCES user(ID) on delete cascade
);

create table userUpgrade (
UpgradeID int unsigned auto_increment,
UserID int unsigned,
Upgrade1 int unsigned,
Upgrade2 int unsigned,
Upgrade3 int unsigned,
MPS int unsigned,
primary key(UpgradeID),
FOREIGN KEY(UserID) REFERENCES user(ID) on delete cascade
);

create table userImg (
UserID int unsigned,
imageID tinyint(3) NOT NULL auto_increment,
filename nvarchar(255) NOT NULL,
imageType nvarchar(50) NOT NULL,
imageData mediumblob NOT NULL,
primary key(imageID),
foreign key(UserID) references user(ID) on delete cascade
);
