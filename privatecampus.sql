-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2024 at 01:00 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `privatecampus`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_code` varchar(10) NOT NULL,
  `course_description` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `course_code`, `course_description`) VALUES
(1, 'Computer Science 101', 'CS101', 'Computer Science 101 is an introductory course that provides students with the fundamental concepts and skills in computer science. Topics covered include programming, algorithms, data structures, and software development. This course serves as the foundation for further studies in computer science.'),
(2, 'Mathematics 201', 'MATH201', 'Mathematics 201 is an advanced course in calculus and analytical geometry. This course explores the fundamental principles of mathematical analysis, focusing on topics such as limits, derivatives, integrals, and their applications in various fields, including physics, engineering, and economics. Students will delve into the mathematical foundations of curves, vectors, and equations, gaining a deep understanding of these essential mathematical concepts. With an emphasis on problem-solving and critical thinking, Mathematics 201 equips students with the skills necessary to tackle complex mathematical challenges. This course is designed for students seeking a solid mathematical background for academic and professional pursuits in the sciences, engineering, or mathematics-related fields. Join us in this mathematical journey and discover the beauty and power of calculus and analytical geometry!'),
(3, 'English Literature 301', 'ENGL301', 'English Literature 301 is a comprehensive course that delves into the world of literary analysis and criticism. Students will explore various genres and literary periods, developing critical thinking and analytical skills. The course covers famous literary works, authors, and literary movements, providing a deeper understanding of English literature.'),
(4, 'History 401', 'HIST401', 'History 401 is a fascinating journey through world history, from ancient civilizations to modern times. Students will explore key historical events, figures, and cultural developments. This course provides valuable insights into the forces that have shaped our world and societies.'),
(5, 'Physics 501', 'PHYS501', 'Physics 501 offers an in-depth exploration of classical mechanics, covering principles like motion, forces, energy, and momentum. Students will engage in practical experiments and problem-solving exercises, gaining a profound understanding of the laws governing physical systems.'),
(6, 'Chemistry 601', 'CHEM601', 'Chemistry 601 is an advanced course in organic chemistry. Students will study the structure, properties, and reactions of organic compounds. This course provides a solid foundation for understanding chemical processes in life sciences and industry.'),
(7, 'Biology 701', 'BIOL701', 'Biology 701 is an in-depth study of cell biology, exploring the structure and functions of cells. Students will dive into the world of molecular biology and genetics, gaining insights into the building blocks of life.'),
(8, 'Economics 801', 'ECON801', 'Economics 801 is a comprehensive introduction to microeconomics. This course covers topics such as supply and demand, market structures, and economic decision-making. Students will analyze economic issues and gain a better understanding of how markets function.'),
(9, 'Psychology 901', 'PSYCH901', 'Psychology 901 is a foundational course that introduces students to the field of psychology. Topics include human behavior, cognition, mental processes, and the biological basis of behavior. This course offers insights into the human mind and behavior.'),
(10, 'Sociology 101', 'SOCIO101', 'Sociology 101 provides an introduction to the field of sociology. Students will explore social institutions, cultural norms, and human behavior in different societies. This course fosters a sociological perspective on social issues and interactions.');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `staff_username` varchar(50) NOT NULL,
  `staff_password` varchar(255) NOT NULL,
  `staff_name` varchar(255) NOT NULL,
  `staff_role` varchar(255) NOT NULL,
  `department` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_username`, `staff_password`, `staff_name`, `staff_role`, `department`) VALUES
(2, 'maheshstaff', '$2y$10$zaqtUPWGctDneEm9myFhCuSTQqlXN2jSAPM6NW9/IHmVk5fpuFPH6', 'Mahesh Jayasuriya', 'IT Admin', 'IT Unit');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `student_nic` varchar(12) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `student_username` varchar(50) NOT NULL,
  `student_password` varchar(255) NOT NULL,
  `student_address` varchar(255) NOT NULL,
  `student_telno` varchar(15) NOT NULL,
  `course_id` int(11) NOT NULL,
  `registration_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `student_nic`, `student_name`, `student_username`, `student_password`, `student_address`, `student_telno`, `course_id`, `registration_date`) VALUES
(3, '198529105200', 'Dhanushka ', 'dhanushka', '$2y$10$vQDaftVQcWFg6IzimFTm8ub2B3dn.rjxu0OdzBng3XcSEzUT0Ggse', '123,Main Street, Piliyandala', '0776003888', 1, '2023-10-10 12:06:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD UNIQUE KEY `staff_username` (`staff_username`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `student_username` (`student_username`),
  ADD KEY `course_id` (`course_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
