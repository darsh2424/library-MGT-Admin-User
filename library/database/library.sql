-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 20, 2024 at 05:51 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `audio_book`
--

DROP TABLE IF EXISTS `audio_book`;
CREATE TABLE IF NOT EXISTS `audio_book` (
  `abook_id` int NOT NULL AUTO_INCREMENT,
  `abook_title` varchar(100) NOT NULL,
  `abook_img` varchar(50) NOT NULL,
  `abook_link` varchar(100) NOT NULL,
  PRIMARY KEY (`abook_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `audio_book`
--

INSERT INTO `audio_book` (`abook_id`, `abook_title`, `abook_img`, `abook_link`) VALUES
(1, 'The Voyages of Doctor Dolittle', 'abook_img/1.jpg', 'abook/1.mp3'),
(2, 'Tale of two cities', 'abook_img/2.jpg', 'abook/2.mp3'),
(4, 'Gullivers Travels', 'abook_img/3.jpg', 'abook/3.mp3'),
(5, 'Tales from Shakespeare', 'abook_img/4.jpg', 'abook/4.mp3'),
(6, 'The Adventures of Tom Sawyer', 'abook_img/5.jpg', 'abook/5.mp3'),
(7, 'The sinking of Titanic', 'abook_img/6.jpg', 'abook/6.mp3'),
(8, 'The Memories of Sherlock Holmes', 'abook_img/7.jpg', 'abook/7.mp3'),
(9, 'The return of Sherlock Holmes', 'abook_img/8.jpg', 'abook/8.mp3'),
(10, 'War of the Worlds', 'abook_img/9.jpg', 'abook/9.mp3'),
(11, 'Dorian Gray', 'abook_img/10.jpg', 'abook/10.mp3');

-- --------------------------------------------------------

--
-- Table structure for table `book_category`
--

DROP TABLE IF EXISTS `book_category`;
CREATE TABLE IF NOT EXISTS `book_category` (
  `cat_id` int NOT NULL AUTO_INCREMENT,
  `c_name` varchar(25) NOT NULL,
  `cover_img` varchar(30) NOT NULL DEFAULT 'category_img\\b1.jpg',
  `most_req_book` int NOT NULL,
  `most_issue_book` int NOT NULL,
  PRIMARY KEY (`cat_id`),
  UNIQUE KEY `c_name` (`c_name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_category`
--

INSERT INTO `book_category` (`cat_id`, `c_name`, `cover_img`, `most_req_book`, `most_issue_book`) VALUES
(1, 'Science', 'category_img\\Science.jpg', 17, 8),
(2, 'Arts', 'category_img\\Arts.jpg', 6, 3),
(3, 'Commerce', 'category_img\\Commerce.jpg', 7, 3),
(4, 'Medical', 'category_img\\Medical.jpg', 8, 3),
(5, 'Architecture', 'category_img\\Architecture.jpg', 8, 2),
(6, 'Engineering', 'category_img\\Engineering.jpg', 5, 4),
(7, 'Education', 'category_img\\Education.jpg', 5, 3),
(8, 'Ayurveda', 'category_img\\Ayurveda.jpg', 9, 5);

-- --------------------------------------------------------

--
-- Table structure for table `book_info`
--

DROP TABLE IF EXISTS `book_info`;
CREATE TABLE IF NOT EXISTS `book_info` (
  `book_id` int NOT NULL AUTO_INCREMENT,
  `book_name` varchar(50) NOT NULL,
  `book_author` varchar(25) NOT NULL,
  `c_name` varchar(25) NOT NULL,
  `pub_year` int NOT NULL,
  `book_img` varchar(100) NOT NULL DEFAULT 'book_img\\b1.jpg',
  `copies` int NOT NULL,
  `price` float NOT NULL,
  `most_req_book` int NOT NULL,
  `most_issue_book` int NOT NULL,
  PRIMARY KEY (`book_id`),
  KEY `c_name` (`c_name`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_info`
--

INSERT INTO `book_info` (`book_id`, `book_name`, `book_author`, `c_name`, `pub_year`, `book_img`, `copies`, `price`, `most_req_book`, `most_issue_book`) VALUES
(1, 'Bio Technology', 'H.K Das', 'Science', 2022, 'book_img\\Bio Technology.jpg', 8, 500, 6, 0),
(2, 'Secret Geometry', 'Charles Bouleau', 'Arts', 2020, 'book_img\\Secret Geometry.jpg', 9, 500, 2, 0),
(4, 'Pharmaceutical Microbiology', 's.chand', 'Medical', 2015, 'book_img\\Pharmaceutical  Microbiology.jpg', 10, 500, 1, 0),
(5, 'Electrical Engineering', 'H Schmidt-Walter', 'Engineering', 2020, 'book_img\\Electrical Engineering.jpg', 9, 500, 1, 0),
(6, 'Essentials of Physical Education', 'Dr Anil Nadir', 'Education', 2019, 'book_img\\Essentials of Physical Education.jpg', 10, 500, 1, 0),
(7, 'Effective management', 'Dietmar Sternad', 'Commerce', 2021, 'book_img\\Effective management.jpg', 10, 500, 1, 0),
(8, 'Space Architecture', 'Douglas A Vakoch', 'Architecture', 2019, 'book_img\\Space Architecture.jpg', 9, 500, 2, 0),
(9, 'Architectue Gate ', 'Jinisha Jain', 'Architecture', 2023, 'book_img\\Architectue Gate.jpg', 10, 500, 1, 0),
(10, 'Architecture of 18th Cent', 'John SummerSon', 'Architecture', 2018, 'book_img\\Architecture of 18th Cent.jpg', 10, 500, 2, 0),
(11, 'The Architecture', 'Julia McMorrough', 'Architecture', 2014, 'book_img\\The Architecture.jpg', 10, 500, 1, 0),
(12, 'Understanding Architectur', 'Amanda C. Roth Clark', 'Architecture', 2017, 'book_img\\Understanding Architecture.jpg', 10, 500, 2, 0),
(13, 'A Feast for the Eyes', 'Carolyn Tillie', 'Arts', 2018, 'book_img\\A Feast for the Eyes.jpg', 9, 500, 2, 0),
(14, 'Indian art & culture', 'Nitin Singhania', 'Arts', 2017, 'book_img\\Indian art & culture.jpg', 10, 500, 2, 0),
(15, 'Starving Artist', 'Gillian park', 'Arts', 2020, 'book_img\\Starving Artist.jpg', 10, 500, 0, 0),
(16, 'Small business management', 'Tim Mazzarol', 'Commerce', 2015, 'book_img\\Small business management.jpg', 10, 500, 2, 0),
(17, 'The Management book', 'Richard Newton', 'Commerce', 2022, 'book_img\\The Management book.jpg', 10, 500, 2, 0),
(18, 'Labour Law', ' Professor Prakash K. Mok', 'Commerce', 2014, 'book_img\\Labour Law.jpg', 9, 500, 1, 0),
(19, 'Law for the Common Man', 'Kush Kalra', 'Commerce', 2016, 'book_img\\Law for the Common Man.jpg', 10, 500, 1, 0),
(20, 'Commerce and Management', 'Dr Yogesh Dalvadi', 'Commerce', 2011, 'book_img\\Commerce and Management.jpg', 10, 500, 0, 0),
(21, 'Health and Physical Education', 'Dr V K Sharma', 'Education', 2022, 'book_img\\Health and Physical Education.jpg', 10, 500, 2, 0),
(22, 'Physical Education with practicals', 'Goyal Brothers Prakashan', 'Education', 2020, 'book_img\\Physical Education with practicals.jpg', 9, 500, 1, 0),
(23, 'Test Measurement in P.E.', ' Dr. Rajendra Singh', 'Education', 2018, 'book_img\\Test Measurement in Pysical Education.jpg', 10, 500, 0, 0),
(24, 'TextBook Of Physical Education', 'Dr Rajendra varma', 'Education', 2016, 'book_img\\TextBook Of Physical Education.jpg', 10, 500, 1, 0),
(25, 'Industrial Chemistry', 'Akira okada', 'Engineering', 2015, 'book_img\\Industrial Chemistry.jpg', 9, 500, 1, 0),
(26, 'Mechatronics', 'William Bolton', 'Engineering', 2017, 'book_img\\Mechatronics.jpg', 10, 500, 1, 0),
(27, 'Philosophy and Engineerin', 'Natasha McCarthy', 'Engineering', 2014, 'book_img\\Philosophy and Engineering.jpg', 9, 500, 1, 0),
(28, 'Workshop Technology', ' Dr. R.K. Singal', 'Engineering', 2011, 'book_img\\Workshop Technology.jpg', 9, 500, 1, 0),
(29, 'Pharmaceutical  Regulatory Science', 'Dr.Jiwan P. Lavande', 'Medical', 2023, 'book_img\\Pharmaceutical  Regulatory Science.jpg', 9, 500, 2, 0),
(30, 'Pharmaceutical Inorganic Chemistry', 'Dr. vinod Ugale', 'Medical', 2017, 'book_img\\Pharmaceutical Inorganic Chemistry.jpg', 9, 500, 3, 0),
(31, 'Pharmaceutical Technology', 'Pankaj Bhatt', 'Medical', 2015, 'book_img\\Pharmaceutical Technology.jpg', 10, 500, 1, 0),
(32, 'Physical Pharmacy', 'Patrick J. Sinko', 'Medical', 2016, 'book_img\\Physical Pharmacy.jpg', 10, 500, 1, 0),
(33, 'BCA complete guide', 'Leo Tolstoy', 'Science', 2022, 'book_img\\BCA complete guide.jpg', 10, 500, 5, 0),
(34, 'Industrial Chemistry', 'Dr. Janakkumar R. Shukla', 'Science', 2018, 'book_img\\Industrial Chemistry.jpg', 9, 500, 2, 0),
(35, 'Information Technology', 'Sumita Arora', 'Science', 2014, 'book_img\\Information Technology.jpg', 9, 500, 1, 0),
(36, 'Science Biology & Botany', 'James Joyce', 'Science', 2021, 'book_img\\Science Biology & Botany.jpg', 9, 500, 2, 0),
(37, 'Ayurveda and modern medicine', 'Dr.R.D.Lele', 'Ayurveda', 2018, 'book_img\\Ayurveda and modern medicine.jpg', 10, 500, 1, 0),
(38, 'Ayurveda-The source of youth and beauty', 'Anand Gupta', 'Ayurveda', 2019, 'book_img\\Ayurveda-The source of youth and beauty.jpg', 9, 500, 2, 0),
(39, 'Guide of Ayurvedic Medicine', 'Pandit Ram Raksha Rathak', 'Ayurveda', 2015, 'book_img\\Guide of Ayurvedic Medicine.jpg', 10, 500, 1, 0),
(41, 'Handbook of Yurvedic Medicine', 'Dr.Bishnu Choudhary', 'Ayurveda', 2020, 'book_img\\Handbook of Yurvedic Medicine.jpg', 9, 500, 2, 0),
(42, 'Yoga and Herbs', 'Dr. David Frawley', 'Ayurveda', 2014, 'book_img\\Yoga and Herbs.jpeg', 8, 500, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `book_request`
--

DROP TABLE IF EXISTS `book_request`;
CREATE TABLE IF NOT EXISTS `book_request` (
  `req_id` int NOT NULL AUTO_INCREMENT,
  `enroll` int NOT NULL,
  `username` varchar(35) NOT NULL,
  `book_id` int NOT NULL,
  `book_name` varchar(50) NOT NULL,
  `c_name` varchar(25) NOT NULL,
  `book_author` varchar(50) NOT NULL,
  `book_req_date` date NOT NULL,
  PRIMARY KEY (`req_id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_request`
--

INSERT INTO `book_request` (`req_id`, `enroll`, `username`, `book_id`, `book_name`, `c_name`, `book_author`, `book_req_date`) VALUES
(32, 2021001356, 'Aman', 14, 'Indian art & culture', 'Arts', 'Nitin Singhania', '2023-03-18'),
(33, 2021001356, 'Aman', 16, 'Small business management', 'Commerce', 'Tim Mazzarol', '2023-03-18'),
(34, 2021001356, 'Aman', 17, 'The Management book', 'Commerce', 'Richard Newton', '2023-03-18'),
(37, 2021001374, 'Darsh', 17, 'The Management book', 'Commerce', 'Richard Newton', '2023-03-18'),
(39, 2021001374, 'Darsh', 19, 'Law for the Common Man', 'Commerce', 'Kush Kalra', '2023-03-18'),
(41, 2021001374, 'Darsh', 30, 'Pharmaceutical Inorganic Chemistry', 'Medical', 'Dr. vinod Ugale', '2023-03-18'),
(42, 2021001374, 'Darsh', 4, 'Pharmaceutical Microbiology', 'Medical', 's.chand', '2023-03-18'),
(43, 2021001374, 'Darsh', 32, 'Physical Pharmacy', 'Medical', 'Patrick J. Sinko', '2023-03-18'),
(44, 2021001374, 'Darsh', 31, 'Pharmaceutical Technology', 'Medical', 'Pankaj Bhatt', '2023-03-18'),
(46, 2021001407, 'Utkarsh', 9, 'Architectue Gate ', 'Architecture', 'Jinisha Jain', '2023-03-18'),
(47, 2021001407, 'Utkarsh', 10, 'Architecture of 18th Cent', 'Architecture', 'John SummerSon', '2023-03-18'),
(48, 2021001407, 'Utkarsh', 11, 'The Architecture', 'Architecture', 'Julia McMorrough', '2023-03-18'),
(49, 2021001407, 'Utkarsh', 12, 'Understanding Architectur', 'Architecture', 'Amanda C. Roth Clark', '2023-03-18'),
(52, 2021001407, 'Utkarsh', 26, 'Mechatronics', 'Engineering', 'William Bolton', '2023-03-18'),
(56, 2021001382, 'Diya', 21, 'Health and Physical Education', 'Education', 'Dr V K Sharma', '2023-03-18'),
(57, 2021001382, 'Diya', 21, 'Health and Physical Education', 'Education', 'Dr V K Sharma', '2023-03-18'),
(59, 2021001382, 'Diya', 24, 'TextBook Of Physical Education', 'Education', 'Dr Rajendra varma', '2023-03-18'),
(60, 2021001382, 'Diya', 37, 'Ayurveda and modern medicine', 'Ayurveda', 'Dr.R.D.Lele', '2023-03-18'),
(61, 2021001382, 'Diya', 38, 'Ayurveda-The source of youth and beauty', 'Ayurveda', 'Anand Gupta', '2023-03-18'),
(62, 2021001382, 'Diya', 39, 'Guide of Ayurvedic Medicine', 'Ayurveda', 'Pandit Ram Raksha Rathak', '2023-03-18'),
(65, 2021001212, 'Shrey', 1, 'Bio Technology', 'Science', 'H.K Das', '2023-03-18'),
(66, 2021001212, 'Shrey', 33, 'BCA complete guide', 'Science', 'Leo Tolstoy', '2023-03-18'),
(68, 2021001212, 'Shrey', 34, 'Industrial Chemistry', 'Science', 'Dr. Janakkumar R. Shukla', '2023-03-18'),
(69, 2021001212, 'Shrey', 36, 'Science Biology & Botany', 'Science', 'James Joyce', '2023-03-18'),
(72, 2021001212, 'Shrey', 14, 'Indian art & culture', 'Arts', 'Nitin Singhania', '2023-03-18'),
(75, 2021001212, 'Shrey', 29, 'Pharmaceutical  Regulatory Science', 'Medical', 'Dr.Jiwan P. Lavande', '2023-03-18'),
(77, 2021001389, 'Kunj', 8, 'Space Architecture', 'Architecture', 'Douglas A Vakoch', '2023-03-18'),
(78, 2021001389, 'Kunj', 10, 'Architecture of 18th Cent', 'Architecture', 'John SummerSon', '2023-03-18'),
(82, 2021001389, 'Kunj', 41, 'Handbook of Yurvedic Medicine', 'Ayurveda', 'Dr.Bishnu Choudhary', '2023-03-18'),
(84, 2021001407, 'Utkarsh', 33, 'BCA complete guide', 'Science', 'Leo Tolstoy', '2023-03-18'),
(85, 2021001407, 'Utkarsh', 1, 'Bio Technology', 'Science', 'H.K Das', '2023-03-18'),
(86, 2021001407, 'Utkarsh', 1, 'Bio Technology', 'Science', 'H.K Das', '2023-03-18'),
(87, 2021001374, 'Darsh', 33, 'BCA complete guide', 'Science', 'Leo Tolstoy', '2023-04-10');

-- --------------------------------------------------------

--
-- Table structure for table `ebook_info`
--

DROP TABLE IF EXISTS `ebook_info`;
CREATE TABLE IF NOT EXISTS `ebook_info` (
  `ebook_id` int NOT NULL AUTO_INCREMENT,
  `ebook_title` varchar(30) NOT NULL,
  `ebook_cat` varchar(20) NOT NULL,
  `ebook_path` varchar(100) NOT NULL,
  `ebook_author` varchar(100) NOT NULL,
  `ebook_img` varchar(100) NOT NULL,
  PRIMARY KEY (`ebook_id`),
  KEY `ebook_path` (`ebook_path`),
  KEY `ebook_path_2` (`ebook_path`),
  KEY `ebook_cat` (`ebook_cat`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ebook_info`
--

INSERT INTO `ebook_info` (`ebook_id`, `ebook_title`, `ebook_cat`, `ebook_path`, `ebook_author`, `ebook_img`) VALUES
(1, 'E-Book Enterpreneur', 'Commerce', 'ebook/2.pdf', 'V.A. Rajput', 'ebook_img/2.png'),
(2, 'Polymer Physics', 'Science', 'ebook/3.pdf', 'Winbing Hu', 'ebook_img/3.png'),
(3, 'Traffic tips ', 'Science', 'ebook/4.pdf', 'Google', 'ebook_img/4.png'),
(4, 'Mastering web application  dev', 'Science', 'ebook/6.pdf', 'Peter Bacon ', 'ebook_img/6.png'),
(5, 'Essentials of medical ', 'Medical', 'ebook/7.pdf', 'K.D Tripathi', 'ebook_img/7.png'),
(6, ': Introduction to .NET Framewo', 'Science', 'ebook/8.pdf', 'ebook/8.pdf', 'ebook_img/8.png'),
(7, 'Irrefutable laws', 'Commerce', 'ebook/10.pdf', 'John Maxwell', 'ebook_img/10.png'),
(8, 'Building your own business', 'Commerce', 'ebook/11.pdf', 'JayKay', 'ebook_img/11.png'),
(9, 'Emergency medicine', 'Medical', 'ebook/13.pdf', 'Adam Rosh', 'ebook_img/13.png'),
(10, 'Pocket medicine', 'Medical', 'ebook/14.pdf', 'Marc sabatine', 'ebook_img/14.png');

-- --------------------------------------------------------

--
-- Table structure for table `fine`
--

DROP TABLE IF EXISTS `fine`;
CREATE TABLE IF NOT EXISTS `fine` (
  `enroll` int NOT NULL,
  `req_id` int NOT NULL,
  `issued_date` date NOT NULL,
  `expected_return_date` date NOT NULL,
  `curr_date` date DEFAULT NULL,
  `total_fine` int NOT NULL,
  UNIQUE KEY `req_id` (`req_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fine`
--

INSERT INTO `fine` (`enroll`, `req_id`, `issued_date`, `expected_return_date`, `curr_date`, `total_fine`) VALUES
(2021001356, 25, '2023-03-18', '2023-03-25', '2023-03-18', 0),
(2021001356, 26, '2023-03-18', '2023-03-25', '2023-03-18', 0),
(2021001356, 27, '2023-03-18', '2023-03-25', '2023-03-18', 0),
(2021001356, 28, '2023-03-18', '2023-03-25', '2023-03-18', 0),
(2021001356, 29, '2023-03-18', '2023-03-25', '2023-03-18', 0),
(2021001356, 30, '2023-03-18', '2023-03-25', '2023-03-18', 0),
(2021001374, 35, '2023-03-18', '2023-03-25', '2023-03-18', 0),
(2021001374, 36, '2023-03-18', '2023-03-25', '2023-03-18', 0),
(2021001374, 38, '2023-03-18', '2023-03-25', '2024-02-04', 0),
(2021001374, 40, '2023-03-18', '2023-03-20', '2024-02-04', 30),
(2021001407, 45, '2023-03-18', '2023-03-15', '2024-04-20', 50),
(2021001407, 50, '2023-03-18', '2023-03-25', '2024-04-20', 0),
(2021001407, 51, '2023-03-18', '2023-03-25', '2024-04-20', 0),
(2021001407, 53, '2023-03-18', '2023-03-25', '2024-04-20', 0),
(2021001407, 54, '2023-03-18', '2023-03-25', '2024-04-20', 0),
(2021001382, 55, '2023-03-18', '2023-03-25', '2023-03-18', 0),
(2021001382, 58, '2023-03-18', '2023-03-25', '2023-03-18', 0),
(2021001382, 63, '2023-03-18', '2023-03-25', '2023-03-18', 0),
(2021001382, 64, '2023-03-18', '2023-03-25', '2023-03-18', 0),
(2021001212, 67, '2023-03-18', '2023-03-25', '2023-03-18', 0),
(2021001212, 70, '2023-03-18', '2023-03-25', '2023-03-18', 0),
(2021001212, 71, '2023-03-18', '2023-03-25', '2023-03-18', 0),
(2021001212, 73, '2023-03-18', '2023-03-25', '2023-03-18', 0),
(2021001212, 74, '2023-03-18', '2023-03-25', '2023-03-18', 0),
(2021001389, 76, '2023-03-18', '2023-03-25', '2023-03-18', 0),
(2021001389, 79, '2023-03-18', '2023-03-25', '2023-03-18', 0),
(2021001389, 80, '2023-03-18', '2023-03-25', '2023-03-18', 0),
(2021001389, 81, '2023-03-18', '2023-03-25', '2023-03-18', 0),
(2021001389, 83, '2023-03-18', '2023-03-25', '2023-03-18', 0),
(2021001374, 88, '2024-02-04', '2024-02-11', '2024-02-04', 0);

-- --------------------------------------------------------

--
-- Table structure for table `issue_book`
--

DROP TABLE IF EXISTS `issue_book`;
CREATE TABLE IF NOT EXISTS `issue_book` (
  `req_id` int NOT NULL,
  `enroll` int NOT NULL,
  `username` varchar(35) NOT NULL,
  `book_id` int NOT NULL,
  `book_name` varchar(50) NOT NULL,
  `c_name` varchar(35) NOT NULL,
  `book_author` varchar(35) NOT NULL,
  `issued_date` date NOT NULL,
  `expected_return_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issue_book`
--

INSERT INTO `issue_book` (`req_id`, `enroll`, `username`, `book_id`, `book_name`, `c_name`, `book_author`, `issued_date`, `expected_return_date`) VALUES
(27, 2021001356, 'Aman', 34, 'Industrial Chemistry', 'Science', 'Dr. Janakkumar R. Shukla', '2023-03-18', '2023-03-25'),
(28, 2021001356, 'Aman', 35, 'Information Technology', 'Science', 'Sumita Arora', '2023-03-18', '2023-03-25'),
(29, 2021001356, 'Aman', 36, 'Science Biology & Botany', 'Science', 'James Joyce', '2023-03-18', '2023-03-25'),
(38, 2021001374, 'Darsh', 18, 'Labour Law', 'Commerce', ' Professor Prakash K.ï¿½Mok', '2023-03-18', '2023-03-25'),
(40, 2021001374, 'Darsh', 29, 'Pharmaceutical  Regulatory Science', 'Medical', 'Dr.Jiwan P. Lavande', '2023-03-18', '2023-03-25'),
(45, 2021001407, 'Utkarsh', 8, 'Space Architecture', 'Architecture', 'Douglas A Vakoch', '2023-03-18', '2023-03-25'),
(51, 2021001407, 'Utkarsh', 25, 'Industrial Chemistry', 'Engineering', 'Akira okada', '2023-03-18', '2023-03-25'),
(50, 2021001407, 'Utkarsh', 5, 'Electrical Engineering', 'Engineering', 'H Schmidt-Walter', '2023-03-18', '2023-03-25'),
(54, 2021001407, 'Utkarsh', 28, 'Workshop Technology', 'Engineering', ' Dr. R.K. Singal', '2023-03-18', '2023-03-25'),
(53, 2021001407, 'Utkarsh', 27, 'Philosophy and Engineerin', 'Engineering', 'Natasha McCarthy', '2023-03-18', '2023-03-25'),
(64, 2021001382, 'Diya', 41, 'Handbook of Yurvedic Medicine', 'Ayurveda', 'Dr.Bishnu Choudhary', '2023-03-18', '2023-03-25'),
(58, 2021001382, 'Diya', 22, 'Physical Education with practicals', 'Education', 'Goyal Brothers Prakashan', '2023-03-18', '2023-03-25'),
(70, 2021001212, 'Shrey', 1, 'Bio Technology', 'Science', 'H.K Das', '2023-03-18', '2023-03-25'),
(73, 2021001212, 'Shrey', 13, 'A Feast for the Eyes', 'Arts', 'Carolyn Tillie', '2023-03-18', '2023-03-25'),
(74, 2021001212, 'Shrey', 30, 'Pharmaceutical Inorganic Chemistry', 'Medical', 'Dr. vinod Ugale', '2023-03-18', '2023-03-25'),
(80, 2021001389, 'Kunj', 42, 'Yoga and Herbs', 'Ayurveda', 'Dr. David Frawley', '2023-03-18', '2023-03-25'),
(81, 2021001389, 'Kunj', 38, 'Ayurveda-The source of youth and beauty', 'Ayurveda', 'Anand Gupta', '2023-03-18', '2023-03-25'),
(83, 2021001389, 'Kunj', 42, 'Yoga and Herbs', 'Ayurveda', 'Dr. David Frawley', '2023-03-18', '2023-03-25'),
(30, 2021001356, 'Aman', 2, 'Secret Geometry', 'Arts', 'Charles Bouleau', '2023-03-18', '2023-03-25'),
(88, 2021001374, 'Darsh', 1, 'Bio Technology', 'Science', 'H.K Das', '2024-02-04', '2024-02-11');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `enroll` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  PRIMARY KEY (`enroll`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`enroll`, `username`, `password`) VALUES
('2021001212', 'Shrey', '12345678'),
('2021001356', 'Aman', '12345'),
('2021001374', 'Darsh', '12345'),
('2021001382', 'Diya', '12345'),
('2021001389', 'Kunj', '12345'),
('2021001407', 'Utkarsh', '12345'),
('admin', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `podcast`
--

DROP TABLE IF EXISTS `podcast`;
CREATE TABLE IF NOT EXISTS `podcast` (
  `pod_id` int NOT NULL AUTO_INCREMENT,
  `pod_category` varchar(100) NOT NULL,
  `pod_title` varchar(100) NOT NULL,
  `pod_link` varchar(200) NOT NULL,
  PRIMARY KEY (`pod_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `podcast`
--

INSERT INTO `podcast` (`pod_id`, `pod_category`, `pod_title`, `pod_link`) VALUES
(1, 'Personality Development', 'The psychology of self-motivation', 'https://youtube.com/embed/7sxpKhIbr0E'),
(2, 'Personality Development', 'The skill of self confidence', 'https://youtube.com/embed/w-HYZv6HzAs'),
(3, 'Personality Development', 'The Skill of Humor', 'https://youtube.com/embed/MdZAMSyn_As'),
(4, 'Personality Development', 'Stand Alone to Stand Apart', 'https://youtube.com/embed/t9fP_b8Ebow'),
(5, 'Personality Development', 'How to Get Your Brain to Focus ', 'https://youtube.com/embed/Hu4Yvq-g7_Y'),
(6, 'Communication Skills', 'Think Fast, Talk Smart', 'https://youtube.com/embed/HAnw168huqA'),
(7, 'Communication Skills', 'Communication Memorable', 'https://youtube.com/embed/Fsr4yrSAIAQ'),
(8, 'Communication Skills', 'Negotiation: Getting What You Want', 'https://youtube.com/embed/MXFpOWDAhvM'),
(9, 'Fitness', 'How To Workout Smarter', 'https://youtube.com/embed/_fbCcWyYthQ'),
(10, 'Fitness', 'Building Endurance', 'https://youtube.com/embed/Ii845pDRC2c'),
(11, 'Fitness', 'Power of Fitness', 'https://youtube.com/embed/37UhELFvPec'),
(12, 'Spirituality', 'Master Yogi\'s Spiritual Secrets', 'https://youtube.com/embed/ZnzUoXJc5-8'),
(13, 'Spirituality', 'The Power of Being Alone', 'https://youtube.com/embed/Yiaatr-Noh0'),
(14, 'Spirituality', 'The Power of Being Alone', 'https://youtube.com/embed/Yiaatr-Noh0'),
(15, 'Spirituality', 'The power of silence', 'https://youtube.com/embed/LRwTUVjnMkw');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `p_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(35) NOT NULL,
  `enroll` int NOT NULL,
  `password` varchar(25) NOT NULL,
  `class` varchar(10) NOT NULL,
  `course` varchar(25) NOT NULL,
  `college` varchar(50) NOT NULL,
  `pending_request_books` int NOT NULL,
  `issued_books` int NOT NULL,
  `pending_returned_books` int NOT NULL,
  `returned_books` int NOT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`p_id`, `name`, `enroll`, `password`, `class`, `course`, `college`, `pending_request_books`, `issued_books`, `pending_returned_books`, `returned_books`) VALUES
(1, 'Aman', 2021001356, '12345', 'FYBCA', 'BCA', 'SEMCOM', 3, 4, 1, 2),
(2, 'Darsh', 2021001374, '12345', 'TYBCA', 'BCA', 'SEMCOM', 7, 3, 1, 2),
(3, 'Diya', 2021001382, '12345', 'SYBCA', 'BCA', 'SEMCOM', 6, 2, 1, 2),
(4, 'Utkarsh', 2021001407, '12345', 'SYBCA', 'BCA', 'SEMCOM', 8, 5, 1, 0),
(5, 'Kunj', 2021001389, '12345', 'FYBCA', 'BCA', 'NVPAS', 3, 3, 1, 2),
(11, 'Shrey', 2021001212, '12345678', 'TYBBA-ITM', 'BBA-ITM', 'SEMCOM', 6, 3, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `return_book`
--

DROP TABLE IF EXISTS `return_book`;
CREATE TABLE IF NOT EXISTS `return_book` (
  `req_id` int NOT NULL,
  `enroll` int NOT NULL,
  `username` varchar(35) NOT NULL,
  `book_id` int NOT NULL,
  `book_name` varchar(50) NOT NULL,
  `book_author` varchar(50) NOT NULL,
  `c_name` varchar(25) NOT NULL,
  `return_request_date` date NOT NULL,
  `book_return_date` date DEFAULT NULL,
  UNIQUE KEY `req_id` (`req_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `return_book`
--

INSERT INTO `return_book` (`req_id`, `enroll`, `username`, `book_id`, `book_name`, `book_author`, `c_name`, `return_request_date`, `book_return_date`) VALUES
(25, 2021001356, 'Aman', 1, 'Bio Technology', 'Science', 'H.K Das', '2023-03-18', '2023-03-18'),
(26, 2021001356, 'Aman', 33, 'BCA complete guide', 'Science', 'Leo Tolstoy', '2023-03-18', '2023-03-18'),
(27, 2021001356, 'Aman', 34, 'Industrial Chemistry', 'Science', 'Dr. Janakkumar R. Shukla', '2023-03-18', NULL),
(35, 2021001374, 'Darsh', 7, 'Effective management', 'Commerce', 'Dietmar Sternad', '2023-03-18', '2023-03-18'),
(36, 2021001374, 'Darsh', 16, 'Small business management', 'Commerce', 'Tim Mazzarol', '2023-03-18', '2023-03-18'),
(38, 2021001374, 'Darsh', 18, 'Labour Law', 'Commerce', ' Professor Prakash K.ï¿½M', '2023-03-18', NULL),
(45, 2021001407, 'Utkarsh', 8, 'Space Architecture', 'Architecture', 'Douglas A Vakoch', '2023-03-21', NULL),
(55, 2021001382, 'Diya', 6, 'Essentials of Physical Education', 'Education', 'Dr Anil Nadir', '2023-03-18', '2023-03-18'),
(63, 2021001382, 'Diya', 42, 'Yoga and Herbs', 'Ayurveda', 'Dr. David Frawley', '2023-03-18', '2023-03-18'),
(64, 2021001382, 'Diya', 41, 'Handbook of Yurvedic Medicine', 'Ayurveda', 'Dr.Bishnu Choudhary', '2023-03-18', NULL),
(67, 2021001212, 'Shrey', 33, 'BCA complete guide', 'Science', 'Leo Tolstoy', '2023-03-18', '2023-03-18'),
(71, 2021001212, 'Shrey', 2, 'Secret Geometry', 'Arts', 'Charles Bouleau', '2023-03-18', '2023-03-18'),
(73, 2021001212, 'Shrey', 13, 'A Feast for the Eyes', 'Arts', 'Carolyn Tillie', '2023-03-18', NULL),
(76, 2021001389, 'Kunj', 12, 'Understanding Architectur', 'Architecture', 'Amanda C. Roth Clark', '2023-03-18', '2023-03-18'),
(79, 2021001389, 'Kunj', 30, 'Pharmaceutical Inorganic Chemistry', 'Medical', 'Dr. vinod Ugale', '2023-03-18', '2023-03-18'),
(81, 2021001389, 'Kunj', 38, 'Ayurveda-The source of youth and beauty', 'Ayurveda', 'Anand Gupta', '2023-03-18', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_info`
--
ALTER TABLE `book_info`
  ADD CONSTRAINT `key` FOREIGN KEY (`c_name`) REFERENCES `book_category` (`c_name`);

--
-- Constraints for table `ebook_info`
--
ALTER TABLE `ebook_info`
  ADD CONSTRAINT `key2` FOREIGN KEY (`ebook_cat`) REFERENCES `book_category` (`c_name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
