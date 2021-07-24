-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2021 at 06:08 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mytecc_sales_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `ord`
--

CREATE TABLE `ord` (
  `ordId` int(11) NOT NULL,
  `size` tinytext NOT NULL,
  `quantity` int(11) NOT NULL,
  `orderCode` varchar(128) NOT NULL,
  `productCode` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ord`
--

INSERT INTO `ord` (`ordId`, `size`, `quantity`, `orderCode`, `productCode`) VALUES
(1, 'S', 1, '#00001', 'CRPT01'),
(2, 'S', 1, '#00001', 'TSHT01');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderCode` varchar(128) NOT NULL,
  `orderDate` date NOT NULL,
  `orderTime` time NOT NULL,
  `orderPrice` decimal(10,2) NOT NULL,
  `usersId` int(11) NOT NULL,
  `statusId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderCode`, `orderDate`, `orderTime`, `orderPrice`, `usersId`, `statusId`) VALUES
('#00001', '2021-07-05', '09:56:00', '85.00', 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productCode` varchar(128) NOT NULL,
  `productName` varchar(128) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `normalPrice` decimal(10,2) DEFAULT NULL,
  `productImg` varchar(128) NOT NULL,
  `productDisc` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productCode`, `productName`, `price`, `normalPrice`, `productImg`, `productDisc`) VALUES
('CRPT01', 'Corporate Shirt Men', '45.00', '50.00', '../assets/img/corporate.png', 'Poly-Cotton, Shirt Collar, Short Sleeve, Formal'),
('CRPT02', 'Corporate Shirt Women', '55.00', '60.00', '../assets/img/corporate2.png', 'Poly-Cotton, Shirt Collar, Long Sleeve, Formal'),
('LNYD01', 'MYTECC Lanyard 2020 Edition', '12.00', '18.00', '../assets/img/lanyard.png', 'Polyester, Size: 30mm Width, Design by MYTECC Member'),
('TSHT01', 'MYTECC T-Shirt 2019 Edition', '35.00', '40.00', '../assets/img/tshirt.png', 'Jersey Fabric, V-Neck Collar, Short Sleeve, Design by MYTECC Member');

-- --------------------------------------------------------

--
-- Table structure for table `pwdreset`
--

CREATE TABLE `pwdreset` (
  `pwdResetId` int(11) NOT NULL,
  `pwdResetEmail` text NOT NULL,
  `pwdResetSelector` text NOT NULL,
  `pwdResetToken` longtext NOT NULL,
  `pwdResetExpires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `stateId` int(11) NOT NULL,
  `stateName` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`stateId`, `stateName`) VALUES
(1, 'Johor'),
(2, 'Kedah'),
(3, 'Kelantan'),
(4, 'Melaka'),
(5, 'Negeri Sembilan'),
(6, 'Pahang'),
(7, 'Penang'),
(8, 'Perak'),
(9, 'Perlis'),
(10, 'Selangor'),
(11, 'Terengganu'),
(12, 'Sabah'),
(13, 'Sarawak'),
(14, 'Kuala Lumpur'),
(15, 'Labuan'),
(16, 'Putrajaya'),
(17, 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `statusId` int(11) NOT NULL,
  `statusName` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`statusId`, `statusName`) VALUES
(1, 'pending'),
(2, 'processing'),
(3, 'delivered'),
(4, 'failed');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `usersId` int(11) NOT NULL,
  `usersName` varchar(128) NOT NULL,
  `usersEmail` varchar(128) NOT NULL,
  `usersUid` varchar(128) NOT NULL,
  `usersPwd` varchar(128) NOT NULL,
  `user_types` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usersId`, `usersName`, `usersEmail`, `usersUid`, `usersPwd`, `user_types`) VALUES
(1, 'Muhamad Syahir Zakwan bin Mohd Yusof', 'syahirzakwanyusof@gmail.com', 'syahir@admin1', '$2y$10$eizEYvdKvoTF/1HXU.vyaePZ6hrH2f0R0w2/UhRx3fmTdWBHF4yYG', 1),
(2, 'Muhamad Syahir Zakwan bin Mohd Yusof', 'syahirzakwan.education@gmail.com', 'syhrzkwn', '$2y$10$t2gFDeZdZr6iNBPeesvJ7.SQtuED2AGiW7ZubayL.idPV5E5WKafW', 2),
(3, 'Johan Nazrin bin Rosli', 'johanazrin310@gmail.com', 'johanNazrin', '$2y$10$UpIF9/VA0LdO7qQ2L8O38.XVzuk8/lLinUx1WaVsi7lvQ1pK5IlBa', 2),
(27, 'Khairul Afnan bin Ahmad Zamakhshari', 'kaaz010201@gmail.com', 'khairulAfnan', '$2y$10$iv7.GebTldbzRbD96FgHmOe746pJvoqmLncIcA7LmPG5WVBN6OMKG', 2);

-- --------------------------------------------------------

--
-- Table structure for table `userscontact`
--

CREATE TABLE `userscontact` (
  `usersContactId` int(11) NOT NULL,
  `address` varchar(128) NOT NULL,
  `postcode` int(11) NOT NULL,
  `city` varchar(128) NOT NULL,
  `phoneNum` varchar(128) NOT NULL,
  `stateId` int(11) NOT NULL,
  `usersId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userscontact`
--

INSERT INTO `userscontact` (`usersContactId`, `address`, `postcode`, `city`, `phoneNum`, `stateId`, `usersId`) VALUES
(1, '38 Jalan Cassia 1, Bandar Botanic', 41200, 'Klang', '0196021939', 10, 1),
(2, '38 Jalan Cassia 1, Bandar Botanic', 41200, 'Klang', '0196021939', 10, 2),
(3, '16 Jalan DC 3/21, Desa Coalfields', 47000, 'Sungai Buloh', '0173857225', 10, 3),
(24, '70, Jalan Dendang 21, Taman Telok', 42500, 'Telok Panglima Garang', '0196043371', 10, 27);

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`type_id`, `type_name`) VALUES
(1, 'Admin'),
(2, 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ord`
--
ALTER TABLE `ord`
  ADD PRIMARY KEY (`ordId`),
  ADD KEY `ord_ibfk_1` (`orderCode`),
  ADD KEY `ord_ibfk_2` (`productCode`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderCode`),
  ADD KEY `orders_ibfk_1` (`statusId`),
  ADD KEY `orders_ibfk_2` (`usersId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productCode`);

--
-- Indexes for table `pwdreset`
--
ALTER TABLE `pwdreset`
  ADD PRIMARY KEY (`pwdResetId`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`stateId`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`statusId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usersId`),
  ADD KEY `type_id` (`user_types`);

--
-- Indexes for table `userscontact`
--
ALTER TABLE `userscontact`
  ADD PRIMARY KEY (`usersContactId`),
  ADD KEY `stateId` (`stateId`),
  ADD KEY `userscontact_ibfk_2` (`usersId`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ord`
--
ALTER TABLE `ord`
  MODIFY `ordId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `pwdResetId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `stateId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `statusId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `userscontact`
--
ALTER TABLE `userscontact`
  MODIFY `usersContactId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ord`
--
ALTER TABLE `ord`
  ADD CONSTRAINT `ord_ibfk_1` FOREIGN KEY (`orderCode`) REFERENCES `orders` (`orderCode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ord_ibfk_2` FOREIGN KEY (`productCode`) REFERENCES `product` (`productCode`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`statusId`) REFERENCES `status` (`statusId`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`usersId`) REFERENCES `users` (`usersId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_types`) REFERENCES `user_types` (`type_id`);

--
-- Constraints for table `userscontact`
--
ALTER TABLE `userscontact`
  ADD CONSTRAINT `userscontact_ibfk_1` FOREIGN KEY (`stateId`) REFERENCES `state` (`stateId`),
  ADD CONSTRAINT `userscontact_ibfk_2` FOREIGN KEY (`usersId`) REFERENCES `users` (`usersId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
