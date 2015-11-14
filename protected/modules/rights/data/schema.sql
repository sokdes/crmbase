/**
* Database schema required by CDbAuthManager.
*/

drop table if exists `bts_AuthAssignment`;
drop table if exists `bts_AuthItemChild`;
drop table if exists `bts_AuthItem`;

create table `bts_AuthItem`
(
   `name` varchar(64) not null,
   `type` integer not null,
   `description` text,
   `bizrule` text,
   `data` text,
   primary key (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

create table `bts_AuthItemChild`
(
   `parent` varchar(64) not null,
   `child` varchar(64) not null,
   primary key (parent,child),
   foreign key (parent) references bts_AuthItem (`name`) on delete cascade on update cascade,
   foreign key (child) references bts_AuthItem (`name`) on delete cascade on update cascade
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

create table `bts_AuthAssignment`
(
   `itemname` varchar(64) not null,
   `userid` varchar(64) not null,
   `bizrule` text,
   `data` text,
   primary key (itemname,userid),
   foreign key (itemname) references bts_AuthItem (`name`) on delete cascade on update cascade
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

/**
* Schema required by Rights.
* Stores Rights specific data about authorization items.
* Replaces the old AuthItemWeight-table.
* @since 1.1.0
*/

create table `bts_Rights`
(
	`itemname` varchar(64) not null,
	`type` integer not null,
	`weight` integer not null,
	primary key (itemname),
	foreign key (itemname) references bts_AuthItem (`name`) on delete cascade on update cascade
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

/**
* Schema for the User table.
* Not necessary to create if already exists.
* @since 0.9.6
*/
/*
create table User
(
   id integer not null auto_increment,
   username varchar(128) not null,
   password varchar(128) not null,
   primary key (id)
) type=InnoDB, character set utf8;
*/