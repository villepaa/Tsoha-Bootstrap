INSERT INTO Week VALUES (31);

INSERT INTO Week VALUES (32);

INSERT INTO Dates VALUES('2016-08-01',31);

INSERT INTO Dates VALUES('2016-08-02',31);

INSERT INTO Dates VALUES('2016-08-03',31);

INSERT INTO Dates VALUES('2016-08-04',31);

INSERT INTO Dates VALUES('2016-08-05',31);

INSERT INTO Dates VALUES('2016-08-06',31);

INSERT INTO Dates VALUES('2016-08-07',31);



INSERT INTO Planner (name,password) VALUES ('setä suunnittelija','setä1');

INSERT INTO Employee (id,forename,surname,osoite,puh) VALUES ('382738','Teppo', 'Duunari','Kuutamokuja 6 ,00101, Helsinki','038234550');

INSERT INTO Task (id,alkuaika,loppuaika,kesto,tietoja) VALUES ('KV','08:00:00','19:00:00','11:00:00', 'Tietoja vuoroon liittyen');

INSERT INTO Task (id,alkuaika,loppuaika,kesto,tietoja) VALUES ('OL','08:00:00','19:00:00','11:00:00', 'Tähänkin tietoja');

INSERT INTO Weekday (task_id,numero) VALUES ('KV',1);

INSERT INTO Weekday (task_id,numero) VALUES ('KV',2);

INSERT INTO PlanBlock VALUES('Viikot: 31-32');


INSERT INTO Weeks VALUES('Viikot: 31-32',31);

INSERT INTO Weeks VALUES('Viikot: 31-32',32);

INSERT INTO Plan (employee_id, task_id, day_of_task,planBlock_id,planner_id) VALUES (382738,'KV','2016-08-01','Viikot: 31-32',1);

INSERT INTO Qualification (employee_id, task_id) VALUES(382738,'OL');







