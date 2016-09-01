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

CREATE TABLE Block(
    id varchar(20) PRIMARY KEY NOT NULL,
    alkupaiva Date,
    loppupaiva Date
);

CREATE TABLE Task(
    id varchar(10) PRIMARY KEY NOT NULL,
    alkuaika Time,
    loppuaika Time,
    kesto Interval,
    tietoja varchar(200)
);

CREATE TABLE Plan(
    employee_id INTEGER REFERENCES Employee(id) ON DELETE CASCADE,
    task_id varchar REFERENCES Task(id) ON DELETE CASCADE,
    day_of_task Date,
    planBlock_id varchar(20) REFERENCES Block(id) ON DELETE CASCADE,
    planner_id INTEGER REFERENCES Planner(id),
    PRIMARY KEY(employee_id,day_of_task)
    
);

CREATE TABLE Qualification(
    employee_id INTEGER REFERENCES Employee(id) ON DELETE CASCADE,
    task_id varchar REFERENCES Task(id) ON DELETE CASCADE,
    PRIMARY KEY(employee_id,task_id)
);








