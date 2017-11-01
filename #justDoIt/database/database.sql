CREATE TABLE task (
    id         INTEGER PRIMARY KEY,
    title      VARCHAR,
    details    VARCHAR,
    completed  BOOLEAN,
    toDoListId INTEGER REFERENCES toDoList (id)
);

CREATE TABLE toDoList (
    id   INTEGER PRIMARY KEY,
    name VARCHAR
);

CREATE TABLE users (
    username     VARCHAR PRIMARY KEY,
    password     VARCHAR,
    name         VARCHAR,
    registerDate INTEGER
);

Insert INTO users VALUES ('diogo', '1234', 'diogo', '111217');