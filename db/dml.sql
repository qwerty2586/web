INSERT INTO rights (label, weight) VALUES ('author', 10);
INSERT INTO rights (label, weight) VALUES ('reviewer', 50);
INSERT INTO rights (label, weight) VALUES ('admin', 100);

INSERT INTO users (name, login, email, password, idright) VALUES ('admin1', 'admin1', 'admin1@admin.admin', '0f6b31b40e622d92344d3c3c5112b32816ac9a0fcc8993a8277ffeb95db297c8', 3);
INSERT INTO users (name, login, email, password, idright) VALUES ('admin2', 'admin2', 'admin2@admin.admin', '0f6b31b40e622d92344d3c3c5112b32816ac9a0fcc8993a8277ffeb95db297c8', 3);
INSERT INTO users (name, login, email, password, idright) VALUES ('admin3', 'admin3', 'admin3@admin.admin', '0f6b31b40e622d92344d3c3c5112b32816ac9a0fcc8993a8277ffeb95db297c8', 3);

-- heslo admin11

INSERT INTO users (name, login, email, password, idright) VALUES ('reviewer1', 'reviewer1', 'reviewer1@reviewer.com', 'd97961ed51f2c87b52fd5779d364a132d49216020695520e8b2c77f1778ff82b', 2);
INSERT INTO users (name, login, email, password, idright) VALUES ('reviewer2', 'reviewer2', 'reviewer2@reviewer.com', 'd97961ed51f2c87b52fd5779d364a132d49216020695520e8b2c77f1778ff82b', 2);
INSERT INTO users (name, login, email, password, idright) VALUES ('reviewer3', 'reviewer3', 'reviewer3@reviewer.com', 'd97961ed51f2c87b52fd5779d364a132d49216020695520e8b2c77f1778ff82b', 2);

-- heslo revi123

INSERT INTO users (name, login, email, password, idright) VALUES ('user1', 'user1', 'user1@seznam.cz', 'b4240791ce0be7b92ddd5091ae67234e5dff778e786dc0a3cb9846af0cf8b653', 1);
INSERT INTO users (name, login, email, password, idright) VALUES ('user2', 'user2', 'user2@seznam.cz', 'b4240791ce0be7b92ddd5091ae67234e5dff778e786dc0a3cb9846af0cf8b653', 1);
INSERT INTO users (name, login, email, password, idright) VALUES ('user3', 'user3', 'user3@seznam.cz', 'b4240791ce0be7b92ddd5091ae67234e5dff778e786dc0a3cb9846af0cf8b653', 1);

-- heslo heslo123

