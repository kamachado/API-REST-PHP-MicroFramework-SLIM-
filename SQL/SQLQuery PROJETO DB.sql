
CREATE TABLE person (
	Id int IDENTITY(1,1) NOT NULL,
	Name varchar(100) NOT NULL,
	CPF char(14) NOT NULL,
	Birth_Date date NOT NULL,
	Dad_Id int NULL,
	Mom_Id int NULL,
	is_employee BIT, 
 CONSTRAINT [PK_PERSON] PRIMARY KEY (Id),
  CONSTRAINT UNIQUE_CPF UNIQUE (CPF),
   CONSTRAINT FK_DAD_ID FOREIGN KEY(Dad_Id)
                    REFERENCES person ([Id]),
 CONSTRAINT FK_MOM_ID FOREIGN KEY(Mom_Id)
                    REFERENCES person (Id));

 CREATE TABLE department (
	Id int  NOT NULL,
	Name varchar (100) NOT NULL,
	Person_Responsible_Id int NOT NULL,
 CONSTRAINT PK_department PRIMARY KEY (id),
 CONSTRAINT FK_Person_Responsible_Id FOREIGN KEY(Person_Responsible_Id)
                                 REFERENCES person(Id));


CREATE TABLE rel_Employee_department (
	 Id_department int NOT NULL,
	 Person_Employee_Id int NOT NULL,
 CONSTRAINT PK_Person_Employee_Id PRIMARY KEY ( Person_Employee_Id,Id_department),
 CONSTRAINT FK_Person_Employee_Id FOREIGN KEY(Person_Employee_Id)
                              REFERENCES person(Id) 
							  ON DELETE CASCADE,
 CONSTRAINT FK_DEPARTMENT_ID FOREIGN KEY(Id_department)
                              REFERENCES department (Id)
							   );

INSERT INTO person (Name,CPF,Birth_Date,is_employee ) VALUES ('Henrique','025.255.589-85','1988-12-05',1);
INSERT INTO person (Name,CPF,Birth_Date,is_employee ) VALUES ('James','089.258.859-15','1998-05-06',1);
INSERT INTO person (Name,CPF,Birth_Date,is_employee ) VALUES ('Ronald','079.897.654-02','1988-11-15',1);
INSERT INTO person (Name,CPF,Birth_Date,is_employee ) VALUES ('Daniel','589.896.123-65','1989-08-09',1);
INSERT INTO person (Name,CPF,Birth_Date,is_employee ) VALUES ('Rodrigo','896.741.269-32','1986-05-15',1);
INSERT INTO person (Name,CPF,Birth_Date,is_employee ) VALUES ('Teteus','158.298.785-85','1989-09-15',1);
INSERT INTO person (Name,CPF,Birth_Date,is_employee ) VALUES ('Naruto','729.278.945-15','1979-06-03',1);
INSERT INTO person (Name,CPF,Birth_Date,is_employee ) VALUES ('Camilla','025.635.458-16','1988-04-20',1);
INSERT INTO person (Name,CPF,Birth_Date,is_employee ) VALUES ('Augusto','125.458.468-52','1997-03-07',1);
INSERT INTO person (Name,CPF,Birth_Date,is_employee ) VALUES ('Luciano','748.348.805-02','1995-02-28',1);
INSERT INTO person (Name,CPF,Birth_Date,is_employee ) VALUES ('Jeremias','101.028.895-32','1996-01-15',1);
INSERT INTO person (Name,CPF,Birth_Date,is_employee ) VALUES ('Charles','457.589.859-99','1988-10-30',1);
INSERT INTO person (Name,CPF,Birth_Date,is_employee ) VALUES ('vêronica','256.457.859-84','1994-08-12',1);
INSERT INTO person (Name,CPF,Birth_Date,is_employee ) VALUES ('Carla','023.478.859-96','1990-07-13',1);
INSERT INTO person (Name,CPF,Birth_Date,is_employee ) VALUES ('Karine','036.456.859-58','1989-06-09',1);
INSERT INTO person (Name,CPF,Birth_Date,is_employee ) VALUES ('Ricardo','158.596.859-45','1992-12-30',1);
INSERT INTO person (Name,CPF,Birth_Date,is_employee ) VALUES ('Matheus','256.258.987-89','1998-11-25',1);
INSERT INTO person (Name,CPF,Birth_Date,is_employee ) VALUES ('Rodrigo','254.896.258-85','1998-11-25',1);
INSERT INTO person (Name,CPF,Birth_Date,is_employee ) VALUES ('Carolina','478.412.587-87','1988-05-08',1);
INSERT INTO person (Name,CPF,Birth_Date,is_employee ) VALUES ('Rafael','457.812.963-85','1992-09-06',1);
INSERT INTO person (Name,CPF,Birth_Date,is_employee ) VALUES ('David','201.236.101-58','1997-06-09',1);
INSERT INTO person (Name,CPF,Birth_Date,is_employee ) VALUES ('Carlos','785.124.853-74','1995-05-08',1);
INSERT INTO person (Name,CPF,Birth_Date,is_employee ) VALUES ('Rogerio','897.472.136-12','1993-06-19',1);
INSERT INTO person (Name,CPF,Birth_Date,is_employee ) VALUES ('Hinata','458.125.632-09','1986-12-15',1);
INSERT INTO person (Name,CPF,Birth_Date,is_employee ) VALUES ('Sarutobi','458.127.632-09','1991-08-02',1);
INSERT INTO person (Name,CPF,Birth_Date,is_employee ) VALUES ('Kakashi','478.125.632-09','1990-09-09',1);
INSERT INTO person (Name,CPF,Birth_Date,is_employee ) VALUES ('Sasuke','273.486.859-75','1997-07-07',1);
INSERT INTO person (Name,CPF,Birth_Date,is_employee ) VALUES ('Marta','788.458.157-80','1988-08-08',1);
INSERT INTO person (Name,CPF,Birth_Date,is_employee ) VALUES ('Matheus','145.587.523-91','1989-09-07',1);
INSERT INTO person (Name,CPF,Birth_Date,is_employee ) VALUES ('Diego','205.200.895-63','1985-06-05',1);
INSERT INTO person (Name,CPF,Birth_Date,is_employee ) VALUES ('Alziro','101.236.258-34','1998-12-07',1);
INSERT INTO person (Name,CPF,Birth_Date,is_employee ) VALUES ('Natalia','028.101.620-85','1998-11-25',1);
INSERT INTO person (Name,CPF,Birth_Date,is_employee ) VALUES ('Matheus','859.458.569-52','1989-05-26',1);
INSERT INTO person (Name,CPF,Birth_Date,Dad_Id,Mom_Id,is_employee ) VALUES ('Bernardo','259.652.787-96','2019-02-20',1,null,0);
INSERT INTO person (Name,CPF,Birth_Date,Dad_Id,Mom_Id,is_employee ) VALUES ('Kiara','965.457.125-87','2015-02-15',null,32,0);
INSERT INTO person (Name,CPF,Birth_Date,Dad_Id,Mom_Id,is_employee ) VALUES ('Karol','102.547.635-25','2019-02-20',null,13,0);
INSERT INTO person (Name,CPF,Birth_Date,Dad_Id,Mom_Id,is_employee ) VALUES ('Atreus','003.587.965-66','2021-03-06',null,15,0);
INSERT INTO person (Name,CPF,Birth_Date,Dad_Id,Mom_Id,is_employee ) VALUES ('Felipe','306.584.632-85','2016-05-25',33,null,0);
INSERT INTO person (Name,CPF,Birth_Date,Dad_Id,Mom_Id,is_employee ) VALUES ('Richard','125.469.023-20','2017-04-30',23,null,0);
INSERT INTO person (Name,CPF,Birth_Date,Dad_Id,Mom_Id,is_employee ) VALUES ('Manuelly','254.154.465-08','2010-04-16',11,null,0);
INSERT INTO person (Name,CPF,Birth_Date,Dad_Id,Mom_Id,is_employee ) VALUES ('Nicole','254.457.698-52','2021-06-08',23,null,0);
INSERT INTO person (Name,CPF,Birth_Date,Dad_Id,Mom_Id,is_employee ) VALUES ('Nesuko','254.147.963-58','2018-12-25',7,24,0);
INSERT INTO person (Name,CPF,Birth_Date,Dad_Id,Mom_Id,is_employee ) VALUES ('Renato','589.478.269-05','2015-07-14',11,null,0);
INSERT INTO person (Name,CPF,Birth_Date,Dad_Id,Mom_Id,is_employee ) VALUES ('Michelle','536.149.024-56','2016-09-16',null,28,0);
INSERT INTO person (Name,CPF,Birth_Date,Dad_Id,Mom_Id,is_employee ) VALUES  ('Boruto','254.745.856-06','2015-01-02',7,24,0);

INSERT INTO department (Id ,Name, Person_Responsible_Id) VALUES (1,'Software',11);
INSERT INTO department (Id ,Name, Person_Responsible_Id) VALUES (2,'Hardware',1);
INSERT INTO department (Id ,Name, Person_Responsible_Id) VALUES (3,'Suporte',16);
INSERT INTO department (Id ,Name, Person_Responsible_Id) VALUES (4,'Produção',13);
INSERT INTO department (Id ,Name, Person_Responsible_Id) VALUES (5,'Comercial',24);
INSERT INTO department (Id ,Name, Person_Responsible_Id) VALUES (6,'RH',33);
INSERT INTO department (Id ,Name, Person_Responsible_Id) VALUES (7,'Financeiro',14);


INSERT INTO rel_Employee_Department (Id_department,Person_Employee_Id) VALUES (1,11);
INSERT INTO rel_Employee_Department (Id_department,Person_Employee_Id) VALUES (1,5);
INSERT INTO rel_Employee_Department (Id_department,Person_Employee_Id) VALUES (1,12);
INSERT INTO rel_Employee_Department (Id_department,Person_Employee_Id) VALUES (1,17);
INSERT INTO rel_Employee_Department (Id_department,Person_Employee_Id) VALUES (1,28);
INSERT INTO rel_Employee_Department (Id_department,Person_Employee_Id) VALUES (1,30);
INSERT INTO rel_Employee_Department (Id_department,Person_Employee_Id) VALUES (2,1);
INSERT INTO rel_Employee_Department (Id_department,Person_Employee_Id) VALUES (2,2);
INSERT INTO rel_Employee_Department (Id_department,Person_Employee_Id) VALUES (2,15);
INSERT INTO rel_Employee_Department (Id_department,Person_Employee_Id) VALUES (2,27);
INSERT INTO rel_Employee_Department (Id_department,Person_Employee_Id) VALUES (2,29);
INSERT INTO rel_Employee_Department (Id_department,Person_Employee_Id) VALUES (2,30);
INSERT INTO rel_Employee_Department (Id_department,Person_Employee_Id) VALUES (3,16);
INSERT INTO rel_Employee_Department (Id_department,Person_Employee_Id) VALUES (3,3);
INSERT INTO rel_Employee_Department (Id_department,Person_Employee_Id) VALUES (3,6);
INSERT INTO rel_Employee_Department (Id_department,Person_Employee_Id) VALUES (3,18);
INSERT INTO rel_Employee_Department (Id_department,Person_Employee_Id) VALUES (3,26);
INSERT INTO rel_Employee_Department (Id_department,Person_Employee_Id) VALUES (3,28);
INSERT INTO rel_Employee_Department (Id_department,Person_Employee_Id) VALUES (4,13);
INSERT INTO rel_Employee_Department (Id_department,Person_Employee_Id) VALUES (4,19);
INSERT INTO rel_Employee_Department (Id_department,Person_Employee_Id) VALUES (4,25);
INSERT INTO rel_Employee_Department (Id_department,Person_Employee_Id) VALUES (4,31);
INSERT INTO rel_Employee_Department (Id_department,Person_Employee_Id) VALUES (4,32);
INSERT INTO rel_Employee_Department (Id_department,Person_Employee_Id) VALUES (4,30);
INSERT INTO rel_Employee_Department (Id_department,Person_Employee_Id) VALUES (5,24);
INSERT INTO rel_Employee_Department (Id_department,Person_Employee_Id) VALUES (5,4);
INSERT INTO rel_Employee_Department (Id_department,Person_Employee_Id) VALUES (5,7);
INSERT INTO rel_Employee_Department (Id_department,Person_Employee_Id) VALUES (5,23);
INSERT INTO rel_Employee_Department (Id_department,Person_Employee_Id) VALUES (6,33);
INSERT INTO rel_Employee_Department (Id_department,Person_Employee_Id) VALUES (6,8);
INSERT INTO rel_Employee_Department (Id_department,Person_Employee_Id) VALUES (6,10);
INSERT INTO rel_Employee_Department (Id_department,Person_Employee_Id) VALUES (6,20);
INSERT INTO rel_Employee_Department (Id_department,Person_Employee_Id) VALUES (7,14);
INSERT INTO rel_Employee_Department (Id_department,Person_Employee_Id) VALUES (7,9);
INSERT INTO rel_Employee_Department (Id_department,Person_Employee_Id) VALUES (7,21);
INSERT INTO rel_Employee_Department (Id_department,Person_Employee_Id) VALUES (7,22);
INSERT INTO rel_Employee_Department (Id_department,Person_Employee_Id) VALUES (7,20);

 




