CREATE TABLE PlanBlock (
    id varchar PRIMARY KEY
    
);

CREATE TABLE Employee(
   
    id INTEGER PRIMARY KEY NOT NULL,
    etunimi varchar(50) NOT NULL,
    sukunimi varchar(50) NOT NULL,
    osoite varchar(100),
    puh varchar (20)
);

CREATE TABLE Planner(
    id SERIAL PRIMARY KEY,
    name varchar(50) NOT NULL,
    password varchar(50) NOT NULL
);

CREATE TABLE Task(
    id varchar(10) PRIMARY KEY NOT NULL,
    alkuaika Time,
    loppuaika Time,
    kesto Interval,
    tietoja varchar(200)
);

CREATE TABLE Plan(
    employee_id INTEGER REFERENCES Employee(id),
    task_id varchar REFERENCES Task(id),
    day_of_task Date,
    planBlock_id varchar REFERENCES PlanBlock(id),
    planner_id INTEGER REFERENCES Planner(id),
    PRIMARY KEY(employee_id,day_of_task)
    
);

CREATE TABLE Qualification(
    employee_id INTEGER REFERENCES Employee(id),
    task_id varchar REFERENCES Task(id),
    PRIMARY KEY(employee_id,task_id)
);

CREATE TABLE Weekday(
    id SERIAL PRIMARY KEY,
    task_id varchar REFERENCES Task(id),
    numero INTEGER NOT NULL
);






