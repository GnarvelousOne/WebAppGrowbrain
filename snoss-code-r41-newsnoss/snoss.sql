-- phpMyAdmin SQL Dump
-- version 2.10.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jul 01, 2007 at 10:38 AM
-- Server version: 5.0.41
-- PHP Version: 5.2.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `snoss`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `email`
-- 

CREATE TABLE `email` (
  `to` longtext NOT NULL,
  `from` longtext NOT NULL,
  `subject` longtext NOT NULL,
  `message` longtext NOT NULL,
  `flag` longtext NOT NULL,
  `str` longtext NOT NULL,
  `date` longtext NOT NULL,
  `time` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `email`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `friends`
-- 

CREATE TABLE `friends` (
  `to` longtext NOT NULL,
  `from` longtext NOT NULL,
  `flag` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `friends`
-- 

INSERT INTO `friends` (`to`, `from`, `flag`) VALUES 
('2', '1', 'ia');

-- --------------------------------------------------------

-- 
-- Table structure for table `useri`
-- 

CREATE TABLE `useri` (
  `user` longtext NOT NULL,
  `password` longtext NOT NULL,
  `uid` longtext NOT NULL,
  `email` longtext NOT NULL,
  `dob` longtext NOT NULL,
  `signupdate` longtext NOT NULL,
  `lastlogin` longtext NOT NULL,
  `picurl` longtext NOT NULL,
  `firstname` longtext NOT NULL,
  `surname` longtext NOT NULL,
  `signupstring` longtext NOT NULL,
  `data` longtext NOT NULL,
  `ip` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `useri`
-- 

INSERT INTO `useri` (`user`, `password`, `uid`, `email`, `dob`, `signupdate`, `lastlogin`, `picurl`, `firstname`, `surname`, `signupstring`, `data`, `ip`) VALUES 
('x_rob', '098f6bcd4621d373cade4e832627b4f6', '1', 'robert.barry@gmail.com', '05/02/1992', '01/07/07', '', '', 'Rob', 'Barry', 'true', '20073146070071001647024118', '127.0.0.1'),
('test', '098f6bcd4621d373cade4e832627b4f6', '2', 'test@test.test', '01/01/1991', '01/07/07', '', '', 'test', 'test', 'true', '20073459070071001582010312', '127.0.0.1');

