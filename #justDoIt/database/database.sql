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

CREATE TABLE user (
    username     VARCHAR PRIMARY KEY,
    password     VARCHAR,
    name         VARCHAR,
    registerDate INTEGER
);
