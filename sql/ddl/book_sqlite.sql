--
-- Creating a sample table.
--



--
-- Table Book
--
DROP TABLE IF EXISTS Book;
CREATE TABLE Book (
    "id" INTEGER PRIMARY KEY NOT NULL,
    `title` VARCHAR(256) NOT NULL,
    `author` VARCHAR(256) NOT NULL,
    `image` VARCHAR(256) NOT NULL
);
