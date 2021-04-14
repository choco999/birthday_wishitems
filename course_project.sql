CREATE TABLE IF NOT EXISTS `course_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `author` varchar(50) NOT NULL,
  `age` int(4) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `birthday_item` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

INSERT INTO `course_project` (`id`, `title`, `author`, `age`, `gender`, `birthday_item`) VALUES
(47, 'more new', 'Chisato', 13, 'female', 'ddd'),
(46, 'new !', 'Chisato', 13, 'female', 'aaa'),
(23, 'aaa', 'Chisato', 13, 'female', 'aaaaaa'),
(20, 'Introduction', 'Chisato', 13, 'female', 'aaaaaa'),
(31, 'hello wprld', 'Chisato', 13, 'female', 'fewvwfev'),
(32, 'hello world', 'Chisato', 13, 'female', 'aaaa'),
(34, 'Chisato Sakata', 'Chisato', 13, 'female', 'ragreg'),
(35, 'new post', 'Chisato', 13, 'female', 'aaaawdev'),
(36, 'RE: Arrays', 'Chisato', 13, 'female', 'freqg'),
(37, 'Chisato Sakata', 'Sakata', 13, 'female', 'g'),
(38, 'yyyyy', 'Chisato', 13, 'female', 'a');
COMMIT;