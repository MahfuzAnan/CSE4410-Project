SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`   
--

CREATE TABLE IF NOT EXISTS `author` (
  `ISBN` char(14) NOT NULL,
  `Author` varchar(50) NOT NULL,
  PRIMARY KEY (`ISBN`,`Author`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`      (Each book can have multiple authors. Hence, the separate tables)
--

INSERT INTO `author` (`ISBN`, `Author`) VALUES
('0123704901', 'David A. Patterson'),
('0123704901', 'John L. Hennessy'),
('0123944244', 'David Harris'),
('0123944244', 'Sarah Harris'),
('0124077269', 'David A. Patterson'),
('0124077269', 'John L. Hennessy'),
('0205973361', 'J. Noland White'),
('0205973361', 'Saundra K. Ciccarelli'),
('0321696867', 'Hugh D. Young'),
('0321696867', 'Roger A. Freedman'),
('0321740904', 'Randall D. Knight'),
('0321884078', 'George B. Thomas Jr'),
('0321884078', 'Joel R. Hass'),
('0321884078', 'Maurice D. Weir'),
('0470879521', 'John D. Cutnell'),
('0470879521', 'Kenneth W. Johnson'),
('0596802358', 'Philipp K. Janert'),
('099040207X', 'Mr. Martin Holzke'),
('099040207X', 'Mr. Tom Stachowitz'),
('1285057090', 'Bruce H. Edwards'),
('1285057090', 'Ron Larson'),
('1429237198', 'Daniel L. Schacter'),
('1429237198', 'Daniel T. Gilbert'),
('1429261781', 'David G. Myers'),
('1449600069', 'Julia Lobur'),
('1449600069', 'Linda Null'),
('1452257876', 'A. Michael Huberman'),
('1452257876', 'Matthew B. Miles'),
('1590597699', 'Clare Churcher'),
('9990000011', 'George R. R. Martin'),
('9990000021', 'J. K. Rowling'),
('9990000031', 'J.R.R. Tolkien'),
('9990000041', 'Ernest Hemingway'),
('9990000051', 'Jane Austen'),
('9990000061', 'Rabindranath Tagore'),
('9990000062', 'Rabindranath Tagore'),
('9990000071', 'Kazi Nazrul Islam'),
('9990000081', 'Humayun Ahmed'),
('9990000082', 'Humayun Ahmed'),
('9990000083', 'Humayun Ahmed'),
('9990000091', 'Samaresh Majumder'),
('9990000101', 'Satyajit Ray');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `ISBN` char(14) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Cost` decimal(5,2) NOT NULL DEFAULT 0,
  `IsReserved` tinyint(1) NOT NULL DEFAULT 0,
  `Edition` int(11) NOT NULL,
  `PublishedPlace` varchar(30) DEFAULT NULL,
  `Publisher` varchar(30) NOT NULL,
  `ReleasedYear` decimal(4,0) NOT NULL,
  `GenreName` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ISBN`),
  KEY `GenreName` (`GenreName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`ISBN`, `Title`, `Cost`, `IsReserved`, `Edition`, `PublishedPlace`, `Publisher`, `ReleasedYear`, `GenreName`) VALUES
('0123704901', 'Computer Architecture: A Quantitative Approach', '24.95', 0, 4, 'US', 'Morgan Kaufmann', '2006', 'Computer Architecture'),
('0123944244', 'Digital Design and Computer Architecture', '52.57', 0, 2, 'US', 'Morgan Kaufmann', '2012', 'Computer Architecture'),
('0124077269', 'Computer Organization and Design', '75.74', 0, 5, 'US', 'Morgan Kaufmann', '2013', 'Computer Architecture'),
('0205973361', 'Psychology', '158.53', 0, 4, '', 'Pearson', '2014', 'Psychology'),
('0321696867', 'University Physics with Modern Physics', '225.76', 0, 13, 'UK', 'Addison-Wesley', '2011', 'Physics'),
('0321740904', 'Physics for Scientists and Engineers: A Strategic Approach with Modern Physics', '228.16', 1, 3, 'US', 'Addison-Wesley', '2012', 'Physics'),
('0321884078', 'Thomas'' Calculus: Early Transcendentals', '198.89', 0, 13, '', 'Pearson', '2013', 'Calculus'),
('0470879521', 'Physics', '209.38', 0, 9, '', 'John Wiley and Sons', '2012', 'Physics'),
('0596802358', 'Data Analysis with Open Source Tools', '26.69', 0, 1, 'US', 'O''Reilly Media', '2010', 'Data Science'),
('099040207X', 'SQL Database for Beginners', '22.49', 0, 1, '', 'LearnToProgram, Incorporated ', '2014', 'Data Science'),
('1285057090', 'Calculus', '245.84', 1, 10, 'US', 'Cengage Learning', '2013', 'Calculus'),
('1429237198', 'Psychology ', '159.48', 1, 2, '', 'Worth Publishers', '2010', 'Psychology'),
('1429261781', 'Psychology', '152.54', 0, 10, '', 'Worth Publishers', '2011', 'Psychology'),
('1449600069', 'The Essentials of Computer Organization and Architecture', '215.95', 0, 3, '', 'Jones & Bartlett Learning', '2010', 'Computer Architecture'),
('1452257876', 'Qualitative Data Analysis: A Methods Sourcebook', '72.42', 0, 3, 'US', 'SAGE Publications, Inc', '2013', 'Data Science'),
('1590597699', 'Beginning Database Design: From Novice to Professional ', '25.82', 0, 1, 'US', 'Apress', '2007', 'Data Science'),
('9990000011', 'A Game of Thrones', 99.99, 0, 1, 'New York', 'Bantam Spectra', 1996, 'Fantasy'),
('9990000021', 'Harry Potter', 149.99, 0, 8, 'London', 'Rowling Publications', 1990, 'Fantasy'),
('9990000031', 'The Lord of the Rings', 39.99, 1, 3, 'London', 'Houghton', 1954, 'Fantasy'),
('9990000041', 'The Old Man and the Sea', 9.99, 0, 1, 'New York', 'Scribner', 1952, 'Fiction'),
('9990000051', 'Pride and Prejudice', 7.99, 1, 1, 'London', 'Penguin Classics', 1813, 'Romance'),
('9990000061', 'Noukadubi', 14.99, 0, 1, 'Kolkata', 'Shomoy', 1910, 'Fiction'),
('9990000062', 'Gitanjali', 4.99, 0, 1, 'Kolkata', 'Shomoy', 1880, 'Poetry'),
('9990000071', 'Sanchita', 18.99, 0, 1, 'Dhaka', 'Prothoma', 1960, 'Poetry'),
('9990000081', 'Aj Himur Biye', 9.99, 1, 1, 'Dhaka', 'Prothoma', 2009, 'Romance'),
('9990000082', 'Shuvro', 49.99, 0, 1, 'Dhaka', 'Prothoma', 2005, 'Fiction'),
('9990000083', 'Opekkha', 29.99, 0, 1, 'Dhaka', 'Prothoma', 2000, 'Fantasy'),
('9990000091', 'Kalbela', 19.99, 0, 1, 'Kolkata', 'Rokomari', 1985, 'Romance'),
('9990000101', 'Feluda', 99.99, 1, 9, 'Kolkata', 'Onnoprokash', 1922, 'Mystery');

-- --------------------------------------------------------

--
-- Table structure for table `bookcopy`
--

CREATE TABLE IF NOT EXISTS `bookcopy` (
  `ISBN` char(14) NOT NULL,
  `CopyID` int(11) NOT NULL,
  `IsBorrowed` tinyint(1) NOT NULL DEFAULT '0',
  `IsHold` tinyint(1) NOT NULL DEFAULT '0',
  `IsDamaged` tinyint(1) NOT NULL DEFAULT '0',
  `FuRequester` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`ISBN`,`CopyID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookcopy`
--

-- INSERT INTO `bookcopy` (`ISBN`, `CopyID`, `IsBorrowed`, `IsHold`, `IsDamaged`, `FuRequester`) VALUES



-- --------------------------------------------------------

--
-- Table structure for table `issue`
--

CREATE TABLE IF NOT EXISTS `issue` (
  `Username` varchar(15) NOT NULL,
  `ISBN` char(14) NOT NULL,
  `CopyID` int(11) NOT NULL,
  `IssueID` char(30) NOT NULL,
  `ExtenDate` date DEFAULT NULL,
  `IssueDate` date NOT NULL,
  `ReturnDate` date NOT NULL,
  `NumExten` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Username`,`ISBN`,`CopyID`),
  UNIQUE KEY `IssueID` (`IssueID`),
  KEY `ISBN` (`ISBN`),
  KEY `issue_ibfk_2` (`ISBN`,`CopyID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issue`
--

-- INSERT INTO `issue` (`Username`, `ISBN`, `CopyID`, `IssueID`, `ExtenDate`, `IssueDate`, `ReturnDate`, `NumExten`) VALUES



-- --------------------------------------------------------

--
-- Table structure for table `user_detail`
--

CREATE TABLE IF NOT EXISTS `user_detail` (
  `Username` varchar(15) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `DOB` date DEFAULT NULL,
  `Email` varchar(30) NOT NULL,
  `Gender` char(1) NOT NULL,
  `Nationality` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_detail`
--

INSERT INTO `user_detail` (`Username`, `Name`, `DOB`, `Email`, `Gender`, `Nationality`) VALUES
('sah75', 'Sakib Al Hasan', '1980-05-15', 'sah75@google.com', 'M', 'Bangladesh'),
('msdhoni', 'Mahendra Singh Dhoni', '1985-08-22', 'msdhoni@google.com', 'M', 'India'),
('cr7', 'Cristiano Ronaldo', '1988-03-10', 'cr7@google.com', 'M', 'Portugal'),
('lm10', 'Lionel Messi','1990-03-10', 'lm10@google.com', 'M', 'Argentina'),
('rafa', 'Rafael Nadal','1995-03-10', 'rafa@google.com', 'M', 'Spain');

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE IF NOT EXISTS `genre` (
  `GenreName` varchar(30) NOT NULL,
  PRIMARY KEY (`GenreName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`GenreName`) VALUES
('Calculus'),
('Computer Architecture'),
('Data Science'),
('Physics'),
('Psychology'),
('Fiction'),
('Mystery'),
('Romance'),
('Poetry'),
('Fantasy');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `Username` varchar(15) NOT NULL,
  `Password` varchar(20) NOT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Username`, `Password`) VALUES
('aclark', 'aclark123'),
('mross', 'mross123'),
('sah75', '123'),
('msdhoni', '123'),
('cr7', '123'),
('lm10', '123'),
('rafa', '123'),
('admin', 'admin');


-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `Username` varchar(15) NOT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`Username`) VALUES
('admin');


--
-- Constraints for dumped tables
--

--
-- Constraints for table `author`
--
ALTER TABLE `author`
  ADD CONSTRAINT `author_ibfk_1` FOREIGN KEY (`ISBN`) REFERENCES `book` (`ISBN`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_2` FOREIGN KEY (`GenreName`) REFERENCES `genre` (`GenreName`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `bookcopy`
--
ALTER TABLE `bookcopy`
  ADD CONSTRAINT `bookcopy_ibfk_1` FOREIGN KEY (`ISBN`) REFERENCES `book` (`ISBN`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `issue`
--
ALTER TABLE `issue`
  ADD CONSTRAINT `issue_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `user` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `issue_ibfk_2` FOREIGN KEY (`ISBN`, `CopyID`) REFERENCES `bookcopy` (`ISBN`, `CopyID`) ON DELETE CASCADE ON UPDATE CASCADE;


--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `user` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_detail`
--
ALTER TABLE `user_detail`
  ADD CONSTRAINT `user_detail` FOREIGN KEY (`Username`) REFERENCES `user` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;




DELIMITER $$
CREATE FUNCTION generateIssueID()
RETURNS VARCHAR(50) 
BEGIN
    DECLARE currentYear CHAR(4);
    DECLARE currentMonth CHAR(2);
    DECLARE currentDate CHAR(2);
    DECLARE currentHour CHAR(2);
    DECLARE currentMinute CHAR(2);
    DECLARE currentSecond CHAR(2);
    DECLARE issueID VARCHAR(50);
    
    SET currentYear = YEAR(CURRENT_TIMESTAMP);
    SET currentMonth = LPAD(MONTH(CURRENT_TIMESTAMP), 2, '0');
    SET currentDate = LPAD(DAY(CURRENT_TIMESTAMP), 2, '0');
    SET currentHour = LPAD(HOUR(CURRENT_TIMESTAMP), 2, '0');
    SET currentMinute = LPAD(MINUTE(CURRENT_TIMESTAMP), 2, '0');
    SET currentSecond = LPAD(SECOND(CURRENT_TIMESTAMP), 2, '0');
    
    SET issueID = CONCAT(currentYear, currentMonth, currentDate, '_', NEW.ISBN, '_', currentHour, currentMinute, currentSecond);
    SET NEW.IssueID = issueID;
    
    RETURN issueID;
END$$
DELIMITER ;


CREATE TRIGGER before_insert_issue
BEFORE INSERT ON issue
FOR EACH ROW
BEGIN
        SET NEW.IssueID = generateIssueID(); 
END;










/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
