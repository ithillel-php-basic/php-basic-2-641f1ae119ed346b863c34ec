USE Hillel_db;

INSERT INTO author (id, date_reg, email, name, password)
VALUES (1, '2023-03-10 10:30:00', 'example1@gmail.com', 'Иван Иванов', 12345),
       (2, '2023-03-26 08:11:37', 'example2@gmail.com', 'Джон Доу', 23456);

INSERT INTO project (id, name, author_id)
VALUES (1, "Вхідні", 1),
       (2, "Навчання", 1),
       (3, "Робота", 2),
       (4, "Домашні справи", 2),
       (5, "Авто", 1);   	

INSERT INTO task (id, date_create, status, title, description, file, deadline, author_id, project_id)
VALUES (1, '2023-04-28 12:30:00', 'backlog', 'Співбесіда в IT компанії', 'Призначено співбесіду в IT компанію Google', 'C:/path/example/file1.txt', '2023-07-01', 2, 3),
       (2, '2023-04-28 14:00:10', 'backlog', 'Виконати тестове завдання', 'Виконати тестове завдання яке дав HR менеджер', 'C:/path/example/file2.txt', '2023-07-25', 2, 3),
       (3, '2023-04-25 17:36:45', 'done', 'Зробити завдання до першого уроку', 'Зробити завдання до першого уроку в школі Hillel', 'C:/path/example/file3.txt', '2023-04-27', 1, 2),
       (4, '2023-05-13 11:04:52', 'to-do', 'Зустрітись з друзями', 'Зустрітись з друзями та поїсти у ресторані', 'C:/path/example/file4.txt', '2023-05-14', 1, 1),
       (5, '2023-05-01 08:25:14', 'in-progress', 'Купити корм для кота', 'Купити корм для кота у магазині', 'C:/path/example/file5.txt', null, 2, 4),
       (6, '2023-04-29 18:35:12', 'to-do', 'Замовити піцу', 'Замовити піцу з ананасами в піцерії', 'C:/path/example/file6.txt', null, 2, 4);

SELECT * FROM project WHERE author_id = 1;

SELECT * FROM task WHERE project_id = 4;

UPDATE task SET status='in-progress' WHERE id = 1;

UPDATE task SET status='done' WHERE id = 2;

UPDATE task SET title='Купити корм для песика' WHERE id = 5;

обновление мейн
на таск(5) и гит ресет 
проверка комитов 
и пуш