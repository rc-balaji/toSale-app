

CREATE TABLE posts (
    post_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    photo VARCHAR(255) NOT NULL,
    caption TEXT,
    post_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    likes INT DEFAULT 0,
    dislikes INT DEFAULT 0,
    username VARCHAR(255) NOT NULL
    
);


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";




CREATE TABLE `login` (
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `u_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `login` (`email`, `password`, `u_id`) VALUES
('balaji@123', '123', 1),
('sam@123', '123', 4);



CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `pnumber` int(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `users` (`u_id`, `email`, `name`, `pnumber`) VALUES
(1, 'balaji@123', 'RC Balaji', 6383579334),
(4, 'sam@123', 'RC Sam', 9080778096);



ALTER TABLE `login`
  ADD KEY `u_id` (`u_id`);


ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `email` (`email`);


ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;


ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`) ON DELETE CASCADE;
COMMIT;

