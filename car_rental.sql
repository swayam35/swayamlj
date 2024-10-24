-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2024 at 03:39 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(3) NOT NULL,
  `car_name` varchar(30) NOT NULL,
  `brand_id` int(3) NOT NULL,
  `type_id` int(3) NOT NULL,
  `color` varchar(20) NOT NULL,
  `model` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `price_per_day` int(11) NOT NULL,
  `car_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `car_name`, `brand_id`, `type_id`, `color`, `model`, `description`, `price_per_day`, `car_image`) VALUES
(1, 'Porsche Boxster', 6, 4, 'Red', '2017', 'The 718 models were made for the sport of it. They are mid-engined roadsters that unite the sporting', 12650, '18967_porsche.jpg'),
(2, 'Audi RS5', 1, 4, 'Red', '2018', 'The Audi RS 5 Sportback is more than a sporty vehicle: experience premium functionality, comfort and', 13775, '6514_rs5.jpg'),
(3, 'Mercedes-Benz CLS', 4, 4, 'Blue', '2019', 'The C257 CLS is the third model and was previously available only as a four-door coupe and in rear-w', 14150, '27180_CLS-1.jpg'),
(4, 'Audi Q7', 1, 6, 'Blue', '2022', 'Distinctive new exterior styling, futuristic interior design, more powerful engines, greater levels', 18680, '2376_q7.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `car_brands`
--

CREATE TABLE `car_brands` (
  `brand_id` int(3) NOT NULL,
  `brand_name` varchar(50) NOT NULL,
  `brand_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `car_brands`
--

INSERT INTO `car_brands` (`brand_id`, `brand_name`, `brand_image`) VALUES
(1, 'Audi', '61386_about-img.jpg'),
(2, 'BMW', 'bmw-3-series-sedan.jpg'),
(3, 'Lexus', '2016-Lexus-RX-350-BM-01.jpg'),
(4, 'Mercedes Benz', 'Mercedes-C-Class-Estate-1.jpg'),
(5, 'MINI', '2016-MINI-Cooper-S-Clubman-ALL4.jpg'),
(6, 'Porsche', 'P14_0596_a4_rgb-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `car_types`
--

CREATE TABLE `car_types` (
  `type_id` int(3) NOT NULL,
  `type_label` varchar(50) NOT NULL,
  `type_description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `car_types`
--

INSERT INTO `car_types` (`type_id`, `type_label`, `type_description`) VALUES
(1, 'Sedan', 'A sedan has four doors and a traditional trunk.'),
(4, 'Coupe', 'A coupe has historically been considered a two-door car with a trunk and a solid roof.');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(10) NOT NULL,
  `full_name` varchar(30) NOT NULL,
  `client_email` varchar(100) NOT NULL,
  `client_phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `full_name`, `client_email`, `client_phone`) VALUES
(5, 'John Doe', 'john_doe@gmail.com', '0123456789'),
(11, 'abhi', 'abhi@gmail.com', '1234567899');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(7, 'Sample Name', 'sample@example.com', 'Sample Subject', 'Sample Message', '2024-09-29 07:57:45');

-- --------------------------------------------------------

--
-- Table structure for table `problems`
--

CREATE TABLE `problems` (
  `id` int(112) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` int(255) NOT NULL,
  `problem_type` int(255) NOT NULL,
  `message` int(255) NOT NULL,
  `created_at` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `problems`
--

INSERT INTO `problems` (`id`, `name`, `email`, `problem_type`, `message`, `created_at`) VALUES
(1, 'John Doe', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `profile_picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `username`, `email`, `phone`, `profile_picture`) VALUES
(1, 'admin', 'Swayam.amin1011@gmail.com', '08866208487', '65397_admin.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(10) NOT NULL,
  `client_id` int(10) NOT NULL,
  `car_id` int(3) NOT NULL,
  `pickup_date` date NOT NULL,
  `return_date` date NOT NULL,
  `pickup_location` varchar(50) NOT NULL,
  `return_location` varchar(50) NOT NULL,
  `canceled` tinyint(1) NOT NULL DEFAULT 0,
  `cancellation_reason` varchar(250) DEFAULT NULL,
  `status` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `client_id`, `car_id`, `pickup_date`, `return_date`, `pickup_location`, `return_location`, `canceled`, `cancellation_reason`, `status`) VALUES
(1, 1, 1, '2021-05-11', '2021-05-17', 'Agadir', 'Agadir', 0, NULL, 0),
(2, 2, 3, '2021-04-30', '2021-05-06', 'Agadir', 'Agadir', 0, NULL, 0),
(3, 3, 4, '2021-04-30', '2021-05-06', 'Agadir', 'Agadir', 1, 'Changed my mind! Sorry', 0),
(4, 4, 4, '2021-04-29', '2021-05-02', 'Casablanca', 'Agadir', 0, NULL, 0),
(5, 5, 4, '2024-03-02', '2024-03-05', 'Paris', 'Paris', 0, NULL, 0),
(26, 1, 1, '2021-05-11', '2021-05-17', 'Agadir', 'Agadir', 0, NULL, 0),
(27, 2, 2, '2021-04-30', '2021-05-06', 'Agadir', 'Agadir', 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `created_at`) VALUES
(1, 'aa@gmail.com', '2024-09-22 15:15:30'),
(2, 'as@gmail.com', '2024-09-22 15:16:04'),
(3, 'Swayam.amin1011@gmail.com', '2024-09-22 15:21:04'),
(4, 'a@gmail.com', '2024-09-22 15:28:04'),
(5, 'sdwt.911@gmail.com', '2024-09-24 10:44:24'),
(6, 'johnsmith@gmail.com', '2024-09-26 07:50:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `group_id` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_email`, `full_name`, `password`, `group_id`) VALUES
(1, 'admin', 'admin.admin@gmail.com', 'Admin Admin', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_brands`
--
ALTER TABLE `car_brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `car_types`
--
ALTER TABLE `car_types`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `problems`
--
ALTER TABLE `problems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `car_brands`
--
ALTER TABLE `car_brands`
  MODIFY `brand_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `car_types`
--
ALTER TABLE `car_types`
  MODIFY `type_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `problems`
--
ALTER TABLE `problems`
  MODIFY `id` int(112) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
