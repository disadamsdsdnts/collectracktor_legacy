USE proyectofinal;

SELECT * FROM collections;

SELECT * FROM item WHERE CollectionsID=3;

SELECT * FROM item, books WHERE (item.ID = books.ItemID) AND collectionsID=3;

DELETE FROM item WHERE CollectionsID=3;

SELECT * FROM item;
SELECT * FROM books;
SELECT * FROM item, books WHERE (item.ID = books.ItemID);

INSERT INTO item VALUES (NULL, 3);
INSERT INTO books VALUES ('Moby Dick', 							'Herman Melville', 		'PENGUIN CLASICOS', '2015-07-02', '978-8491050209', 'img/0_books.jpg', LAST_INSERT_ID());
INSERT INTO item VALUES (NULL, 3);
INSERT INTO books VALUES ('La isla del tesoro', 				'Robert L. Stevenson', 	'PENGUIN CLASICOS', '2015-07-02', '978-8491050889', 'img/0_books.jpg', LAST_INSERT_ID());
INSERT INTO item VALUES (NULL, 3);
INSERT INTO books VALUES ('Las aventuras de Huckleberry Finn', 	'Mark Twain', 			'PENGUIN CLASICOS', '2016-02-18', '978-8491051657', 'img/0_books.jpg', LAST_INSERT_ID());

DESC books;

SELECT * FROM userdefinedcollections;
DELETE FROM userdefinedcollections WHERE ID=2;

