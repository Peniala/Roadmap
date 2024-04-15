create table Projects(
	id_project int not null auto_increment primary key,
	name varchar(100) not null, 
	target text, deadline date
);
create table Steps(

	id_step int not null auto_increment primary key, 
	name varchar(200) not null, 
	descri text, priority enum('1','2','3'), 
	status enum('done') default null, 
	id_project int not null,
	
	CONSTRAINT fk_step
		FOREIGN KEY (id_project)
		REFERENCES Projects(id_project)
);
