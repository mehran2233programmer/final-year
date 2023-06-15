-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2022 at 01:37 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final_year_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(255) NOT NULL,
  `category_title` text NOT NULL,
  `category_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_title`, `category_description`) VALUES
(1, 'Electrician', 'akjklajdlkasjkd'),
(5, 'Plumber', 'we are giving services of plumbing'),
(8, 'Electrician', 'Electric Works'),
(9, 'Cable Operator', ''),
(10, 'Maintanance', 'House maintaining works'),
(11, 'Carousel1', 'Testing the card'),
(12, 'Carousel2', 'Just testing bro');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(255) NOT NULL,
  `feedback` varchar(255) NOT NULL,
  `rating` int(255) NOT NULL,
  `feedback_resident_id` int(255) NOT NULL,
  `feedback_category_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `feedback`, `rating`, `feedback_resident_id`, `feedback_category_id`) VALUES
(102, 'This site is amazing', 5, 17, 1),
(103, 'this site doing good work', 5, 17, 8),
(104, 'this site doing good work', 5, 17, 8),
(105, 'im here for you', 5, 17, 8),
(106, 'ilove you', 5, 17, 5),
(107, 'i love that', 5, 16, 5),
(108, 'Electrician is mazing', 5, 16, 9),
(109, 'hi', 2, 1, 8),
(110, 'this site is amazing', 5, 17, 8),
(111, 'hi hello', 4, 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(255) NOT NULL,
  `order_date` date NOT NULL,
  `order_time` time NOT NULL,
  `order_problem` varchar(255) NOT NULL,
  `order_resident_id` int(255) NOT NULL,
  `order_category_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `order_time`, `order_problem`, `order_resident_id`, `order_category_id`) VALUES
(21, '2022-12-08', '01:11:00', 'aaaaaaaaaaaa', 16, 8),
(22, '2022-12-15', '01:13:00', 'wwwwwwwwwwww', 16, 8),
(24, '2022-12-20', '03:40:00', 'i have problem in tv', 17, 8),
(25, '2022-12-01', '03:11:00', 'aaaa', 17, 5);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `resident_id` int(255) NOT NULL,
  `resident_fname` varchar(255) NOT NULL,
  `resident_lname` varchar(255) NOT NULL,
  `resident_email` varchar(255) NOT NULL,
  `resident_gender` varchar(255) NOT NULL,
  `resident_mobile_number` varchar(255) NOT NULL,
  `resident_house_no` int(255) NOT NULL,
  `resident_payment` varchar(255) NOT NULL,
  `resident_password` varchar(255) NOT NULL,
  `role` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`resident_id`, `resident_fname`, `resident_lname`, `resident_email`, `resident_gender`, `resident_mobile_number`, `resident_house_no`, `resident_payment`, `resident_password`, `role`) VALUES
(15, 'zuneira', 'rajput', 'zuni@gmail.com', 'Female', '0312452145', 1, 'Monthly', '$2y$10$xX7wKV4EPFUD8SeCSH2vPu.aXUnremc5YlzWiaCF/5G84OM3U6frq', 'resident'),
(16, 'arslan', 'shan', 'arslan@gmail.com', 'Male', '03124569854', 2, 'Monthly', '$2y$10$9kdf/7jOazWSt71XWL7.ZuTFHkJ2yUkVNP6mnLZiYk/fweIMMSIZe', 'resident'),
(17, 'furqan', 'ansari', 'furkan@gmail.com', 'Male', '03125469658', 5, 'Weekly', '$2y$10$kEkDDxCDrZn93EATADwD8.glYBKHsQv6ys2GJB1MrRWEksR0jTN8e', 'resident'),
(18, 'sumaira', 'ansari', 'sumaira@gmail.com', 'Female', '031256485695', 9, 'Weekly', '$2y$10$z9PBdUVleC2jfWnyHDaI6O4UyQNkgfWPV25vWBWCI21yTPkFF82gW', 'resident'),
(19, 'mehvish', 'ansari', 'mehvish@gmail.com', 'Female', '03254695785', 4, 'Monthly', '$2y$10$Dr522CBwuY260wVaztkz8OvBROz69HHSHi9sk7panLf/3CEmmd.0u', 'resident'),
(20, 'gurriya', 'ansari', 'gurriya@gmail.com', 'Female', '031546584555', 4, 'Monthly', '$2y$10$zgTACONhB1KTI8ZGHIyJ7OA6M3zO8VTRPdpvnJo.vUGeLzBrDKhkW', 'resident'),
(21, 'muneeb', 'ansari', 'muneeb@gmail.com', 'Male', '03125469587', 5, 'Weekly', '$2y$10$EVpsrHPrIDGFVJST5uvzAeNiyphTuFAS3CFE22McIeiYUXfL.RXmG', 'resident');

-- --------------------------------------------------------

--
-- Table structure for table `residents`
--

CREATE TABLE `residents` (
  `resident_id` int(11) NOT NULL,
  `resident_fname` varchar(255) NOT NULL,
  `resident_lname` varchar(255) NOT NULL,
  `resident_email` varchar(255) NOT NULL,
  `resident_gender` varchar(255) NOT NULL,
  `resident_mobile_number` varchar(255) NOT NULL,
  `resident_house_no` int(255) NOT NULL,
  `resident_payment` varchar(255) NOT NULL,
  `resident_password` varchar(255) NOT NULL,
  `role` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `residents`
--

INSERT INTO `residents` (`resident_id`, `resident_fname`, `resident_lname`, `resident_email`, `resident_gender`, `resident_mobile_number`, `resident_house_no`, `resident_payment`, `resident_password`, `role`) VALUES
(1, 'Mehran', 'Akhtar', 'mehranakhtar2233@gmail.com', 'male', '03047137407', 25, 'weekly', '1234', ''),
(2, 'mujahid', 'ismael', 'mujahid@gaml.com', 'male', '0314569854', 23, 'monthly', '1234', ''),
(3, 'yasir', 'ali', 'yasir@maj', 'female', '0315648765', 55, 'monthly', '1234', ''),
(4, 'afaq', 'mahar', 'afaq@ksldl', 'male', '0322546854', 4, 'monthly', '1234', ''),
(5, 'shoaib', 'waryam', 'shoaib@msdfks', 'male', '03122546547655', 12, 'monthly', '1234', ''),
(6, 'sdsdssdssdsdsdsdsdsdssddsds', 'sjdjkashd', 'dasjkhdjksa@sajdka', 'Male', '03215', 2, 'Monthly', '$2y$10$Q61UWzoQBftdrkjZuZAlruvAFE7y6CcBYrPxLbP.Q.BiA61kCGoHC', 'resident'),
(7, 'talha', 'shafique', 'talha@dss', 'male', '031245632521', 5, 'weekly', '$2y$10$3whi2TEq177A3nhAOrshCOMzWqu0qeHER1af2UAfsEfxsHuuNcexe', ''),
(8, 'Mehran', 'Akhtar', 'mehranakhtar2233@gmail.com', 'Male', '03047137407', 3, 'monthly', '$2y$10$QzIr..sXB8qFgvyk3VyYG.9bZObY81L6bNLs6JKDG2pPH3lFdoVDi', ''),
(9, 'ayesha', 'rajput', 'mehran12@gmail.com', 'Female', '0312546954', 3, 'weekly', '$2y$10$pHHrtNnwYJJXEROL39bXouxHenzHiPp2Gv3KW47hIAWogExz9Wm4a', ''),
(10, 'Mehran', 'Akhtar', 'bc190201541@vu.edu.pk', 'Male', '03166219352', 4, 'Monthly', '$2y$10$PV0Jc0SFWeZORu4w3bZeHOsdBRNzwNdjy2W/VE0Aty0oMwg5yjIXy', 'resident'),
(11, 'mehran', 'Akhtar', 'mehranakhtar2233@gmail.com', 'Male', '03047137407', 2, 'Weekly', '$2y$10$/7bdhgRSoLF/Hl9y3R9r.uuRO0hQSiWUgJSuCK3It.ATrjOykpfx6', 'resident'),
(12, 'akjdklakl', 'ksdklalk', 'slakjldkjakls', 'male', '0343', 12, 'monthly', '123', ''),
(13, 'Mehran', 'Akhtar', 'meh33@gmail.com', 'Male', '03044444', 4, 'Monthly', '$2y$10$4V8BPZiIePP9Rc4S.ifMYeckAL2OzEi4cDuB1b41jhdYj/6vCGYdK', 'resident'),
(14, 'Mehran', 'Akhtar', 'me@', 'Male', '031122', 4, 'Monthly', '$2y$10$qf6gfzyiHsApED0jEYDW4O4cIad6eXGOmiXZtpub/QNvx/1j/Emn.', 'resident'),
(15, 'Mehran', 'Akhtar', 'mehranakhtar2233@gmil.com', 'Male', '03047137407', 4, 'Monthly', '$2y$10$NLEWhCf2qNWKqJcD09kq2umt.E0/a./CK4Qhyok5b1yq.fWJ47H5i', 'resident'),
(16, 'Rehan', 'Akhtar', 'meh@22.gmail', 'Male', '12', 2525, 'Monthly', '$2y$10$agYgnqZmFSnRLbHTZr0bGOt8JZxqCnpsXi0rGtZYtgSrlcNbToICS', 'resident'),
(17, 'Mehran', 'Akhtar', 'me@gmail.com', 'Male', '00000000', 12, 'Monthly', '$2y$10$FoF6Z/mzDuWFItKfPFpugOMQ3DGa5u17u2ga0HxtpS0qQi0xSX2H.', 'resident');

-- --------------------------------------------------------

--
-- Table structure for table `workers`
--

CREATE TABLE `workers` (
  `worker_id` int(255) NOT NULL,
  `worker_fname` varchar(255) NOT NULL,
  `worker_lname` varchar(255) NOT NULL,
  `worker_email` varchar(255) NOT NULL,
  `worker_gender` varchar(255) NOT NULL,
  `worker_mobile_number` varchar(255) NOT NULL,
  `worker_category` varchar(255) NOT NULL,
  `worker_password` varchar(255) NOT NULL,
  `role` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `workers`
--

INSERT INTO `workers` (`worker_id`, `worker_fname`, `worker_lname`, `worker_email`, `worker_gender`, `worker_mobile_number`, `worker_category`, `worker_password`, `role`) VALUES
(7, 'Mehran', 'Akhtar', 'mehranakhtar2233@gmail.com', 'Male', '0314531251', 'Plumber', '$2y$10$/2rllQyyCvsi6LWuRwsdsOHkbBBO3Z2wT16iG25qQ2Zly5YEl9CHS', 'worker'),
(9, 'Yasir', 'Ali', 'yasirali@2214', 'Female', '0314531251', 'Plumber', '$2y$10$v5vZ2fL0d.aY8Mfc9sk3CedGid/xcN57eGaiL7iqhFcak2wjT0Ci.', 'worker'),
(10, 'Mujahid', 'Ismail', 'mujahidismail3344@gmail', 'Male', '031165656', 'Electrician', '$2y$10$4j.3riii9v6jix11sWJZnOIFEBd1.8MpVYa2zW6Snf2AVLhsnFtIa', 'worker'),
(11, 'Ayesha', 'rajput', 'ayesha22@gmail.com', 'Female', '0000000000000', 'Plumber', '$2y$10$if2S/Enb7PdV9W5G.z6Ss.RXLgiFWtRG9oW7QbGsGLSoBH0Li40yS', 'worker'),
(12, 'talha', 'ansari', 'talha@gmail.com', 'Male', '030121456954', 'Plumber', '$2y$10$LgTHv/6B7Wjv/DdzKIM14O4NvkC0OGpJ.L9rXYqXcvLp8AZ7cDeOS', 'worker'),
(13, 'farhan', 'sarwar', 'farhan@gmail.com', 'Male', '03125469584', 'Cable Operator', '$2y$10$nQSkm4PC1Bo6s9c5vzIJOutlRW1P8hYW73QfOb9d7T4a6GwA1FftO', 'worker');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`resident_id`);

--
-- Indexes for table `residents`
--
ALTER TABLE `residents`
  ADD PRIMARY KEY (`resident_id`);

--
-- Indexes for table `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`worker_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `resident_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `residents`
--
ALTER TABLE `residents`
  MODIFY `resident_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `workers`
--
ALTER TABLE `workers`
  MODIFY `worker_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
