SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `defyne`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `blogid` int(11) NOT NULL,
  `authorid` int(64) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `publish` char(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`blogid`, `authorid`, `title`, `content`, `publish`, `created`) VALUES
(5, 1, 'test', 'test', 'pub', '2019-05-07 14:52:40'),
(6, 1, 'help', 'help\r\n', 'pub', '2019-05-07 17:49:52'),
(7, 1, 'tru test', 'tru', 'pub', '2019-05-07 19:07:39'),
(8, 3, 'new test', 'new test', '', '2019-05-08 20:27:25'),
(9, 3, 'comment test', 'comment test', '', '2019-05-09 20:13:14');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentid` int(11) NOT NULL,
  `blogid` int(16) NOT NULL,
  `userid` int(16) NOT NULL,
  `comment` longtext NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentid`, `blogid`, `userid`, `comment`, `created`) VALUES
(9, 5, 0, 'Hello', '2019-05-09 23:26:17'),
(10, 5, 0, 'Testing', '2019-05-09 23:55:00'),
(11, 5, 0, 'public user', '2019-05-10 00:01:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(64) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `password`, `email`, `role`, `created`) VALUES
(1, 'super', '$2y$10$GoB5VNNTbull14EbJ37OpeClWUkc5ma2fDb6jHtYg1Of.xYGsL5ci', 'super@email.com', 'editor', '2019-05-07 08:20:27'),
(2, 'admin', '$2y$10$/mfyuVAsKw5AUrl74tX8XODUzoQ7eIhxN/wu8fAw2CviUemCOgPxq', 'admin@gmail.com', 'editor', '2019-05-07 08:53:16'),
(3, 'auth', '$2y$10$YAG9BTVU2HD6Z8Xg4v7se.YGONCjR3iegbQTiWMoiOGrmKme8eao.', 'auth@car.com', 'author', '2019-05-07 09:01:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`blogid`),
  ADD KEY `authorid` (`authorid`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `blogid` (`blogid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `blogid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`authorid`) REFERENCES `users` (`userid`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`blogid`) REFERENCES `blog` (`blogid`) ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
