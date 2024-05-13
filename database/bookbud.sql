-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2022 at 02:08 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookbud`
--

-- --------------------------------------------------------
--
-- Table structure for table `genreid`
--
CREATE TABLE genreid(
    `genre` varchar(40) NOT NULL ,
    `genreID` int,
    `count` int 
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
    `bookId` int(10) NOT NULL,
    `title` varchar(255) NOT NULL,
    `series` varchar(145),
    `author` varchar(385) NOT NULL DEFAULT 'Unspecified Author',
    `rating` Numeric(3,2)  ,
    `bookDescription` TEXT ,
    `publicationLanguage` VARCHAR(37) NOT NULL DEFAULT 'Unspecified Language',
    `genres` VARCHAR(250) NOT NULL ,
    `mainGenre` VARCHAR(30) NOT NULL  ,
    `genreID` int NOT NULL,
    `numericCount` int NOT NULL ,
    `alphabeticalCount` VARCHAR(5) NOT NULL  ,
    `shelf` VARCHAR(10) NOT NULL,
    `bookForm` VARCHAR(40) DEFAULT 'Unspecified' ,
    `bookEdition` TEXT  ,
    `pages` int DEFAULT -1,
    `publisher` VARCHAR(130) NOT NULL DEFAULT 'Unspecified Publisher',
    `yearOfPublication` VARCHAR(250) DEFAULT 'Unspecified Year' ,
    `awards` TEXT   ,
    `numRating` int,
    `ratingbyStars` VARCHAR(55)DEFAULT 'Unspecified' ,
    `coverImage` VARCHAR(150) DEFAULT 'Unspecified' ,
    `isAvailable` BINARY(1) DEFAULT 1,
    `reservedNb` INT DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `M_Id` int(10) NOT NULL,
  `Sender` varchar(255) NOT NULL,
  `userId` int(10) DEFAULT NULL,
  `Msg` varchar(255) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `record`
--

CREATE TABLE `record` (
  `id` int(11) NOT NULL,
  `userId` int(10) NOT NULL,
  `bookId` int(255) NOT NULL,
  `Date_of_Issue` date NOT NULL,
  `Due_Date` date NOT NULL,
  `Date_of_Return` date NOT NULL,
  `Dues` int(255) NOT NULL,
  `Penalty` int(255) NOT NULL,
  `Renewals_left` int(255) NOT NULL,
  `Time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `renew`
--

CREATE TABLE `renew` (
  `userId` int(10) NOT NULL,
  `bookId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `return`
--

CREATE TABLE `return` (
  `id` int(11) NOT NULL,
  `userId` int(10) NOT NULL,
  `bookId` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(10) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `balance` Numeric(10,2) DEFAULT 0,
  `currentBorrowed` int(255) DEFAULT NULL,
  `interests` VARCHAR(250) DEFAULT NULL,
  `borrowedNb` int(10) DEFAULT 0,
  `creationDate` TIMESTAMP DEFAULT CURRENT_DATE()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `userId` int(10) NOT NULL,
  `bookId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `name`, `username`, `email`, `password`,`type`) VALUES
('1', 'Administrator', 'admin', 'admin', 'admin','Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `genreid`
  ADD PRIMARY KEY (`genreID`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`bookId`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`M_Id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `record`
--
ALTER TABLE `record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `renew`
--
ALTER TABLE `renew`
  ADD PRIMARY KEY (`userId`,`bookId`),
  ADD KEY `bookId` (`bookId`);

--
-- Indexes for table `return`
--
ALTER TABLE `return`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl`
--
ALTER TABLE `user`
  MODIFY `userId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;

--
-- AUTO_INCREMENT for table `book`
--


--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `M_Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=371;

--
-- AUTO_INCREMENT for table `record`
--
ALTER TABLE `record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `return`
--
ALTER TABLE `return`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`);

-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`),
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`bookId`) REFERENCES `book` (`bookId`);

--
-- Constraints for table `renew`
--
ALTER TABLE `renew`
  ADD CONSTRAINT `renew_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`),
  ADD CONSTRAINT `renew_ibfk_2` FOREIGN KEY (`bookId`) REFERENCES `book` (`bookId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
