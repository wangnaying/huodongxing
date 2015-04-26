create table `user` (
	`user_id` int(11) PRIMARY KEY,
	`user_name` varchar(12) CHARACTER SET utf8 NOT NULL,
	`user_pw` varchar(12) CHARACTER SET utf8 NOT NULL,
	`user_school` varchar(40) CHARACTER SET utf8 NOT NULL,
	`user_year` varchar(30) CHARACTER SET utf8
);