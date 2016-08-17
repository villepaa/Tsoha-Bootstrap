
INSERT INTO Planner (name,password) VALUES ('Ben Planner','setä1');

INSERT INTO Employee (id,etunimi,sukunimi,osoite,puh) VALUES ('382738','Teppo', 'Duunari','Kuutamokuja 6 ,00101, Helsinki','038234550');

INSERT INTO Employee (id,etunimi,sukunimi,osoite,puh) VALUES ('482738','Seppo', 'Duunari','Kuutamokuja 7 ,00101, Helsinki','038234551');

INSERT INTO Task (id,alkuaika,loppuaika,kesto,tietoja) VALUES ('KV','08:00:00','19:00:00','11:00:00', 'Tietoja vuoroon liittyen');

INSERT INTO Task (id,alkuaika,loppuaika,kesto,tietoja) VALUES ('OL','08:00:00','19:00:00','11:00:00', 'Tähänkin tietoja');

INSERT INTO Task (id,alkuaika,loppuaika,kesto,tietoja) VALUES ('VP','00:00:00','00:00:00','00:00:00', 'Vapaapäivä');

INSERT INTO Weekday (task_id,numero) VALUES ('KV',1);

INSERT INTO Weekday (task_id,numero) VALUES ('KV',2);

INSERT INTO Plan (employee_id, task_id, day_of_task,planBlock_id,planner_id) VALUES (382738,'KV','2016-08-01','Viikot:31-32_2016',1);

INSERT INTO Qualification (employee_id, task_id) VALUES(382738,'OL');







