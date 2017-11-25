PRAGMA foreign_keys = ON;

DROP TABLE IF EXISTS task;
DROP TABLE IF EXISTS toDoList;
DROP TABLE IF EXISTS user;

CREATE TABLE task (
    id         INTEGER PRIMARY KEY,
    title      VARCHAR,
    details    VARCHAR,
    completed  BOOLEAN,
    toDoListId INTEGER REFERENCES toDoList (id) ON DELETE CASCADE
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
