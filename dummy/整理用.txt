CREATE TABLE userlist(
	id INT  AUTO_INCREMENT,
        name VARCHAR(20),
        usename VARCHAR(20) UNIQUE,
        address VARCHAR(100),
        tel VARCHAR(20),
        gender VARCHAR(5),
        birthday DATE,
        pass VARCHAR(256) NOT NULL,
  	PRIMARY KEY (id)
);


CREATE TABLE contributions(
	id INT  AUTO_INCREMENT,
	title VARCHAR(30) NOT NULL,
	 filename VARCHAR(50) NOT NULL,
  	 usename VARCHAR(20) NOT NULL,
  	 comment VARCHAR(100),
  	uploaddate timestamp not null default current_timestamp,
  	PRIMARY KEY (id)
);

CREATE TABLE vote(
	voteid INT  AUTO_INCREMENT NOT NULL,
	entryid INT NOT NULL,
	voter VARCHAR(256) NOT NULL,
	confirm INT NOT NULL,
  	PRIMARY KEY (voteid)
);



alter table vote convert to character set utf8 collate utf8_general_ci;
alter table contributions convert to character set utf8 collate utf8_general_ci;
alter table userlist convert to character set utf8 collate utf8_general_ci;
